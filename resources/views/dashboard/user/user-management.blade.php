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
                        <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600">Role</th>
                        <th class="px-4 py-2 border-b border-gray-200 text-left text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $user->name }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $user->email }}</td>
                        <td class="py-2 px-4 border-b">
                            @foreach ($user->roles as $role)
                                {{ $role->name }}
                            @endforeach
                        </td>
                        <td class="px-4 py-2 border-b border-gray-200 flex">
                            <x-cta.link-primary class="bg-transparent text-green-500" :link="route('users.edit', $user->id)">
                                <x-icons.pencil></x-icons.pencil>
                            </x-cta.link-primary>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <x-cta.button-primary class="bg-transparent text-rose-600 border-none">
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
                <div>
                    <x-forms.input-group
                        id="name"
                        label="Name"
                        name="name"
                        type="text"
                        placeholder="Enter name"
                        value="{{ old('name') }}"
                    />
                    @error('name')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <x-forms.input-group
                        id="email"
                        label="Email"
                        name="email"
                        type="email"
                        placeholder="Enter email"
                        value="{{ old('email') }}"
                    />
                    @error('email')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="role" class="block text-gray-700 text-base font-bold mb-2">Role</label>
                    <select name="role" id="role" class="rounded-md border-transparent bg-slate-200 w-full focus:outline-none focus:shadow-outline">
                        <option value=""></option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" class="capitalize">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <x-cta.button-primary text="Add User" />
            </form>
        </div>
    </div>

</div>
@endsection
