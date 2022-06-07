<?php

namespace App\Models;

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use BaseModel, HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'story',
        'user_id'
    ];

    public $queryable = [
        'id'
    ];

    protected $relationship = [
        'user' => [
            'model' => 'App\Models\User',
        ],
    ];

    protected $exactFilters = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
