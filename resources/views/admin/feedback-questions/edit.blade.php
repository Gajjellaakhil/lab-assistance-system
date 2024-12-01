@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Feedback Question</h1>
    <form method="POST" action="{{ route('feedback-questions.update', $feedbackQuestion->id) }}">
        @csrf
        @method('PUT')
        <div>
            <label for="question_text">Question</label>
            <input type="text" name="question_text" value="{{ old('question_text', $feedbackQuestion->question_text) }}" required>
        </div>
        <button type="submit">Update Question</button>
    </form>
</div>
@endsection
