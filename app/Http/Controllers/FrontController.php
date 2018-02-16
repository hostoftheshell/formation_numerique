<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\TraitSearch;


class FrontController extends Controller
{

    use TraitSearch;

    public function __construct()
    {   
            view()->composer(
                'partials.menu', function ($view) {
                    $types = Post::pluck('post_type', 'id')->unique(); 
                    $view->with('types', $types); 
                }
            );

            $this->viewSearch = 'front.search'; // récupérer dans ton trait
    }
    
    public function index()
    {
        $prefix = request()->page?? '1';
        $key = 'post' . $prefix;

        $posts = Cache::remember(
            $key, 60*24, function () {
                return Post::published()
                    ->with('picture', 'category')
                    ->orderBy('started', 'asc')
                    ->paginate(2);
            }
        );
        
        return view('front.index', ['posts' => $posts]);
    }

    public function show(int $id)
    {
        $post = Post::find($id);
        
        return view('front.show', ['post' => $post]);
    }

    public function type(string $type)
    {
        $posts = Post::where('post_type', $type)->published()
            ->with('picture', 'category')
            ->orderBy('started', 'asc')
            ->paginate(2);
        
            return  view('front.type', ['posts' => $posts, 'type' => $type]);  
    }
}
