<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use App\Http\Requests\VisitorStoreRequest;
use App\Http\Requests\VisitorUpdateRequest;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Routing\Controllers\Middleware;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public static function middleware(): array
    {
        return [
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('index visitor'), only:['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('show visitor'), only:['show']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('create visitor'), only:['create', 'store']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('edit visitor'), only:['edit', 'update']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete visitor'), only:['delete', 'destroy']),

        ];
    }
    public function index(Request $request)
    {
        $query = Visitor::with('location'); // Eager load location

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('BSN_nummer', 'like', "%{$search}%");
        }

        if ($request->has('location_id')) {
            $location_id = $request->input('location_id');
            $query->where('location_id', $location_id);
        }

        $visitors = $query->paginate(10);
        $locations = Location::all();

        return view('admin.visitors.indexvisitor', compact('visitors', 'locations'));
    }

    public function filterByLocation(Location $location)
    {
        $visitors = Visitor::where('location_id', $location->id)->with('location')->paginate(10); // Eager load location
        $locations = Location::all();

        return view('admin.visitors.indexvisitor', compact('visitors', 'locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::all();

        return view('admin.visitors.createvisitor', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VisitorStoreRequest $request): RedirectResponse
    {
    // Check if visitor with BSN_nummer exists
    $existingVisitor = Visitor::where('BSN_nummer', $request->BSN_nummer)->first();
    if ($existingVisitor) {
        // Create a link to the existing visitor's details
        $link = route('visitors.show', ['visitor' => $existingVisitor->id]);
        $message = 'A visitor with this BSN_nummer already exists. <a href="' . $link . '" class="text-blue-500">Info Visitor</a>';
        return back()->withErrors(['BSN_nummer' => $message])->withInput();
    }

    // Validate the request
    $request->validate([
        'name' => 'required|string|max:100',
        'BSN_nummer' => 'required|integer|unique:visitors,BSN_nummer',
        'location_id' => 'required|integer|exists:locations,id',
    ]);


        // Create a new visitor instance
        $visitor = new Visitor();
        $visitor->name = $request->name;
        $visitor->BSN_nummer = $request->BSN_nummer;
        $visitor->location_id = $request->location_id;

        // Save the visitor
        $visitor->save();

        return redirect()->route('visitors.index')->with('status', 'Visitor added successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Visitor $visitor)
    {
        return view('admin.visitors.showvisitor', ['visitor' => $visitor]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visitor $visitor)
    {
        $locations = Location::all();

        return view('admin.visitors.editvisitor', compact('visitor', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VisitorUpdateRequest $request, Visitor $visitor)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:100',
            'BSN_nummer' => 'required|integer',
            'location_id' => 'required|integer|exists:locations,id',
        ]);

        // Update the prisoner details
        $visitor->update($request->all());


        return redirect()->route('visitors.index')->with('status', "Visitor $visitor->name updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */

    public function delete(Visitor $visitor)
    {
        return view('admin.visitors.deletevisitor', ['visitor' => $visitor]);
    }

    public function destroy(Visitor $visitor)
    {
        $visitor->delete();

        return to_route('visitors.index')->with('status', "$visitor->name deleted successfully");
    }
}
