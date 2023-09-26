<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Role;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Model
{
    use HasApiTokens, Notifiable, SoftDeletes;
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
