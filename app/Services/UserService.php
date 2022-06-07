<?php

namespace App\Services;

use App\Models\User;
use GuzzleHttp\Psr7\Request;
use App\Exceptions\CustomException;
use Plank\Mediable\Facades\MediaUploader;

class userService
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function collection($inputs = null)
    {
        $query = $this->user->getQB();
        if (!empty($inputs['sort'])) {
            $query = $query->orderBy($inputs['sort']['by'], $inputs['sort']['order']);
        }

        if (!empty($inputs['search'])) {
            $query = $query->where('name', 'LIKE', '%' . $inputs['search'] . '%');
        }

        if (!empty($inputs['limit'])) {
            return ($inputs['limit'] == -1) ? $query->get() : $query->paginate($inputs['limit']);
        }
        return $query->get();
    }

    public function resource($id)
    {
        $query = $this->user->getQB()->findOrFail($id);
        return $query;
    }

    public function update($id, $inputs = null)
    {
        $user = $this->resource($id);
        $defaultLocation = isset(config('filesystems.disks')[config('filesystems.default')]['default_location']) ? config('filesystems.disks')[config('filesystems.default')]['default_location'] : '/';
        $location =  (!empty($location)) ? $defaultLocation . '/' . $location : $defaultLocation;
        if (isset($inputs['avatar'])) {
            $media = MediaUploader::fromSource($inputs['avatar'])
                ->toDestination(config('mediable.default_disk'), $location)
                ->setAllowedAggregateTypes(['image'])
                ->setMaximumSize(99999)
                ->upload();

            $user->syncmedia($media, 'avatar');
        }

        $user->update($inputs);
        return $user;
    }
}
