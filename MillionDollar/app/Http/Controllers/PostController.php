<?php

namespace App\Http\Controllers;

use App\Http\Resources\AllPostCollection;
use App\Http\Resources\AllPostsController;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $categorys = Category::all();
        return Inertia::render('Posts', [
            'posts' => new AllPostCollection($posts),
            'categories' => $categorys
        ]);
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
        // dd($request);
        // $request->validate(['text' => 'required']);
        $post = new Post;
        $post->user_id = auth()->user()->id;
        $post->text = $request->input('text');

        $imageName = uniqid(). '-' . $request->image->getClientOriginalName();
        $request->image->move(public_path('images'), $imageName);

        $post->image = $imageName;

        // dd($imageName);
        $post->save();

        $post->categories()->attach($request->category);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $post = Post::find($id);

        if(!empty($post->image)){
            $currentImage = public_path() . $post->image;

            if(file_exists($currentImage)){
                unlink($currentImage);
            }
        }
        $post->delete();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request){

        $categorys = Category::all();
        $query = $request->input('key');
        $posts = Post::where('text','like', '%'.$query.'%')->get();
        return Inertia::render('Posts',[
            'result' => new AllPostCollection($posts),
            'categories' => $categorys
        ]);
    }
}
