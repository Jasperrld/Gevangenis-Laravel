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
<div class="arrestanten-new-container">
    <div class="card-header">
            Role Details: {{ $role->name }}
        </div>
        <div class="card-body">
            <div><strong>Name:</strong> {{ $role->name }}</div>
            <div><strong>Permissions:</strong></div>
            <ul>
                @foreach($role->permissions as $permission)
                    <li>{{ $permission->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
