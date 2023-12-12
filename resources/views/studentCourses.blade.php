@extends('layout')
@yield('title', 'Courses')
@section('content')
<div class="sidenav">
    <a href="{{ route('student.profile') }}">Profile</a>
    <a href="#">Courses</a>
    <a href="{{ route('logout') }}">Logout</a>
    
</div>

<div class="container" style="margin-left: 250px; padding: 20px;">
    <div id="courses">
        <h2>Your Courses</h2>

        @if(count($courses) > 0)
        <ul>
        @foreach($courses as $course)
            <li>{{ $course->course_name }}</li>
        @endforeach
        </ul>
        @else
        <p>You haven't enrolled in any courses yet.</p>
        @endif

    </div>
</div>
@endsection