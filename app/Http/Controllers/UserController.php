<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Support\Facades\Input;
use File;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

    public function update_avatar(Request $request)
    {
        $this->validate($request,[
            'avatar' => 'required|image|mimes:jpg,jpeg,png,bmp,gif|max:2048',
        ]);

        // $validation = Validator::make(
        //         array('avatar' => Input::file('avatar')),
        //         array('avatar' => 'required|image|mimes:jpg,jpeg,png,bmp,gif|max:2048')
        //     );
        //
        // var_dump($validation->errors());
        //
        // if($validation->passes()){
        //     var_dump('valid');
        // }
        // else{
        //     var_dump('invalid');
        // }

        if($request->hasFile('avatar')){
            if($request->file('avatar')->isValid()){
                $avatar  = $request->file('avatar');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(300,300)->save( public_path ('/uploads//') . $filename);

                // Delete current image before uploading new image
                if (Auth::user()->avatar !== 'default.png') {
                    $file = public_path('/uploads//' . Auth::user()->avatar);
                    if (File::exists($file)) {
                        unlink($file);
                    }
                }
                $user = Auth::user();
                $user->avatar = $filename;
                $user->save();
            }
            else{

            }
        }
        return back()->with('success','Image Upload successfully');
        // $user->image =
    }
}
