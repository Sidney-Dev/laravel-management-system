@php
    $roleNames = $userRoles->pluck('name')->toArray();
    $admin_or_manager = false;
    if((in_array('admin', $roleNames) || in_array('manager', $roleNames))) {
        $admin_or_manager = true;
    }
@endphp
@extends('layouts.dashboard')

@section('content')

<div class="flex justify-between mb-4 items-center">
    
    <h1 class="text-[32px] font-bold">Projects</h1>
    @if($admin_or_manager)
        <x-cta.link-primary text="Create Project" link="{{ route('project.create') }}" />
    @endif
</div>    

<div class="main-content bg-white shadow-md rounded-lg p-6">
    @if($projects)
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
              <tr class="bg-gray-200">
                <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600">Name</th>
                <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600">Start Date</th>
                <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600">End Date</th>
                <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600">Priority</th>
                @if($admin_or_manager)
                    <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600">Actions</th>
                @endif
                <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600">Tasks</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-2 border-b border-gray-200">{{ $project->name }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $project->start_date }}</td>  
                        <td class="px-4 py-2 border-b border-gray-200">{{ $project->end_date }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $project->priority }}</td>
                        @if($admin_or_manager)
                            <td class="px-4 py-2 border-b border-gray-200">
                                <div class="flex items-center">
                                    <a href="{{ route('project.edit', $project->id) }}" class="text-green-600 hover:text-blue-800 mr-4">                    
                                        <x-icons.pencil></x-icons.pencil>
                                    </a>
                                    <form class="flex" action="{{ route('project.delete', $project->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:text-red-800">
                                            <x-icons.trash></x-icons.trash>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        @endif
                        <td class="px-4 py-2 border-b border-gray-200">
                            <a href="{{ route('task.index', $project->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
