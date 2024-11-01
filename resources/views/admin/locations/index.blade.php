@extends('layouts.layoutadmin')

@section('topmenu')

<div class="head">
    <a href="{{ route('locations.create') }}" class="">Add New Location</a>

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
<div class="location-list-container">
    <table id="customers">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($locations as $location)
                <tr>
                    <td>{{ $location->id }}</td>
                    <td>{{ $location->name }}</td>
                    <td>
                        <a href="{{ route('locations.edit', ['location' => $location->id]) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('locations.confirmDelete', ['location' => $location->id]) }}" class="btn btn-danger">Delete</a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
