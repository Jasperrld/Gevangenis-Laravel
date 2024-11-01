@extends('layouts.layoutadmin')

@section('content')
<div class="location-form-container">
    <h2>Add New Location</h2>
    <form action="{{ route('locations.store') }}"  method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
