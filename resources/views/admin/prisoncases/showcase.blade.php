@extends('layouts.layoutadmin')

@section('content')
<div class="zaak-info">
    <button class="Terug" onclick="window.history.back()">Terug</button>

    <h2>Zaak Information</h2>
    <div class="zaak-details">
        <div><strong>Zaak nummer:</strong> {{ $prisonCase->id }}</div><br>
        <div><strong>Zaak Reden:</strong> {{ $prisonCase->zaakreden }}</div><br>
        <p><h1>Locatie ID:</h1> {{ $prisonCase->location ? $prisonCase->location->name : 'N/A' }}

        @if($prisonCase->verslag_pdf_path)
            <h3>Case Report (PDF):</h3><br>
            <a href="{{ Storage::url($prisonCase->verslag_pdf_path) }}" download="CaseReport_{{ $prisonCase->id }}.pdf">Download PDF</a>
        @endif
    </div><br>

    <div class="prisoners-list">
        <h2>Prisoners</h2>
        {{-- <ul>
            @foreach ($prisoners as $prisoner)
                <li>{{ $prisoner->id }}: {{ $prisoner->name }} - BSN: {{$prisoner->BSN_nummer }}</li>
                <!-- Display more prisoner details as needed -->
            @endforeach
        </ul> --}}
        @if ($prisonCase->prisoners->count() > 0)
        <ul>
            @foreach ($prisonCase->prisoners as $prisoner)
                <li>{{ $prisoner->id }}: {{ $prisoner->name }}</li>
            @endforeach
        </ul>
    @else
        <div>No prisoners associated with this case.</div>
    @endif
    </div>
</div>
@endsection
