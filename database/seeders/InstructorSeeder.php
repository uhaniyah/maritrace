<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Instructor;

class InstructorSeeder extends Seeder
{
    public function run()
    {
        $instructors = [
            ['employee_id' => 'INS-001', 'full_name' => 'Capt. Budi Santoso', 'email' => 'budi.santoso@poltekpel-barombong.ac.id', 'phone' => '081234567890', 'specialization' => 'Navigation & Watchkeeping', 'qualifications' => 'Master Mariner Class 1, STCW Certificate', 'certificates_held' => 'STCW Basic Safety, Advanced Firefighting, GMDSS GOC', 'years_experience' => 20, 'status' => 'active'],
            ['employee_id' => 'INS-002', 'full_name' => 'Ch. Eng. Ahmad Rizal', 'email' => 'ahmad.rizal@poltekpel-barombong.ac.id', 'phone' => '081234567891', 'specialization' => 'Marine Engineering', 'qualifications' => 'Chief Engineer Class 1, MEO Class 1', 'certificates_held' => 'STCW Basic Safety, High Voltage, Electro-Technical Officer', 'years_experience' => 18, 'status' => 'active'],
            ['employee_id' => 'INS-003', 'full_name' => 'Capt. Sri Wahyuni', 'email' => 'sri.wahyuni@poltekpel-barombong.ac.id', 'phone' => '081234567892', 'specialization' => 'Safety & Survival Techniques', 'qualifications' => 'Master Mariner, IMO Model Course 1.19', 'certificates_held' => 'Advanced Firefighting, PSCRB, Medical First Aid', 'years_experience' => 15, 'status' => 'active'],
            ['employee_id' => 'INS-004', 'full_name' => 'Dr. Hendra Wijaya', 'email' => 'hendra.wijaya@poltekpel-barombong.ac.id', 'phone' => '081234567893', 'specialization' => 'GMDSS & Radio Communications', 'qualifications' => 'PhD Maritime Communication, GOC Certificate', 'certificates_held' => 'GMDSS GOC, GMDSS ROC, SAR', 'years_experience' => 12, 'status' => 'active'],
            ['employee_id' => 'INS-005', 'full_name' => 'Capt. Dewi Lestari', 'email' => 'dewi.lestari@poltekpel-barombong.ac.id', 'phone' => '081234567894', 'specialization' => 'Bridge Resource Management', 'qualifications' => 'Master Mariner, BRM Instructor', 'certificates_held' => 'BRM, ECDIS, ARPA Radar', 'years_experience' => 14, 'status' => 'active'],
            ['employee_id' => 'INS-006', 'full_name' => 'Ir. Fajar Nugroho', 'email' => 'fajar.nugroho@poltekpel-barombong.ac.id', 'phone' => '081234567895', 'specialization' => 'Cargo Handling & Stability', 'qualifications' => 'Chief Officer, Cargo Inspector Certificate', 'certificates_held' => 'Dangerous Goods, Cargo Securing, Tanker Safety', 'years_experience' => 16, 'status' => 'active'],
            ['employee_id' => 'INS-007', 'full_name' => 'Dr. Rina Marlina', 'email' => 'rina.marlina@poltekpel-barombong.ac.id', 'phone' => '081234567896', 'specialization' => 'Maritime Law & ISM Code', 'qualifications' => 'PhD Maritime Law, ISM Auditor', 'certificates_held' => 'ISM Code, ISPS Code, MLC 2006', 'years_experience' => 10, 'status' => 'active'],
            ['employee_id' => 'INS-008', 'full_name' => 'Ch. Eng. Surya Pratama', 'email' => 'surya.pratama@poltekpel-barombong.ac.id', 'phone' => '081234567897', 'specialization' => 'Engine Room Resource Management', 'qualifications' => 'Chief Engineer, ERM Instructor', 'certificates_held' => 'ERM, EOOW, Engine Watchkeeping', 'years_experience' => 13, 'status' => 'active'],
        ];

        foreach ($instructors as $instructor) {
            Instructor::create($instructor);
        }
    }
}