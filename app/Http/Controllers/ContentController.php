<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Course;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Storage;

class ContentController extends Controller
{
    public function display(Course $course){
        $files = Content::where('course_id', $course->id)->get();
        return view('teacherContent', compact('course', 'files'));
    }

    public function add(Request $request, Course $course){
        $data = new Content();
        $file = $request->file;
        $filename = $request->name. '.' . $file->getClientOriginalExtension();
        $request->file->move('assets', $filename);
        $data->file = $filename;
        $data->name = $request->name;
        $data->course_id = $course->id;
        $data->save();
        $files = Content::where('course_id', $course->id)->get();
        return view('teacherContent', ['files' => $files, 'course' => $course]);
    }

    public function download(Request $request, $file){
        return response()->download(public_path('assets/'.$file));
    }

    public function studentDisplay(Course $course){
        $files = Content::where('course_id', $course->id)->get();
        return view('studentContent', compact('course', 'files'));
    } 
}
