<?php

use Illuminate\Database\Seeder;
use App\Test_type;

class TestTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        factory(Test_type::class, 2)->create();

    }
}
