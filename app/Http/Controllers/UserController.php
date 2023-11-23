<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $errorMessage = Session::get('errorMessage$errorMessage', '');
        return view('login', ['infoMessage' => $infoMessage, 'errorMessage' => $errorMessage]);
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

        return Redirect::to('/login')->with('errorMessage', 'Wrong email or password');
    }

    public function create(): View
    {
        $errorMessage = Session::get('errorMessage', '');
        return view('signup', ['errorMessage' => $errorMessage]);
    }

    public function store(Request $request)
    {
        if (!$request->has(['name', 'email', 'password'])) {
            return Redirect::to('/register')->with('errorMessage', 'Missing required field(s)');
        }

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
}
