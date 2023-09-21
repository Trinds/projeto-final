<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class User_role extends Model
{
    protected $fillable = [
        'role',
    ];
    public function user()
    {
        return $this->hasMany(User::class);
    }   
}
