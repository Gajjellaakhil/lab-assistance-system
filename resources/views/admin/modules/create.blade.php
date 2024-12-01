@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Module</h1>
    <form method="POST" action="{{ route('admin.modules.Store') }}">
        
        @csrf
        <div>
            <label for="name">Module Name</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="description">Description (Optional)</label>
            <textarea name="description" id="description"></textarea>
        </div>
        <button type="submit">Create Module</button>
    </form>
</div>
@endsection
