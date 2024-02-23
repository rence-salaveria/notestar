<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Traits\HttpResponse;

class AuthController extends Controller
{
    use HttpResponse;

    public function login(LoginUserRequest $request)
    {
        $credentials = $request->validated();

        if (!auth()->attempt($credentials)) {
            return $this->error('Wrong credentials', 401);
        }

        $token = auth()->user()->createToken('authToken')->plainTextToken;

        $user = User::where('email', $credentials['email'])->first();

        return $this->success([
            'user' => $user,
            'token' => $token
        ], 'Login Successful');
    }

    public function register(RegisterUserRequest $request)
    {
        $credentials = $request->validated();

        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => bcrypt($credentials['password']),
        ]);

        $tokenMemo = "Auth Token for " . $user->name;
        $token = $user->createToken($tokenMemo)->plainTextToken;

        return $this->success([
            'user' => $user,
            'token' => $token
        ], 'User registration successful', 201);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return $this->success([], 'Logged out successfully');
    }
}
