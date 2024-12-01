@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modules</h1>
    <a href="{{ route('admin.modules.create') }}" class="btn btn-primary">Add New Module</a>
    <ul>
        @foreach ($modules as $module)
            <li>
                {{ $module->name }} - {{ $module->description ?? 'No Description' }}
            </li>
        @endforeach
    </ul>
</div>
@endsection
