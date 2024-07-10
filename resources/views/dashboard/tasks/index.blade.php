@extends('layouts.dashboard')

@section('content')

<div class="flex justify-between mb-4 items-center">
    <h1 class="text-[32px] font-bold">Tasks for {{ $project->name }} project</h1>
    <x-cta.link-primary text="Create Task" link="{{ route('task.create', $project->id) }}" />
</div>

<div class="main-content bg-white shadow-md rounded-lg p-6">
    @if($tasks->count())
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
              <tr class="bg-gray-200">
                <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600">Name</th>
                <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600">Start Date</th>
                <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600">End Date</th>
                <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600">Status</th>
                <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600">Owner</th>
                <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600">Actions</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-2 border-b border-gray-200">{{ $task->name }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $task->start_date }}</td>  
                        <td class="px-4 py-2 border-b border-gray-200">{{ $task->end_date }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $task->status }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $task->owner?->name }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">
                            <div class="flex items-center">
                                <a href="{{ route('task.edit', [$project->id, $task->id]) }}" class="text-green-600 hover:text-blue-800 mr-4">                    
                                    <x-icons.pencil></x-icons.pencil>
                                </a>
                                <form class="flex" action="{{ route('task.delete', [$project->id, $task->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        <x-icons.trash></x-icons.trash>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-600">No tasks found for this project.</p>
    @endif
</div>

@endsection
