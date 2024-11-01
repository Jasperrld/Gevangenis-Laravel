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
@endsection
@section('content')
<div class="arrestanten-new-container">
    <div class="card-header">
            User Details: {{ $user->name }}
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Roles:</strong></p>
            <ul>
                @foreach($user->roles as $role)
                    <li>{{ $role->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
