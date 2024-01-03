<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'answer' => 'required',
        ]);
     
        // Create a new Assessment instance using the fillable attributes
        $submission = Submission::create([
            'answer' => $request->input('answer'),
            'student_id' => $request->input('student_id'),
            'assessment_id' => $request->input('assessment_id'),
        ]);

        return redirect()->route('courses.index')->with('success', 'Submission Sent successfully.');
    }

}
