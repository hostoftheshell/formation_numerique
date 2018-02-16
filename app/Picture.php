<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{

    protected $fillable 
        =[
        'link',
        'title'
        ];
    
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
