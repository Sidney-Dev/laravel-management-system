@extends('layouts.dashboard')

@section('content')

    <div class="project-header">
        <h1 class="text-[32px] font-bold">Create Project</h1>
    </div>

    <div class="project-form-content max-w-2xl">

        <form action="{{ route('project.store') }}" method="post">
            @csrf

            <div class="mt-2">
                <x-forms.input-group id="name" label="Project Name" name="name" type="text" placeholder="Name of the project" />
                @error('name')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <div class="flex gap-1 w-full">
                    <div class="w-1/2">
                        <x-forms.input-group id="start_date" label="Project Start Date" name="start_date" type="date" />
                        @error('start_date')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-1/2">
                        <x-forms.input-group id="end_date" label="Project End Date" name="end_date" type="date" />
                        @error('end_date')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-gray-700 text-base font-bold mb-2" for="priority">Priority</label>
                <x-forms.input-group id="low" label="Low" name="priority" type="radio" value="low" />
                <x-forms.input-group id="medium" label="Medium" name="priority" type="radio" value="medium" />
                <x-forms.input-group id="high" label="High" name="priority" type="radio" value="high" />
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
            />

            <div class="mt-2">
                <button class="bg-purple-900 hover:bg-back text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Save</button>
            </div>
        </form>


    </div>

@endsection