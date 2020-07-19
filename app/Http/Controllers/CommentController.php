<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($postId)
    {
        return Post::find($postId)->comments;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $postId)
    {
        Comment::create([
            'post_id' => $postId,
            'name' => $request->name,
            'pw' => $request->pw,
            'content' => $request->content
        ]);

        return 1;
    }

    public function delete(Request $request, $id)
    {
        $isDelete = Comment::where('id', $id)->where('pw', $request->pw)->delete();
        return $isDelete;
    }
}
