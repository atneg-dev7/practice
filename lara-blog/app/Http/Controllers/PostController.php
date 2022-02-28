<?php

namespace App\Http\Controllers;
// Postモデルを使用する宣言
use App\Post;
// use Auth;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    function index()
    {
        $posts = Post::all();
        // var_dumpと同じデバッグ機能
        // dd($posts);
        return view('posts.index', ['posts'=>$posts]);
    }

    function create()
    {
        return view('posts.create');
    }

    function store(Request $request)
    {
        $post = new Post;
        $post -> title = $request -> title;
        $post -> body = $request -> body;
        $post -> user_id = Auth::id();

        $post -> save();

        return redirect()->route('posts.index');
    }

    // $idはindex.blade.phpから送られたid
    function show($id)
    {
        $post = Post::find($id);
        return view('posts.show',['post'=>$post]);
    }

    function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', ['post'=>$post]);
    }

    function update(Request $request, $id)
    {
        $post = Post::find($id);

        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        return view('posts.show',compact('post'));
    }

    function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('posts.index');
    }
}
