@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lab Requests</h1>

    @if($labRequests->isEmpty())
        <p>No lab requests found.</p>
    @else
        <ul class="lab-request-list">
            @foreach($labRequests as $request)
                <li class="lab-request-item">
                    <span class="description">{{ $request->description }}</span>
                    <span class="timestamp">{{ $request->created_at->format('d M Y, h:i A') }}</span>
                </li>
            @endforeach
        </ul>
    @endif
</div>

<style>
    /* Container Styles */
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

    .lab-request-list {
        list-style-type: none;
        padding: 0;
    }

    .lab-request-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 1rem;
        background-color: #f9f9f9;
        transition: background-color 0.3s ease;
    }

    .lab-request-item:hover {
        background-color: #f1f1f1;
    }

    .description {
        font-weight: bold;
        color: #333;
    }

    .timestamp {
        font-size: 0.9rem;
        color: #666;
    }
</style>
@endsection
