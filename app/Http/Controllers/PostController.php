<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $posts = Post::orderBy('status')->paginate(7);

        return view('back.post.index', ['posts' => $posts]);
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
    public function store(Request $request)
    {
        $this->validate(
            $request, [
            'title'         => 'required',
            'description'   => 'required|string',
            'category_id'   => 'required|string',
            'started'       =>'required|date',
            'ended'         =>'required|date|after:started_at',
            'price'         => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'student_max'   =>'required|integer',
            'post_type'     => 'in:stage|formation',
            'status'        => 'in:published,unpublished',
            'picture'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]
        );
        
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
       
        return redirect()->route('post.index')->with('message', 'SUCCESS');
        //
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
        $types= Post::pluck('post_type', 'id')->unique();
 
        return view('back.post.edit', ['post' => $post, 'categories' => $categories, 'types' => $types]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request, [
            'title'         => 'required',
            'description'   => 'required|string',
            'category_id'   => 'required|string',
            'started'       =>'required|date|after:tomorrow',
            'ended'         =>'required|date|after:started_at',
            'price'         =>'required|regex:/^\d*(\.\d{1,2})?$/',
            'student_max'   =>'required|integer',
            'post_type'     => 'in:stage|formation',
            'status'        => 'in:published,unpublished',
            'picture'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]
        );
        
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
