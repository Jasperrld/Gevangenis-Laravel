
@extends('layouts.layoutadmin')

@section('topmenu')
@endsection

@section('content')
<div class="arrestanten-info">
    <button class="Terug" onclick="window.history.back()">Terug</button>
    <h2>Visitor Information</h2>


    <div class="arrestanten-details">
        <div><strong>Naam:</strong> {{ $visitor->name }}</div>
        <div><strong>BSN Nummer:</strong> {{ $visitor->BSN_nummer }}</div>

    </div>
</div>
@endsection
