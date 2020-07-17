<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $nPageIndex = 0;
        $nPageRow = 15;
        
        if($request->query('page') !== null) {
            $nPageIndex = $request->query('page') - 1;
        }

        $START = $nPageIndex * $nPageRow;
        $END = $nPageRow;

        if($request->query('keyword') === null) {
            $posts = DB::table('posts')->orderBy('id', 'desc')->offset($START)->limit($END)->get();
            $postNum = DB::table('posts')->count();
        }
        else {
            $posts = DB::table('posts')->where('subject', 'like', '%'.$request->query('keyword').'%')->orderBy('id', 'desc')->offset($START)->limit($END)->get();
            $postNum = DB::table('posts')->where('subject', 'like', '%'.$request->query('keyword').'%')->count();
        }

        return view('posts.index', [ 'posts' => $posts, 'postNum' => $postNum ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Post::create([
            'name' => $request->name,
            'pw' => $request->pw,
            'subject' => $request->subject,
            'content' => $request->content
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return response($post->toJson(JSON_UNESCAPED_UNICODE))
                        ->header('Content-Type', 'application/json');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
