@extends('layout')
@yield('title', 'Assessments')
@section('content')
<div class="sidenav">
    <a href="{{ route('teacher.profile') }}">Profile</a>
    <a href="{{ route('teacher.courses') }}">Courses</a>
    <a href="{{ route('logout') }}">Logout</a>
    
</div>

<div class="container" style="margin-left: 250px; padding: 20px;">

</div>


@endsection