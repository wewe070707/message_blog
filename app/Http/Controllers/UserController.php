<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show_profile()
    {
        $messages = Message::where('user_id',Auth::id())->paginate(2);
        // $currentTime = Carbon::now();
        // $diff = date('G:i', strtotime($currentTime) - strtotime(Auth::user()->created_at));
        // $diff = (new Carbon($currentTime))-> diff(new Carbon(Auth::user()->created_at))->format('%h:%I');
        // $diff = Auth::user()->created_at->diffForHumans();
        // dd($diff);
        return view('profile',[
            'messages' => $messages
        ]);
    }
}
