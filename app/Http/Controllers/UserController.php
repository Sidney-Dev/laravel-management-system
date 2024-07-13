<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\AccountCreated;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    // lists all users and displays the form to create a new user
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('dashboard.user.user-management', compact('users', 'roles'));
    }

    // creates a new user
    public function store(Request $request)
    {
        Gate::authorize('create', auth()->user());
        $validated_data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
        ]);

        $user = User::create([
            'name' => $validated_data["name"],
            'email' => $validated_data["email"],
            'password' => Hash::make(env('DEFAULT_PASSWORD'))
        ]);

        $user->roles()->attach($validated_data["role"]);

        $user->notify(new AccountCreated($user));

        return redirect()->route('users.index')->with('success', 'User added successfully');
    }

    // displays the screen where the user form is show for update
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('dashboard.user.user-edit', compact('user', 'roles'));
    }

    // updates the user information
    public function update(Request $request, User $user)
    {
        $validated_user = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
        ]);

        $user->name = $validated_user['name'];
        $user->email = $validated_user['email'];

        if($user->isDirty()) {
            $user->save();
        }

        $user->roles()->sync($validated_user['role']);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    public function logout(Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
