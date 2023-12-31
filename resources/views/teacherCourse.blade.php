@extends('layout')
@yield('title', 'Course page')
@section('content')
<div class="sidenav">
    <a href="{{ route('teacher.profile') }}">Profile</a>
    <a href="{{ route('teacher.courses') }}">Courses</a>
    <a href="{{ route('logout') }}">Logout</a>

</div>

<div class="container" style="margin-left: 250px; padding: 20px;">
    <div id="announcements">
        <div class="navbar">
            <ul>
                <li><a class="list-links" href="">Announcments</a></li>
                <li><a class="list-links" href="{{ route('teacher.content', ['course' => $course]) }}">Content</a></li>
                <li><a class="list-links" href="">Assessments</a></li>
                <li><a class="list-links"
                        href="{{ route('course.participants', ['course' => $course]) }}">Participants</a></li>
            </ul>
        </div>


        <h1>Course Announcements</h1>

        @if(count($announcements) > 0)
        <ul>
            @foreach($announcements as $announcement)
            <li>
                Date: {{ optional($announcement->created_at)->format('Y-m-d H:i') }} </br>
                {{ $announcement->announcement }}
            </li>
            @endforeach
        </ul>
        @else
        <p>No announcements in this course.</p>
        @endif

        <button class="btn" onclick="toggleForm()">Create announcement</button>
    </div>

    <form id="announcementsForm" method='POST' style="display: none;">
        @csrf
        <input type="text" placeholder="Announcement" name="announcement">
        <button type="submit" class="btn" onclick="setAction('addAnnouncement')">Add announcement</button>
        <button type="button" class="btn" onclick="setAction('back')">Back</button>
    </form>

</div>

<script>
    function toggleForm() {
        document.getElementById('announcements').style.display = 'none';
        document.getElementById('announcementsForm').style.display = 'block';
    }

    function setAction(action) {
        const form = document.getElementById('announcementsForm');
        const courseId = "{{ $course->id }}";

        if (action === 'addAnnouncement') {
            form.action = "{{ route('course.add.announcements', ['course' => ':courseId']) }}".replace(':courseId', courseId);
        } else if (action === 'back') {
            form.action = "javascript:window.history.back()";
        }

        form.submit();
    }zzz

</script>


@endsection