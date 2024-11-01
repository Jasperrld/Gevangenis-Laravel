@extends('layouts.layoutadmin')

@section('content')
<div class="location-form-container">
    <h2>Edit Location</h2>
    <form action="{{ route('locations.update', ['location' => $location->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $location->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
