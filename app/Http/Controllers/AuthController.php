<?php

namespace App\Http\Controllers;

use App\Http\Requests\v1\LoginUserRequest;
use App\Http\Requests\v1\RegisterUserRequest;
use App\Http\Resources\v1\UserResource;
use App\Models\User;
use App\Traits\APIResponseTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use APIResponseTrait;

    // --- User Registration ---
    public function register(RegisterUserRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->success([
            'token' => $token,
            'user' => UserResource::make($user),
        ], 200, 'user registered successfully');
    }

    // --- User Login ---
    public function login(LoginUserRequest $request)
    {
        $validated = $request->validated();

        if (!Auth::attempt($validated)) {
            return $this->failed([], 401, 'Invalid login credentials');
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->success([
            'token' => $token,
            'user' => UserResource::make($user),
        ], 200, 'Successfully logged in');
    }

    // User Logout
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return $this->success([], 200, 'Successfully logged out');
    }
}
