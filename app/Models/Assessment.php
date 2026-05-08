<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'course_id', 'assessment_type', 'assessment_date',
        'score', 'max_score', 'passing_score', 'result',
        'assessor_name', 'remarks', 'attempt_number',
    ];

    protected $casts = [
        'assessment_date' => 'date',
        'score'           => 'float',
        'max_score'       => 'float',
        'passing_score'   => 'float',
        'attempt_number'  => 'integer',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function getPercentageAttribute()
    {
        return $this->max_score > 0 ? round(($this->score / $this->max_score) * 100, 1) : 0;
    }
}