<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthTokenResource;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): AuthTokenResource
    {
        $fields = $request->validate();

        $user = User::create($fields);

        $token = $user->createToken($request->header('User-Agent'));

        return new AuthTokenResource($token);
    }

    public function login(LoginRequest $request): AuthTokenResource
    {
        $fields = $request->validate();

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
