<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Locale;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $locations = Location::all();

        return view('admin.adminpanel.users', compact('users', 'locations'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'id');
        $locations = Location::all();
        return view('admin.adminpanel.createuser', compact('roles', 'locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'roles' => 'required|array',
            'location_id' => 'required|exists:locations,id', // Validation for location_id
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'location_id' => $request->location_id, // Assign location_id from the request

        ]);

        $user->syncRoles($request->roles);

        return redirect()->route('admin.users.index')->with('status', 'User created successfully.');
    }

    public function show(User $user)
    {
        $user->load('roles'); // Load roles associated with the user
        $locations = Location::all();
        return view('admin.adminpanel.showuser', compact('user', 'locations'));
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id');
        $locations = Location::all();

        $user->load('roles'); // Load roles associated with the user
        return view('admin.adminpanel.edituser', compact('user', 'roles', 'locations'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'roles' => 'required|array',
            'location_id' => 'required|exists:locations,id', // Validation for location_id
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'location_id' => $request->location_id, // Update location_id from the request

        ]);

        // Sync roles
        $user->syncRoles($request->roles);

        return redirect()->route('admin.users.index')->with('status', "User $user->name updated successfully.");
    }
}
