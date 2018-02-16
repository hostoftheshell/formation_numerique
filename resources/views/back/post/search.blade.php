@extends('layouts.master') 
@section('content') 
<div class="text-left">
<a href="{{route('post.create')}}">
        <button type="button" class="btn btn-primary btn-lg">Ajouter un stage / une formation</button>
    </a>
</div>

@include('back.partials.searchBar')

@if(Session::has('message'))
<div class="alert">
    <p>{{Session::get('message')}}</p>
</div>

@endif

@if(isset($details))

{{$details->appends(Request::only('post.search'))->links()}}
<div class="text-left">
<button class="btn btn-danger delete_all" data-url="{{ route('delete') }}">Delete All Selected</button>
<table class="table table-striped">
    <thead>
        <tr>
            <th class="text-center"><input type="checkbox" id="master"></th>
            <th class="text-center">@sortablelink('title', 'Titre')</th>
            <th class="text-center">@sortablelink('post_type', 'Type')</th>
            <th class="text-center">@sortablelink('category.name', 'Intitulé')</th>
            <th class="text-center">@sortablelink('student_max', 'Places disponibles')</th>
            <th class="text-center">@sortablelink('price', 'Prix')</th>
            <th class="text-center">@sortablelink('started', 'Date de début')</th>
            <th class="text-center">@sortablelink('ended', 'Date de fin')</th>
            <th class="text-center">@sortablelink('status', 'Statut')</th>
            <th class="text-center">Afficher</th>
            <th class="text-center">&Eacute;diter</th>
            <th class="text-center">Supprimer</th>
        </tr>
    </thead>
    <tbody>
        @foreach($details as $key => $user)
        <tr class="mb-2 text-center" id="tr_{{$user->id}}" content="{{csrf_token()}}">
        <td><input type="checkbox" class="sub_chk" data-id=>{{$user->id}}</td>
            <td>
                <a href="{{route('post.edit', $user->id)}}">{{$user->title}}</a>
            </td>
            <td>{{$user->post_type}}</td>
            <td>{{$user->category->name?? 'aucune category'}}</td>
            <td>{{$user->student_max}}</td>
            <td>{{$user->price}}</td>
            <td>{{$user->started}}</td>
            <td>{{$user->ended}}</td>
            <td>
                
                <form action="{{route('status', $user->id)}}" method="get">
                @if($user->status == 'published')
                <button type="submit" value="unpublished" name="status" class="btn btn-success btn-xs">Publi&eacute;</button>
                @elseif($user->status == 'unpublished')
                <button type="submit" value="published" name="status" class="btn btn-warning btn-sm">Pr&ecirc;t &agrave; publier</button>
                @endif</form></td>
            <td>
                <a href="{{route('post.show', $user->id)}}">
                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                </a>
            </td>
            <td>
                <a href="{{route('post.edit', $user->id)}}">
                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                </a>
            </td>
            <td>
                <form class="delete" method="POST" action="{{route('post.destroy', $user->id)}}">
                    {{method_field('DELETE')}} {{csrf_field()}}
                    <input class="btn btn-danger btn-sm" type="submit" value="delete">
                </form>
            </td>
        </tr>
       
        @endforeach
        @endif
    </tbody>
</table>
{!! $details->appends(\Request::except('page'))->render() !!}



@endsection

@section('scripts')
    @parent
    <script src="{{asset('js/confirm.js')}}"></script>
@endsection