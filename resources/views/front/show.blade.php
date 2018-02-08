@extends('layouts.master') @section('content')
<ul class="list-group">
    <li class="list-group-item">
        <a href="{{route('show', $post->id)}}">
            <h2>{{$post->title}}</h2>
        </a>
        <h3>{{$post->category->name}}</h3>
        <div class='row'>
            <div class="col-6 col-sm-4">
                @if(count($post->picture)>0)
                <img class="img-thumbnail " src="{{url('images', $post->picture->link)}}" style="width: 300px"> @endif
                <a href="{{route('type', $post->post_type)}}">
                    <h3>{{$post->post_type}}</h3>
                </a>
                <div class="row">
                    <div class="col-8 col-sm-4">
                        <p>{{$post->started}}</p>
                        <p>{{$post->ended}}</p>
                    </div>
                    <div class="col-8 col-sm-8" style="">
                        <p>Nombre d'inscrits : {{$post->student_max}}/25</p>
                        <p>TARIF : {{$post->price}} &euro;
                            <em>HT</em>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-8">
                {{$post->description}}
            </div>
        </div>
    </li>
</ul>
</div>
@endsection