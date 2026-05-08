<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            InstructorSeeder::class,
            CourseSeeder::class,
            StudentSeeder::class,
            EnrollmentSeeder::class,
            CertificateSeeder::class,
        ]);
    }
}