@extends('layouts.master') @section('content')
<div class="col-12">
    <a href="{{route('show', $post->id)}}">
        <h2>{{$post->title}}</h2>
    </a>
    <ul class="list-group">
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-4">
                    <h3>{{$post->category->name}}</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    @if(count($post->picture)>0)
                    <img class="img-thumbnail " src="{{url('images', $post->picture->link)}}" style="width: 300px"> @endif
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{route('type', $post->post_type)}}">
                                <h3>{{ucfirst($post->post_type)}}</h3>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Date de début :</h4> {{$post->started}}
                        </div>
                        <div class="col-md-6">
                            <h4>Date de fin :</h4> {{$post->ended}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Places Disponibles :</h4> {{$post->student_max}}
                        </div>
                    
                        <div class="col-md-6">
                            <h4>TARIF :</h4> {{$post->price}} &euro;
                            <em>HT</em>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-4">
                    {{$post->description}}
                </div>
            </div>
        </li>
    </ul>
</div>
@endsection