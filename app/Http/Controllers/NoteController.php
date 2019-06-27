<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Note;
Use Carbon\Carbon;
class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

      public function index()
     {
         $now = Carbon::now('Asia/Taipei')->toDateString();
         $note = Note::orderBy('created_at',"DESC")->first();
         return $now;
     }

      public function store(Request $request, Message $message)
      {
            $this->validate($request, [
                  'reply_content' => 'required|max:255',
            ]);

            $message->notes()->create([
                'reply_content' => $request->reply_content,
                'user_id' => $request->user()->id
            ]);
            //ajax leave message
            $note = Note::orderBy('created_at',"DESC")->first();
            // dd($note);
            $response = array([
                'note' => $note->id,
                'created_at' => time(),
                'reply_content' => $request->reply_content,
                'name' => $request->user()->name,
                'user_id' => $request->user()->id
                ]);

            if($request->ajax()){
                return response()->json($response);
            }

            return back();
      }

      public function destroy(Message $message, Note $note)
      {
          $note->delete();
          return back();
      }
}
