<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content', 'user_id'
    ];
    const STORE_RULES = [
        'content' => 'required|max:1000'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
