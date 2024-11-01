@extends('layouts.layoutadmin')

@section('content')
<div class="arrestanten-new-container">
    <h2>Visit Details</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Visitor: {{ $visit->visitor ? $visit->visitor->name : 'N/A' }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">Prisoner: {{ $visit->prisoner ? $visit->prisoner->name : 'N/A' }}</h6>
            <p class="card-text">
                <p>Visit Date:</p> {{ $visit->bezoekdatum }}<br>
                <p>Time In:</p> {{ $visit->tijd_in }}<br>
                <p>Time Out:</p> {{ $visit->tijd_uit }}<br>
                <p>Location ID:</p> {{ $visit->locatie_id ?? 'Not specified' }}
            </p>
        </div>
    </div>

    <a href="{{ route('visits.index') }}" class="btn btn-primary mt-3">Back to Visits</a>
</div>
@endsection
