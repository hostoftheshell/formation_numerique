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
        
        $user = Post::search($search)->with('category')->sortable()->paginate(9);
        
        if (count($user) > 0) 
            return view($this->viewSearch, ['user' => $user])
                    
                    ->withDetails($user)
                    ->withQuery($search);
         
        return view($this->viewSearch, ['user' => $user])
               ->withMessage('No Details found. Try to search again !');
    }
}