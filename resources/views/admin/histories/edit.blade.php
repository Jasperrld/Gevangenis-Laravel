@extends('layouts.layoutadmin')

@section('topmenu')
<div class="head">
    <a href="{{ route('histories.index') }}" class='btn-back'><i class='material-icons md-24'>arrow_back</i></a>
</div>
@endsection

@section('content')
<div class="form-container">
    <h1>Edit Historie</h1>
    <form action="{{ route('histories.update', ['historie' => $historie->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Naam</label>
            <input type="text" name="name" id="name" value="{{ old('name', $historie->name) }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="arrestatiereden">Arrestatiereden</label>
            <input type="text" name="arrestatiereden" id="arrestatiereden" value="{{ old('arrestatiereden', $historie->arrestatiereden) }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="zaak_id">Zaak_id</label>
            <input type="text" name="zaak_id" id="zaak_id" value="{{ old('zaak_id', implode(', ', json_decode($historie->zaak_id))) }}" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
