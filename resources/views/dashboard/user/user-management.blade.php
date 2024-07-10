@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto p-4">

    <div class="flex gap-6 w-full">
    
        <div class="w-1/3">
            <h2 class="text-xl font-bold mb-2">Users List</h2>
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600">Name</th>
                        <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600">Email</th>
                        {{-- <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600">Role</th> --}}
                        <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $user->name }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $user->email }}</td>
                        {{-- <td class="py-2 px-4 border-b">{{ $user->role }}</td> --}}
                        <td class="px-4 py-2 border-b border-gray-200 flex">
                            <x-cta.link-primary class="bg-transparent text-green-300 border-0" :link="route('users.edit', $user->id)">
                                <x-icons.pencil></x-icons.pencil>
                            </x-cta.link-primary>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <x-cta.button-primary class="bg-transparent text-red-900 border-0">
                                    <x-icons.trash></x-icons.trash>
                                </x-cta.button-primary>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mb-6 w-2/3">
            <h2 class="text-xl font-bold mb-2">Add New User</h2>
            <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
                @csrf
                <x-forms.input-group
                    id="name"
                    label="Name"
                    name="name"
                    type="text"
                    placeholder="Enter name"
                    required
                />
                <x-forms.input-group
                    id="email"
                    label="Email"
                    name="email"
                    type="email"
                    placeholder="Enter email"
                    required
                />
                <x-forms.input-group
                    id="role"
                    label="Role"
                    name="role"
                    type="text"
                    placeholder="Enter role"
                    required
                />
                <x-cta.button-primary text="Add User" />
            </form>
        </div>
    </div>

</div>
@endsection
