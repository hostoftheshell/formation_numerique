<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    /**
     * Owns post_id foreign key
     * 
     * @return associated Post 
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
