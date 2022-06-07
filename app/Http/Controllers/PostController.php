<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Services\PostService;
use App\Http\Requests\Post\Upsert;
use App\Http\Controllers\Controller;
use App\Http\Resources\Post\Resource;
use App\Http\Resources\Post\Collection;

class PostController extends Controller
{
    use ApiResponser;
    public $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }
  
    public function index(Request $request)
    {
        $posts = $this->service->collection($request->all());
        return $this->collection(new Collection($posts));
    }

    public function store(Upsert $request)
    {
        $post = $this->service->store($request->all());
        return $this->resource(new Resource($post));
    }

    public function show(Post $post)
    {
        $post = $this->service->resource($post->id);
        return $this->resource(new Resource($post));
    }

    public function update(Post $post, Upsert $request)
    {
        $post = $this->service->update($post->id, $request->all());
        return $this->resource(new Resource($post));
    }

    public function destroy(Post $post)
    {
        return $this->service->delete($post->id);
    }
}