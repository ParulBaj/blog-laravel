<?php

namespace App\Http\Controllers;

use App\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Posts::latest()->paginate(5);

        return view('posts.index',compact('posts'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
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
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        Posts::create($request->all());

        return redirect()->route('posts.index')
            ->with('success','Post created successfully.');
    }
    /**
     * Display the specified resource.
     * GET /posts/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Posts $post)
    {
        return view('posts.show',compact('post'));
    }
    /**
     * Show the form for editing the specified resource.
     * GET /posts/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Posts $post)
    {
        return view('posts.edit',compact('post'));
    }
    /**
     * Update the specified resource in storage.
     * PUT /posts/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, Posts $post)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $post->update($request->all());

        return redirect()->route('posts.index')
            ->with('success','Post updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     * DELETE /posts/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Posts $post)
    {
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success','Post deleted successfully');
    }
}