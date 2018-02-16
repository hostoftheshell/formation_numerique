<?php 

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;

trait TraitSearch
{
    protected $viewSearch;

    public function search(Request $request) 
    {
        $search = $request->search?? null;
        $types = Post::pluck('post_type', 'id')->unique(); // ??

        $user =Post::search($search)->with('category')->paginate(9);
        if (count($user) > 0) 
            return view($this->viewSearch, ['user' => $user, 'types' => $types])
                    ->withDetails($user)
                    ->withQuery($search);
         
        return view($this->viewSearch)
               ->withMessage('No Details found. Try to search again !');
    }
}