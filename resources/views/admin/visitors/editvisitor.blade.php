@extends('layouts.layoutadmin')

@section('topmenu')


@endsection

@section('content')

   <!-- errors -->

   @if($errors->any())
        <div class="bg-red-200 text-red-900 rounded-lg shadow-md p-6 pr-10 mb-8" >
            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>

    @endif

    <!-- end errors -->
<div class="arrestanten-new-container">
    <button class="Terug" onclick="window.history.back()">Terug</button>
    <h2>Add New Arrestant</h2>
    <form action="{{ route('visitors.update', ['visitor' => $visitor->id]) }}" class="arrestanten-new-form" method="post" enctype="multipart/form-data">
        @method('PUT')

        @csrf
        <input type="hidden" name="action" value="AddArrestant">

        <label for="name">Naam:</label>
        <input type="text" id="name" name="name" value="{{ old('name', $visitor->name) }}"><br>


        <label for="BSN_nummer">BSN-nummer:</label>
        <input type="number" id="BSN_nummer" name="BSN_nummer" value="{{ old('BSN_nummer', $visitor->BSN_nummer) }}"><br>

        <div class="form-group">
            <label for="location_id">Location</label>
            <select name="location_id" id="location_id" class="form-control" required>
                @foreach($locations as $location)
                    <option value="{{ $location->id }}" {{ $visitor->location_id == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                @endforeach
            </select>
        </div>

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
        $('#prison_cases').select2({
            placeholder: 'Select prisoners',
            allowClear: true,
            closeOnSelect: false,
            width: '100%' // Changed width to 100% to match your style
        });
    });
</script>
@endsection
