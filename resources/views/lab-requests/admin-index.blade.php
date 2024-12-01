@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Uncompleted Lab Requests</h1>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Go to Dashboard</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($labRequests->isEmpty())
        <p class="text-muted">No uncompleted lab requests found.</p>
    @else
        <ul class="lab-requests-list">
            @foreach ($labRequests as $labRequest)
                <li class="lab-request-item">
                    <div class="details">
                        <p><strong>Request ID:</strong> {{ $labRequest->id }}</p>
                        <p><strong>Description:</strong> {{ $labRequest->description }}</p>
                    </div>
                    <div class="actions">
                        <form action="{{ route('lab-requests.admin.complete', $labRequest->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Mark as Complete</button>
                        </form>
                        <a href="{{ route('lab-requests.show', $labRequest->id) }}" class="btn btn-info">View Details</a>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>

<style>
    /* General Container Styling */
    .container {
        max-width: 800px;
        margin: 2rem auto;
        padding: 2rem;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        margin-bottom: 1.5rem;
        color: #007bff;
    }

    /* Alert Success Message */
    .alert.alert-success {
        padding: 1rem;
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
        border-radius: 5px;
        margin-bottom: 1rem;
    }

    /* Empty State Text */
    .text-muted {
        color: #6c757d;
        text-align: center;
        margin: 2rem 0;
    }

    /* Lab Requests List Styling */
    .lab-requests-list {
        list-style: none;
        padding: 0;
    }

    .lab-request-item {
        padding: 1rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        background-color: #f9f9f9;
        transition: background-color 0.3s ease;
    }

    .lab-request-item:hover {
        background-color: #f1f1f1;
    }

    .details {
        max-width: 65%;
    }

    .details p {
        margin: 0.2rem 0;
    }

    .actions {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .btn {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 0.9rem;
        text-decoration: none;
        text-align: center;
        color: #fff;
    }

    .btn-primary {
        background-color: #007bff;
    }

    .btn-success {
        background-color: #28a745;
    }

    .btn-info {
        background-color: #17a2b8;
    }

    .btn:hover {
        opacity: 0.9;
    }
</style>
@endsection
