<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gradebook extends Model
{  
    protected $fillable = ['name', 'professor_id'];
    const STORE_RULES = [
        'name' => 'required|unique:gradebooks|min:2',
    ];
    public function professor()
    {
        return $this->belongsTo('App\Professor');
    }
}
