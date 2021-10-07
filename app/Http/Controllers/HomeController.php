<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        $all = User::get();
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
}

// when($request->search,function($q){
//     $value = $request->search;
//     return $q->where('name','like',"%$value%");
// })->