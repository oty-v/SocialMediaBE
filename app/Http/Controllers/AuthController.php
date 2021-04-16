<?php

namespace App\Http\Controllers;

use App\Http\Resources\TokenResource;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request): TokenResource
    {
        $fields = $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = User::create($fields);

        return new TokenResource($user);
    }

    public function login(Request $request): TokenResource
    {
        $fields = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($fields)) {
            return response()->status(401);
        }

        return new TokenResource(auth()->user());
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->noContent();
    }
}
