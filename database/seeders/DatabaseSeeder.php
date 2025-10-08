<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ClassRoom; 
use App\Models\Student; 
use App\Models\Teacher;
use App\Models\Subject;  

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // // User::factory(10)->create();
        // ClassRoom::factory(4)->create()->each(function ($classRoom) {
        //     Student::factory(4)->for($classRoom)->create();
        // });

        ClassRoom::factory(4)
            ->hasStudents(3)
            ->create();
        Subject::factory(5)->has(Teacher::factory(1))->create();
    }
}
