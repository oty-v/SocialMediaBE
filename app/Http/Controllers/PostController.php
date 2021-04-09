<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        $userId = auth()->id();
        $userName = auth()->user()->username;
        $request['user_id'] = $userId;
        $request['username'] = $userName;
        return Post::create($request->all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Response
     */
    public function show(Post $post) {
        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Post $post
     * @return Response
     */
    public function update(Request $request, Post $post) {
        $post->update($request->all());
        return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return Response
     * @throws Exception
     */
    public function destroy(Post $post) {
        $post->delete();
        return response()->noContent();
    }
}
