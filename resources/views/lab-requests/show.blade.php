@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lab Request Details</h1>

    <div class="request-details">
        <p><strong>Description:</strong> {{ $labRequest->description }}</p>

        @if($labRequest->screenshot)
            <p><strong>Screenshot:</strong></p>
            <img src="{{ asset('storage/' . $labRequest->screenshot) }}" alt="Screenshot" class="screenshot">
        @else
            <p>No screenshot available.</p>
        @endif
    </div>

    <form action="{{ route('lab-requests.admin.complete', $labRequest->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Mark as Complete</button>
    </form>

    <a href="{{ route('lab-requests.admin.index') }}" class="btn btn-primary">Back to Lab Requests</a>
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

    .request-details {
        margin-bottom: 2rem;
    }

    .screenshot {
        max-width: 100%;
        border-radius: 10px;
        margin-top: 1rem;
    }

    button {
        padding: 0.75rem 1.5rem;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #218838;
    }

    a.btn {
        padding: 0.75rem 1.5rem;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 1rem;
        display: inline-block;
    }

    a.btn:hover {
        background-color: #0056b3;
    }
</style>
@endsection
