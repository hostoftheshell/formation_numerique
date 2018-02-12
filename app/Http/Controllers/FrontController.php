<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Post;

class FrontController extends Controller
{
    public function __construct()
    {   
            view()->composer(
                'partials.menu', function ($view) {
                    $types = Post::pluck('post_type', 'id')->unique(); 
                    $view->with('types', $types); 
                }
            );
    }
    
    public function index()
    {
        $posts = Post::orderBy('started', 'asc')->paginate(2);
        
        return view('front.index', ['posts' => $posts]);
    }

    public function show(int $id)
    {
        $post = Post::find($id);
        
        return view('front.show', ['post' => $post]);
    }

    public function type(string $type)
    {
        $posts = Post::where('post_type', $type)
            ->orderBy('started', 'asc')->paginate(2);
        
            return  view('front.type', ['posts' => $posts, 'type' => $type]);  
    }

    public function search()
    {
        $search = Input::get('search');
        
        $user = Post::where('post_type', 'LIKE', '%' .$search. '%')
            ->orwhere('title', 'LIKE', '%'.$search.'%')
            ->orWhere('description', 'LIKE', '%' .$search. '%')->paginate(2);
        
            if (count($user) > 0) {
            return view('front.search', ['user' => $user])->withDetails($user)->withQuery($search);
        
        } else { 
            
            return view('front.search')->withMessage('No Details found. Try to search again !');
        }

    }
}
