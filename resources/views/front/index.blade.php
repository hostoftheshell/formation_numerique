@extends('layouts.master') 

@section('content')
<div class=container>
<h1 class="mb-2 text-center">FORMATIONS &amp; STAGES D'AVENIR</h1>
        {{$posts->links()}}
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
                            <a href="{{route('type', $post->post_type)}}">
                                <h3>{{$post->post_type}}</h3>
                            </a>
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
                                <div class="col-md-4">
                                    <h4>TARIF :</h4> {{$post->price}} &euro;
                                    <em>HT</em>
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
        <div class="col-md-3">
        @include('partials.searchBar')
        </div>
    </div>
</div>
@endsection