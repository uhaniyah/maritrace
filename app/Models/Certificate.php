<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'course_id', 'certificate_number', 'issued_date',
        'expiry_date', 'issuing_authority', 'stcw_regulation',
        'competency', 'grade', 'status', 'notes', 'file_path',
    ];

    protected $casts = [
        'issued_date' => 'date',
        'expiry_date' => 'date',
    ];

    /**
     * Get the student that owns the certificate.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the course associated with the certificate.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the number of days until the certificate expires.
     */
    public function getDaysUntilExpiryAttribute(): int
    {
        return (int) now()->diffInDays($this->expiry_date, false);
    }

    /**
     * Get the absolute URL to the certificate file.
     */
    public function getFileUrlAttribute(): ?string
    {
        return $this->file_path ? Storage::url($this->file_path) : null;
    }
}
