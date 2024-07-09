@extends('layouts.dashboard')

@section('content')

    <div class="project-header">
        <h1 class="text-[32px] font-bold">Project Update</h1>
    </div>

    <div class="project-form-content max-w-2xl">

        <form action="{{ route('project.update', $project->id) }}" method="post">
            @csrf
            @method('PATCH')
            
            <div class="mt-2">
                <x-forms.input-group 
                    id="name" 
                    label="Project Name" 
                    name="name" 
                    type="text" 
                    placeholder="Name of the project"
                    value="{{ $project->name }}" />
                @error('name')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <div class="flex gap-1 w-full">
                    <div class="w-1/2">
                        <x-forms.input-group 
                        id="start_date" 
                        label="Project Start Date" 
                        name="start_date" 
                        type="date"
                        value="{{ $project->start_date }}"/>
                        @error('start_date')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-1/2">
                        <x-forms.input-group 
                        id="end_date" 
                        label="Project End Date" 
                        name="end_date" 
                        type="date"
                        value="{{ $project->end_date }}"/>
                        @error('end_date')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-gray-700 text-base font-bold mb-2" for="priority">Priority</label>
                <x-forms.input-group 
                    id="low" 
                    label="Low" 
                    name="priority" 
                    type="radio" 
                    value="low" 
                    :checked="old('priority', $project->priority ?? 'low') == 'low'" />
                <x-forms.input-group 
                    id="medium" 
                    label="Medium" 
                    name="priority" 
                    type="radio" 
                    value="medium" 
                    :checked="old('priority', $project->priority ?? 'medium') == 'medium'" />
                <x-forms.input-group 
                    id="urgent" 
                    label="Urgent" 
                    name="priority" 
                    type="radio" 
                    value="urgent"
                    :checked="old('priority', $project->priority ?? 'urgent') == 'urgent'" />
                @error('priority')
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
                value="{{ $project->description }}" />

            <div class="mt-2">
                <div class="flex items-center">
                    <x-cta.button-primary text="Update"></x-cta.button-primary>
                    <x-cta.link-primary text="Back" link="{{ route('project.index') }}"></x-cta.button-primary>
                </div>
            </div>
        </form>


    </div>

@endsection