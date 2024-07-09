@extends('layouts.dashboard')

@section('content')
<div class="task-form-content max-w-2xl">

    <form action="{{ route('task.store', $project->id) }}" method="post">
        @csrf

        <div class="mt-2">
            <x-forms.input-group id="name" label="Task Name" name="name" type="text" placeholder="Name of the task" />
            @error('name')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-4">
            <x-forms.input-group 
                id="description" 
                label="Description (optional)" 
                name="description" 
                type="textarea" 
                placeholder="Optional description" 
                cols="30" 
                rows="10"   
            />
        </div>

        <div class="mt-4">
            <div class="flex gap-1 w-full">
                <div class="w-1/2">
                    <x-forms.input-group id="start_date" label="Task Start Date" name="start_date" type="date" />
                    @error('start_date')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-1/2">
                    <x-forms.input-group id="end_date" label="Task End Date" name="end_date" type="date" />
                    @error('end_date')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mt-4">
            <label class="block text-gray-700 text-base font-bold mb-2" for="status">Status</label>
            <x-forms.input-group id="pending" label="Pending" name="status" type="radio" value="pending" />
            <x-forms.input-group id="in-progress" label="In Progress" name="status" type="radio" value="in progress" />
            <x-forms.input-group id="in-review" label="In Review" name="status" type="radio" value="in review" />
            <x-forms.input-group id="done" label="Done" name="status" type="radio" value="done" />
            <x-forms.input-group id="needs-assistance" label="Needs Assistance" name="status" type="radio" value="needs assistance" />
            @error('status')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- <div class="mt-4">
            <x-forms.input-group id="owner_id" label="Owner" name="owner_id" type="text" placeholder="User ID of the owner" />
            @error('owner_id')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div> --}}

        <div class="mt-4">
            <label class="block text-gray-700 text-base font-bold mb-2" for="owner_id">Owner</label>
            <select name="owner_id" id="owner_id" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="">Unassigned</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
            @error('owner_id')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <input type="hidden" name="project_id" value="{{ $project->id }}">
        <input type="hidden" name="reporter_id" value="{{ Auth::id() }}">

        <div class="mt-2">
            <div class="flex items-center">
                <x-cta.button-primary text="Save"></x-cta.button-primary>
            </div>
        </div>
    </form>
</div>
@endsection
