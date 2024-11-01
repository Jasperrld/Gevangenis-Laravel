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
    <form action="{{ route('prisoners.store') }}" class="arrestanten-new-form" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="action" value="AddArrestant">
        <div class="mb-3">
            <label for="image" class="form-label">Pasfoto</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <label for="name">Naam:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}"><br>

        <label for="arrestatiereden">Arrestatiereden:</label>
        <select id="arrestatiereden" name="arrestatiereden">
            @php
                $arrestatieRedenOptions = ['Rijden onder invloed', 'Moord', 'Gestolen', 'Geweld'];
            @endphp
            @foreach($arrestatieRedenOptions as $option)
                <option value="{{ $option }}" {{ old('arrestatiereden') == $option ? 'selected' : '' }}>{{ $option }}</option>
            @endforeach
        </select><br>

        <label for="BSN_nummer">BSN-nummer:</label>
        <input type="number" id="BSN_nummer" name="BSN_nummer" value="{{ old('BSN_nummer') }}"><br>

        <label for="adres">Adres:</label>
        <input type="text" id="adres" name="adres" value="{{ old('adres') }}"><br>

        <label for="woonplaats">Woonplaats:</label>
        <input type="text" id="woonplaats" name="woonplaats" value="{{ old('woonplaats') }}"><br>

        <label for="datumarrestatie">Datum Arrestatie:</label>
        <input type="date" id="datumarrestatie" name="datumarrestatie" value="{{ old('datumarrestatie') }}"><br>

        <label for="verslag_pdf">Upload Prisoner Verslag (PDF):</label>
        <input type="file" id="verslag_pdf" name="verslag_pdf" accept="application/pdf"><br>

        <label for="zaak_id">Zaak ID:</label>
        <select multiple id="prison_cases" name="prison_cases[]" class="form-control">
            @foreach($prisonCases as $case)
                <option value="{{ $case->id }}">
                    {{ $case->zaakreden }}
                </option>
            @endforeach
        </select>
        <label for="cel_id">Cel ID:</label>
        <input type="number" id="cel_id" name="cel_id" value="{{ old('cel_id') }}" disabled><br>

        <label for="location_id">Locatie:</label>
        <select id="location_id" name="location_id" class="form-control">
            @foreach($locations as $location)
                <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                    {{ $location->name }}
                </option>
            @endforeach
        </select><br>
        <label for="insluitingsdatum">Insluitingsdatum:</label>
        <input type="date" id="insluitingsdatum" name="insluitingsdatum" value="{{ old('insluitingsdatum') }}"><br>

        <label for="uitsluitingsdatum">Uitsluitingsdatum:</label>
        <input type="date" id="uitsluitingsdatum" name="uitsluitingsdatum" value="{{ old('uitsluitingsdatum') }}"><br>

        <label for="maatschappelijke_aantekeningen">Maatschappelijke Aantekeningen:</label>
        <textarea id="maatschappelijke_aantekeningen" name="maatschappelijke_aantekeningen">{{ old('maatschappelijke_aantekeningen') }}</textarea><br>

        <input type="submit" value="Submit">
    </form>
</div>

<!-- Include Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<!-- Include jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Include Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#prison_cases').select2({
            placeholder: 'Select case',
            allowClear: true,
            closeOnSelect: false,
            width: '100%' // Changed width to 100% to match your style
        });
    });
</script>
@endsection
