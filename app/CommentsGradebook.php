<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentsGradebook extends Model
{
    protected $fillable = [
        'comment_id', 'gradebook_id'
    ];
}
