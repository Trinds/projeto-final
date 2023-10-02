<?php

namespace App;
use App\Student;
use App\Test;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = [
        'score', 'student_id', 'test_id'
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
