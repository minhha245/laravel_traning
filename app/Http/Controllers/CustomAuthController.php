<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repository\UserRepository;

class CustomAuthController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login()
    {
        return view('auth.login');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ],
            [
                'email.required' => 'Email is not blank!',
                'password.required' => 'Password is not blank!',

            ]
        );

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect("dashboard")->with('status', 'Signed in');
        }

        return redirect()->back()->with('status', 'Login details are not valid');
    }

    public function registration()
    {
        return view('auth.register');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->userRepository->register($data);
        auth()->login($check);
        return redirect("dashboard")->with('status', 'You have signed-in');
    }

    public function logOut()
    {
        $this->userRepository->logout();
        return Redirect("login");
    }
}
