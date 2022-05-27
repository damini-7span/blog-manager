<?php

namespace App\Http\Resources\User;

use App\Traits\ResourceFilterable;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Media\Resource as MediaResource;

class Resource extends JsonResource
{
    use ResourceFilterable;
    protected $model = 'User';

    public function toArray($request)
    {
        $data = $this->fields();
        $data['avatar'] = $this->hasMedia('avatar') ? new MediaResource($this->firstMedia('avatar')) : null;
        return $data;
    }
}
