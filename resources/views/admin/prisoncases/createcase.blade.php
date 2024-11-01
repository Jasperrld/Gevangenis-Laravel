@extends('layouts.layoutadmin')

@section('topmenu')
@endsection

@section('content')
<div class="zaken-new-container">
    <h2>Add Prison Case</h2>
    <form action="{{ route('prisoncases.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="action" value="addprisoncase" />

        <label for="prisoners">Prisoner:</label>
        <select id="prisoners" name="prisoners[]" multiple required style="width: 100%;">
            @foreach ($prisoners as $prisoner)
                <option value="{{ $prisoner->id }}">{{ $prisoner->name }}</option>
            @endforeach
        </select><br><br>

        <label for="location_id">Locatie:</label>
        <select id="location_id" name="location_id" class="form-control">
            @foreach($locations as $location)
                <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                    {{ $location->name }}
                </option>
            @endforeach
        </select><br>

        <label for="zaakreden">Case Reason:</label>
        <textarea id="zaakreden" name="zaakreden" rows="4" cols="50" required></textarea>

        <label for="verslag_pdf">Upload Verslag (PDF):</label>
        <input type="file" id="verslag_pdf" name="verslag_pdf" accept="application/pdf"><br><br>

        <input type="submit" value="Submit">
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
