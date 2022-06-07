<?php

namespace App\Http\Resources\User;

use App\Traits\ResourceFilterable;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Media\Resource as MediaResource;
use App\Http\Resources\Post\Collection as PostCollection;

class Resource extends JsonResource
{
    use ResourceFilterable;
    protected $model = 'User';

    public function toArray($request)
    {
        $data = $this->fields();
        $data['avatar'] = $this->hasMedia('avatar') ? new MediaResource($this->firstMedia('avatar')) : null;
        $data['posts'] = new PostCollection($this->whenLoaded('posts'));
        return $data;
    }
}
