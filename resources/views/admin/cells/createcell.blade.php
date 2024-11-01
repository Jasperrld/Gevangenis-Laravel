@extends('layouts.layoutadmin')

@section('topmenu')

@endsection

@section('content')
<div class="zaken-new-container">
    <h2>Add Cell</h2>
    <form action="{{ route('cells.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="action" value="addcel" />

        <label for="prisoner">Prisoner:</label>
        <select id="prisoner" name="prisoner_id">

            @foreach ($prisoners as $prisoner)
                <option value="{{ $prisoner->id }}">{{ $prisoner->name }}</option>
            @endforeach
        </select>

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
