<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Like;
use App\Models\OrganizationTag;
use App\Models\StatusTracker;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(50);
        return view("posts.index", ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Post::class);


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
        $this->authorize('create', Post::class);

        $this->validate($request,[
            'title' => ['required', 'max:255', 'min:5'],
            'description' => ['required', 'max:1000'],
            //หาวิธี validate ให้มีรูปอย่างเดียว
        ]);
        $checkboxStatus = (boolean)$request->input('status');;


        $post = new Post();
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->user_id = $request->user()->id;
        $post->status = $checkboxStatus;


        $post->tag_id = $request->input('tags');
        $post->organization_tag_id = $request->input('organizations');
        $post->progression = "ยื่นคำร้อง/ปัญหา";



        if($request->hasFile('images')) {
            $request->validate([
                'images' => 'required',
                'images.*' => 'mimes:jpg,png,jpeg,gif,svg'
            ]);
            $post->save();
            foreach ($request->file('images') as $saves) {
                $save = new Image();
                $title = time().$saves->getClientOriginalName();
                $saves->move(public_path().'/images/',$title);
                $save->title = $title;
                $save->post_id = $post->id;
                $save->save();
                $post->images()->save($save);
            }
        }





        $statusTracker = new StatusTracker();
        $statusTracker->message = "ยื่นคำร้องเรียบร้อยค่ะ";
        $post->statusTrackers()->save($statusTracker);


        return redirect()->route('posts.show', ['post' => $post->id]);
        //                     -------------------------^
        //                    |
        // GET|HEAD  posts/{post} ......... posts.show › PostController@show
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)    // Dependency Injection
    {
        if($post->id != null){
            $post->view_count++;
            $post->save();
        }
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        $tags = $post->tag->name;


        return view('posts.edit', ['post' => $post, 'tags' => $tags, 'organizations']);
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
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'min:5'],
            'description' => ['required', 'max:1000']
        ]);

        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->tag_id = $request->input('tags');
        $post->organization_tag_id = $request->input('organizations');
        if($request->input('progression')){
            $post->progression = $request->input('progression');
        }

        if($request->hasFile('images')) {
            $request->validate([
                'images' => 'required',
                'images.*' => 'mimes:jpg,png,jpeg,gif,svg'
            ]);
            $post->save();
            foreach ($request->file('images') as $saves) {
                $save = new Image();
                $title = time() . $saves->getClientOriginalName();
                $saves->move(public_path() . '/images/', $title);
                $save->title = $title;
                $save->post_id = $post->id;
                $save->save();
                $post->images()->save($save);
            }
        }else{
            $post->save();
        }


        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Post $post)
    {
        $this->authorize('delete', $post);

        $title = $request->input('title');
        if ($title == $post->title) {
            foreach($post->images as $image) {
                File::delete('images/'.$image->title);
            }
            $post->delete();
            return redirect()->route('posts.index');
        }
        return redirect()->back();
    }

    public function deleteImage(Request $request, Post $post){
        foreach ($post->images as $image){
            if($image->title == $request->input('imageNames')){
                File::delete('images/'.$image->title);
                Image::where('title',$request->input('imageNames'))->first()->delete();
            }
        }
        return redirect()->route('posts.edit',['post' => $post->id]);
    }




    public function deleteAllImages(Post $post){
        foreach($post->images as $image) {
            File::delete('images/'.$image->title);
        }
        $post->images()->delete();
        return redirect()->route('posts.edit',['post' => $post->id]);
    }




    public function storeComment(Request $request, Post $post)
    {
        $comment = new Comment();
        $comment->message = $request->get('message');
        $post->comments()->save($comment);
        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    public function storeStatus(Request $request, Post $post)
    {
        $statusTracker = new StatusTracker();
        $statusTracker->message = $request->get('message');
        $post->statusTrackers()->save($statusTracker);
        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    public function search(Request $request){
        $posts = Post::filterTitle($request->input('search'))->get();
        return view('posts.index',['posts' => $posts]);
    }


    public function like(Post $post){
        $user = Auth::user();
        $likeStatus = $user->likes()->where('post_id', $post->id)->count();
        if( $likeStatus == 0){
            Like::create(['user_id' => $user->id, 'post_id'=> $post->id]);
            $post->like_count++;
        }else{
            $user->likes()->where('post_id',$post->id)->delete();
            $post->like_count--;
        }
        $post->save();
        return redirect()->route('posts.show', ['post' => $post->id,'likeStatus' => $likeStatus]);
    }



}
