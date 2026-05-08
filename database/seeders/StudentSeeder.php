<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $students = [
            ['student_id' => 'STD-2024-001', 'full_name' => 'Muhammad Aldi Pratama', 'email' => 'aldi.pratama@student.poltekpel-barombong.ac.id', 'phone' => '082100001001', 'date_of_birth' => '2000-03-15', 'nationality' => 'Indonesia', 'rank' => 'Taruna Tingkat III', 'seaman_book' => 'SB-2024001', 'company' => null, 'vessel_type' => null, 'address' => 'Jl. Pelabuhan No.1, Makassar', 'status' => 'active'],
            ['student_id' => 'STD-2024-002', 'full_name' => 'Siti Rahma Aulia', 'email' => 'siti.rahma@student.poltekpel-barombong.ac.id', 'phone' => '082100001002', 'date_of_birth' => '1999-07-22', 'nationality' => 'Indonesia', 'rank' => 'Taruna Tingkat IV', 'seaman_book' => 'SB-2024002', 'company' => null, 'vessel_type' => null, 'address' => 'Jl. Bougenville No.5, Makassar', 'status' => 'active'],
            ['student_id' => 'STD-2024-003', 'full_name' => 'Rudi Hermawan', 'email' => 'rudi.hermawan@student.poltekpel-barombong.ac.id', 'phone' => '082100001003', 'date_of_birth' => '1998-11-08', 'nationality' => 'Indonesia', 'rank' => 'Taruna Tingkat IV', 'seaman_book' => 'SB-2024003', 'company' => null, 'vessel_type' => null, 'address' => 'Jl. Kartini No.12, Makassar', 'status' => 'active'],
            ['student_id' => 'STD-2024-004', 'full_name' => 'Dewi Kusuma Wardani', 'email' => 'dewi.kusuma@student.poltekpel-barombong.ac.id', 'phone' => '082100001004', 'date_of_birth' => '2001-01-30', 'nationality' => 'Indonesia', 'rank' => 'Taruna Tingkat II', 'seaman_book' => null, 'company' => null, 'vessel_type' => null, 'address' => 'Jl. Veteran No.8, Makassar', 'status' => 'active'],
            ['student_id' => 'STD-2023-005', 'full_name' => 'Bagas Nugroho', 'email' => 'bagas.nugroho@student.poltekpel-barombong.ac.id', 'phone' => '082100001005', 'date_of_birth' => '1997-06-14', 'nationality' => 'Indonesia', 'rank' => 'AB (Able Seaman)', 'seaman_book' => 'SB-2023005', 'company' => 'PT Pelayaran Nasional Indonesia', 'vessel_type' => 'Bulk Carrier', 'address' => 'Jl. Diponegoro No.3, Makassar', 'status' => 'active'],
            ['student_id' => 'STD-2023-006', 'full_name' => 'Hendri Saputra', 'email' => 'hendri.saputra@student.poltekpel-barombong.ac.id', 'phone' => '082100001006', 'date_of_birth' => '1996-09-25', 'nationality' => 'Indonesia', 'rank' => 'Mualim III', 'seaman_book' => 'SB-2023006', 'company' => 'PT Meratus Line', 'vessel_type' => 'Container Ship', 'address' => 'Jl. Sudirman No.15, Makassar', 'status' => 'active'],
            ['student_id' => 'STD-2023-007', 'full_name' => 'Fitriani Rahayu', 'email' => 'fitriani.rahayu@student.poltekpel-barombong.ac.id', 'phone' => '082100001007', 'date_of_birth' => '1999-04-18', 'nationality' => 'Indonesia', 'rank' => 'Taruna Tingkat III', 'seaman_book' => 'SB-2023007', 'company' => null, 'vessel_type' => null, 'address' => 'Jl. Cendrawasih No.9, Makassar', 'status' => 'active'],
            ['student_id' => 'STD-2023-008', 'full_name' => 'Arif Rahman Hakim', 'email' => 'arif.hakim@student.poltekpel-barombong.ac.id', 'phone' => '082100001008', 'date_of_birth' => '1995-12-02', 'nationality' => 'Indonesia', 'rank' => 'Mualim II', 'seaman_book' => 'SB-2023008', 'company' => 'PT EMAS (Equator Maritime)', 'vessel_type' => 'Oil Tanker', 'address' => 'Jl. AP Pettarani No.22, Makassar', 'status' => 'active'],
            ['student_id' => 'STD-2023-009', 'full_name' => 'Yusril Ihza Mahendra', 'email' => 'yusril.mahendra@student.poltekpel-barombong.ac.id', 'phone' => '082100001009', 'date_of_birth' => '1994-08-10', 'nationality' => 'Indonesia', 'rank' => 'Masinis III', 'seaman_book' => 'SB-2023009', 'company' => 'PT Samudera Indonesia', 'vessel_type' => 'General Cargo', 'address' => 'Jl. Urip Sumoharjo No.44, Makassar', 'status' => 'active'],
            ['student_id' => 'STD-2023-010', 'full_name' => 'Nur Azizah Putri', 'email' => 'nurazizah@student.poltekpel-barombong.ac.id', 'phone' => '082100001010', 'date_of_birth' => '2000-05-20', 'nationality' => 'Indonesia', 'rank' => 'Taruna Tingkat II', 'seaman_book' => null, 'company' => null, 'vessel_type' => null, 'address' => 'Jl. Perintis Kemerdekaan No.7, Makassar', 'status' => 'active'],
            ['student_id' => 'STD-2022-011', 'full_name' => 'Dodi Firmansyah', 'email' => 'dodi.firmansyah@student.poltekpel-barombong.ac.id', 'phone' => '082100001011', 'date_of_birth' => '1993-03-05', 'nationality' => 'Indonesia', 'rank' => 'Nakhoda', 'seaman_book' => 'SB-2022011', 'company' => 'PT Pelindo Regional 4', 'vessel_type' => 'Tugboat', 'address' => 'Jl. Haji Bau No.11, Makassar', 'status' => 'graduated'],
            ['student_id' => 'STD-2022-012', 'full_name' => 'Rizki Fadhilah', 'email' => 'rizki.fadhilah@student.poltekpel-barombong.ac.id', 'phone' => '082100001012', 'date_of_birth' => '1998-02-14', 'nationality' => 'Indonesia', 'rank' => 'Mualim I', 'seaman_book' => 'SB-2022012', 'company' => 'PT Berlian Laju Tanker', 'vessel_type' => 'Chemical Tanker', 'address' => 'Jl. Raya Barombong No.5, Makassar', 'status' => 'active'],
            ['student_id' => 'STD-2022-013', 'full_name' => 'Kevin Andersen', 'email' => 'kevin.andersen@student.poltekpel-barombong.ac.id', 'phone' => '082100001013', 'date_of_birth' => '1990-10-30', 'nationality' => 'Filipina', 'rank' => 'Chief Officer', 'seaman_book' => 'SB-2022013', 'company' => 'Stolt Tankers BV', 'vessel_type' => 'Chemical Tanker', 'address' => 'Jl. Hose No.3, Makassar', 'status' => 'active'],
            ['student_id' => 'STD-2024-014', 'full_name' => 'Aditya Putra Rahardja', 'email' => 'aditya.rahardja@student.poltekpel-barombong.ac.id', 'phone' => '082100001014', 'date_of_birth' => '2001-06-11', 'nationality' => 'Indonesia', 'rank' => 'Taruna Tingkat I', 'seaman_book' => null, 'company' => null, 'vessel_type' => null, 'address' => 'Jl. Racing Centre No.2, Makassar', 'status' => 'active'],
            ['student_id' => 'STD-2024-015', 'full_name' => 'Putri Amalia Hidayat', 'email' => 'putri.amalia@student.poltekpel-barombong.ac.id', 'phone' => '082100001015', 'date_of_birth' => '2002-09-19', 'nationality' => 'Indonesia', 'rank' => 'Taruna Tingkat I', 'seaman_book' => null, 'company' => null, 'vessel_type' => null, 'address' => 'Jl. Tamalate No.10, Makassar', 'status' => 'active'],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}