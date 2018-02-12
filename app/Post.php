<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class Post extends Model
{
    protected $fillable     
        =[
        'title',
        'description',
        'post_type',
        'status', 
        'started', 
        'ended',
        'price',
        'student_max',
        'category_id',
        ];
    
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

    // Date Mutators : date format('Y-m-d H:i:s') to ('d/m/Y') in view.front
    public function getStartedAttribute($value)
    {
        if (Auth::check()) {
            return $value;
        }
        
        return Carbon::parse($value)->format('d/m/Y');
    }
    public function getEndedAttribute($value)
    {
        if (Auth::check()) {
            return $value;
        }
       
        return Carbon::parse($value)->format('d/m/Y');
    }
    
    // public function getStatusAttribute($value)
    // {
    //     return $this->attributes['status'];
    // }
    // public function setStatusAttribute($value)
    // {
    //     $this->attributes['$post->status'] = ($value);
    // }
}

