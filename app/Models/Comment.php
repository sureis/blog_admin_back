<?php

namespace App\Models;

class Comment extends BaseModel
{
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function content()
    {
        return $this->belongsTo('App\Models\Content');
    }
}
