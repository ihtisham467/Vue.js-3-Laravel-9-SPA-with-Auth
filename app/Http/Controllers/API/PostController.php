<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index(Request $request) {
        $posts = Post::with('category')->when(request('category_id', '') != '' , function($query) {
            $query->where('category_id', request('category_id'));
        })->paginate(5);
        return PostResource::collection($posts);
    }
}
