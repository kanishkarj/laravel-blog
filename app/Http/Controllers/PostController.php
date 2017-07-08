<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Post;
use Carbon\Carbon;
class PostController extends Controller
{
    public function index(){
        
        //method injection : passing args

        $posts = Post::latest()
        ->filter(request(['month','year']))
        ->get();
        
        return view('posts.index',compact('posts'));
    }
    public function show($id){
        $post = Post::find($id);
        return view('posts.show',compact('post'));
    }
    public function create(){
        return view('posts.create');
    }
    public function store(){
        $post = new Post;
        
        $this->validate(request(),[
            'title' => 'required',
            'body' => 'required'
        ]);
        session()->flash('message','new post');
        //$post->user->publish(new Post(request(['title','body'])));

        $post -> user_id = auth()->id();
        $post -> title = request('title'); 
        $post -> body = request('body');

        $post->save();
        return redirect('/');
    }
}
