@extends('layouts.master') 
@section('content') 

@if(isset($details))
<h2>Résultats pour votre recherche :
    <b>{{$query}}</b>
</h2>
<div class="container">
    {{$details->appends(Request::only('search'))->links()}}
    <div class="row">
        <div class="col-12 col-md-8">
            <ul class="list-group">
                @forelse($details as $user)
                <li class="list-group-item">
                    <a href="{{route('show', $user->id)}}">
                        <h2>{{$user->title}}</h2>
                    </a>
                    <h3>{{$user->category->name}}</h3>
                    <div class='row'>
                        <div class="col-8 col-sm-6">
                            @if(count($user->picture)>0)
                            <img class="img-thumbnail " src="{{url('images', $user->picture->link)}}" style="width: 300px"> 
                            @endif
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="{{route('type', $user->post_type)}}">
                                        <h3>{{ucfirst($user->post_type)}}</h3>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Date de début :</h4> {{$user->started}}
                                </div>
                                <div class="col-md-6">
                                    <h4>Date de fin :</h4> {{$user->ended}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Nombre d'inscrits :</h4> {{$user->student_max}}/25
                                </div>
                                <div class="col-md-6">
                                    <h4>TARIF :</h4> {{$user->price}} &euro;<em>HT</em>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 col-sm-6">
                            {{$user->description}}
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
@else
<div class="row">
    <div class="col-md-6">
        <h3>Aucun résultat ne correspond à votre recherche.</h3>
        <br>
        @include('partials.searchBar')
        <br>
        <a href="{{url('/')}}">
            <span class="glyphicon glyphicon-chevron-left"></span>Retour à la page d'accueil</a>
    </div>
</div>
<br>
@endif 
@endsection