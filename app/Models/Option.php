<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends BaseModel
{
    use SoftDeletes;

//    protected $casts = ['extra' => 'array'];

//    public function user()
//    {
//        return $this->belongsTo('ApiDemo\Models\User');
//    }
//
//    public function comments()
//    {
//        return $this->hasMany('ApiDemo\Models\PostComment');
//    }
}
