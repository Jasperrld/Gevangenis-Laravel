<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use App\Http\Requests\VisitStoreRequest;
use App\Http\Requests\VisitUpdateRequest;
use App\Models\Location;
use App\Models\Prisoner;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Routing\Controllers\Middleware;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public static function middleware(): array
    {
        return [
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('index visit'), only:['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('show visit'), only:['show']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('create visit'), only:['create', 'store']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('edit visit'), only:['edit', 'update']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete visit'), only:['delete', 'destroy']),

        ];
    }
    public function index(Request $request)
    {
        $query = Visit::with(['visitor', 'prisoner']); // Eager load relationships

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('id', 'like', "%{$search}%")
                  ->orWhere('id', 'like', "%{$search}%");
        }

        if ($request->has('location_id')) {
            $location_id = $request->input('location_id');
            $query->where('location_id', $location_id);
        }

        $visits = $query->paginate(10);
        $locations = Location::all();

        return view('admin.visits.indexvisit', compact('visits', 'locations'));

    }

    public function filterByLocation(Location $location)
    {
        $visits = Visit::where('location_id', $location->id)->paginate(10);
        $locations = Location::all();

        return view('admin.visits.indexvisit', compact('visits', 'locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $visitors = Visitor::all();
        $prisoners = Prisoner::all();
        $locations = Location::all();

        return view('admin.visits.createvisit', compact('visitors', 'prisoners', 'locations'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(VisitStoreRequest $request)
    {
        Visit::create($request->validated());

        return redirect()->route('visits.index')->with('success', 'Visit created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Visit $visit): View
    {
        // You may eager load relationships here if needed
        $visit->load('visitor', 'prisoner');

        return view('admin.visits.showvisit', compact('visit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visit $visit)
    {
        $visitors = Visitor::all();
        $prisoners = Prisoner::all();
        $locations = Location::all();

        return view('admin.visits.editvisit', compact('visit', 'visitors', 'prisoners', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VisitUpdateRequest $request, Visit $visit)
    {

        $visit->update($request->all());

        return redirect()->route('visits.index')->with('success', 'Visit updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */

     public function delete(Visit $visit)
     {
         // Fetch related prisoners
         $prisoners = Prisoner::all();

         return view('admin.visits.deletevisit', compact('visit', 'prisoners'));
     }

     public function destroy(Request $request, Visit $visit): RedirectResponse
     {
         // If there is a related prisoner, update the prisoner to remove the visit
         if ($request->has('prisoner_id')) {
             $prisoner = Prisoner::find($request->input('prisoner_id'));
             if ($prisoner) {
                 $prisoner->visit_id = null;
                 $prisoner->save();
             }
         }

         $visit->delete();

         return redirect()->route('visits.index')->with('status', 'Visit deleted successfully.');
     }
}
