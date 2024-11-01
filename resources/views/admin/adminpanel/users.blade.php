@extends('layouts.layoutadmin')

@section('topmenu')

<div class="head flex justify-between items-center bg-gray-800 text-white py-4 px-6">
    <h1 class="text-2xl font-bold">Dashboard</h1>
    <div class="flex space-x-4">
        <a href="{{ route('admin.users.index') }}" class="btn-new">Gebruikers</a>
        <a href="{{ route('admin.roles.index') }}" class="btn-new">Rollen</a>
        <a href="{{ route('admin.users.create') }}" class="btn-new">Create User</a>

    </div>
</div>

@if(session('status'))
        <div class="card-body">
            <div class="bg-green-400 text-green-800 rounded-lg shadow-md p-6 pr-10 mb-8">{{session('status')}}</div>
        </div>

    @endif
    @if(session('status-wrong'))
        <div class="card-body">
            <div class="bg-red-400 text-red-800 rounded-lg shadow-md p-6 pr-10 mb-8">{{session('status-wrong')}}</div>
        </div>

@endif
@endsection

@section('content')
    <div class="arrestanten_container">
        <h1>Roles</h1>
        <table id="customers">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>email</th>
                    <th>Location</th>
                    <th>Roles</th>
                    <th class="actie">Actie</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->location ? $user->location->name : 'N/A' }}</td>
                        <td>
                            @foreach($user->roles as $role)
                            <span class="badge badge-primary">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td class="actions">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-edit">Edit</a>
                            <span class="separator">|</span>
                            @can('delete prisoner')
                            <a href="" class="btn-delete">Delete</a>
                                <span class="separator">|</span>
                            @endcan
                            <a href="{{ route('admin.adminpanel.users.show', $user->id) }}" class="btn btn-warning">Info</a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
