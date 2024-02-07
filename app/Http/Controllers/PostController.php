<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostsResource;
use App\Models\Category;
use App\Models\Post;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PostsResource::collection(
            Post::where('user_id', Auth::user()->id)->with('categories')->orderBy('created_at', 'DESC')->paginate(5)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $request->validated($request->all());

        $post = Post::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'content' => $request->description,
            'status' => $request->status,
        ]);

        $post->categories()->attach(Category::create(['name' => $request->name]));

        return PostsResource::collection(Post::where('id', $post->id)->with('categories')->get());
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return $this->isNotAuthorized($post) ?: PostsResource::collection(Post::where('id', $post->id)->with('categories')->get());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if (Auth::user()->id !== $post->user_id) {
            return $this->error('', 'You are not authorized.', '403');
        }

        $post->update($request->all());

        return new PostsResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        return $this->isNotAuthorized($post) ?: $post->delete();
    }

    private function isNotAuthorized($post) {
        if (Auth::user()->id !== $post->user_id) {
            return $this->error('', 'You are not authorized.', '403');
        }
    }
}
