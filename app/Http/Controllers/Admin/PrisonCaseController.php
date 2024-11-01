<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrisonCase;
use App\Http\Requests\PrisonCaseStoreRequest;
use App\Http\Requests\PrisonCaseUpdateRequest;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\Prisoner;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;

class PrisonCaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public static function middleware(): array
    {
        return [
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('index prisoncase'), only:['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('show prisoncase'), only:['show']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('create prisoncase'), only:['create', 'store']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('edit prisoncase'), only:['edit', 'update']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete prisoncase'), only:['delete', 'destroy']),

        ];
    }

    public function index(Request $request)
    {
        $query = PrisonCase::with('prisoners');

        // Filter by search
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('zaakreden', 'like', "%{$search}%")
            ->orWhere('id', 'like', "%{$search}%");

        }

        if ($request->has('location_id')) {
            $location_id = $request->input('location_id');
            $query->where('location_id', $location_id);
        }

        $cases = $query->paginate(10);
        $locations = Location::all();

        return view('admin.prisoncases.indexcase', compact('cases', 'locations'));
    }

    public function filterByLocation(Location $location)
    {
        $cases = PrisonCase::where('location_id', $location->id)->paginate(10);
        $locations = Location::all();

        return view('admin.prisoncases.indexcase', compact('cases', 'locations'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prisoners = Prisoner::whereNull('zaak_id')->get();
        $locations = Location::all();

        return view('admin.prisoncases.createcase', compact('prisoners', 'locations'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PrisonCaseStoreRequest $request): RedirectResponse
    {
           // Handle file upload if a PDF file is provided
           $pdfPath = null;
           if ($request->hasFile('verslag_pdf')) {
               $pdfPath = $request->file('verslag_pdf')->store('verslagen', 'public');
           }


            // Create a new instance of PrisonCase
        $prisonCase = new PrisonCase();
        $prisonCase->zaakreden = $request->zaakreden;
        $prisonCase->location_id = $request->location_id;
        $prisonCase->verslag_pdf_path = $pdfPath;


        // Save the prison case
        $prisonCase->save();

        // Get the selected prisoners' IDs from the request
        $prisonerIds = $request->input('prisoners');

        // Update the zaak_id for each selected prisoner
        // Prisoner::whereIn('id', $prisonerIds)->update(['zaak_id' => $prisonCase->id]);


        $prisonCase->prisoners()->attach($prisonerIds);

        // Redirect or return a response
        return redirect()->route('prisoncases.index')->with('status', 'Prison case created successfully.');
    }

   /**
     * Display the specified resource.
     * @param PrisonCase $projects
     * @return View
     */

    //  public function show($id)
    //  {
    //      // Retrieve the PrisonCase by its ID
    //      $prisonCase = PrisonCase::findOrFail($id);

    //      // Retrieve prisoners associated with this PrisonCase
    //      $prisoners = Prisoner::where('zaak_id', $prisonCase->id)->get();

    //      return view('admin.prisoncases.showcase', compact('prisonCase', 'prisoners'));
    //  }

    public function show($id)
    {
        // Retrieve the PrisonCase by its ID
        $prisonCase = PrisonCase::with('prisoners')->findOrFail($id);
        $locations = Location::all();

        return view('admin.prisoncases.showcase', compact('prisonCase', 'locations'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $prisonCase = PrisonCase::findOrFail($id);
        $prisoners = Prisoner::all(); // Get all prisoners for the selection
           // Fetch all locations
           $locations = Location::all();
        return view('admin.prisoncases.editcase', compact('prisonCase', 'prisoners', 'locations'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(PrisonCaseUpdateRequest $request, PrisonCase $prisonCase)
    {
        // Validate the request data
        $request->validate([
            'zaakreden' => 'required|string|max:255',
            'verslag_pdf' => 'nullable|file|mimes:pdf|max:2048',
            'prisoners' => 'array',
            'location_id' => 'integer',
        ]);

        if ($request->hasFile('verslag_pdf')) {
            $pdfPath = $request->file('verslag_pdf')->store('verslagen', 'public');
            $prisonCase->verslag_pdf_path = $pdfPath;
        }

        // Update prison case details
        $prisonCase->zaakreden = $request->zaakreden;
        $prisonCase->location_id = $request->location_id;
        $prisonCase->save();

        // Sync prisoners
        $prisonerIds = $request->input('prisoners', []);
        $prisonCase->prisoners()->sync($prisonerIds);

        return redirect()->route('prisoncases.index')->with('status', 'Prison case updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(PrisonCase $prisonCase): View
    {
        return view('admin.prisoncases.deletecase', ['prisonCase' => $prisonCase]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        // Find the prison case by ID
        $prisonCase = PrisonCase::findOrFail($id);

        // Delete the prison case
        $prisonCase->delete();

        return redirect()->route('prisoncases.index')->with('status', "Prison case deleted successfully.");
    }
}
