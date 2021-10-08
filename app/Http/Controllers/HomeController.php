<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {   $man = Auth::user();
        $all = User::with('message')->get();
        if($request->search){
            $all = User::where('name','like',"%$request->search%")->get();
            return $all;
        }
        return view('master.chatlist',compact('man','all'));
    }

    public function chat(User $user)
    {   $auth = Auth::user();
        return view('master.chat',compact('user','auth'));
    }
    
    public function goAway()
    {
        $user = Auth::user();
        // return $user;
        $user->active = '0';
        $user->update();
        Auth::logout();
        return redirect('/');
    }

    public function profile()
    {
        $auth = Auth::user();
        return view('master.profile',compact('auth'));
    }

    public function ChangeImg(Request $request)
    {
        
        $request->validate([
            'photo' =>'mimes:jpeg,jpg,gif,png'
         ]);
         $photo = $request->file('photo');
         $newName = uniqid().'.png';
         Image::make($photo)->fit(200)->save('image/'.$newName); //that is main
         //u can u also $newImg = Imag.... , $newImg->save('path.../'.name.jpeg or png );

         $user = Auth::user();
         $user->photo = $newName;
         $user->update();
                                                         //        $dir = "/public/profile/";
                                                     //        $newImg->save($dir.$newName);
                                                     //        Storage::putFileAs($dir,$newImg,$newName);
        //  $files = scandir(public_path('image/'));
        //  foreach ($files as $file){
        //      if($file != '.' && $file != '..' && $file != $newName && $file != 'user.png'){
        //          File::delete(public_path('image/'.$file));
        //      }
        //  }

         return redirect()->back();
    }
}

// when($request->search,function($q){
//     $value = $request->search;
//     return $q->where('name','like',"%$value%");
// })->