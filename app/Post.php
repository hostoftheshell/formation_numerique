<?php

namespace App;

use App\Category;
use Carbon\Carbon;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;


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
        
        use Sortable;
        
    public $sortable 
        =[
        'title',  
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

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeSearch($query, $search)
    {
       
        return $query->where('post_type', 'LIKE', '%' .$search. '%')
            ->orwhere('title', 'LIKE', '%'.$search.'%')
            ->orWhere('description', 'LIKE', '%' .$search. '%')
            ->orWhereHas( // Select * FROM Post where category_id IN (SELECT id FROM Categories WHERE name LIKE '%' $search '%';)
                'category', function ($Key) use ($search) { 
                    // use pour faire passer la var à la requête/function (courtesy Vinciane)
                    return $Key->where('name', 'LIKE', '%'.$search.'%');
                }
            );
    }
    
}