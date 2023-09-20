<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Test;


class Test_type extends Model
{
    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
