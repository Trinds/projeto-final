<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Role;
class User extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
