<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Relation 1:n with Category
     * 
     * @return associated Category 
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    /**
     * Relation n:1 with Picture
     * 
     * @return associated Picture 
     */
    public function picture()
    {
        return $this->hasOne(Picture::class);
    }
}

