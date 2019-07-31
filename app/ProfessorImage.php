<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfessorImage extends Model
{
    protected $fillable = [
        'professor_id' => 'required',
        'imageURL' => 'required|image|mimes:jpeg,png,jpg'
    ];
}
