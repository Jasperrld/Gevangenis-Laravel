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
    <form action="{{ route('visitors.destroy', ['visitor' => $visitor->id]) }}" class="arrestanten-new-form" method="post" enctype="multipart/form-data">
        @method('DELETE')

        @csrf

        <label for="name">Naam:</label>
        <input type="text" id="name" name="name" value="{{ $visitor->name }}" disabled/><br>


        <label for="BSN_nummer">BSN-nummer:</label>
        <input type="number" id="BSN_nummer" name="BSN_nummer" value="{{ $visitor->BSN_nummer }}" disabled><br>


        <input type="submit" value="Delete">
    </form>
</div>
@endsection
