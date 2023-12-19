@extends('layout')
@yield('title', 'Course participants')
@section('content')
<div class="sidenav">
    <a href="{{ route('teacher.profile') }}">Profile</a>
    <a href="{{ route('teacher.courses') }}">Courses</a>
    <a href="{{ route('logout') }}">Logout</a>
    
</div>

<div class="container" style="margin-left: 250px; padding: 20px;">
    <div class="navbar">
        <ul>
            <li><a class="list-links" href="{{ route('courses.display', ['course' => $course]) }}">Announcments</a></li>
            <li><a class="list-links" href="{{ route('teacher.content', ['course' => $course]) }}">Content</a></li>
            <li><a class="list-links" href="">Assessments</a></li>
            <li><a class="list-links" href="{{ route('course.participants', ['course' => $course]) }}">Participants</a></li>
        </ul>
    </div>

    <div id="participants">
    <h2>Course Participants for {{ $course->course_name }}</h2>

    @if(count($participants) > 0)
        <ul>
            @foreach($participants as $enrollment)
                <li>{{ $enrollment->student->name }} - {{ $enrollment->student->email }}</li>
            @endforeach
        </ul>
    @else
        <p>No participants in this course.</p>
    @endif

    <button class="btn" onclick="toggleForm()">Add Participants</button>
    </div>

    <form id="addParticipant" method='POST' style="display: none;">
        @csrf
        <input type="number" placeholder="Participant ID" name="id">
        <button type="submit" class="btn" onclick="setAction('addParticipant')">Add Participant</button>
        <button type="button" class="btn" onclick="setAction('back')">Back</button>
    </form>

</div>

<script>
    function toggleForm() {
        document.getElementById('participants').style.display = 'none';
        document.getElementById('addParticipant').style.display = 'block';
    }
   
    function setAction(action) {
    const form = document.getElementById('addParticipant');
    const courseId = "{{ $course->id }}"; 

    if (action === 'addParticipant') {
        form.action = "{{ route('course.add.participants', ['course' => ':courseId']) }}".replace(':courseId', courseId);
    } else if (action === 'back') {
        form.action = "javascript:window.history.back()";
    }

    form.submit();
}

</script>


@endsection