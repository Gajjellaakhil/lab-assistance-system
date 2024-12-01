@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Feedback for Your Labs</h1>
    <ul>
        @foreach($feedbacks as $feedback)
            <li>
                <strong>{{ $feedback->user->name }}</strong> (Module: {{ $feedback->module->name }})<br>
                {{ $feedback->content }}
            </li>
        @endforeach
    </ul>
</div>
@endsection
