@extends('layouts.layoutadmin')

@section('topmenu')
@endsection

@section('content')
<div class="cel-info-container">
    <button class="Terug" onclick="window.location.href='{{ route('cells.index') }}'">Terug</button>
    <br><br>
    <h2>Cell Information</h2>
    <p><h1>Cell ID:</h1> {{ $cell->id }}</p>
    <p><h1>Locatie ID:</h1> {{ $cell->location ? $cell->location->name : 'N/A' }}
    </p>
    <h3>Associated Prisoner</h3>
    @if ($prisoner)
        <p><h1>Prisoner ID:</h1> {{ $prisoner->id }}</p>
        <p><h1>Name:</h1> {{ $prisoner->name }}</p>
    @else
        <p>No prisoner associated with this cell.</p>
    @endif
    <br>
    <a href="{{ route('cells.edit', $cell->id) }}" class="edit-link">
        <button class="edit-button">Edit Cell</button>
    </a>
</div>
@endsection
