<?php

namespace App\Services;

use App\Models\Post;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Auth;

class PostService
{
    private $model;

    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function collection($inputs)
    {
        $user = Auth::user();
        $roles = ['user'];
        if (array_intersect($roles, $user->getRoleNames()->toArray())) {
            $query = $this->model->getQB()->where('user_id', $user->id);
        }
        else{
            $query = $this->model->getQB();
        }
        return $query->get();
    }

    public function resource($id)
    {
        $user = Auth::user();
        $roles = ['user'];
        if (array_intersect($roles, $user->getRoleNames()->toArray())) {
            $post = $this->model->getQB()->where('user_id', $user->id)->findOrFail($id);
        }
        else{
            $post = $this->model->getQB()->findOrFail($id);  
        }
        return $post;
        
    }

    public function store($inputs)
    {
        if(Auth::user()->id == $inputs['user_id'])
        {
            $post = $this->model->create($inputs);
            return $post;
        }
        else
        {
            throw new CustomException('you can not post from different user');
        }
    }

    public function update($id, $inputs=null)
    {
        $post = $this->resource($id);
        $post->update($inputs);
        return $post;
    }

    public function delete($id)
    {
        $post = $this->resource($id);
        return $post->delete();
    }
}
?>