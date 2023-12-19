<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Course;
use App\Http\Requests;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function createAnnouncement(Request $request, Course $course){
        $request->validate([
            'announcement' => 'required|string',
        ]);

        $newAnnouncement = new Announcement([
            'announcement' => $request->input('announcement'),
        ]);
    
        $course->announcements()->save($newAnnouncement);
        $announcements = $course->announcements; 

        return view('teacherCourse', ['announcements' => $announcements, 'course' => $course]);

    }

    public function displayAnnouncements(Course $course){
        $announcements = $course->announcements()->with('course.teacher')->get();
        return view('teacherCourse', compact('announcements', 'course'));
    }

    public function displayStudentAnnouncements(Course $course){
        $announcements = $course->announcements;
        return view('studentCourse', compact('announcements', 'course'));
    }

    
}
