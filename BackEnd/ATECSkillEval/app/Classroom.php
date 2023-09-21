<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;
use App\Student;

class Classroom extends Model
{
    protected $fillable = [
        'id',
        'edition',
        'start_date',
        'end_date',
        'course_id',
        'created_at',
        'updated_at',
    ];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }   

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
