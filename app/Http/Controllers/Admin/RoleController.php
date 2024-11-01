<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('admin.adminpanel.roles', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.adminpanel.createrole', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array',
        ]);

        // Create the role
        $role = Role::create(['name' => $request->name]);

        // Retrieve the permission names from their IDs
        $permissions = Permission::whereIn('id', $request->permissions)->pluck('name');

        // Assign permissions to the role
        $role->givePermissionTo($permissions);

        return redirect()->route('admin.roles.index')->with('status', 'Role created successfully.');
    }


    public function show(Role $role)
    {
        $role->load('permissions');
        return view('admin.adminpanel.showrole', compact('role'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $role->load('permissions');
        return view('admin.adminpanel.editrole', compact('role', 'permissions'));
    }


    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'required|array',
        ]);

        $role->update(['name' => $request->name]);

        // Retrieve the permission names from their IDs
        $permissions = Permission::whereIn('id', $request->permissions)->pluck('name');

        $role->syncPermissions($permissions);

        return redirect()->route('admin.roles.index')->with('status', "Role $role->name updated successfully.");
    }


    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index')->with('status', 'Role deleted successfully.');
    }
}
