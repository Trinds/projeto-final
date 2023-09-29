<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Classroom;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;
    protected $fillable = ['name'];
    
    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
}
