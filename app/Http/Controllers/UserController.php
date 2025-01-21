<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_fullname' => 'required|string|max:255',
            'user_email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'user_fullname' => $validated['user_fullname'],
            'user_email' => $validated['user_email'],
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'user_fullname' => 'string|max:255',
            'user_email' => 'string|email|max:255|unique:users,user_email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

        $user->update([
            'user_fullname' => $validated['user_fullname'] ?? $user->user_fullname,
            'user_email' => $validated['user_email'] ?? $user->user_email,
            'password' => isset($validated['password']) ? Hash::make($validated['password']) : $user->password,
        ]);

        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully.']);
    }

    public function countUser()
    {
        $userCount = User::count();
        return response()->json(['count' => $userCount]);
    }

    public function countUserLogin()
    {
        $userLoginCount = User::where('user_status', '1')->count();
        return response()->json(['count' => $userLoginCount]);
    }
}
