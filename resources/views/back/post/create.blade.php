@extends('layouts.master') @section('content')
<form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Cr&eacute;er un Article :</h2>
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Titre</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="title" id="title" value="{{old('title')}}" placeholder="Titre du stage/de la formation"> @if($errors->has('title'))
                                <span class="error bg-warning text-warning">{{ $errors->first('title') }}</span>@endif
                            </div>
                        </div>
                        {{-- End of input title --}}
                        <div class="form-group row">
                            <label for="category_id" class="col-sm-2 col-form-label">Intitul&eacute;</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="category_id" id="category_id">
                                    <option value="0" {{ is_null(old( 'category_id'))? 'selected' : '' }}>Pas d&apos;intitul&eacute;</option>
                                    @foreach($categories as $id => $name)
                                    <option value="{{$id}}" {{ old( 'category_id')==$id ? 'selected' : '' }}>{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- End of input category --}}
                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" id="description" rows="3" name="description"> {{old('description')}}
                                </textarea>@if($errors->has('description'))
                                <span class="error bg-warning text-warning"> {{$errors->first('description')}}
                                </span>@endif
                            </div>
                        </div>
                        {{-- End of input description --}}
                        <div class="form-group row">
                            <label for="started" class="col-sm-2 col-form-label">Date de d&eacute;but</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" name="started" value="{{old('started')}}">@if($errors->has('started'))
                                <span class="error" style="color : red;"> {{$errors->first('started')}}</span>@endif
                            </div>
                        </div>
                        {{-- End of input started --}}
                        <div class="form-group row">
                            <label for="ended" class="col-sm-2 col-form-label">Date de fin</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" name="ended" value="{{old('ended')}}">@if($errors->has('ended'))
                                <span class="error" style="color : red;"> {{$errors->first('ended')}}</span>@endif
                            </div>
                        </div>
                        {{-- End of input ended --}}
                        <div class="form-group row">
                            <label for="price" class="col-sm-2 col-form-label">Prix</label>
                            <div class="col-sm-10">
                                <input type="number" name="price" value="{{old('price')}}">@if($errors->has('price'))
                                <span class="error" style="color : red;"> {{$errors->first('price')}}</span>@endif </div>
                        </div>
                        {{-- End of input price --}}
                        <div class="form-group row">
                            <label for="student_max" class="col-sm-2 col-form-label">Places disponibles</label>
                            <div class="col-sm-10">
                                <input type="number" name="student_max" value="{{old('price')}}">@if($errors->has('student_max'))
                                <span class="error" style="color : red;"> {{$errors->first('student_max')}}</span>@endif </div>
                        </div>
                        {{-- End of input student_max --}}
                        <div class="form-check row">
                            <label class="form-check-label col-sm-2 col-form-label" for="status">Publi&eacute;</label>
                            <div class="col-sm-10">
                                <input type="radio" @if(old( 'status')=='published' ) checked @endif name="status" value="published" checked>
                            </div>
                        </div>
                        <div class="form-check row">
                            <label class="form-check-label col-sm-2 col-form-label" for="status">Pr&ecirc;t &agrave; publier</label>
                            <div class="col-sm-10">
                                <input type="radio" @if(old( 'status')=='unpublished' ) checked @endif name="status" value="unpublished">
                            </div>
                        </div>
                        {{-- End of input status --}}
                        <div class="custom-file">
                            <label class="custom-file-label" for="validatedCustomFile">S&eacute;lectionner une image</label>
                            <input type="file" class="form-control-file" name="picture"> @if($errors->has('picture'))
                            <p class="error bg-warning text-warning">{{$errors->first('picture')}}</p>@endif
                        </div>
                    </li>
                    <br>
                    <div class="col-12 col-sm-6">
                        <button type="submit" class="btn btn-primary">Ajouter un Post</button>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</form>
<br>
@endsection