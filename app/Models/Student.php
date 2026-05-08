<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'full_name', 'email', 'phone', 'date_of_birth',
        'nationality', 'rank', 'seaman_book', 'company', 'vessel_type',
        'address', 'status',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }
}