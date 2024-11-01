@extends('layouts.layoutadmin')

@section('content')
<div class="arrestanten-new-container">
    <h2>Delete Visit</h2>
        <div>Are you sure you want to delete this visit?</div>
        <div><strong>Visit Details:</strong></div>
        <div>Date: {{ $visit->bezoekdatum }}</div>
        <div>Time In: {{ $visit->tijd_in }}</div>
        <div>Time Out: {{ $visit->tijd_uit }}</div>
        <div>Prisoner: {{ $visit->prisoner ? $visit->prisoner->name : 'N/A' }}</div>

        <form action="{{ route('visits.destroy', ['visit' => $visit->id]) }}" method="POST">
            @csrf
            @method('DELETE')

            <input type="submit" value="Submit">
        </form>

        <a href="{{ route('visits.index') }}">Cancel</a>
    </div>
@endsection
