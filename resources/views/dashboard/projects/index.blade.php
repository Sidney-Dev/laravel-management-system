@extends('layouts.dashboard')

@section('content')

<div class="flex justify-between mb-4 items-center">
    <h1 class="text-[32px] font-bold">Main content</h1>
    <x-cta.link-primary text="Create Project" link="{{ route('project.create') }}" />
</div>

<div class="main-content bg-white shadow-md rounded-lg p-6">
    @if($projects)
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
              <tr>
                <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600">Name</th>
                <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600">Start Date</th>
                <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600">End Date</th>
                <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600">Priority</th>
                <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600">Actions</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-2 border-b border-gray-200">{{ $project->name }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $project->start_date }}</td>  
                        <td class="px-4 py-2 border-b border-gray-200">{{ $project->end_date }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $project->priority }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">
                            <a href="" class="text-blue-600 hover:text-blue-800 mr-4">Edit</a>
                            <a href="" class="text-red-600 hover:text-red-800">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
