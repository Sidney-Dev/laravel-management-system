@extends('layouts.dashboard')

@section('content')

<div class="flex justify-between mb-4 items-center">
    <h1 class="text-[32px] font-bold">Projects</h1>
    <x-cta.link-primary text="Create Project" link="{{ route('project.create') }}" />
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
                            <div class="flex items-center">
                                <a href="{{ route('project.edit', $project->id) }}" class="text-green-600 hover:text-blue-800 mr-4">                    
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                                <form class="flex" action="{{ route('project.delete', $project->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:text-red-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
