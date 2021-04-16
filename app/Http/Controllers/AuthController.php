<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthTokenResource;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request): AuthTokenResource
    {
        $fields = $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = User::create($fields);

        $token = $user->createToken($request->header('User-Agent'));

        return new AuthTokenResource($token);
    }

    public function login(Request $request): AuthTokenResource
    {
        $fields = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($fields)) {
            return response()->status(401);
        }

        $token = auth()->user()->createToken($request->header('User-Agent'));

        return new AuthTokenResource($token);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->noContent();
    }
}
