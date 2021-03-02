<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Post;
use App\Mail\PostMail;

class PostController extends Controller
{
    /**
     * Post validation
     */

    protected $postValidation = [
        'title' => 'required|max:100',
        'image' => 'required|image',
        'body_content' => 'required',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::id())->get();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        $request->validate($this->postValidation);
        
        $newPost = new Post();
        $data['user_id'] = Auth::id();
        $data['image'] = Storage::disk('public')->put('images', $data['image']);
        $data['slug'] = Str::slug($data['title']);
        $newPost->fill($data);
        $newPost->save();

        Mail::to('blog-supervisor@blog.com')->send(new PostMail($newPost));

        return redirect()
            ->route('admin.posts.index')
            ->with('message','Post: '.$newPost->title.' created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
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

        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        
        $data = $request->all();

        $request->validate($this->postValidation);
        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($data['title']);

        if(!empty($data['image'])) {
            if(!empty($post->image)) {
                Storage::disk('public')->delete($post->image);
            }

            $data['image'] = Storage::disk('public')->put('images', $data['image']);
        }

        $post->update($data);

        return redirect()
            ->route('admin.posts.index')
            ->with('edited', 'Post '.$post->title.' edited successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('deleted', 'Post '.$post->title.' deleted successfully');
    }
}
