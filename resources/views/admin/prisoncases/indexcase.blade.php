@extends('layouts.layoutadmin')

@section('topmenu')
<div class="head">
    <a href="{{ route('prisoncases.create') }}" class="">Add New Case</a>


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
                <li><a href="{{ route('prisoncases.filterByLocation', ['location' => $location->id]) }}">{{ $location->name }}</a></li>
            @endforeach
            <li><a href="{{ route('prisoncases.index') }}">Alles</a></li>
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

   <!-- Search Form -->
     <!-- Search Form -->
     <form action="{{ route('prisoncases.index') }}" method="GET" class="search-form flex items-center">
        <input type="text" name="search" placeholder="Search by Zaakreden or Zaaknummer" value="{{ request()->query('search') }}" class="border rounded p-2">
        <button type="submit" class="ml-2 p-2 bg-blue-500 text-white rounded"><i class="material-icons md-24">search</i></button>
    </form>
<div class="arrestanten_container">

    <table id="customers">
        <thead>
            <tr>
                <th>zaaknummer</th>
                <th>zaakreden</th>
                <th>locatie</th>
                <th class="actie">Actie</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cases as $case)
                <tr>
                    <td>{{ $case->id }}</td>
                    <td>{{ $case->zaakreden }}</td>
                    <td>{{ $case->location ? $case->location->name : 'N/A' }}</td>
                    <td class="actions">
                        <a href="{{ route('prisoncases.edit', ['prisonCase' => $case->id]) }}" class="btn-edit">Edit</a>

                        <span class="separator">|</span>
                        <a href="{{ route('prisoncases.delete', $case->id) }}" class="btn-delete">Delete</a>
                            <span class="separator">|</span>
                        <a href="{{ route('prisoncases.show', ['prisoncase' => $case->id]) }}" class="btn-info">Info</a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {{ $cases->appends(request()->input())->links('vendor.pagination.bootstrap-5') }}

    </div>
</div>

@endsection
