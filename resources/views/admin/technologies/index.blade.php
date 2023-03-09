@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 my-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <h1>ELENCO TECHNOLOGIES</h1>
                    </div>
                </div>
            </div>
            <div class="col-12">
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
                        @foreach ($technologies as $technology)
                        <tr>
                            <th scope="row">{{ $technology->id }}</th>
                            <td>{{ $technology->name }}</td>
                            <td>{{ $technology->slug }}</td>
                            <td>
                                {{-- <a href="{{route('admin.posts.show', $post->slug)}}" title="Visualizza post" class="btn btn-sm btn-square btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{route('admin.posts.edit', $post->slug)}}" title="Modfica post" class="btn btn-sm btn-square btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="submit" class="btn btn-sm btn-square btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form class="d-inline-block" action="{{route('admin.posts.destroy', $post->slug)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-square btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- @include('admin.partials.modals') --}}
@endsection