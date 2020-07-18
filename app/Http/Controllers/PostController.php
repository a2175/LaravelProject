<?php

namespace App\Http\Controllers;

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
            $posts = Post::orderBy('id', 'desc')->offset($START)->limit($END)->get();
            $postNum = Post::count();
        }
        else {
            $posts = Post::where('subject', 'like', '%'.$request->query('keyword').'%')->orderBy('id', 'desc')->offset($START)->limit($END)->get();
            $postNum = Post::where('subject', 'like', '%'.$request->query('keyword').'%')->count();
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
        return view('posts.create');
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

        return redirect()->route('post.index');
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
        return view('posts.show', [ 'post' => $post ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', [ 'post' => $post ]);
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
        $isUpdate = Post::where('id', $id)->where('pw', $request->pw)->update([
                        'name' => $request->name,
                        'subject' => $request->subject,
                        'content' => $request->content
                    ]);
        
        if($isUpdate) {
            return redirect()->route('post.show', [ 'id' => $id ])->with('alert', '완료되었습니다.');
        }
        else {
            return redirect()->back()->with('alert', '비밀번호가 일치하지 않습니다.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return view('posts.destroy', [ 'postId' => $id ]);
    }

    public function delete(Request $request, $id)
    {
        $isDelete = Post::where('id', $id)->where('pw', $request->pw)->delete();

        if($isDelete) {
            return redirect()->route('post.index')->with('alert', '완료되었습니다.');
        }
        else {
            return redirect()->back()->with('alert', '비밀번호가 일치하지 않습니다.');
        }
    }
}
