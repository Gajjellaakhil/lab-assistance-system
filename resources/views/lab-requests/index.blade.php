@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lab Requests</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($labRequests->isEmpty())
        <p>No lab requests found.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Screenshot</th>
                    <th>Submitted At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($labRequests as $request)
                    <tr>
                        <td>{{ $request->description }}</td>
                        <td>
                            @if($request->screenshot)
                                <img src="{{ asset('storage/' . $request->screenshot) }}" alt="Screenshot" style="max-width: 100px;">
                            @else
                                No Screenshot
                            @endif
                        </td>
                        <td>{{ $request->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<style>
    .container {
        max-width: 900px;
        margin: 2rem auto;
        padding: 2rem;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #007bff;
    }

    .alert-success {
        background-color: #28a745;
        color: white;
        padding: 1rem;
        border-radius: 5px;
        margin-bottom: 1rem;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: #007bff;
        color: white;
    }

    td {
        background-color: #f9f9f9;
    }

    img {
        max-width: 100px;
        border-radius: 5px;
    }
</style>
@endsection
