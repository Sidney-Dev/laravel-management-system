<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // lists all users and displays the form to create a new user
    public function index()
    {
        $users = User::all();
        return view('dashboard.user.user-management', compact('users'));
    }

    // creates a new user
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            // 'role' => 'required',
        ]);

        /**
         * @todo add temporary password
         */

        User::create($validated_data);

        return redirect()->route('users.index')->with('success', 'User added successfully');
    }

    public function edit(User $user)
    {
        return view('dashboard.user.user-edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
        ]);

        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
