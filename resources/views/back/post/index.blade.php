@extends('layouts.master') 
@section('content')
<div class="text-left">
<a href="{{route('post.create')}}">
        <button type="button" class="btn btn-primary btn">ajouter un stage / une formation</button>
    </a>
</div>

@include('back.partials.searchBar')

{{$posts->links()}} 
@if(Session::has('message'))
<div class="alert">
    <p>{{Session::get('message')}}</p>
</div>
@endif
<div class="text-left">
<button class="btn btn-danger delete_all" data-url="{{ route('delete') }}">Delete All Selected</button>
</div>    

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
            <th class="text-center">Éditer</th>
            <th class="text-center">Supprimer</th>
        </tr>
    </thead>
    <tbody>
    @if($posts->count())


        @foreach($posts as $key => $post)
        
        <tr class="mb-2 text-center" id="tr_{{$post->id}}" content="{{csrf_token()}}">
            <td><input type="checkbox" class="sub_chk" data-id=>{{$post->id}}</td>
            <td>
                <a href="{{route('post.edit', $post->id)}}">{{$post->title}}</a>
            </td>
            <td>{{$post->post_type}}</td>
            <td>{{$post->category->name?? 'aucune category'}}</td>
            <td>{{$post->student_max}}</td>
            <td>{{$post->price}}</td>
            <td>{{$post->started}}</td>
            <td>{{$post->ended}}</td>
            <td>
                <form action="{{route('status', $post->id)}}" method="get">
                @if($post->status == 'published')
                <button type="submit" value="unpublished" name="status" class="btn btn-success btn-xs">Publi&eacute;</button>
                @elseif($post->status == 'unpublished')
                <button type="submit" value="published" name="status" class="btn btn-warning btn-sm">Pr&ecirc;t &agrave; publier</button>
                @endif</form></td>
            <td>
                <a href="{{route('post.show', $post->id)}}">
                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                </a>
            </td>
            <td>
                <a href="{{route('post.edit', $post->id)}}">
                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                </a>
            </td>
            <td>
                <form class="delete" method="POST" action="{{route('post.destroy', $post->id)}}">
                    {{method_field('DELETE')}} {{csrf_field()}}
                    <input class="btn btn-danger btn-sm" type="submit" value="delete">
                </form>
            </td>
        </tr>
       
        @endforeach
        @endif
    </tbody>
</table>
{!! $posts->appends(\Request::except('page'))->render() !!}
@endsection

@section('scripts')
    @parent
    <script src="{{asset('js/confirm.js')}}"></script>
    <script src="{{asset('js/delete.js')}}"></script>
    <script src="{{asset('js/datepicker')}}"></script>
@endsection