<?php

namespace App\Http\Controllers;
use App\Category;
use App\Post;
use Illuminate\Support\Facades\Session;
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
        //
        return view('admin.posts.index')->with('posts',Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories=Category::all();

        if($categories->count()==0)
        {
            Session::flash('info','You must have some categories before attempting to create a post');
            return redirect()->back();
        }
        return view('admin.posts.create')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate($request,[

            'title'=>'required',
            'featured'=>'required|image',
            'content'=>'required',
'category_id'=>'required'
        ]);

        $featured=$request->featured;
        $featured_new_name=time().$featured->getClientOriginalName();
        $featured->move('uploads/posts',$featured_new_name);

        $post=Post::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'featured'=>'uploads/posts/'.$featured_new_name,
            'category_id'=>$request->category_id,
            'slug'=>str_slug($request->title)
        ]);

        Session::flash('success','Post created successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id);
        return view('admin.posts.edit')->with('post',$post)->with('categories',Category::all());

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
            'category_id'=>'required'
        ]);
        $post=Post::find($id);
        if($request->hasFile('featured'))
        {
          $featured=$request->featured;
          $featured_new_name=time().$featured->getClientOriginalName();
          $featured->move('uploads/posts',$featured_new_name);
          $post->featured='uploads/posts/'.$featured_new_name;
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->save();
        Session::flash('success','You successfully updated the post');
        return redirect()->route('posts');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post=Post::find($id);
        $post->delete();
        Session::flash('success','Your post was deleted succcessfully');
        return redirect()->back();
    }

    public function trash()
    {
        $posts=Post::onlyTrashed()->get();
        return view('admin.posts.trash')->with('posts',$posts);
        //

    }

    public function kill($id)
    {
        $post=Post::withTrashed()->where('id',$id)->first();
        //dd($post);
        $post->forceDelete();
        Session::flash('success','Post deleted permanently');
        return redirect()->back();



    }
    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        //dd($post);
        $post->restore();
        Session::flash('success', 'Post restored successfully');
        return redirect()->route('posts');
    }
}
