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
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }   

    public function test_type()
    {
        return $this->belongsTo(Test_type::class);
    }
}
