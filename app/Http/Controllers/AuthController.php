<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        $currentDate = Carbon::now()->format('d F Y');
        return view('auth.login')->with([
            'date' => $currentDate
        ]);
    }

    public function indexRegister()
    {
        $currentDate = Carbon::now()->format('d F Y');
        return view('auth.register')->with([
            'date' => $currentDate
        ]);
    }
    public function registerCheckEmail(Request $r)
    {
        $email = $r->email;

        $emailExists = User::where('email', $email)->exists();

        return response()->json(['available' => !$emailExists]);
    }
    public function registerCheck(Request $r)
    {
        $r->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[!@#$%^&*.]/'
            ]
        ]);

        $name = $r->input('name');
        $email = $r->input('email');
        $password = md5($r->input('password'));

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);

        return redirect()->to('/login')->with([
            'from' => 'registerSuccess'
        ]);
    }
    public function loginCheck(Request $r)
    {
        $r->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $hashedPassword = md5($r->input('password'));

        $user = User::where('email', $r->input('email'))
            ->where('password', $hashedPassword)
            ->first();

        if (!$user) {
            return back()->with(['error' => 'Invalid email or password']);
        }

        Auth::login($user);

        return redirect()->to('/')->with('from', 'loginSuccessful');
    }
    public function logout()
    {
        Auth::logout();

        return redirect('/')->with('success', 'You have been logged out.');
    }
}
