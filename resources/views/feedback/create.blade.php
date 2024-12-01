@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Submit Feedback</h1>
    <form method="POST" action="{{ route('feedback.store') }}">
        @csrf
        <div>
            <label for="module_id">Module</label>
            <select name="module_id" required>
                @foreach($modules as $module)
                    <option value="{{ $module->id }}">{{ $module->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="content">Feedback</label>
            <textarea name="content" rows="5" required></textarea>
        </div>
        <button type="submit">Submit Feedback</button>
    </form>
</div>
@endsection
