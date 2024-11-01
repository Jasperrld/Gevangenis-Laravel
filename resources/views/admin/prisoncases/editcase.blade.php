@extends('layouts.layoutadmin')

@section('content')
<div class="arrestanten-new-container">
    <h1>Edit Prison Case</h1><br>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('prisoncases.update', $prisonCase->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div></div>

        <div class="form-group">
            <label for="zaakreden">Case Reason</label>
            <input type="text" class="form-control" id="zaakreden" name="zaakreden" value="{{ old('zaakreden', $prisonCase->zaakreden) }}" required>
        </div>

        <div class="form-group">
            <label for="verslag_pdf">Case Report (PDF)</label>
            <input type="file" class="form-control" id="verslag_pdf" name="verslag_pdf">
            @if ($prisonCase->verslag_pdf_path)
                <a href="{{ Storage::url($prisonCase->verslag_pdf_path) }}" target="_blank">Current PDF</a>
            @endif
        </div>

        <div class="form-group">
            <label for="prisoners">Prisoners</label>
            <select multiple class="form-control" id="prisoners" name="prisoners[]">
                @foreach ($prisoners as $prisoner)
                    <option value="{{ $prisoner->id }}" {{ in_array($prisoner->id, old('prisoners', $prisonCase->prisoners->pluck('id')->toArray())) ? 'selected' : '' }}>
                        {{ $prisoner->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <label for="location_id">Locatie:</label>
        <select id="location_id" name="location_id" class="form-control">
            @foreach($locations as $location)
                <option value="{{ $location->id }}" {{ old('location_id', $prisonCase->location_id) == $location->id ? 'selected' : '' }}>
                    {{ $location->name }}
                </option>
            @endforeach
        </select><br>

        <button type="submit" class="btn btn-primary">Update Prison Case</button>
    </form>
</div>

<!-- Include Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<!-- Include jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Include Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#prisoners').select2({
            placeholder: 'Select prisoners',
            allowClear: true,
            closeOnSelect: false,
            width: '100%' // Changed width to 100% to match your style
        });
    });
</script>
@endsection
