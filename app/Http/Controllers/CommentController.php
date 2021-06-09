<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Http\Resources\CommentResource;
use App\Models\Tag;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CommentController extends Controller
{
    public function index(Post $post): AnonymousResourceCollection
    {
        return CommentResource::collection($post->comments);
    }


    public function store(StoreCommentRequest $request, Post $post): CommentResource
    {
        $comment = $request->user()->comments()->make($request->validated());
        $comment = $post->comments()->save($comment);
        $tags = [];
        preg_match_all('/#(\w+)/i', request('body'), $tags);
        foreach ($tags[0] as $tag) {
            $tag_exist = Tag::whereName($tag)->firstOrCreate(["name"=>$tag]);
            $comment->tags()->attach($tag_exist->id);
        }
        return new CommentResource($comment);
    }


    public function show(Comment $comment): CommentResource
    {
        return new CommentResource($comment);
    }


    public function update(UpdateCommentRequest $request, Comment $comment): CommentResource
    {
        $comment->update($request->validated());
        $tags = [];
        preg_match_all('/#(\w+)/i', request('body'), $tags);
        foreach ($tags[0] as $tag) {
            $tag_exist = Tag::whereName($tag)->firstOrCreate(["name"=>$tag]);
            $comment->tags()->attach($tag_exist->id);
        }
        return new CommentResource($comment);
    }


    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->noContent();
    }
}
