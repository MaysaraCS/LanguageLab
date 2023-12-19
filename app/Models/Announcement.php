<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $table = "announcements";

    protected $fillable = [
        'announcement',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }
}
