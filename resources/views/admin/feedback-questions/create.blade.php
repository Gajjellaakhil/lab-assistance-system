@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Feedback Question</h1>
    <form method="POST" action="{{ route('feedback-questions.store') }}">
        @csrf
        <div>
            <label for="question_text">Question</label>
            <input type="text" name="question_text" required>
        </div>
        <button type="submit">Add Question</button>
    </form>
</div>
@endsection
