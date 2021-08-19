<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Http\Requests\UploadImageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use InterventionImage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $search = $request->input('search');
        // dd($request);
        
        // 検索フォーム
        $query = DB::table('posts');

        if($search !== null ){
          $search_split =mb_convert_kana($search, 's');
          $search_split2 =preg_split('/[\s]+/', $search_split, -1, PREG_SPLIT_NO_EMPTY );
          
          foreach($search_split2 as $value)
          {
            $query->where('title', 'like', '%'.$value.'%')
            ->orwhere('body', 'like', '%'.$value.'%')
            ->orwhere('name', 'like', '%'.$value.'%');
          }
        };
        $query->join('users', 'posts.user_id', '=', 'users.id');
        $query->select('posts.id as post_id', 'posts.created_at as created_at', 'title', 'body', 'user_id', 'users.id', 'users.name', 'filename');
        $query->orderby('created_at', 'desc');
        $posts = $query->paginate(21);


        return view ('posts.index', compact('posts')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadImageRequest $request)
    {
        //
        
        $post = new Post;

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = Auth::user()->id;
        
        $imageFile = $request->image;
        if (!is_null($imageFile) && $imageFile->isValid()) {
          $filename1 = uniqid(rand().'_');
          $extension = $imageFile->extension(); 
          $post ->filename = $filename1 . '.' . $extension;
          $resizedImage = InterventionImage::make($imageFile)->resize(1280, 866)->encode();
          Storage::put('public/posts/' . $post->filename, $resizedImage );

          $post->save();
        }


        
        return redirect('index');

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
        $post = DB::table('posts')
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->where('posts.id', $id)->first();


        // dd($post);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::find($id);

        return view('posts.edit', compact('post'));

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
        //
        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        


        $post->save();

        return redirect('index');

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
    }
}
