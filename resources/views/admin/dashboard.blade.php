@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <h1 class="dashboard-title">Admin Dashboard</h1>

    <!-- Navigation Links -->
    <div class="dashboard-links">
        <a href="{{ route('admin.modules') }}" class="dashboard-link">Manage Modules</a>
        <a href="{{ route('admin.feedback') }}" class="dashboard-link">Manage Feedback</a>
        <a href="{{ route('admin.enroll.student.form') }}" class="dashboard-link">Enroll Students</a>
        <a href="{{ route('admin.add.staff.form') }}" class="dashboard-link">Add Staff</a>
        <a href="{{ route('lab-requests.admin.index') }}" class="dashboard-link">View Lab Requests</a>
    </div>

    <!-- Logout Button -->
    <form method="POST" action="{{ route('admin.logout') }}" class="logout-form">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
</div>

<!-- Custom Styles for Admin Dashboard -->
<style>
    .dashboard-container {
        max-width: 800px;
        margin: 2rem auto;
        padding: 2rem;
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
        text-align: center;
        font-family: Arial, sans-serif;
    }

    .dashboard-title {
        font-size: 2rem;
        color: #333333;
        margin-bottom: 1.5rem;
    }

    .dashboard-links {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .dashboard-link {
        display: block;
        text-decoration: none;
        background-color: #007bff;
        color: #ffffff;
        padding: 0.75rem 1rem;
        border-radius: 5px;
        font-size: 1rem;
        transition: background-color 0.3s ease;
    }

    .dashboard-link:hover {
        background-color: #0056b3;
    }

    .logout-form {
        margin-top: 1.5rem;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        border-radius: 5px;
        cursor: pointer;
        color: #ffffff;
        transition: background-color 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #b02a37;
    }
</style>
@endsection
