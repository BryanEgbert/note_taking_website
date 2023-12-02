<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $infoMessage = Session::get('infoMessage', '');
        $wrongPasswordMessage = Session::get('wrongPasswordMessage', '');
        return view('login', ['infoMessage' => $infoMessage, 'wrongPasswordMessage' => $wrongPasswordMessage]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials))
        {
            $request->session()->regenerate();

            return redirect()->intended('/notes');
        }

        return Redirect::to('/login')->with('wrongPasswordMessage', 'Password is incorrect');
    }

    public function create(): View
    {
        $errorMessage = Session::get('errorMessage', '');
        return view('signup', ['errorMessage' => $errorMessage]);
    }

    public function store(Request $request)
    {
        // if (!$request->has(['name', 'email', 'password'])) {
        //     return Redirect::to('/register')->with('errorMessage', 'Missing required field(s)');
        // }

        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email', 'max:255'],
            'password' => ['required', 'min:8'],
        ]);

        try 
        {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);
    
            return Redirect::to('/login')->with('infoMessage', 'User successfully registered');
        } catch(UniqueConstraintViolationException $e)
        {
            return Redirect::to('/register')->with('errorMessage', 'Email already exists');
        }

    }

    public function logout()
    {
        Auth::logout();

        return redirect()->intended('/notes');
    }
}
