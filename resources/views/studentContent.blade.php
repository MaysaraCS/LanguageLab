@extends('layout')
@yield('title', 'Content page')
@section('content')
<div class="sidenav">
    <a href="{{ route('student.profile') }}">Profile</a>
    <a href="{{ route('student.courses') }}">Courses</a>
    <a href="{{ route('logout') }}">Logout</a>
    
</div>

<div class="container" style="margin-left: 250px; padding: 20px;">
   
<div class="navbar">
    <ul>
        <li><a class="list-links" href="{{ route('student.courses.display', ['course' => $course]) }}">Announcments</a></li>
        <li><a class="list-links" href="">Content</a></li>
        <li><a class="list-links" href="">Assessments</a></li>
    </ul>
</div>
<h1>Course Content</h1>

    @if(count($files) > 0)
        <ul>
            @foreach($files as $file)
                <li><a href="{{route('content.download', $file->file)}}">{{ $file->name }}</a></li>
            @endforeach
        </ul>
    @else
        <p>No content in this course.</p>
    @endif
</div>