<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $posts = Post::paginate();
        return new PostResource($posts);
    }


    public function show($id)
    {
        $post = Post::find($id);
        return new PostResource($post);
    }


}
