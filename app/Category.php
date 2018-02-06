<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Relation n:1 with Post
     * 
     * @return all associated Post 
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
