<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'course_id', 'certificate_number', 'issued_date',
        'expiry_date', 'issuing_authority', 'stcw_regulation',
        'competency', 'grade', 'status', 'notes',
    ];

    protected $casts = [
        'issued_date'  => 'date',
        'expiry_date'  => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function getDaysUntilExpiryAttribute()
    {
        return now()->diffInDays($this->expiry_date, false);
    }
}