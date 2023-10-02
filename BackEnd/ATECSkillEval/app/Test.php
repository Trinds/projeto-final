<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Evaluation;
use App\Test_type;

class Test extends Model
{
    protected $fillable = [
        'evaluation_id',
        'test_type_id',
        'date',
    ];

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
    public function test_type()
    {
        return $this->belongsTo(Test_type::class);
    }
}
