<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User_role;
class User extends Model
{
    protected $fillable = [
        'name', 'email', 'password','image','user_role_id'
    ];
    public function user_role()
    {
        return $this->belongsTo(User_role::class);
    }   
}
