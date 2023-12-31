<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Enrollment;
use App\Models\Teacher;
use App\Models\Assessment;
use App\Models\Submission;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\DB;


class CourseController extends Controller
{
   public function teacherCourses(){
    $courses = Course::where('teacher_id', auth()->user()->id)->get();
    return view('teacherCourses', compact('courses'));
   }

   public function teacherCoursesPost(){
    return redirect(route('teacher.courses'));
   }

   public function createCourses(Request $request){
    $request->validate([
        'name' => 'required'
    ]);

    $newCourse = Course::create([
        'course_name' => $request->input('name'),
        'teacher_id' => auth()->user()->id,
        'deadline'=> $request-> deadline,
    ]);

    $courses = Course::all();

    $courses = Course::where('teacher_id', auth()->user()->id)->get();
 
    return view('teacherCourses', ['success' => 'Course created successfully', 'courses' => $courses]);
    
   }

   public function displayParticipants(Course $course){
    $participants = $course->enrollments()->with('student')->get();
    return view('courseParticipants', compact('participants', 'course'));
   }

   public function addParticipant(Request $request, Course $course){ 
    $request->validate([
        'id' => 'required|exists:students,id',
    ]);

    $enrollment = Enrollment::where('student_id', $request->id)->where('course_id', $course->id)->first();

    if ($enrollment) {
        return redirect()->back()->with('error', 'Student is already enrolled in the course.');
    }

    try {
        Enrollment::create([
            'course_id' => $course->id,
            'student_id' => $request->id,
        ]);
    } catch (\Exception $e) {
        logger()->error('Error creating enrollment: ' . $e->getMessage());
    }

    return redirect()->back()->with('success', 'Student enrolled successfully.');
    }  

    public function displayStudentCourses()
    {
    $student = auth()->user(); 
    $enrollments = Enrollment::where('student_id', $student->id)->with('course')->get();
    $courses = $enrollments->pluck('course');
    return view('studentCourses', compact('courses'));
    }

}
