@extends('layouts.layoutadmin')

@section('topmenu')
<div class="head flex justify-between items-center bg-gray-800 text-white py-4 px-6">
    <h1 class="text-2xl font-bold">Dashboard</h1>
    <div class="flex space-x-4">
        <a href="{{ route('admin.users.index') }}" class="btn-new">Gebruikers</a>
        <a href="{{ route('admin.roles.index') }}" class="btn-new">Rollen</a>
        <a href="{{ route('admin.roles.create') }}" class="btn-new">Create Role</a>

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
                    <th>Name</th>
                    <th>guard_name</th>

                    <th class="actie">Actie</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->guard_name }}</td>

                        <td class="actions">
                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn-edit">Edit</a>
                            <span class="separator">|</span>
                            @can('delete prisoner')
                            <a href="" class="btn-delete">Delete</a>
                                <span class="separator">|</span>
                            @endcan
                            <a href="{{ route('admin.adminpanel.roles.show', $role->id) }}" class="btn btn-warning">Info</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
