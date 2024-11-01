@extends('layouts.layoutadmin')

@section('content')
<div class="confirm-delete-container">
    <h2>Confirm Deletion of Location</h2>
    <p>Are you sure you want to delete the location: {{ $location->name }}?</p>

    <form action="{{ route('locations.destroy', $location->id) }}" method="POST">
        @csrf
        @method('DELETE')

        <label for="new_location_id">Reassign prisoners to:</label>
        <select id="new_location_id" name="new_location_id" required>
            <option value="">Select a new location</option>
            @foreach($locations as $loc)
                <option value="{{ $loc->id }}">{{ $loc->name }}</option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</div>
@endsection
