
@extends('layouts.layoutadmin')

@section('topmenu')
@endsection

@section('content')
<div class="arrestanten-info">
    <button class="Terug" onclick="window.history.back()">Terug</button>
    <h2>Arrestant Information</h2>
    <div class="arrestanten-info-container">
        @if ($prisoner->pasfoto)
            <img src="{{ asset('storage/' . $prisoner->pasfoto) }}" alt="Pasfoto">
        @else
            <p>No image available</p>
        @endif
    </div>
    <div class="arrestanten-details">
        <div><strong>Naam:</strong> {{ $prisoner->name }}</div>
        <div><strong>Arrestatiereden:</strong> {{ $prisoner->arrestatiereden }}</div>
        <div><strong>BSN Nummer:</strong> {{ $prisoner->BSN_nummer }}</div>
        <div><strong>Adres:</strong> {{ $prisoner->adres }}</div>
        <div><strong>Woonplaats:</strong> {{ $prisoner->woonplaats }}</div>
        <div><strong>Datum arrestatie:</strong> {{ $prisoner->datumarrestatie }}</div>
        @if($prisoner->verslag_pdf_path)
        <h3>Prisoner Verslag (PDF):</h3><br>
        <a href="{{ Storage::url($prisoner->verslag_pdf_path) }}" download="CaseReport_{{ $prisoner->id }}.pdf">Download PDF</a>
        <br>
        @endif
        <br>
        {{-- <div><strong>Zaak ID:</strong> {{ $prisoner->zaak_id }}</div> --}}
        <div><strong>Zaak ID(s):</strong>
            @foreach($prisoner->prisonCases as $case)
                {{ $case->id }}{{ !$loop->last ? ', ' : '' }}
            @endforeach
        </div>
        <div><strong>Cel ID:</strong> {{ $prisoner->cel_id }}</div>
        <div><strong>Insluitingsdatum:</strong> {{ $prisoner->insluitingsdatum }}</div>
        <div><strong>Uitsluitingsdatum:</strong> {{ $prisoner->uitsluitingsdatum }}</div>
        <div><strong>Maatschappelijke aantekeningen:</strong> {{ $prisoner->maatschappelijke_aantekeningen }}</div>
    </div>
</div>
@endsection
