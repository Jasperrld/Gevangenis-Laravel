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
            Edit Role
        </div>
        <div class="card-body">
            <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Role Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $role->name) }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="permissions">Permissions</label>
                    <div class="checkbox-group">
                        @foreach($permissions as $permission)
                            <div class="form-check">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                       id="permission_{{ $permission->id }}"
                                       class="form-check-input"
                                       {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }}>
                                <label class="form-check-label" for="permission_{{ $permission->id }}">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @if($errors->has('permissions'))
                        <span class="text-danger">{{ $errors->first('permissions') }}</span>
                    @endif
                </div>


                <button type="submit" class="btn btn-primary">Update Role</button>
            </form>
        </div>
    </div>

    <style>
        .checkbox-group {
            column-count: 3; /* Adjust the number of columns as needed */
            column-gap: 20px;
        }
        .checkbox-group .form-check {
            break-inside: avoid;
            margin-bottom: 10px;
        }
    </style>

@endsection


