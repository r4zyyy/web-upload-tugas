<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'meeting_id',
        'student_name',
        'student_nim',
        'notes',
        'file_path',
        'original_filename',
        'file_size',
        'mime_type',
        'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'file_size' => 'integer',
    ];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    public function getFormattedFileSizeAttribute(): string
    {
        $bytes = $this->file_size;
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }
        return $bytes . ' Bytes';
    }
}
