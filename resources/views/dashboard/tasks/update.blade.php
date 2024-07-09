@extends('layouts.dashboard')

@section('content')

    <div class="task-header">
        <h1 class="text-[32px] font-bold">Edit - {{ $task->name }}</h1>
    </div>

    <div class="task-form-content max-w-2xl">

        <form action="{{ route('task.update', [$task->project->id, $task->id]) }}" method="post">
            @csrf
            @method('PATCH')
            
            <div class="mt-2">
                <x-forms.input-group 
                    id="name" 
                    label="Task Name" 
                    name="name" 
                    type="text" 
                    placeholder="Name of the task"
                    value="{{ $task->name }}" />
                @error('name')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <div class="flex gap-1 w-full">
                    <div class="w-1/2">
                        <x-forms.input-group 
                        id="start_date" 
                        label="Task Start Date" 
                        name="start_date" 
                        type="date"
                        value="{{ $task->start_date }}"/>
                        @error('start_date')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-1/2">
                        <x-forms.input-group 
                        id="end_date" 
                        label="Task End Date" 
                        name="end_date" 
                        type="date"
                        value="{{ $task->end_date }}"/>
                        @error('end_date')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-slate-200 text-base font-bold mb-2" for="owner_id">Status</label>
                <select name="status" id="status" class="block appearance-none w-full bg-slate-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option class="" value="{{ $task->status }}">{{ $task->status }}</option>

                    @if($task->status !== 'pending')
                        <option value="pending">Pending</option>
                    @endif
                    
                    @if($task->status !== 'in progress')
                    <option value="in progress">In Progress</option>
                    @endif
                    
                    @if($task->status !== 'in review')
                        <option value="in review">In Review</option>
                    @endif
                    
                    @if($task->status !== 'done')
                        <option value="done">Done</option>
                    @endif
                    
                    @if($task->status !== 'needs assistance')
                        <option value="needs assistance">Needs Assistance</option>
                    @endif
                    

                </select>
                @error('status')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <x-forms.input-group 
                id="description" 
                label="Description (optional)" 
                name="description" 
                type="textarea" 
                placeholder="Optional description" 
                cols="30" 
                rows="10"
                value="{{ $task->description }}" />

            <div class="mt-2">
                <div class="flex items-center">
                    <x-cta.button-primary text="Update"></x-cta.button-primary>
                    <x-cta.link-primary text="Back to tasks" link="{{ route('task.index', [$task->project->id]) }}"></x-cta.button-primary>
                </div>
            </div>
        </form>


    </div>

@endsection