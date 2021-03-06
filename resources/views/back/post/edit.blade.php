@extends('layouts.master') 
@section('content')
<form action="{{route('post.update', $post->id)}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}} {{method_field('PUT')}}
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>&Eacute;diter l&apos;article :</h2>
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Titre</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="title" id="title" value="{{$post->title}}" placeholder="Titre du stage/de la formation"> @if($errors->has('title'))
                                <span class="error bg-warning text-warning">{{$errors->first('title')}}</span>@endif
                            </div>
                        </div>
                        {{-- End of input title --}}
                        <div class="form-group row">
                            <label for="category_id" class="col-sm-2 col-form-label">Intitul&eacute;</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="category_id" id="category_id" value="{{$post->category->name}}">
                                    <option value="0" {{ is_null(old( 'category_id'))? 'selected' : '' }}>Pas d&apos;intitul&eacute;'</option>
                                    @foreach($categories as $id => $name)
                                    <option value="{{$id}}" {{ $post->category_id==$id ? 'selected' : '' }}>{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        {{-- End of input category --}}
                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" id="description" rows="3" name="description" placeholder="Description du stage/de la formation">{{$post->description}}</textarea>
                                @if($errors->has('description'))
                                <span class="error bg-warning text-warning">{{$errors->first('description')}}</span>@endif
                            </div>
                        </div>
                        {{-- End of input description --}}
                        <div class="form-group row">
                            <label for="started" class="col-sm-2 col-form-label">Date de d&eacute;but</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" name="started" value="{{$post->started}}" placeholder="Date de début"> @if($errors->has('started'))
                                <span class="error" style="color : red;">
                                    {{$errors->first('started')}}
                                </span>
                                @endif
                            </div>
                            {{-- End of input started --}}
                        </div>
                        <div class="form-group row">
                            <label for="ended" class="col-sm-2 col-form-label">Date de fin</label>
                            <div class="col-sm-10">
                            <input type="datetime-local" name="ended" value="{{$post->ended}}" placeholder="Date de fin"> @if($errors->has('ended'))
                                <span class="error" style="color : red;">
                                    {{$errors->first('ended')}}
                                </span>
                                @endif
                            </div>
                            {{-- End of input ended --}}
                            
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-2 col-form-label">Prix</label>
                            <div class="col-sm-10">
                                <input type="number" name="price" value="{{$post->price}}"> @if($errors->has('price'))
                                <span class="error" style="color : red;">
                                    {{$errors->first('price')}}
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- End of input price --}}
                        <div class="form-group row">
                            <label for="student_max" class="col-sm-2 col-form-label">Places disponibles</label>
                            <div class="col-sm-10">
                                <input type="number" name="student_max" value="{{$post->student_max}}"> @if($errors->has('student_max'))
                                <span class="error" style="color : red;">
                                    {{$errors->first('student_max')}}
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- End of input student_max --}}
                        <div class="form-check row">
                            <label class="form-check-label col-sm-2 col-form-label" for="status">Publi&eacute;</label>
                            <div class="col-sm-10">
                                <input type="radio" @if(old('status')=='published') checked @endif name="status" value="published" checked>
                            </div>
                        </div>
                        <div class="form-check row">
                            <label class="form-check-label col-sm-2 col-form-label" for="status">Pr&ecirc;t &agrave; publier</label>
                            <div class="col-sm-10">
                                <input type="radio" @if(old('status')=='unpublished') checked @endif name="status" value="unpublished">
                            </div>
                        </div>
                        <br> {{-- End of input status --}}
                        <div class="custom-file">
                            <label for="title_image">Title image :</label>
                            
                            <input type="text" name="title_image" id="title_image" class="form-control" value="{{ !empty(old('title_image')) ? old('title_image') : $post->picture->title }}" placeholder="Titre de l'image">
                            
                            <label class="custom-file-label" for="validatedCustomFile">S&eacute;lectionner une image</label>
                            <input type="file" name="picture" class="file" src="{{url('images', $post->picture->link)}}">@if($errors->has('picture'))
                            <span class="invalid-feedback">{{$errors->first('picture')}}</span>@endif
                        </div>
                        
                        @if($post->picture)
                        <div class="form-group">
            <div class="col-sm">
                <h3>Image associée : {{$post->picture->title}}</h3>
            </div>
            <div class="form-group">
            <img width="300" src="{{url('images', $post->picture->link)}}" alt="">
            </div>
            </div>
            @endif

                        {{-- End of input picture --}}
                    </li>
                    <br>
                    <div>
                        <button type="submit" class="btn btn-primary btn-lg">&Eacute;diter</button>
                    </div>
                    <br>
                </ul>
            </div>
        </div>
    </div>
    </div>
  <br>
  </form>


@endsection
@section('scripts')
    @parent
    
@endsection