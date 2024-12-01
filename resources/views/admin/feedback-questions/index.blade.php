@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Feedback Questions</h1>
    <a href="{{ route('feedback-questions.create') }}" class="btn btn-primary">Add New Question</a>
    <ul>
        @foreach ($questions as $question)
            <li>
                {{ $question->question_text }}
                <a href="{{ route('feedback-questions.edit', $question->id) }}">Edit</a> |
                <form action="{{ route('feedback-questions.destroy', $question->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
@endsection
