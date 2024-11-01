@extends('layouts.layoutadmin')

@section('topmenu')
<div class="head">
    <a href="{{ route('cells.create') }}" class="">Add New Cell</a>


</div>

@if(session('status'))
        <div class="card-body">
            <div class="bg-green-400 text-green-800 rounded-lg shadow-md p-6 pr-10 mb-8">{{session('status')}}</div>
        </div>

    @endif
    @if(session('status-wrong'))
        <div class="card-body">
            <div class="bg-red-400 text-red-800 rounded-lg shadow-md p-6 pr-10 mb-8">{{session('status-wrong')}}</div>
        </div>

@endif
@endsection

@section('content')
<div class="locatie_header">
    <header class="locatie_menu">
        <ul>
            @foreach($locations as $location)
                <li><a href="{{ route('cells.filterByLocation', ['location' => $location->id]) }}">{{ $location->name }}</a></li>
            @endforeach
            <li><a href="{{ route('cells.index') }}">Alles</a></li>
        </ul>
        <button class="hoornhek_menu-toggle" aria-label="Toggle Menu">
            <span class="icon-container-locatie">
                <i class="fa-sharp fa-solid fa-bars"></i>
            </span>
        </button>
    </header>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuToggle = document.querySelector('.hoornhek_menu-toggle');
        const menu = document.querySelector('.locatie_menu ul');

        menuToggle.addEventListener('click', function () {
            menu.classList.toggle('active');
        });
    });
</script>
<div class="cellen-container">

    @foreach ($cells as $cell)
        @php
            $cellClass = ($cell->prisoner_id) ? 'cel cel-red' : 'cel';
        @endphp
        <a href="{{ route('cells.show', ['cell' => $cell->id]) }}">
            <div class="{{ $cellClass }}" id="cel_{{ $cell->id }}">
                {{ $cell->id }}
            </div>
        </a>
    @endforeach

</div>
@endsection
