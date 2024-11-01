<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Http\Requests\LocationStoreRequest;
use App\Http\Requests\LocationUpdateRequest;
use App\Models\Prisoner;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Routing\Controllers\Middleware;

class LocationController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('index location'), only:['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('show location'), only:['show']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('create location'), only:['create', 'store']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('edit location'), only:['edit', 'update']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete location'), only:['delete', 'destroy']),

        ];
    }
    public function index(): View
    {
        $locations = Location::all();
        return view('admin.locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.locations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Location::create($request->all());

        return redirect()->route('locations.index')->with('status', 'Location created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location): View
    {
        return view('admin.locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $location->update($request->all());

        return redirect()->route('locations.index')->with('status', 'Location updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Location $location): RedirectResponse
    {
        $newLocationId = $request->input('new_location_id');

        // Reassign prisoners to the new location
        Prisoner::where('location_id', $location->id)->update(['location_id' => $newLocationId]);

        // Delete the location
        $location->delete();

        return redirect()->route('locations.index')->with('status', 'Location deleted and prisoners reassigned successfully.');
    }


    public function confirmDelete(Location $location)
    {
    $locations = Location::where('id', '!=', $location->id)->get();
    return view('admin.locations.confirmDelete', compact('location', 'locations'));
    }


}
