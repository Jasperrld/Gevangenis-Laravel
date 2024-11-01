<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public static function middleware(): array
    {
        return [
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('index log'), only:['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('show log'), only:['show']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('create log'), only:['create', 'store']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('edit log'), only:['edit', 'update']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete log'), only:['delete', 'destroy']),

        ];
    }
    public function index(Request $request)
    {
        $query = Log::orderBy('created_at', 'desc');

        // Filter by model type if search parameter is provided
        if ($request->has('model_type')) {
            $query->where('model_type', 'like', '%' . $request->input('model_type') . '%');
        }

        // Filter by action if search parameter is provided
        if ($request->has('action')) {
            $query->where('action', 'like', '%' . $request->input('action') . '%');
        }

        $logs = $query->paginate(10);

        return view('admin.logs.indexlog', compact('logs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Log $log)
    {
        return view('admin.logs.showlog', compact('log'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Log $log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Log $log)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Log $log)
    {
        //
    }
}
