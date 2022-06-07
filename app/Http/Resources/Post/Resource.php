<?php

namespace App\Http\Resources\Post;

use App\Traits\ResourceFilterable;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\Resource as UserResource;

class Resource extends JsonResource
{
    use ResourceFilterable;
    protected $model = 'Post';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       $data = $this->fields();
       $data['user'] = new UserResource($this->whenLoaded('user'));
       return $data;
    }
}
