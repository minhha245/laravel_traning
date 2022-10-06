<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repository\UserRepository;
use Hash;
use App\Http\Requests\LoginRequests;


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

    public function customLogin(LoginRequests $request)
    {
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
        $email = $request->input('email');
        $name = $request->input('name');
        $pass = Hash::make($request->input('password'));
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $pass,
        ];
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
