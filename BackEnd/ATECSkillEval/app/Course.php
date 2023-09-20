<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Classroom;
class Course extends Model
{
    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
}
