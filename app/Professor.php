<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'user_id'
    ];

    const STORE_RULES = [
        'first_name' => 'required|max:255',
        'last_name' => 'required|max:255',  
        'user_id' => 'required|numeric'      
    ];

    public function gradebooks()
    {
        return $this->hasMany('App\Gradebook');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
