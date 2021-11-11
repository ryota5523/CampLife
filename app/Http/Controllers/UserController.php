<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Requests\UserUploadImageRequest;
use App\Services\UserImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use InterventionImage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $user = User::find($id);
        $posts = User::find($id)->posts;
        // dd($user, $posts);
        
        return view ('users.index', compact('user','posts')) ;
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
        //
        $user = Auth::id($id);

        return view('users.edit', ['user' => Auth::user() ]);
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
      $request->validate([
        'nickName' => 'nullable|string|max:15',
        'bio' => 'nullable|string|max:1000', 
        ]);

        $imageFile = $request->image;
        if (!is_null($imageFile) && $imageFile->isValid()) {
          $filename = UserImageservice::upload($imageFile, 'users');
          
        }
        $user = User::findOrFail($id);
        
        if (!is_null($imageFile) && $imageFile->isValid()) {
          $user->iconfile = $filename; 
        }
        
        $user->nickName = $request->input('nickName');
        $user->bio = $request->input('bio');
        $user->save();

      return redirect($id)->with('flash_message', 'プロフィールを更新しました。');

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
