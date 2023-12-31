@extends('layout')
@yield('title', 'Assessments')
@section('content')
<div class="sidenav">
    </div>

<div class="container" style="margin-left: 250px; padding: 20px;">
    <div id="assessments">
        <div class="navbar">
            <ul>
                </ul>
        </div>

        <h1>Course Assessments</h1>

        @if(count($assessments) > 0)
            <ul>
                @foreach($assessments as $assessment)
                    <li>
                        Title: {{ $assessment->title }} </br>
                        Deadline: {{ $assessment->deadline->format('Y-m-d H:i') }} </br>
                        Description: {{ $assessment->description }}
                    </li>
                @endforeach
            </ul>
        @else
            <p>No assessments in this course yet.</p>
        @endif

        <button class="btn" onclick="toggleForm()">Create assessment</button>
    </div>

    <form id="assessmentsForm" method='POST' style="display: none;">
        @csrf
        <input type="text" placeholder="Assessment title" name="title">
        <input type="datetime-local" placeholder="Deadline" name="deadline">
        <textarea placeholder="Description" name="description"></textarea>
        <button type="submit" class="btn" onclick="setAction('addAssessment')">Add assessment</button>
        <button type="button" class="btn" onclick="setAction('back')">Back</button>
    </form>
</div>

<script>
    function toggleForm() {
        document.getElementById('assessments').style.display = 'none';
        document.getElementById('assessmentForm').style.display = 'block';
    }

    function setAction(action) {
        const form = document.getElementById('assessmentForm');
        const courseId = "{{ $course->id }}";

        if (action === 'addAssessment') {
            form.action = "{{ route('course.add.assessment', ['course' => ':courseId']) }}".replace(':courseId', courseId);
        } else if (action === 'back') {
            form.action = "javascript:window.history.back()";
        }

        form.submit();

    }
</script>
@endsection
