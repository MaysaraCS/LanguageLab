<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $table = "assessments";

    protected $fillable = [
        'course_id',
        'teacher_id',
        'title',
        'description',
        'due_date',
        'max_score',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class, 'assessment_id', 'id');
    }

    
}
