<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cell;
use App\Http\Requests\CellStoreRequest;
use App\Http\Requests\CellUpdateRequest;
use App\Models\Location;
use App\Models\Prisoner;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Http\Request;



class CellController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public static function middleware(): array
     {
         return [
             new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('index cell'), only:['index']),
             new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('show cell'), only:['show']),
             new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('create cell'), only:['create', 'store']),
             new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('edit cell'), only:['edit', 'update']),
             new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete cell'), only:['delete', 'destroy']),

         ];
     }
    public function index(Request $request)
    {
        $query = Cell::with('location');

        if ($request->has('location_id')) {
            $location_id = $request->input('location_id');
            $query->where('location_id', $location_id);
        }

        $cells = $query->paginate(50);

        $locations = Location::all();

        return view('admin.cells.indexcell', compact('cells', 'locations'));
    }

    public function filterByLocation(Location $location)
    {
        $cells = Cell::where('location_id', $location->id)->paginate(10);
        $locations = Location::all();

        return view('admin.cells.indexcell', compact('cells', 'locations'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::all();

          // Fetch prisoners who do not have a cel_id
          $prisoners = Prisoner::whereNull('cel_id')->get();
          return view('admin.cells.createcell', compact('prisoners', 'locations'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CellStoreRequest $request): RedirectResponse
    {

        // Create a new prisoner instance
        $cell = new Cell();
        $cell->location_id = $request->location_id;
        $cell->prisoner_id = $request->prisoner_id;

        // Save the prisoner
        $cell->save();

         // Update the prisoner record with the new cel_id
         $prisoner = Prisoner::find($request->prisoner_id);
         $prisoner->cel_id = $cell->id;
         $prisoner->save();

        return redirect()->route('cells.index')->with('status', 'Cell added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cell $cell)
    {


           // Fetch associated prisoner details
        $prisoner = Prisoner::find($cell->prisoner_id);

        return view('admin.cells.showcell', ['cell' => $cell, 'prisoner' => $prisoner]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cell $cell)
    {
        $locations = Location::all();

        $prisoners = Prisoner::whereNull('cel_id')
        ->orWhere('cel_id', $cell->id)
        ->get();

        return view('admin.cells.editcell', compact('cell', 'prisoners', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CellUpdateRequest $request, Cell $cell): RedirectResponse
    {
        $request->validate([
            'prisoner_id' => 'nullable|exists:prisoners,id',
        ]);

        // Unassign the cell from any prisoners previously assigned to this cell
        Prisoner::where('cel_id', $cell->id)->update(['cel_id' => null]);

        if ($request->filled('prisoner_id')) {
            // Assign the cell to the selected prisoner
            $prisoner = Prisoner::findOrFail($request->prisoner_id);
            $prisoner->cel_id = $cell->id;
            $prisoner->save();

            // Update the cell's prisoner_id
            $cell->prisoner_id = $request->prisoner_id;
        } else {
            // No prisoner selected, set prisoner_id to null
            $cell->prisoner_id = null;
        }
        $cell->location_id = $request->location_id;

        $cell->save();

        return redirect()->route('cells.index')->with('status', 'Cell updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cell $cell)
    {
        //
    }
}
