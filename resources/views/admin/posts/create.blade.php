@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 m-3">
                <h1>AGGIUNGI NUOVO POST</h1>
            </div>
            <div class="class-12">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{$error}}</div>
                    @endforeach
                @endif
                <form method="POST" action="{{route('admin.posts.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group m-2">
                        <label class="fs-2 fw-semibold" for="title">Titolo</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Titolo">
                        @error('title')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group m-2">
                        <label class="fs-2 fw-semibold" for="content">Contenuto</label>
                        <textarea type="password" class="form-control" name="content" id="content" placeholder="Contenuto"></textarea>
                        @error('content')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group m-2">
                        <label class="fs-2 fw-semibold" for="type_id">Categorie</label>
                        <select class="form-control" name="type_id" id="type_id">
                            <option value="disabled selected">Seleziona categoria</option>
                            @foreach ($types as $type)
                            <option value="{{$type->id}}">
                                {{$type->name}}
                            </option>  
                            @endforeach
                        </select>
                        @error('type_id')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group m-2">
                        <div class="fs-2 fw-semibold">Technologies</div>
                        @foreach ($technologies as $technology)
                        <div class="form-check @error('technologies') is-invalid @enderror">
                            <input type="checkbox" value="{{$technology->id}}" name="technologies[]">
                            <label class="form-check-label">{{$technology->name}}</label>
                        </div>
                        @endforeach
                        @error('technologies')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group m-2">
                        <label class="fs-2 fw-semibold">Immagine</label>
                        <input type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image" id="cover_image">
                        @error('cover_image')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Salva</button>
                </form>
            </div>
        </div>
    </div>
@endsection