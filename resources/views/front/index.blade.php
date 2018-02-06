@extends('layouts.master') @section('content')

<h1>FORMATIONS &amp; STAGES D'AVENIR</h1>

{{$posts->links()}}
<div class=container>
    <div class="row">
        <div class="col-12 col-md-8">
            <ul class="list-group">
                @forelse($posts as $post)
                <li class="list-group-item">
                    <a href="{{route('show', $post->id)}}">
                        <h2>{{$post->title}}</h2>
                    </a>
                    <h3>{{$post->category->name}}</h3>
                    <div class='row'>
                        <div class="col-8 col-sm-6">
                            @if(count($post->picture)>0)
                            <img class="img-thumbnail " src="{{url('images', $post->picture->link)}}" style="width: 300px"> @endif
                            <a href="{{route('type', $post->post_type)}}"><h3>{{$post->post_type}}</h3></a>
                            <div class="row">
                                <div class="col-8 col-sm-4">
                                    <p>{{$post->started}}</p>
                                    <p>{{$post->ended}}</p>
                                </div>
                                <div class="col-8 col-sm-6" style="">
                                    <p>Nombre d'inscrits : {{$post->student_max}}/25</p>
                                    <p>TARIF : {{$post->price}} &euro;
                                        <em>HT</em>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 col-sm-6">
                            {{$post->description}}
                        </div>
                    </div>
                </li>
                @empty
                <li>AUCUNE FORMATION D'AVENIR</li>
                @endforelse
            </ul>
        </div>
        <div class="col-12 col-md-2">
            <p>(moteur de recherche)</p>
        </div>
    </div>
</div>
@endsection