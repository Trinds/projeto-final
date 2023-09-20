<?php

namespace App;
use App\Evaluation;
use App\Classroom;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class);
    }

    public function evaluation()
    {
        return $this->hasOne(Evaluation::class);
    }
    
  
}
