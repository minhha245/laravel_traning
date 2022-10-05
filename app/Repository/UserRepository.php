<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    public function register($data)
    {
        return User::create($data);
    }

    public function logout()
    {
        return Auth::logout();
    }
}
