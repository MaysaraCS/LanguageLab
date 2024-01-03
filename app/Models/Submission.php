<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;
    protected $fillable=[
        'assessment_id',
        'student_id',
        'answer',
    ];

    public function student(){
        return $this->belongsTo(User::class,'student_id','id');
    }
}
