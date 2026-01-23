<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('students.login');
    }

public function login(Request $request)
{
    $request->validate(
        [
            'email'    => 'required|email',
            'password' => 'required',
        ],
        [
            'email.required'    => 'Email is required',
            'email.email'       => 'Enter a valid email address',
            'password.required' => 'Password is required',
        ]
    );

    $email    = trim(strtolower($request->email));
    $password = $request->password;

    $user = User::where('email', $email)->first();

        if (!$user) {
        return back()->withInput()
            ->with('error', 'Invalid email or password');
    }

    
    if ($user->status === 'inactive') {

        if ($user->role === 'teacher') {
            return back()->withInput()
                ->with('error', 'Teacher not available');
        }

        if ($user->role === 'student') {
            return back()->withInput()
                ->with('error', 'Student not available');
        }
    }

    if (!Hash::check($password, $user->password)) {
        return back()->withInput()
            ->with('error', 'Invalid email or password');
    }

    
    Auth::login($user);
    $request->session()->regenerate();

    return $user->role === 'teacher'
        ? redirect()->route('teacher.dashboard')
        : redirect()->route('student.dashboard');
}

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
