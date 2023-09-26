<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $this->call(CourseSeeder::class);
        $this->call(ClassroomSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(EvaluationSeeder::class);
        $this->call(TestTypeSeeder::class);
        $this->call(TestSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
    }
}
