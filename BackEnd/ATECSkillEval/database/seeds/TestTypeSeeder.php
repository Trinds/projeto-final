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
        
      DB::table('test_types')->insert([
        'type' => 'Tecnico',
        'created_at' => now(),
        'updated_at' => now()
      ]);

      DB::table('test_types')->insert([
        'type' => 'Psiquico',
        'created_at' => now(),
        'updated_at' => now()
      ]);

    }
}
