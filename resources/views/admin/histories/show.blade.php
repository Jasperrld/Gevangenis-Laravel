@extends('layouts.layoutadmin')

@section('topmenu')
<div class="head">
    <a href="{{ route('histories.index') }}" class='btn-back'><i class='material-icons md-24'>arrow_back</i></a>
</div>
@endsection

@section('content')
<div class="arrestanten-new-container">
    <h1>Historie Details</h1>
    <div class="arrestanten-details">
        <div class="arrestanten-info-container">
            @if ($historie->pasfoto)
                <img src="{{ asset('storage/' . $historie->pasfoto) }}" alt="Pasfoto">
            @else
                <p>No image available</p>
            @endif
        </div>

        <div><strong>Naam:</strong> {{ $historie->name }}</div>
        <div><strong>Arrestatiereden:</strong> {{ $historie->arrestatiereden }}</div>
        <div><strong>BSN_nummer:</strong> {{ $historie->BSN_nummer }}</div>
        <div><strong>Adres:</strong> {{ $historie->adres }}</div>
        <div><strong>Woonplaats:</strong> {{ $historie->woondivlaats }}</div>
        <div><strong>Datumarrestatie:</strong> {{ $historie->datumarrestatie }}</div>
        <div><strong>Zaak_id:</strong>
            @foreach(json_decode($historie->zaak_id) as $case_id)
                {{ $case_id }}{{ !$loop->last ? ', ' : '' }}
            @endforeach
        </div>
        <div><strong>Cel_id:</strong> {{ $historie->cel_id }}</div>
        <div><strong>Insluitingsdatum:</strong> {{ $historie->insluitingsdatum }}</div>
        <div><strong>Uitsluitingsdatum:</strong> {{ $historie->uitsluitingsdatum }}</div>
        <div><strong>Maatschadivdivelijke aantekeningen:</strong> {{ $historie->maatschadivdivelijke_aantekeningen }}</div>
        <div><strong>Locatie:</strong> {{ $historie->location_id }}</div>
    </div>
</div>
@endsection
