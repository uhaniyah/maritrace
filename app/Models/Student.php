<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'full_name', 'email', 'phone', 'date_of_birth',
        'nationality', 'rank', 'seaman_book', 'seaman_book_path', 'company',
        'vessel_type', 'address', 'status',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /**
     * Get the enrollments for the student.
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Get the certificates for the student.
     */
    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    /**
     * Get the assessments for the student.
     */
    public function assessments(): HasMany
    {
        return $this->hasMany(Assessment::class);
    }

    /**
     * Get the absolute URL to the seaman book document.
     */
    public function getSeamanBookUrlAttribute(): ?string
    {
        return $this->seaman_book_path ? Storage::url($this->seaman_book_path) : null;
    }
}
