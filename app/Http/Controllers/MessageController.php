<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use DB;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //show whole message
    public function index(Request $request)
    {
        // $user = Auth::user();

        // if($request->submit == 'show_all'){
            $messages = Message::get();
            // $users = User::where('id', $message)->get();
            $users = DB::table('messages')
                    ->leftJoin('users','users.id','=','messages.user_id')
                    ->get();


            // $users = User::get('id');
            // return redirect('/message');
            // echo $users;
        // }
        // else{
            // $messages = Message::where('user_id', $request->user()->id)->get();
            return view('index',compact('messages','users'));
        // }

        // $messages = $request->user()->messages()->get();
    }

    //show create page
    public function create()
    {
        return view('message.add');
    }

    //update message
    public function store(Request $request)
    {
        // $user = Auth::user();

        $this->validate($request, [
              'name' => 'required|max:255',
        ]);

        // $message = new Message();
        //
        // $message->title = $request->title;
        // $message->content = $request->content;
        // $message->user_id =  Auth::user()->id;
        //
        // $message->save();


        // if(Auth::user()){
        //     'user_id' => auth()->id(),
        //     'title' => $request->title,
        //     'content' => $request->content
        // };

        $request->user()->messages()->create([
            'name' => $request->name,
        ]);

        // $message = $request->all();
        // Message::create($message);

        return Redirect('/message');
    }

    // show edit message
    public function edit(Message $message)
    {
        // $message_id = Message::find($message);
        // echo $message;
        return view('message.edit',compact('message'));
    }

    //update edit message
    public function update(Request $request, Message $message)
    {
        // $message_id = Message::find($message);
        $message->update([
              'name' => $request->name,
        ]);

        return Redirect('/message');
    }

    //delete message
    public function destroy(Message $message)
    {
      $message->delete();
      return Redirect('/message');
    }

    //show detail message
    public function show(Message $message)
    {
        return $message;
    }

}
