<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
     protected $fillable = ['reply_content','user_id'];

     public function message()
     {
          return $this->belongsTo(Message::class);
     }

     public function user()
     {
         return $this->belongsTo(User::class);
     }
}
