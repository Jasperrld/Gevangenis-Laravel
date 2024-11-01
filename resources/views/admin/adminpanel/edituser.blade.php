
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
<div class="arrestanten-new-container">
    <div class="card-header">
            Edit User: {{ $user->name }}
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="roles">Roles</label>
                    <select name="roles[]" id="roles" class="form-control" multiple required>
                        @foreach($roles as $id => $name)
                            <option value="{{ $name }}" {{ in_array($name, $user->roles->pluck('name')->toArray()) ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>

                </div>

                <div class="form-group">
                    <label for="location_id">Location</label>
                    <select name="location_id" id="roles" class="form-control" required>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}" {{ $user->location_id == $location->id ? 'selected' : '' }}>
                                {{ $location->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update User</button>
            </form>
        </div>
    </div>
    <!-- Include Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<!-- Include jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Include Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#roles').select2({
            placeholder: 'Select Role',
            allowClear: true,
            closeOnSelect: false,
            width: '100%' // Changed width to 100% to match your style
        });
    });
</script>
@endsection
