<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PrisonerStoreRequest;
use App\Http\Requests\PrisonerUpdateRequest;
use App\Models\Prisoner;
use App\Models\PrisonCase;
use App\Models\Location;
use App\Observers\PrisonerObserver;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PrisonerController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public static function middleware(): array
    {
        return [
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('index prisoner'), only:['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('show prisoner'), only:['show']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('create prisoner'), only:['create', 'store']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('edit prisoner'), only:['edit', 'update']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete prisoner'), only:['delete', 'destroy']),

        ];
    }

    public function transferToHistorie(Prisoner $prisoner)
    {
    $prisoner->moveToHistorie();

          // Trigger the observer to log the action
          $observer = new PrisonerObserver();
          $observer->movedToHistorie($prisoner);

    return redirect()->route('prisoners.index')->with('status', 'Prisoner moved to historie successfully.');
    }

    // public function index(Request $request)
    // {
    //     $query = Prisoner::with('prisonCases');

    //     if ($request->has('search')) {
    //         $search = $request->input('search');
    //         $query->where('name', 'like', "%{$search}%")
    //               ->orWhere('BSN_nummer', 'like', "%{$search}%");
    //     }

    //     $prisoners = $query->paginate(10); // Adjust the number as per your requirement

    //     return view('admin.prisoners.index', compact('prisoners'));
    // }

    public function index(Request $request)
    {
        $query = Prisoner::with('location');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('BSN_nummer', 'like', "%{$search}%");
        }

        if ($request->has('location_id')) {
            $location_id = $request->input('location_id');
            $query->where('location_id', $location_id);
        }

        $prisoners = $query->paginate(10);
        $locations = Location::all();

        return view('admin.prisoners.index', compact('prisoners', 'locations'));
    }

    public function filterByLocation(Location $location)
    {
        $prisoners = Prisoner::where('location_id', $location->id)->paginate(10);
        $locations = Location::all();

        return view('admin.prisoners.index', compact('prisoners', 'locations'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prisonCases = PrisonCase::all();
        $locations = Location::all();

        return view('admin.prisoners.createprisoner', compact('prisonCases', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PrisonerStoreRequest $request): RedirectResponse
    {

          // Handle file upload if an image is provided
    if ($request->hasFile('image')) {
        // Store the image in storage/app/public/images/prisoners directory
        $pasfotoPath = $request->file('image')->store('images/prisoners', 'public');
    } else {
        $pasfotoPath = null; // Set to null if no image is uploaded
    }

           // Handle file upload if a PDF file is provided
           $pdfPath = null;
           if ($request->hasFile('verslag_pdf')) {
               $pdfPath = $request->file('verslag_pdf')->store('verslagen', 'public');
           }

        // Create a new prisoner instance
        $prisoner = new Prisoner();
        $prisoner->name = $request->name;
        $prisoner->arrestatiereden = $request->arrestatiereden;
        $prisoner->BSN_nummer = $request->BSN_nummer;
        $prisoner->adres = $request->adres;
        $prisoner->woonplaats = $request->woonplaats;
        $prisoner->datumarrestatie = $request->datumarrestatie;
        $prisoner->cel_id = $request->cel_id;
        $prisoner->location_id = $request->location_id;
        $prisoner->insluitingsdatum = $request->insluitingsdatum;
        $prisoner->uitsluitingsdatum = $request->uitsluitingsdatum;
        $prisoner->maatschappelijke_aantekeningen = $request->maatschappelijke_aantekeningen;
        $prisoner->pasfoto = $pasfotoPath; // Save the image path
        $prisoner->verslag_pdf_path = $pdfPath; // Store the path of the uploaded PDF



        // Save the prisoner
        $prisoner->save();

        $prisoner->prisonCases()->attach($request->prison_cases);

        return redirect()->route('prisoners.index')->with('status', 'Prisoner added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prisoner $prisoner)
    {
        // dd($prisoner); // Debugging output

        // return view('admin.prisoners.showprisoner', ['prisoner' => $prisoner]);v

         // Eager load prisonCases for the single prisoner
         $prisoner->load('prisonCases');

         return view('admin.prisoners.showprisoner', ['prisoner' => $prisoner]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prisoner $prisoner)
    {
        // Fetch all prison cases
        $prisonCases = PrisonCase::all();

        // Fetch all locations
        $locations = Location::all();

        // Get the currently associated prison case IDs for the prisoner
        $currentPrisonCaseIds = $prisoner->prisonCases->pluck('id')->toArray();

        return view('admin.prisoners.editprisoner', compact('prisoner', 'prisonCases', 'locations', 'currentPrisonCaseIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Prisoner $prisoner): RedirectResponse
    // {
    //     // Validate the request
    //     $request->validate([
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Example rules for image upload
    //         'name' => 'required|string|max:100',
    //         'arrestatiereden' => 'required|string|max:100',
    //         'BSN_nummer' => 'required|integer',
    //         'adres' => 'required|string|max:100',
    //         'woonplaats' => 'required|string|max:100',
    //         'datumarrestatie' => 'required|date',
    //         'cel_id' => 'nullable|integer',
    //         'insluitingsdatum' => 'required|date',
    //         'uitsluitingsdatum' => 'required|date',
    //         'maatschappelijke_aantekeningen' => 'required|string',
    //         'location_id' => 'integer',
    //         'prison_cases' => 'nullable|array',
    //         'prison_cases.*' => 'integer|exists:prison_cases,id',
    //     ]);

    //     // Update the prisoner details
    //     $prisoner->update($request->except('prison_cases'));

    //     // Sync the prison cases
    //     $prisoner->prisonCases()->sync($request->input('prison_cases', []));

    //     return redirect()->route('prisoners.index')->with('status', "Prisoner $prisoner->name updated successfully.");
    // }

    public function update(Request $request, Prisoner $prisoner): RedirectResponse
    {
        // Validate the request
        $request->validate([
            'pasfoto' => 'nullable|image', // Example rules for image upload
            'name' => 'required|string|max:100',
            'arrestatiereden' => 'required|string|max:100',
            'BSN_nummer' => 'required|integer',
            'adres' => 'required|string|max:100',
            'woonplaats' => 'required|string|max:100',
            'datumarrestatie' => 'required|date',
            'cel_id' => 'nullable|integer',
            'insluitingsdatum' => 'required|date',
            'uitsluitingsdatum' => 'required|date',
            'maatschappelijke_aantekeningen' => 'required|string',
            'location_id' => 'integer',
            'prison_cases' => 'nullable|array',
            'prison_cases.*' => 'integer|exists:prison_cases,id',
            'verslag_pdf' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($prisoner->pasfoto) {
                Storage::disk('public')->delete($prisoner->pasfoto);
            }

            // Store new image in storage/app/public/images/prisoners directory
            $imagePath = $request->file('image')->store('images/prisoners', 'public');

            // Update image path in database
            $prisoner->pasfoto = $imagePath;
        }
           // Handle file upload if a new PDF file is provided
           if ($request->hasFile('verslag_pdf')) {
            $pdfPath = $request->file('verslag_pdf')->store('verslagen', 'public');
            $prisoner->verslag_pdf_path = $pdfPath;
        }


        // Update the prisoner details
        $prisoner->update($request->except(['prison_cases', 'image']));

        // Sync the prison cases
        $prisoner->prisonCases()->sync($request->input('prison_cases', []));

        return redirect()->route('prisoners.index')->with('status', "Prisoner $prisoner->name updated successfully.");
    }


    public function delete(Prisoner $prisoner): View
    {
        return view('admin.prisoners.deleteprisoner', ['prisoner' => $prisoner]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prisoner $prisoner): RedirectResponse
    {
        $prisoner->delete();
        return to_route(route: 'prisoners.index')->with('status', "prisoner $prisoner->name deleted successfully");
    }
}
