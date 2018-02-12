@extends('layouts.master') @section('content')
<p>
    <a href="{{route('post.create')}}">
        <button type="button" class="btn btn-primary btn-lg">Ajouter un stage / une formation</button>
    </a>
</p>
{{$posts->links()}} @if(Session::has('message'))
<div class="alert">
    <p>{{Session::get('message')}}</p>
</div>
@endif
<table class="table table-striped">
    <thead>
        <tr>
            <th class="text-center">Titre</th>
            <th class="text-center">Type</th>
            <th class="text-center">Intitul&eacute;</th>
            <th class="text-center">Places disponibles</th>
            <th class="text-center">Prix</th>
            <th class="text-center">Date de d&eacute;but</th>
            <th class="text-center">Date de fin</th>
            <th class="text-center">Statut</th>
            <th class="text-center">Afficher</th>
            <th class="text-center">&Eacute;diter</th>
            <th class="text-center">Supprimer</th>
        </tr>
    </thead>
    <tbody>
        @forelse($posts as $post)
        <tr class="mb-2 text-center">
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
                {{-- test mutator --}}
                <form action="" method="post">
                {{csrf_field()}} {{method_field('PUT')}}
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
                <form class="delete" method="POST" action="">
                    {{method_field('DELETE')}} {{csrf_field()}}
                    <input class="btn btn-danger btn-sm" type="submit" value="delete">
                </form>
            </td>
        </tr>
        @empty 
        <tr>
            <td>aucun titre</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection