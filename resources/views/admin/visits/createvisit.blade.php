@extends('layouts.layoutadmin')

@section('content')
<div class="arrestanten-new-container">
    <h2>Create Visit</h2>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('visits.store') }}" method="POST" class="arrestanten-new-form">
        @csrf

        <div class="form-group">
            <label for="visitor_id">Visitor</label>
            <select id="visitor_id" name="visitor_id" class="form-control" required>
                @foreach($visitors as $visitor)
                    <option value="{{ $visitor->id }}">{{ $visitor->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="prisoner_id">Prisoner</label>
            <select id="prisoner_id" name="prisoner_id" class="form-control" required>
                @foreach($prisoners as $prisoner)
                    <option value="{{ $prisoner->id }}">{{ $prisoner->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="bezoekdatum">Visit Date</label>
            <input type="date" id="bezoekdatum" name="bezoekdatum" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="tijd_in">Time In</label>
            <input type="time" id="tijd_in" name="tijd_in" class="form-control" required>
        </div><br>

        <div class="form-group">
            <label for="tijd_uit">Time Out</label>
            <input type="time" id="tijd_uit" name="tijd_uit" class="form-control" required>
        </div><br>

        <div>
            <label for="location_id">Location</label>
            <select name="location_id" id="location_id">
                @foreach($locations as $location)
                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                @endforeach
            </select>
        </div><br>

        <input type="submit" value="Submit">

    </form>
</div>
@endsection
