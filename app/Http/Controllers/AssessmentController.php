<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Http\Requests\StoreAssessmentRequest;
use App\Http\Requests\UpdateAssessmentRequest;


class AssessmentController extends Controller
{

    public function index(Course $course)
    {
        $assessments = $course->assessments;
        return view('assessments.index', compact('assessments'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Pass necessary data for form population (e.g., course)
        return view('assessments.create', compact('course')); // Replace 'course' with relevant model if needed
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAssessmentRequest $request, Course $course)
    {
        $this->validate($request, [
            'title' => 'required',
            'deadline' => 'required|date',
            'description' => 'nullable',
        ]);

        $assessment = Assessment::create([
            'title' => $request->title,
            'deadline' => $request->deadline,
            'description' => $request->description,
            'course_id' => $course->id,
        ]);



        return redirect()->route('assessments.index')->with('success', 'Assessment created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Assessment $assessment)
    {
        return view('assessments.show', compact('assessment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assessment $assessment)
    {
        return view('assessments.edit', compact('assessment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssessmentRequest $request, Assessment $assessment)
    {
        $this->validate($request, [
            // Validation rules for updating
        ]);

        $assessment->update($request->all());

        return redirect()->route('assessments.index')->with('success', 'Assessment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assessment $assessment)
    {
        $assessment->delete();

        return redirect()->back()->with('success', 'Assessment deleted successfully!');
    }
}

