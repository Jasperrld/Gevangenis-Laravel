<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Historie;
use App\Models\Location;
use Illuminate\Http\Request;

use App\Http\Requests\StoreHistorieRequest;
use App\Http\Requests\UpdateHistorieRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Routing\Controllers\Middleware;
class HistorieController extends Controller
{
    public function index(Request $request): View
    {
        $query = Historie::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('BSN_nummer', 'like', "%{$search}%");
        }

        if ($request->has('location_id')) {
            $location_id = $request->input('location_id');
            $query->where('location_id', $location_id);
        }

        $histories = $query->paginate(10);
        $locations = Location::all();

        return view('admin.histories.index', compact('histories', 'locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $locations = Location::all();

        return view('admin.histories.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHistorieRequest $request): RedirectResponse
    {
        // Create a new historie instance
        $historie = new Historie();
        $historie->fill($request->all());
        $historie->zaak_id = json_encode($request->input('zaak_id'));
        $historie->save();

        return redirect()->route('histories.index')->with('status', 'Historie added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Historie $historie): View
    {
        return view('admin.histories.show', compact('historie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Historie $historie): View
    {
        $locations = Location::all();

        return view('admin.histories.edit', compact('historie', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHistorieRequest $request, Historie $historie): RedirectResponse
    {
        $historie->fill($request->all());
        $historie->zaak_id = json_encode($request->input('zaak_id'));
        $historie->save();

        return redirect()->route('histories.index')->with('status', "Historie $historie->name updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Historie $historie): RedirectResponse
    {
        $historie->delete();
        return redirect()->route('histories.index')->with('status', "Historie $historie->name deleted successfully.");
    }

    /**
     * Show the form for confirming the deletion of the specified resource.
     */
    public function delete(Historie $historie): View
    {
        return view('admin.histories.delete', compact('historie'));
    }

    public function filterByLocation(Location $location): View
    {
        $histories = Historie::where('location_id', $location->id)->paginate(10);
        $locations = Location::all();

        return view('admin.histories.index', compact('histories', 'locations'));
    }

    /**
     * Define the middleware for the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('index historie'), only: ['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('show historie'), only: ['show']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('create historie'), only: ['create', 'store']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('edit historie'), only: ['edit', 'update']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete historie'), only: ['delete', 'destroy']),
        ];
    }
}
