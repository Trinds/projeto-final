<?php

namespace App;
use App\Evaluation;
use App\Classroom;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'student_number',
        'classroom_id',
        'email',
        'name',
        'birth_date',
        'image',
    ];
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function evaluation()
    {
        return $this->hasOne(Evaluation::class);
    }
    
}
