@extends('layout')
@yield('title', 'Courses')
@section('content')
<div class="sidenav">
    <a href="{{ route('teacher.profile') }}">Profile</a>
    <a href="#">Courses</a>
    <a href="{{ route('logout') }}">Logout</a>
    
</div>

<div class="container" style="margin-left: 250px; padding: 20px;">
    <div id="courses">
        <h2>Your Courses</h2>

        @if(count($courses) > 0)
        <ul>
        @foreach($courses as $course)
            <li><a class="link-lists" href="{{ route('courses.display', ['course' => $course]) }}">{{ $course->course_name }}</a></li>
        @endforeach
        </ul>
        @else
        <p>You haven't created any courses yet.</p>
        @endif

        <button class="btn" onclick="toggleForm()">Create New Course</button>
    </div>

    <form id="createCourse" method='POST' style="display: none;">
        @csrf
        <input type="name" placeholder="Course Name" name="name">
        <button type="submit" class="btn" onclick="setAction('createCourse')">Create course</button>
        <button type="button" class="btn" onclick="setAction('back')">Back</button>
    </form>
</div>

<script>
    function toggleForm() {
        document.getElementById('courses').style.display = 'none';
        document.getElementById('createCourse').style.display = 'block';
    }
   
    function setAction(action) {
        const form = document.getElementById('createCourse');
        if (action === 'createCourse') {
            form.action = "{{ route('courses.create') }}";
        } else if (action === 'back') {
            form.action = "{{ route('teacher.courses.post') }}";
        }
        form.submit();
    }
</script>

@endsection