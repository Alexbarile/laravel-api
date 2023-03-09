@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 m-4">
            <div class="d-flex justify-content-between">
                <div>
                    <h2>Dettaglio post: {{$post->title}}</h2>
                </div>
                <div>
                    <a href="{{route('admin.posts.index')}}" class="btn btn-primary">
                        Torna all'elenco
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 m-4">
            <p><strong>Slug:</strong> {{$post->slug}}</p>
            <label class="d-block" for=""></label>
            <p><strong>Contenuto:</strong> {{$post->content}}</p>
            <p><strong>Categoria:</strong> {{$post->type ? $post->type->name : 'Senza categoria'}}</p>
            <p><strong>Technologies:</strong>
                @forelse ($post->technologies as $technology)
                {{$technology->name}},
                @empty
                Nessuna tecnologia associato al Post    
                @endforelse
            </p>
            <img src="{{asset ('storage/' .$post->cover_image)}}" alt="{{$post->title}}">
        </div>
    </div>
</div>
@endsection