<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_code', 'title', 'standard_type', 'imo_course_number',
        'category', 'level', 'duration_hours', 'duration_days',
        'description', 'objectives', 'prerequisites', 'instructor_id',
        'max_participants', 'passing_score', 'status', 'fee',
    ];

    protected $casts = [
        'duration_hours'   => 'integer',
        'duration_days'    => 'integer',
        'max_participants' => 'integer',
        'passing_score'    => 'integer',
        'fee'              => 'decimal:2',
    ];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class)->orderBy('order_number');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
}