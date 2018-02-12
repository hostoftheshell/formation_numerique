@extends('layouts.master') @section('content')
<div class="col-12">
    <a href="{{route('show', $post->id)}}">
        <h2>Titre : {{$post->title}}</h2>
    </a>
    <ul class="list-group">
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-4">
                    <h3>Domaine : {{$post->category->name}}</h3>
                </div>
                <div class="col-md-4">
                    <h3>Status : @if($post->status == 'published')
                        <button class="btn btn-success btn-xs">Publi&eacute;</button>
                        @elseif($post->status == 'unpublished')
                        <button class="btn btn-warning btn-sm">Pr&ecirc;t &agrave; publier</button>
                        @endif
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h3>Description :</h3> {{$post->description}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h3>Categorie :</h3><a href="{{route('type', $post->post_type)}}"> {{$post->post_type}}
                    </a>
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Date de début :</h3> {{$post->started}}
                        </div>
                        <div class="col-md-6">
                            <h3>Date de fin :</h3> {{$post->ended}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <h3>Places Disponibles :</h3> {{$post->student_max}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <h3>TARIF :</h3> {{$post->price}} &euro;
                            <em>HT</em>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3>Image :</h3>
                    @if(count($post->picture)>0)
                    <img class="img-thumbnail " src="{{url('images', $post->picture->link)}}" style="width: 300px"> @endif
                </div>
            </div>
        </li>
    </ul>
</div>

@endsection