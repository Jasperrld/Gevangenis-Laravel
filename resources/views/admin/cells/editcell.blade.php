@extends('layouts.layoutadmin')

@section('topmenu')

@endsection

@section('content')
<div class="zaken-new-container">
    <a href="{{ route('cells.show', $cell->id) }}" class="Terug">Terug</a>
    <br><br>
    <h2>Edit Cell</h2>
    <form action="{{ route('cells.update', $cell->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="cel_id" value="{{ $cell->id }}"/>

        <label for="prisoner">Prisoner:</label>
        <select id="prisoner" name="prisoner_id">
            <option value="">-- Select Prisoner --</option>
            @foreach ($prisoners as $prisoner)
                <option value="{{ $prisoner->id }}" {{ $cell->prisoner_id == $prisoner->id ? 'selected' : '' }}>
                    {{ $prisoner->name }}
                </option>
            @endforeach
        </select>


         <label for="location_id">Locatie:</label>
        <select id="location_id" name="location_id" class="form-control">
            @foreach($locations as $location)
                <option value="{{ $location->id }}" {{ old('location_id', $cell->location_id) == $location->id ? 'selected' : '' }}>
                    {{ $location->name }}
                </option>
            @endforeach
        </select><br>
        <input type="submit" value="Submit">
    </form>
</div>
@endsection
