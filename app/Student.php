<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'imageURL'
    ];
    const STORE_RULES = [
        'first_name' => 'required',
        'last_name' => 'required',
        'imageURL' => 'required'
    ];
}
