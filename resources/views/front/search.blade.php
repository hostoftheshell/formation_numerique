@extends('layouts.master') @section('content')
<div class="container">
    

    @if(isset($details)) 
    {{$details->appends(Request::only('search'))->links()}}
    <div class="row">
    <p> The Search results for your query <b> {{ $query }} </b> are :</p>
    <h2>Sample User details</h2>
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
                            <img class="img-thumbnail " src="{{url('images', $user->picture->link)}}" style="width: 300px"> @endif
                            <a href="{{route('type', $user->post_type)}}">
                                <h3>{{$user->post_type}}</h3>
                            </a>
                            <div class="row">
                                <div class="col-8 col-sm-4">
                                    <p>{{$user->started}}</p>
                                    <p>{{$user->ended}}</p>
                                </div>
                                <div class="col-8 col-sm-8" style="">
                                    <p>Nombre d'inscrits : {{$user->student_max}}/25</p>
                                    <p>TARIF : {{$user->price}} &euro;
                                        <em>HT</em>
                                    </p>
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
        <div class="col-md-4">
        
        @else
        <p>Aucun résultat ne correspond à votre recherche</p>     
        @endif 
            <form action="search" method="POST" role="search">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search users">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection