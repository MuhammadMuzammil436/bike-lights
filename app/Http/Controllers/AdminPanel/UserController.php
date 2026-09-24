<?php

namespace App\Http\Controllers\AdminPanel;

use App\Helpers\UserLogHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function Users()
    {
        $data['title'] = 'Users';
        $data['users'] = User::all();

        return view('adminpanel.users', $data);
    }

    public function AddUser(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|in:staff,admin',
        ]);
        $user = User::create([
            'name' => ucwords(strtolower($validate['name'])),
            'email' => strtolower($validate['email']),
            'password' => Hash::make($validate['password']),
            'role' => strtolower($validate['role']),
        ]);
        // dd()
        UserLogHelper::log($user->id, 'create user', 'adminpanel', 'user created: '.$user->name.' successfull');

        return redirect()
            ->route('users')
            ->with('success', 'User created successfully.');
    }
}
