<?php

namespace App\Http\Controllers;

use App\Post;
use App\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    
    public function _construct()
    {
    }

    public function index()
    {
        $posts = Post::with(['likes', 'user'])
        ->orderBy('id', 'desc')
        ->get();

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function liked()
    {
        $posts = Post::with(['likes', 'user'])
            ->whereIn('id', function ($query) {
                return $query->select('post_id')->from('likes')->where('user_id', Auth::id());
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function following()
    {
        $posts = Post::with(['likes', 'user'])
        ->whereIn('user_id', function ($query) {
            return $query->select('user_2')->from('follows')->where('user_1', Auth::id());
        })
        ->orderBy('id', 'desc')
        ->get();

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'required|max:128',
        ]);
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        
        request()->image->move(public_path('images').'/posts/', $imageName);
        
        $post = new Post();
        $post->user_id = Auth::id();
        $post->image = $imageName;
        $post->description = request()->description;
        $post->save();

        return redirect('posts/'.$post->id);
    }

    public function show($id)
    {
        return view('posts.index', [
            'posts' => [Post::findOrFail($id)],
        ]);
    }

    public function edit($id)
    {
        return view('posts.edit', [
            'post' => Post::findOrFail($id),
        ]);
    }

    public function update(Request $request,$id)
    {
        $post = Post::find($id); 
        if (intval($post->user_id) === Auth::id()) {
            $request->validate([
                'description' => 'required|max:255',
            ]);

            $post->description = request()->description;

            $post->save();
        }

        return redirect('posts/'.$post->id);
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if (intval($post->user_id) === Auth::id()) {
            $post->delete();
        }

        return redirect('posts/');
    }

    public function like($id)
    {
        $data = Like::where([
            ['user_id', Auth::id()],
            ['post_id', $id],
        ]);
        if (null === $data->first()) {
            $like = new Like();

            $like->user_id = Auth::id();
            $like->post_id = $id;
            $like->save(); 
        } else {
            $data->delete();
        } 
        return back();
    }
}
