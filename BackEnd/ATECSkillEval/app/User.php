<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User_role;
class User extends Model
{
    public function user_role()
    {
        return $this->hasOne(User_role::class);
    }   
}
