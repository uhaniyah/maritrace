<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Certificate;
use App\Models\Student;
use App\Models\Course;

class CertificateSeeder extends Seeder
{
    public function run()
    {
        $students = Student::all();
        $courses = Course::all();

        if ($students->isEmpty() || $courses->isEmpty()) return;

        $certs = [
            ['s' => 0, 'c' => 0, 'num' => 'STCW/BST/2024/0001', 'issued' => '2024-01-12', 'expiry' => '2029-01-12', 'auth' => 'Poltekpel Barombong', 'reg' => 'STCW Regulation VI/1', 'comp' => 'Basic Safety Training', 'grade' => 'Pass', 'status' => 'valid'],
            ['s' => 1, 'c' => 0, 'num' => 'STCW/BST/2024/0002', 'issued' => '2024-01-12', 'expiry' => '2029-01-12', 'auth' => 'Poltekpel Barombong', 'reg' => 'STCW Regulation VI/1', 'comp' => 'Basic Safety Training', 'grade' => 'Pass', 'status' => 'valid'],
            ['s' => 2, 'c' => 0, 'num' => 'STCW/BST/2024/0003', 'issued' => '2024-01-12', 'expiry' => '2029-01-12', 'auth' => 'Poltekpel Barombong', 'reg' => 'STCW Regulation VI/1', 'comp' => 'Basic Safety Training', 'grade' => 'Pass', 'status' => 'valid'],
            ['s' => 4, 'c' => 1, 'num' => 'STCW/SCRB/2024/0001', 'issued' => '2024-02-07', 'expiry' => '2029-02-07', 'auth' => 'Poltekpel Barombong', 'reg' => 'STCW Regulation VI/2', 'comp' => 'Survival Craft & Rescue Boats', 'grade' => 'Pass', 'status' => 'valid'],
            ['s' => 5, 'c' => 2, 'num' => 'STCW/AFF/2024/0001', 'issued' => '2024-02-15', 'expiry' => '2029-02-15', 'auth' => 'Poltekpel Barombong', 'reg' => 'STCW Regulation VI/3', 'comp' => 'Advanced Firefighting', 'grade' => 'Pass', 'status' => 'valid'],
            ['s' => 11, 'c' => 9, 'num' => 'STCW/TANKER/2024/0001', 'issued' => '2024-01-19', 'expiry' => '2029-01-19', 'auth' => 'Poltekpel Barombong', 'reg' => 'STCW Regulation V/1-1', 'comp' => 'Basic Training for Oil Tanker', 'grade' => 'Distinction', 'status' => 'valid'],
            ['s' => 12, 'c' => 10, 'num' => 'STCW/SSO/2024/0001', 'issued' => '2024-02-22', 'expiry' => '2029-02-22', 'auth' => 'Poltekpel Barombong', 'reg' => 'STCW Regulation VI/5', 'comp' => 'Ship Security Officer', 'grade' => 'Pass', 'status' => 'valid'],
            ['s' => 10, 'c' => 0, 'num' => 'STCW/BST/2019/0101', 'issued' => '2019-05-10', 'expiry' => '2024-05-10', 'auth' => 'Poltekpel Barombong', 'reg' => 'STCW Regulation VI/1', 'comp' => 'Basic Safety Training', 'grade' => 'Pass', 'status' => 'expired'],
            ['s' => 5, 'c' => 4, 'num' => 'STCW/BRM/2023/0005', 'issued' => '2023-11-20', 'expiry' => '2028-11-20', 'auth' => 'Poltekpel Barombong', 'reg' => 'STCW Regulation VIII/2', 'comp' => 'Bridge Resource Management', 'grade' => 'Pass', 'status' => 'valid'],
        ];

        foreach ($certs as $cert) {
            $student = $students->get($cert['s']);
            $course = $courses->get($cert['c']);
            if (!$student || !$course) continue;

            Certificate::create([
                'student_id'        => $student->id,
                'course_id'         => $course->id,
                'certificate_number'=> $cert['num'],
                'issued_date'       => $cert['issued'],
                'expiry_date'       => $cert['expiry'],
                'issuing_authority' => $cert['auth'],
                'stcw_regulation'   => $cert['reg'],
                'competency'        => $cert['comp'],
                'grade'             => $cert['grade'],
                'status'            => $cert['status'],
            ]);
        }
    }
}