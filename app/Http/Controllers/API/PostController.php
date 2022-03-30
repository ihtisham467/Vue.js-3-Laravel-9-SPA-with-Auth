<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index() {
        $posts = Post::with('category')->paginate(5);
        return PostResource::collection($posts);
    }
}
