@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 m-3">
                <h1>MODIFICA POST</h1>
            </div>
            <div class="class-12">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{$error}}</div>
                    @endforeach
                @endif
                <form method="POST" action="{{route('admin.posts.update', $post->slug)}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group m-2">
                        <label class="fs-2 fw-semibold" for="title">Titolo</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Titolo" value="{{old('title') ?? $post->title}}">
                        @error('title')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group m-2">
                        <label class="fs-2 fw-semibold" for="content">Contenuto</label>
                        <textarea type="password" class="form-control" name="content" id="content" placeholder="Contenuto" value="{{old('content') ?? $post->content}}"></textarea>
                        @error('content')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group m-2">
                        <label class="fs-2 fw-semibold" for="type_id">Categorie</label>
                        <select class="form-control" name="type_id" id="type_id">
                            <option value="disabled selected">Seleziona categoria</option>
                            @foreach ($types as $type)
                            <option value="{{$type->id}}"
                                {{$type->id == old('type_id', $post->type_id) ? 'selected' : ''}}>
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
                            @if($errors->any())
                            {{-- 1 CASO --}}
                            {{-- Ci sono errori di validazione e bisogna ricaricare i tag selezionati tramite funzione ''old''' --}}
                            <input type="checkbox" value="{{$technology->id}}" name="technologies[]" {{in_array($technology->id, old('technologies', [])) ? 'checked' : ''}} class="form-check-input">
                            <label class="form-check-label">{{$technology->name}}</label>
                            @else
                            {{-- 2 CASO --}}
                            {{-- Se non ci sono errori di validazione la pagina è stata aperta per la prima volta e quindi bisogna recuperare i tag in relazione con il post --}}
                            <input type="checkbox" value="{{$technology->id}}" name="technologies[]" {{$post->technologies->contains($technology) ? 'checked' : ''}} class="form-check-input">
                            @endif <label class="form-check-label">{{$technology->name}}</label>
                        </div>
                        @endforeach
                        @error('technologies')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group m-2">
                        <label class="fs-2 fw-semibold">Immagine</label>
                        <div>
                            <img src="{{asset('storage/' .$post->cover_image)}}" alt="">
                        </div>
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