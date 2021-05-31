<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchUserRequest;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return UserResource
     */
    public function index(): AnonymousResourceCollection
    {
        $users = User::orderBy('id')->paginate(5);
        return UserResource::collection($users);
    }

    public function search(SearchUserRequest $request): AnonymousResourceCollection
    {
        $users = User::where("username", 'LIKE', "%{$request->search}%")->orderBy('id')->paginate(5);
        return UserResource::collection($users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return UserResource
     */
    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }
}
