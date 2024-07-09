@extends('layouts.dashboard')

@section('content')
<div class="task-details max-w-2xl">

    <h2 class="text-xl font-bold">{{ $task->name }}</h2>
    <p>{{ $task->description }}</p>
    <p><strong>Start Date:</strong> {{ $task->start_date }}</p>
    <p><strong>End Date:</strong> {{ $task->end_date }}</p>
    <p><strong>Status:</strong> {{ $task->status }}</p>
    <p><strong>Owner:</strong> {{ $task->owner ? $task->owner->name : 'Unassigned' }}</p>
    <p><strong>Reporter:</strong> {{ $task->reporter->name }}</p>

</div>
@endsection
