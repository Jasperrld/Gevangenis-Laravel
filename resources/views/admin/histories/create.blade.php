@extends('layouts.layoutadmin')

@section('topmenu')
<div class="head">
    <a href="{{ route('histories.index') }}" class='btn-back'><i class='material-icons md-24'>arrow_back</i></a>
</div>
@endsection

@section('content')
<div class="form-container">
    <h1>Create Historie</h1>
    <form action="{{ route('histories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Naam</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="arrestatiereden">Arrestatiereden</label>
            <input type="text" name="arrestatiereden" id="arrestatiereden" value="{{ old('arrestatiereden') }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="zaak_id">Zaak_id</label>
            <input type="text" name="zaak_id" id="zaak_id" value="{{ old('zaak_id') }}" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
