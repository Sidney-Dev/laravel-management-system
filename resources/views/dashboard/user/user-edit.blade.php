@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit User</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PATCH')
        <div>
            <x-forms.input-group
                id="name"
                label="Name"
                name="name"
                type="text"
                placeholder="Enter name"
                value="{{ $user->name }}"
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
                value="{{ $user->email }}"
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
                    <option value="{{ $role->id }}" class="capitalize" @selected($user->roles->contains($role))>{{ $role->name }}</option>
                @endforeach
            </select>
            @error('role')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <x-cta.button-primary text="Add User" />
    </form>
</div>
@endsection
