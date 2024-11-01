@extends('layouts.layoutadmin')

@section('topmenu')
<div class="head flex justify-between items-center bg-gray-800 text-white py-4 px-6">
    <h1 class="text-2xl font-bold">Dashboard</h1>
    <div class="flex space-x-4">
        <a href="{{ route('admin.users.index') }}" class="btn-new">Gebruikers</a>
        <a href="{{ route('admin.roles.index') }}" class="btn-new">Rollen</a>
    </div>
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

<div class="panel-cointainer">
    <h1>Dashboard</h1>
    <div class="admin">    <img src="{{ asset('img/admin.jpg') }}" alt="admin">
</div>

</div>
<style>
    .panel-container {
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
        padding: 20px;
    }

    .admin img {
        width: 30%;
        max-width: 100%;
        height: auto;
        display: block;
        margin: 0 auto;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        margin-bottom: 20px;
    }
</style>


@endsection
