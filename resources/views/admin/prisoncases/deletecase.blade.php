@extends('layouts.layoutadmin')

@section('content')
<div class="arrestanten-new-container">
    <h1>Delete Prison Case</h1><br>
    <div>Are you sure you want to delete the prison case with ID: {{ $prisonCase->id }}?</div>
    <form action="{{ route('prisoncases.destroy', $prisonCase->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
        <a href="{{ route('prisoncases.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
