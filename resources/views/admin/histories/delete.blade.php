@extends('layouts.layoutadmin')

@section('topmenu')
@endsection

@section('content')

   <!-- Errors -->
   @if($errors->any())
        <div class="bg-red-200 text-red-900 rounded-lg shadow-md p-6 pr-10 mb-8">
            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- End Errors -->

<div class="arrestanten-new-container">
    <button class="Terug" onclick="window.history.back()">Terug</button>
    <h2>Delete Historie</h2>
    <form action="{{ route('histories.destroy', ['historie' => $historie->id]) }}" class="arrestanten-new-form" method="post">
        @method('DELETE')
        @csrf

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $historie->name }}" disabled><br>

        <label for="arrestatiereden">Arrestatiereden:</label>
        <input type="text" id="arrestatiereden" name="arrestatiereden" value="{{ $historie->arrestatiereden }}" disabled><br>

        <label for="BSN_nummer">BSN Number:</label>
        <input type="number" id="BSN_nummer" name="BSN_nummer" value="{{ $historie->BSN_nummer }}" disabled><br>

        <label for="adres">Adres:</label>
        <input type="text" id="adres" name="adres" value="{{ $historie->adres }}" disabled><br>

        <label for="woonplaats">Woonplaats:</label>
        <input type="text" id="woonplaats" name="woonplaats" value="{{ $historie->woonplaats }}" disabled><br>

        <label for="datumarrestatie">Datum Arrestatie:</label>
        <input type="date" id="datumarrestatie" name="datumarrestatie" value="{{ $historie->datumarrestatie }}" disabled><br>

        <label for="zaak_id">Zaak ID:</label>
        <input type="number" id="zaak_id" name="zaak_id" value="{{ $historie->zaak_id }}" disabled><br>

        <label for="cel_id">Cel ID:</label>
        <input type="number" id="cel_id" name="cel_id" value="{{ $historie->cel_id }}" disabled><br>

        <label for="locatie_id">Locatie:</label>
        <input type="number" id="locatie_id" name="locatie_id" value="{{ $historie->locatie_id }}" disabled><br>

        <label for="insluitingsdatum">Insluitingsdatum:</label>
        <input type="date" id="insluitingsdatum" name="insluitingsdatum" value="{{ $historie->insluitingsdatum }}" disabled><br>

        <label for="uitsluitingsdatum">Uitsluitingsdatum:</label>
        <input type="date" id="uitsluitingsdatum" name="uitsluitingsdatum" value="{{ $historie->uitsluitingsdatum }}" disabled><br>

        <label for="maatschappelijke_aantekeningen">Maatschappelijke Aantekeningen:</label>
        <textarea id="maatschappelijke_aantekeningen" name="maatschappelijke_aantekeningen" disabled>{{ $historie->maatschappelijke_aantekeningen }}</textarea><br>

        <input type="submit" value="Delete">
    </form>
</div>
@endsection
