@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 my-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <h1>ELENCO POST</h1>
                    </div>
                    <div>
                        <a class="btn btn-primary" href="{{route('admin.posts.create')}}">Aggiungi Post</a>
                    </div>
                </div>
            </div>
            <div class="col-12">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message')}}
                    </div>
                @endif
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Titolo</th>
                            <th>Slug</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                        <tr>
                            <th scope="row">{{ $post->id }}</th>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->slug }}</td>
                            <td>
                                <a href="{{route('admin.posts.show', $post->slug)}}" title="Visualizza post" class="btn btn-sm btn-square btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{route('admin.posts.edit', $post->slug)}}" title="Modfica post" class="btn btn-sm btn-square btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="submit" class="btn btn-sm btn-square btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fas fa-trash"></i>
                                </button>
                                {{-- <form class="d-inline-block" action="{{route('admin.posts.destroy', $post->slug)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-square btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td scope="row">
                                Nessun post, aggiungilo da <a href="{{route('admin.posts.create')}}">qui</a> 
                            </td>
                        </tr>        
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('admin.partials.modals')
@endsection