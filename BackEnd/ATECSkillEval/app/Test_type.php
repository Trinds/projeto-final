<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Test;


class Test_type extends Model
{
  public function tests()
  {
        return $this->hasMany(Test::class);
  }
}
