@extends('layouts.layoutadmin')

@section('topmenu')
<div class="head">
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
                <li><a href="{{ route('histories.filterByLocation', ['location' => $location->id]) }}">{{ $location->name }}</a></li>
            @endforeach
            <li><a href="{{ route('histories.index') }}">Alles</a></li>
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

<form action="{{ route('histories.index') }}" method="GET" class="search-form flex items-center">
    <input type="text" name="search" placeholder="Search by BSN or Name" value="{{ request()->query('search') }}" class="border rounded p-2">
    <button type="submit" class="ml-2 p-2 bg-blue-500 text-white rounded"><i class="material-icons md-24">search</i></button>
</form>

<div class="arrestanten_container">
    <table id="customers">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Arrestatiereden</th>
                <th>BSN_nummer</th>
                <th>Adres</th>
                <th>Woonplaats</th>
                <th>Datumarrestatie</th>
                <th>Zaak_id</th>
                <th>Cel_id</th>
                <th>Insluitingsdatum</th>
                <th>Uitsluitingsdatum</th>
                <th>Locatie</th>
                <th class="actie">Actie</th>
            </tr>
        </thead>
        <tbody>
            @foreach($histories as $history)
                <tr>
                    <td>{{ $history->name }}</td>
                    <td>{{ $history->arrestatiereden }}</td>
                    <td>{{ $history->BSN_nummer }}</td>
                    <td>{{ $history->adres }}</td>
                    <td>{{ $history->woonplaats }}</td>
                    <td>{{ $history->datumarrestatie }}</td>
                    <td>
                        @foreach(json_decode($history->zaak_id) as $case_id)
                            {{ $case_id }}{{ !$loop->last ? ', ' : '' }}
                        @endforeach
                    </td>
                    <td>{{ $history->cel_id != 0 ? $history->cel_id : '' }}</td>
                    <td>{{ $history->insluitingsdatum }}</td>
                    <td>{{ $history->uitsluitingsdatum }}</td>
                    <td>{{ $history->location_id }}</td>
                    <td class="actions">
                        {{-- <a href="{{ route('histories.edit', ['historie' => $history->id]) }}" class="btn-edit">Edit</a>
                        <span class="separator">|</span> --}}

                        @can('delete historie')
                            <a href="{{ route('histories.delete', ['historie' => $history->id]) }}" class="btn-delete">Delete</a>
                        @endcan

                        <a href="{{ route('histories.show', ['historie' => $history->id]) }}" class="btn-info">Info</a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {{ $histories->appends(request()->input())->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>
@endsection
