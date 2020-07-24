<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;
use App\Events\MessageSend;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Chat::all();
        return view('chats.index', [ 'messages' => $messages ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = Chat::create([
                    'name' => $request->name,
                    'content' => $request->content
                   ]);

        MessageSend::dispatch($message);

        return $message;
    }
}
