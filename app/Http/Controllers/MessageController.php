<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{

    public function all(Request $request)
    {   
        // return $request;

        // $messages = Message::where('sender',$request->sender)->where('receiver',$request->receiver)->Where('sender',$request->sender)->Where('receiver',$request->receiver)->get();
        // $receive = Message::where('receiver',$request->sender)->where('sender',$request->receiver)->get();
        
        $all =  DB::table('messages')->orWhere('receiver',$request->receiver)->orWhere('sender',$request->sender)
                ->orWhere('receiver',$request->sender)->orWhere('sender',$request->receiver)->get();

        return $all;
        // return response()->json(['r'=>$messages,'s'=>$receive]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        return 'hel9';
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
        $data = $request->validate([
            'sender' => 'required',
            'receiver' => 'required',
            'description' => 'required',
        ]); 

        Message::create($data);

        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
