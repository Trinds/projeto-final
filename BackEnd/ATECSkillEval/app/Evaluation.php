<?php

namespace App;
use App\Student;
use App\Test;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
