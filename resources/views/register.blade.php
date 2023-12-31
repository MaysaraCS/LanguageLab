@extends('layout')
@section('title', 'Register')
@section('content')
<div class="login-signup-form animated fadeInDown">
    <div class="mt-5">
        @if ($errors->any())
            <div class="col-12">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if(session()->has('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
        @endif
    </div>
    <div class="form">
        <form id="registrationForm" method="POST">
            @csrf
            <h1 class="title">Create an account</h1>
            <input type="text" placeholder="Name" name="name">
            <input type="email" placeholder="Email" name="email">
            <input type="password" placeholder="Password" name="password">

            <div>
                <label class="radio-label" for="student">Student</label>
                <input type="radio" id="student" name="user_type" value="student">
            </div>

            <div>
                <label>Teacher</label>
                <input type="radio" id="teacher" name="user_type" value="teacher">
            </div>

            <button type="submit" class="btn btn-block">Register</button>
            <p class="message">Have an account? <a href="{{ route('login') }}">Login now</a></p>
        </form>
    </div>
</div>

<script>
    const form = document.getElementById('registrationForm');
    const studentRadio = document.getElementById('student');
    const teacherRadio = document.getElementById('teacher');

    studentRadio.addEventListener('change', function () {
        form.action = "{{ route('register.student') }}";
        form.submit();
    });

    teacherRadio.addEventListener('change', function () {
        form.action = "{{ route('register.teacher') }}";
        form.submit();
    });
</script>
@endsection;zz