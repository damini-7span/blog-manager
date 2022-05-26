<?php

namespace App\Models;

use App\Traits\BaseModel;
use Plank\Mediable\Mediable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use BaseModel, HasApiTokens, HasFactory, Notifiable, HasRoles, Mediable;

    protected $guard_name = 'api';

    protected $fillable = [
        'name',
        'email',
        'mobile_no',
        'password',
        'information'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $queryable = [
        'id'
    ];

    protected $relationship = [];

    public function relationship()
    {
        return $this->relationship;
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
