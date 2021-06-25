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
    public function index(SearchUserRequest $request): AnonymousResourceCollection
    {
        $users = User::whereUsername($request->username)->orderBy('username')->paginate(5);
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

    public function userFollowings(User $user): AnonymousResourceCollection
    {
        return UserResource::collection($user->followings);
    }

    public function userFollowers(User $user): AnonymousResourceCollection
    {
        return UserResource::collection($user->followers);
    }

    public function follow(User $user)
    {
        $followingsIdArray = auth()->user()->followings()->pluck('id');
        $followingsIdArray->push($user->id);
        auth()->user()->followings()->sync($followingsIdArray);
        return response()->noContent();
    }

    public function unfollow(User $user)
    {
        auth()->user()->followings()->detach($user->id);
        return response()->noContent();
    }
}
