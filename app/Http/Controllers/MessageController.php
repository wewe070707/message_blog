<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use App\Note;
use DB;
use Carbon\Carbon;
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

            $note = DB::table('messages')
                    ->leftJoin('notes','notes.message_id','=','messages.id')
                    ->select('message_id', \DB::raw('count(*) as total'))
                    ->groupBy('messages.id')
                    ->get();

            // $note = Note::select('message_id', \DB::raw('count(*) as total'))
            //         ->groupby('message_id')
            //         ->get();

            // $users = User::get('id');
            // return redirect('/message');
            // echo $users;
        // }
        // else{
            // $messages = Message::where('user_id', $request->user()->id)->get();
            return view('index',compact('messages','users','note'));
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
              'content' => 'required|max:255',
              'title' => 'required|max:15',
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
            'content' => $request->content,
            'title' => $request->title,
        ]);

        // Session::flash('flash_message','新增成功！');

        //ajax leave message
        $message = Message::orderBy('created_at',"DESC")->first();
        // $response = array(
        //     'id' => $message->id,
        //     'reply_content' => $message->content
        // );
        //
        // if($request->ajax()){
        //     return response()->json($response);
        // }

        return Redirect('/message')->with([
            'flash_message','新增成功！'
            ]
        );
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
        $this->validate($request,[
            'content' => 'required|max:255',
            'title' => 'required|max:15',
        ]);

        $message->update([
              'content' => $request->content,
              'title' => $request->title,
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
        $notes = Note::where('message_id',$message->id)
                ->orderBy('created_at','DESC')
                ->get();
        return view('note.show', compact('message','notes'));
    }

    public function showProfile()
    {
        $messages = Message::where('user_id',Auth::id())->paginate(1);
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
