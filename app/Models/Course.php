<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public $timestamps = false;
    
    use HasFactory;

    protected $table = "courses";

    protected $fillable = [
        'course_name',
        'teacher_id',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments', 'course_id', 'student_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'course_id', 'id');
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class, 'course_id', 'id');
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'course_id', 'id');
    }

}
