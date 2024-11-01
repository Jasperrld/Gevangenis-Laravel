@extends('layouts.layoutadmin')

@section('topmenu')
<div class="head">
    <a href="{{ route('visits.create') }}" class="">Add New Visit</a>


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
                <li><a href="{{ route('visits.filterByLocation', ['location' => $location->id]) }}">{{ $location->name }}</a></li>
            @endforeach
            <li><a href="{{ route('visits.index') }}">Alles</a></li>
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

<div class="arrestanten_container">
    <form action="{{ route('visits.index') }}" method="GET" class="search-form flex items-center">
        <input type="text" name="search" placeholder="Search by bezoeknummer" value="{{ request()->query('search') }}" class="border rounded p-2">
        <button type="submit" class="ml-2 p-2 bg-blue-500 text-white rounded"><i class="material-icons md-24">search</i></button>
    </form>
    <table id="customers">
        <thead>
            <tr>
                <th>Bezoek nummer</th>
                <th>Prisoner Name</th>
                <th>Visitor Name</th>
                <th>Visit Locatie</th>
                <th class="actie">Actie</th>
            </tr>
        </thead>
        <tbody>
            @foreach($visits as $visit)
                <tr>
                    <td>{{ $visit->id }}</td>
                    <td>{{ $visit->prisoner ? $visit->prisoner->name : 'N/A' }}</td>
                    <td>{{ $visit->visitor ? $visit->visitor->name : 'N/A' }}</td>
                    <td>{{ $visit->location ? $visit->location->name : 'N/A' }}</td>
                    <td class="actions">
                        <a href="{{ route('visits.edit', $visit->id) }}" class="btn-edit">Edit</a>
                        <span class="separator">|</span>
                            <a href="{{ route('visits.delete', $visit->id) }}" class="btn-delete">Delete</a>
                            <span class="separator">|</span>
                        <a href="{{ route('visits.show', $visit->id) }}" class="btn btn-info">Info</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {{ $visits->appends(request()->input())->links('vendor.pagination.bootstrap-5') }}

    </div>
</div>
@endsection
