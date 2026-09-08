<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = [
        'meeting_number',
        'title',
        'topic',
        'description',
        'due_date',
        'is_active',
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'is_active' => 'boolean',
        'meeting_number' => 'integer',
    ];

    public function submissions()
    {
        return $this->hasMany(Submission::class)->orderBy('submitted_at', 'desc');
    }

    public function latestSubmission()
    {
        return $this->hasOne(Submission::class)->latestOfMany('submitted_at');
    }
}
