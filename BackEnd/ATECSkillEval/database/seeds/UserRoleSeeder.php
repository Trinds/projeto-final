<?php

use Illuminate\Database\Seeder;
use App\User_role;
class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User_role::class, 2)->create(); 
    }
}
