<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id', 'title', 'type', 'description', 'content',
        'duration_hours', 'order_number', 'is_mandatory',
    ];

    protected $casts = [
        'duration_hours' => 'float',
        'order_number'   => 'integer',
        'is_mandatory'   => 'boolean',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}