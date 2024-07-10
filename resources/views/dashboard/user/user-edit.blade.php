@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit User</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <h1>Edit form</h1>
        {{-- <div>
            <x-input type="text" name="name" placeholder="Name" value="{{ $user->name }}" class="w-full" required />
        </div>
        <div>
            <x-input type="email" name="email" placeholder="Email" value="{{ $user->email }}" class="w-full" required />
        </div>
        <div>
            <x-input type="text" name="role" placeholder="Role" value="{{ $user->role }}" class="w-full" required />
        </div>
        <div>
            <x-button type="submit">Update User</x-button> --}}
        </div>
    </form>
</div>
@endsection
