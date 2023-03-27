<?php

namespace App\Http\Controllers;

use App\Models\LikeComment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LikeCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $likes = LikeComment::all();
        return Inertia::render('Posts',[
            'likecom' => $likes
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
        $id = $request->input('comment_id');
        // dd($id);
        $like = LikeComment::where('comment_id', $id)->where('user_id', auth()->user()->id)->first();

        if($like){
            $like->delete();
        }else{
            LikeComment::create([
                'comment_id' => $id,
                'user_id' => auth()->user()->id,
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LikeComment  $likeComment
     * @return \Illuminate\Http\Response
     */
    public function show(LikeComment $likeComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LikeComment  $likeComment
     * @return \Illuminate\Http\Response
     */
    public function edit(LikeComment $likeComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LikeComment  $likeComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LikeComment $likeComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LikeComment  $likeComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(LikeComment $likeComment)
    {
        //
    }
}
