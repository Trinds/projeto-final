<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;
use App\Student;

class Classroom extends Model
{
    public function course()
    {
        return $this->belongsTo(Course::class);
    }   

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
