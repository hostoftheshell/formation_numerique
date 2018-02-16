<?php

namespace App\Http\Controllers;

use App\Post;
use Artisan;
use Storage;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\TraitSearch;



class PostController extends Controller
{
    use TraitSearch;
    
    public function __construct()
    {
        // parent::__construct(); // au cas où tu défies un constructor dans un parent ...

        $this->viewSearch = 'back.post.search';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $prefix = request()->page?? '1';
        $key = 'admin' . $prefix;

        $posts = Post::sortable()->paginate(9);
            
        return view('back.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // permet de récupérer une collection type array avec en clé id => name
        $categories = Category::pluck('name', 'id')->all();
        $types= Post::pluck('post_type', 'id')->unique();
        
        return view('back.post.create', ['categories' => $categories, 'types' => $types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        // Hydratation des inputs (post) et enregistrement dans la Bdd
        $post = Post::create($request->all()); // associés aux fillables dans la classe POST
        
        $image = $request->file('picture');

        if (!empty($image)) {
            $image = $request->file('picture');
            $link = $image->store('./');
           
            $post->picture()->create(
                [ 
                'link'  => $link,
                'title' => $request->title_image?? $request->title
                ]
            );
        }
        Artisan::call('cache:clear');
       
        return redirect()->route('post.index')->with('message', 'SUCCESS');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::find($id);
        return view('back.post.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::find($id);
        $categories = Category::pluck('name', 'id')->all();
        $types = Post::pluck('post_type', 'id')->unique();
        
        return view('back.post.edit', ['post' => $post, 'categories' => $categories, 'types' => $types]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id); // associé les fillables
        
        $post->update($request->all());

        $image = $request->file('picture');
        
        
        if (!empty($image)) {
            
            $link = $request->file('picture')->store('./');
            if (count($post->picture)>0) {
                Storage::disk('local')->delete($post->picture->link); // supprimer physiquement l'image
                $post->picture()->delete(); // supprimer l'information en base de données
            }
            
            $post->picture()->create(
                [ 
                'link'  => $link,
                'title' => $request->title_image?? $request->title
                ]
            );
        }

        return redirect()->route('post.index')->with('message', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        
        $post->delete();
        
        if (!empty($image)) {
            
            $link = $request->file('picture')->store('./');
            if (count($post->picture)>0) {
                Storage::disk('local')->delete($post->picture->link); // supprimer physiquement l'image
                $post->picture()->delete(); // supprimer l'information en base de données
            }
            
        }
        
        Artisan::call('cache:clear');
        
        return redirect()->route('post.index')->with('message', "L'article été supprimé avec succès");

    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;

        $ids = explode(',', $ids);

        Post::destroy($ids);

        if (!empty($image)) {
            
            $link = $request->file('picture')->store('./');
            if (count($post->picture)>0) {
                Storage::disk('local')->delete($post->picture->link); // supprimer physiquement l'image
                $post->picture()->delete(); // supprimer l'information en base de données
            }
            
        }
        
        return response()->json(
            [
                'success'=>"Products Deleted successfully.",
                'error' => 'Error deleted'
            ] 
        );
        
    }

    public function status($id, Request $request)
    {
        $status = $request->status?? null;
        $post = Post::find($id);
        
        ($status === ('published')) ? $post->update(['status' => 'published']) : $post->update(['status' => 'unpublished']);
        
        Artisan::call('cache:clear');
        
        return redirect()->route('post.index');
    }
    
   

    


}
