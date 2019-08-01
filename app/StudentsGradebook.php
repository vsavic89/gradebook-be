<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentsGradebook extends Model
{
    protected $fillable = [
        'student_id', 'gradebook_id'
    ];
}
