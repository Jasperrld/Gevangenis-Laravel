@extends('layouts.layoutadmin')

@section('topmenu')


@endsection

@section('content')

   <!-- errors -->

   @if($errors->any())
        <div class="bg-red-200 text-red-900 rounded-lg shadow-md p-6 pr-10 mb-8" >
            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>

    @endif

    <!-- end errors -->
<div class="arrestanten-new-container">
    <button class="Terug" onclick="window.history.back()">Terug</button>
    <h2>Add New Arrestant</h2>
    <form action="{{ route('prisoners.destroy', ['prisoner' => $prisoner->id]) }}" class="arrestanten-new-form" method="post" enctype="multipart/form-data">
        @method('DELETE')

        @csrf

        <label for="name">Naam:</label>
        <input type="text" id="name" name="name" value="{{ $prisoner->name }}" disabled/><br>

        <label for="arrestatiereden">Arrestatiereden:</label>
        <select id="arrestatiereden" name="arrestatiereden" disabled>
            @php
                $arrestatieRedenOptions = ['Rijden onder invloed', 'Moord', 'Gestolen', 'Geweld'];
            @endphp
            @foreach($arrestatieRedenOptions as $option)
                <option value="{{ $option }}" {{ $prisoner->arrestatiereden == $option ? 'selected' : '' }}>{{ $option }}</option>
            @endforeach
        </select><br>

        <label for="BSN_nummer">BSN-nummer:</label>
        <input type="number" id="BSN_nummer" name="BSN_nummer" value="{{ $prisoner->BSN_nummer }}" disabled><br>

        <label for="adres">Adres:</label>
        <input type="text" id="adres" name="adres" value="{{ $prisoner->adres }}" disabled><br>

        <label for="woonplaats">Woonplaats:</label>
        <input type="text" id="woonplaats" name="woonplaats" value="{{ $prisoner->woonplaats }}" disabled><br>

        <label for="datumarrestatie">Datum Arrestatie:</label>
        <input type="date" id="datumarrestatie" name="datumarrestatie" value="{{ $prisoner->datumarrestatie }}" disabled><br>

        <label for="zaak_id">Zaak ID:</label>
        <input type="number" id="zaak_id" name="zaak_id" value="{{ $prisoner->zaak_id }}" disabled><br>

        <label for="cel_id">Cel ID:</label>
        <input type="number" id="cel_id" name="cel_id" value="{{ $prisoner->cel_id }}" disabled><br>

        <label for="locatie_id">Locatie:</label>
        <input type="number" id="locatie_id" name="locatie_id" value="{{ $prisoner->location_id }}" disabled><br>

        <label for="insluitingsdatum">Insluitingsdatum:</label>
        <input type="date" id="insluitingsdatum" name="insluitingsdatum" value="{{ $prisoner->insluitingsdatum }}" disabled><br>

        <label for="uitsluitingsdatum">Uitsluitingsdatum:</label>
        <input type="date" id="uitsluitingsdatum" name="uitsluitingsdatum" value="{{ $prisoner->uitsluitingsdatum }}" disabled><br>

        <label for="maatschappelijke_aantekeningen">Maatschappelijke Aantekeningen:</label>
        <textarea id="maatschappelijke_aantekeningen" name="maatschappelijke_aantekeningen" disabled>{{ $prisoner->maatschappelijke_aantekeningen }}</textarea><br>

        <input type="submit" value="Delete">
    </form>
</div>
@endsection
