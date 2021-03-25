<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index() {
        return Post::all();
    }

    public function store(Request $request) {
        return Post::create($request->all());
    }

    public function update(Request $request, Post $id) {
        $id->update($request->all());
    }

    public function delete(Post $id) {
        $id->delete();
    }
}
