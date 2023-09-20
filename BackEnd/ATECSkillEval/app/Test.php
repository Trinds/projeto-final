<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Evaluation;
use App\Test_type;

class Test extends Model
{
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }   

    public function test_type()
    {
        return $this->hasOne(Test_type::class);
    }

}
