<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TagController extends Controller
{
    public function index(Tag $tag): AnonymousResourceCollection
    {
        $posts = $tag->posts;
        $comments = $tag->comments;
        $comments_post = [];
        foreach ($comments as $comment) {
            array_push($comments_post, $comment->post);
        }
        $finalPosts = $posts->merge($comments_post);
        return PostResource::collection($finalPosts->sortByDesc('id'));
    }
}
