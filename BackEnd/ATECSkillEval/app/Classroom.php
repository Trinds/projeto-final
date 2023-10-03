<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;
use App\Student;

class Classroom extends Model
{
    protected $fillable = [
        'edition',
        'start_date',
        'end_date',
        'course_id',
    ];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }   

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
