<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $posts = Post::orderBy('id','desc')->get();
        return view('admin.post',[
            'categories'=>$categories,
            'posts'=>$posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'category_id'=>'required',
            'description'=>'required'
        ]);
        $post = new Post();
        $post->title = $request->title;
        if($request->hasFile('thumbnail')){
            // $file = $request->file('thumbnail');
            // $extension = $file->getClientOriginalExtension();
            // $filename = time().'.'.$extension;
            // $file->move(public_path('images/post_thumbnails'),$filename);
            // $post->thumbnail = $filename;
            $imageName = time().'.'.$request->thumbnail->extension();
            $request->thumbnail->move(public_path("images/post_thumbnails"),$imageName);
        }
        $post->description = $request->description;
        $post->thumbnail = $imageName;
        $post->category_id = $request->category_id;
        $post->status = $request->status;
        $post->subtitle = $request->subtitle;
        $post->save();
        return redirect()->back()->with('createPost','Successfully Created Post');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'=>'required',
            'category_id'=>'required',
            'description'=>'required'
        ]);
        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        if($request->hasFile('thumbnail')) {
            if($request->old_thumbnail) {
                File::delete(public_path('images/post_thumbnails'.$request->old_thumbnail));
                // remove(public_path("images/post_thumbnails".$request->old_thumbnail));
            }else{
                $imageName = time().'.'.$request->thumbnail->extension();
                $request->thumbnail->move(public_path("images/post_thumbnails"),$imageName);
                $post->thumbnail = $imageName;
            }
        }
        $post->category_id = $request->category_id;
        $post->status = $request->status;
        $post->subtitle = $request->subtitle;
        $post->save();
        return redirect()->back()->with('updatePost','Successfully Updated Post');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        // if($post->thumbnail) {
        //     File::delete(public_path('images/post_thumbnails/'.$post->thumbnail));
        // }
        $post->delete();
        return redirect()->back()->with('deletePost','Post Deleted');
    }
}
