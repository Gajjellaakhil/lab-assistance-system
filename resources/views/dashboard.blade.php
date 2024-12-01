@extends('layouts.app')

@section('title', 'Dashboard')  {{-- Title section defined for 'title' yield in layout --}}

@section('content')  {{-- Content section for 'content' yield in layout --}}
<div class="container">
    <h1>Welcome to the Dashboard</h1>
    <p>This is the main content area. You can manage your lab requests and more here.</p>

    <div class="btn-group">
        <a href="{{ route('lab-requests.create') }}" class="btn btn-primary">Create Request</a>
        <a href="{{ route('lab-requests.index') }}" class="btn btn-primary">Lab Requests</a>
    </div>

    {{-- Logout form --}}
    <form method="POST" action="{{ route('logout') }}" style="margin-top: 1rem;">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
</div>

<style>
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
        color: #007bff;
    }

    p {
        text-align: center;
        margin-bottom: 2rem;
        color: #555;
    }

    .btn-group {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    button {
        padding: 0.75rem 1.5rem;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #0056b3;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }
</style>
@endsection
