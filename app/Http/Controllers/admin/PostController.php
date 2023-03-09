<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmProject;

// MODEL
use App\Models\Post;
use App\Models\Type;
use App\Models\Technology;
use App\Models\Lead;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.posts.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $slug = Post::generateSlug($request->title);

        // aggiungo una coppia chiave valore all'array $data
        $data['slug'] = $slug;
        $newPost = new Post();

        if($request->hasFile('cover_image')){
            $path = Storage::disk('public')->put('post_images', $request->cover_image);
            $data['cover_image'] = $path;
        }

        $newPost->fill($data);
        $newPost->save();

        if($request->has('technologies')){
            $newPost->technologies()->attach($request->technologies);
        }

        $new_lead = new Lead();
        $new_lead->title = $data['title'];
        $new_lead->content = $data['content'];
        $new_lead->slug = $data['slug'];

        $new_lead->save();

        Mail::to('hello@example.com')->send(new ConfirmProject($new_lead));


        // queste operazione si possono fare anche così (3 in 1)
        // $newPost = Post::create($data);

        return redirect()->route('admin.posts.index')->with('message', 'Post creato correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.posts.edit', compact('post', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();
        $slug = Post::generateSlug($request->title, '-');
        $data['slug'] = $slug;

        if($request->hasFile('cover_image')){
            if($post->cover_image){
                Storage::delete($post->cover_image);
            }
            $path = Storage::disk('public')->put('post_images', $request->cover_image);
            $data['cover_image'] = $path;
        }

        $post->update($data);

        if($request->has('technologies')){
            $post->technologies()->sync($request->technologies);
        }
        else{
            $post->technologies()->sync([]);
        }

        return redirect()->route('admin.posts.index')->with('message', $post->title.' è stato aggiornato');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        // se non avessi inserito il CASCADEONDELETE
        // 1' cancellare tutti i record presenti nella tabella ponte
        $post->technologies()->sync([]);

        // 2' cancellare il POST
        $post->delete();
        return redirect()->route('admin.posts.index')->with('message', $post->title. ' è stato cancellato');
    }
}
