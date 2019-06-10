<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Note;

class NoteController extends Controller
{
      public function index()
      {

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
            // $message = Message::orderBy('created_at',"DESC")->first();

            $response = array([
                // 'created_at' => Carbon::now(),
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
