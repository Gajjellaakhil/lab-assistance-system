@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-container">
        <h1>Add Staff</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn-link">Go to Dashboard</a>
        <form method="POST" action="{{ route('admin.add.staff') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role" required>
                    <option value="lecturer">Lecturer</option>
                    <option value="teaching_assistant">Teaching Assistant</option>
                </select>
            </div>
            <button type="submit" class="btn-primary">Add Staff</button>
        </form>
    </div>
</div>

<style>
    /* Container Styles */
    .container {
        max-width: 600px;
        margin: 2rem auto;
        padding: 2rem;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
    }

    .form-container h1 {
        text-align: center;
        margin-bottom: 1.5rem;
        color: #007bff;
    }

    .btn-link {
        display: inline-block;
        margin-bottom: 1.5rem;
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
    }

    .btn-link:hover {
        text-decoration: underline;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: bold;
    }

    .form-group input, .form-group select {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1rem;
    }

    .btn-primary {
        display: inline-block;
        width: 100%;
        background-color: #007bff;
        color: white;
        padding: 0.75rem;
        border: none;
        border-radius: 5px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>
@endsection
