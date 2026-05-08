<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;

class EnrollmentSeeder extends Seeder
{
    public function run()
    {
        $students = Student::all();
        $courses = Course::all();

        if ($students->isEmpty() || $courses->isEmpty()) return;

        $enrollments = [
            ['student_idx' => 0, 'course_idx' => 0, 'start_date' => '2024-01-08', 'end_date' => '2024-01-12', 'batch_number' => 'BST-2024-01', 'status' => 'completed', 'final_score' => 82, 'completion_date' => '2024-01-12'],
            ['student_idx' => 1, 'course_idx' => 0, 'start_date' => '2024-01-08', 'end_date' => '2024-01-12', 'batch_number' => 'BST-2024-01', 'status' => 'completed', 'final_score' => 88, 'completion_date' => '2024-01-12'],
            ['student_idx' => 2, 'course_idx' => 0, 'start_date' => '2024-01-08', 'end_date' => '2024-01-12', 'batch_number' => 'BST-2024-01', 'status' => 'completed', 'final_score' => 76, 'completion_date' => '2024-01-12'],
            ['student_idx' => 4, 'course_idx' => 1, 'start_date' => '2024-02-05', 'end_date' => '2024-02-07', 'batch_number' => 'SCRB-2024-01', 'status' => 'completed', 'final_score' => 80, 'completion_date' => '2024-02-07'],
            ['student_idx' => 5, 'course_idx' => 2, 'start_date' => '2024-02-12', 'end_date' => '2024-02-15', 'batch_number' => 'AFF-2024-01', 'status' => 'completed', 'final_score' => 85, 'completion_date' => '2024-02-15'],
            ['student_idx' => 7, 'course_idx' => 3, 'start_date' => '2024-03-04', 'end_date' => '2024-03-13', 'batch_number' => 'GMDSS-2024-01', 'status' => 'in_progress', 'final_score' => null, 'completion_date' => null],
            ['student_idx' => 5, 'course_idx' => 4, 'start_date' => '2024-03-11', 'end_date' => '2024-03-15', 'batch_number' => 'BRM-2024-01', 'status' => 'in_progress', 'final_score' => null, 'completion_date' => null],
            ['student_idx' => 8, 'course_idx' => 7, 'start_date' => '2024-03-18', 'end_date' => '2024-03-22', 'batch_number' => 'ERM-2024-01', 'status' => 'enrolled', 'final_score' => null, 'completion_date' => null],
            ['student_idx' => 6, 'course_idx' => 0, 'start_date' => '2024-04-01', 'end_date' => '2024-04-05', 'batch_number' => 'BST-2024-02', 'status' => 'enrolled', 'final_score' => null, 'completion_date' => null],
            ['student_idx' => 9, 'course_idx' => 6, 'start_date' => '2024-04-08', 'end_date' => '2024-04-12', 'batch_number' => 'MFA-2024-01', 'status' => 'enrolled', 'final_score' => null, 'completion_date' => null],
            ['student_idx' => 11, 'course_idx' => 9, 'start_date' => '2024-01-15', 'end_date' => '2024-01-19', 'batch_number' => 'TANKER-2024-01', 'status' => 'completed', 'final_score' => 90, 'completion_date' => '2024-01-19'],
            ['student_idx' => 12, 'course_idx' => 10, 'start_date' => '2024-02-19', 'end_date' => '2024-02-22', 'batch_number' => 'SSO-2024-01', 'status' => 'completed', 'final_score' => 78, 'completion_date' => '2024-02-22'],
            ['student_idx' => 3, 'course_idx' => 0, 'start_date' => '2024-04-15', 'end_date' => '2024-04-19', 'batch_number' => 'BST-2024-03', 'status' => 'enrolled', 'final_score' => null, 'completion_date' => null],
            ['student_idx' => 13, 'course_idx' => 0, 'start_date' => '2024-04-15', 'end_date' => '2024-04-19', 'batch_number' => 'BST-2024-03', 'status' => 'enrolled', 'final_score' => null, 'completion_date' => null],
            ['student_idx' => 14, 'course_idx' => 5, 'start_date' => '2024-04-22', 'end_date' => '2024-04-26', 'batch_number' => 'ECDIS-2024-01', 'status' => 'enrolled', 'final_score' => null, 'completion_date' => null],
        ];

        foreach ($enrollments as $e) {
            $student = $students->get($e['student_idx']);
            $course = $courses->get($e['course_idx']);
            if (!$student || !$course) continue;

            Enrollment::create([
                'student_id'      => $student->id,
                'course_id'       => $course->id,
                'start_date'      => $e['start_date'],
                'end_date'        => $e['end_date'],
                'batch_number'    => $e['batch_number'],
                'status'          => $e['status'],
                'final_score'     => $e['final_score'],
                'completion_date' => $e['completion_date'],
            ]);
        }
    }
}