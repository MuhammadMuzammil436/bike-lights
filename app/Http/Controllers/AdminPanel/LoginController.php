<?php

namespace App\Http\Controllers\AdminPanel;

use App\Helpers\UserLogHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function LoginPage()
    {
        if (session()->has('id')) {
            return redirect()->route('admin.dashboard');
        }

        return view('adminpanel.login');
    }

    public function LoginForm(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        $email = $validate['email'];
        $password = $validate['password'];
        $user = User::where('email', $request->email)->first();

        // return $user;
        if (! $user) {
            $message = 'User not found';
            UserLogHelper::log(null, 'login', 'adminpanel', $message, null, $validate);

            return redirect()
                ->route('login.page')
                ->withErrors([
                    'login' => 'Invalid email or password',
                ])
                ->withInput();
        }
        if (! Hash::check($password, $user->password)) {
            $message = 'Incorrect password user is: '.$user->name;
            UserLogHelper::log($user->id, 'login', 'adminpanel', $message, null, $validate);

            return redirect()
                ->route('login.page')
                ->withErrors([
                    'login' => 'Invalid email or password',
                ])
                ->withInput();
        }
        if ($user->is_active == 0) {
            $message = 'Inactive user: '.$user->name;
            UserLogHelper::log($user->id, 'login', 'adminpanel', $message, null, $validate);

            return redirect()
                ->route('login.page')
                ->withErrors([
                    'login' => 'Your account is inactive. Please contact the administrator.',
                ])
                ->withInput();
        }
        session([
            'id' => $user->id,
            'name' => $user->name,
        ]);
        if (session()->has('id')) {
            $message = 'Login susscess user: '.$user->name;
            UserLogHelper::log($user->id, 'login', 'adminpanel', $message, null, $validate);

            return redirect()->route('admin.dashboard');
        }
    }

    public function LogOut()
    {
        $id = session('id');
        UserLogHelper::log($id, 'logout', 'adminpanel', 'user: '.session('name').' logout successfull');
        session()->forget([
            'id',
            'name',
        ]);

        return redirect()->route('admin.logout');
    }
}
