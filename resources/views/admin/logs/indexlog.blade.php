@extends('layouts.layoutadmin')

@section('content')
<div class="arrestanten_container">
    <form action="{{ route('logs.index') }}" method="GET">
        <div class="head pb-1">
        <div class="row">
            <div class="col">
                <input type="text" class="form-control ml-2 mt-1" name="model_type" placeholder="Search by Model Type" value="{{ request('model_type') }}">
            </div>
            <div class="col">
                <input type="text" class="form-control ml-2" name="action" placeholder="Search by Action" value="{{ request('action') }}">
            </div>
            <div class="col ml-2">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </div>
    </form>
</div>
<table id="customers">
    <thead>
        <tr>
            <th>ID</th>
            <th>Model Type</th>
            <th>Model ID</th>
            <th>Action</th>
            <th id="changes">Changes</th>
            <th>Timestamp</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($logs as $log)
            <tr>
                <td>{{ $log->id }}</td>
                <td>{{ $log->model_type }}</td>
                <td>{{ $log->model_id }}</td>
                <td>{{ $log->action }}</td>
                <td id="changes"><pre class="changes-content">{{ json_encode($log->changes, JSON_PRETTY_PRINT) }}</pre></td>
                <td>{{ $log->created_at }}</td>
                <td>
                    <a href="{{ route('logs.show', ['log' => $log->id]) }}" class="btn btn-info">View</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination">    {{ $logs->appends(request()->except('page'))->links('vendor.pagination.bootstrap-5') }}

</div>
@endsection
