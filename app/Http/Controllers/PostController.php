<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Http\Requests\UploadImageRequest;
use App\Services\ImageService;
use Carbon\Carbon;
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

        $date_now = Carbon::now();
        $date_parse = Carbon::parse(now());

        if($search !== null ){
          $search_split =mb_convert_kana($search, 's');
          $search_split2 =preg_split('/[\s]+/', $search_split, -1, PREG_SPLIT_NO_EMPTY );
          
          foreach($search_split2 as $value)
          {
            $query->where('title', 'like', '%'.$value.'%')
            ->orwhere('body', 'like', '%'.$value.'%')
            ->orwhere('name', 'like', '%'.$value.'%')
            ->orwhere('users.nickName', 'like', '%'.$value.'%');
          }
        };
        $query->join('users', 'posts.user_id', '=', 'users.id');
        $query->select('posts.id as post_id', 'posts.created_at as created_at', 'title', 'body', 'user_id', 'users.id', 'users.name', 'filename', 'users.iconfile', 'users.nickName');
        $query->orderby('created_at', 'desc');
        $posts = $query->paginate(18);

        // dd($post);

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
        $request->validate([
          'title' => 'required|string|max:50',
          'body' => 'required|string|max:3000', 
          ]);

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = Auth::user()->id;

        $imageFile = $request->image;
        if (!is_null($imageFile) && $imageFile->isValid()) {
          $post->filename = Imageservice::upload($imageFile, 'posts');

        }
        $post->save();
        

        
        return redirect('/')->with('flash_message', '記事を投稿しました');

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
        $posts = post::find($id);
        $now = Carbon::now();
        $time = $posts->created_at->diffForHumans($now);
        // dd($now, $post, $time);

        $post = DB::table('posts')
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->where('posts.id', $id)
        ->select('posts.id as post_id', 'posts.created_at as created_at', 'title', 'body', 'user_id', 'users.id', 'filename', 'users.name', 'users.iconfile', 'users.nickName')
        ->first();
        


        return view('posts.show', compact('post','time'));
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
        // dd($post);

        return view('posts.edit', compact('post'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UploadImageRequest $request, $id)
    {
      //
      $request->validate([
        'title' => 'required|string|max:50',
        'body' => 'required|string|max:3000', 
      ]);
      
        $post = Post::findOrFail($id);
        $imageFile = $request->image;
        if (!is_null($imageFile) && $imageFile->isValid()) {
          Storage::disk('s3')->delete('posts/' . $post->filename);
          Storage::disk('local')->delete('public/posts/'.$post->filename);
          $filename = Imageservice::upload($imageFile, 'posts');
          
        }

        if(!is_null($imageFile) && $imageFile->isValid()) { 
          
          $post->filename = $filename; 
        }
        $post->title = $request->input('title'); 
        $post->body = $request->input('body'); 
        $post->user_id = Auth::user()->id;
        // dd($post);

        
        $post->save();
        
        return redirect('/')->with('flash_message', '記事を更新しました');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $post = Post::find($id);
        // dd($post, $id);
        $post->delete();

        return redirect('/')->with('flash_message', '記事を削除しました');

    }
    
}