<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Instructor extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'full_name', 'email', 'phone',
        'specialization', 'qualifications', 'certificates_held',
        'years_experience', 'status',
    ];

    protected $casts = [
        'years_experience' => 'integer',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}