<?php

namespace App\Models;

use App\Traits\BaseModel;
use Plank\Mediable\Media as MediaClass;

class Media extends MediaClass
{
    use BaseModel;

    protected $fillable = [
        'disk',
        'filename',
        'mime_type',
        'created_at',
        'updated_at'
    ];

    public $queryable = [
        'id'
    ];

    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];

    public function mediable()
    {
        return $this->hasOne(Mediable::class);
    }
}
