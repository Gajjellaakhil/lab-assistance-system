@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Submit Lab Request</h1>
    <a href="{{ route('student.dashboard') }}" class="btn btn-primary">Go to Dashboard</a>

    <form action="{{ route('lab-requests.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" class="form-control" required></textarea>
            @error('description')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="screenshot">Screenshot (optional)</label>
            <input type="file" id="screenshot" name="screenshot" accept="image/*" class="form-control">
            @error('screenshot')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Submit Lab Request</button>
    </form>
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

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .form-control:focus {
        border-color: #007bff;
    }

    .error {
        color: #dc3545;
        font-size: 0.9rem;
        margin-top: 0.25rem;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-align: center;
    }

    .btn-primary {
        background-color: #007bff;
    }

    .btn-success {
        background-color: #28a745;
    }

    .btn:hover {
        opacity: 0.9;
    }
</style>
@endsection
