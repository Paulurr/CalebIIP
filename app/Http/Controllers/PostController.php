<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        return view('post', ['posts' => Post::all()]);
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);
        Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);
        return redirect('/post');
    }
    function delete($id){
        $post = Post::findOrFail($id);
        if($post->user_id != auth()->id()){
            abort(403);
        }
        $post->delete();
        return redirect('/post');
    }
}
