@extends('layout')
@yield('title', 'Course page')
@section('content')
<div class="sidenav">z
    <a href="{{ route('student.profile') }}">Profile</a>
    <a href="{{ route('student.courses') }}">Courses</a>
    <a href="{{ route('logout') }}">Logout</a>

</div>

<div class="container" style="margin-left: 250px; padding: 20px;">

    <div class="navbar">
        <ul>
            <li><a class="list-links" href="">Announcments</a></li>
            <li><a class="list-links" href="{{ route('student.content.display', ['course' => $course]) }}">Content</a>
            </li>
            <li><a class="list-links" href="">Assessments</a></li>
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

</div>