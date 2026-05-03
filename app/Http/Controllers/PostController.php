<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        return view('post', ['posts' => Post::with('user')->get()]);
    }
     // CREAR
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'user_id' => 'required'
        ]);

        Post::create($request->all());

        return back();
    }

    // ACTUALIZAR
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $post->update($request->only('title', 'content'));

        return back();
    }

    // ELIMINAR
    public function delete($id)
    {
        Post::findOrFail($id)->delete();
        return back();
    }
}
