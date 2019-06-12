<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['content','title'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function likes()
    {
        return $this->belongsToMany('App\Like');
    }
}
