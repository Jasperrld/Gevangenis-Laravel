@extends('layouts.layoutadmin')

@section('content')
<h2>Log Details</h2>
<div class="log-details">
    <table>
        <tr>
            <th>ID:</th>
            <td>{{ $log->id }}</td>
        </tr>
        <tr>
            <th>Model Type:</th>
            <td>{{ $log->model_type }}</td>
        </tr>
        <tr>
            <th>Model ID:</th>
            <td>{{ $log->model_id }}</td>
        </tr>
        <tr>
            <th>Action:</th>
            <td>{{ $log->action }}</td>
        </tr>
        <tr>
            <th>Changes:</th>
            <td>
                <pre>{{ json_encode($log->changes, JSON_PRETTY_PRINT) }}</pre>
            </td>
        </tr>
        <tr>
            <th>Timestamp:</th>
            <td>{{ $log->created_at }}</td>
        </tr>
    </table>
</div>
<a href="{{ route('logs.index') }}" class="btn btn-primary">Back to Logs</a>
@endsection
