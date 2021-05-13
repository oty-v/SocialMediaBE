<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return PostResource
     */
    public function index(User $user): AnonymousResourceCollection
    {
        return PostResource::collection($user->posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return PostResource
     */
    public function store(StorePostRequest $request): PostResource
    {
        return new PostResource($request->user()->posts()->create($request->validated()));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return PostResource
     */
    public function show(Post $post): PostResource
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Post $post
     * @return PostResource
     */
    public function update(UpdatePostRequest $request, Post $post): PostResource
    {
        $post->update($request->validated());
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return Response
     * @throws Exception
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->noContent();
    }
}
