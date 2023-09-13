<?php 

namespace App\Service;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService 
{
    public function login($request)
    {
        $credentials = $request->only('email', 'password');
        $token = Auth::attempt($credentials);
        return $token;
    }

    public function register($request) 
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }
}