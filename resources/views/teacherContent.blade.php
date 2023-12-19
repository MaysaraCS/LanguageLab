@extends('layout')
@yield('title', 'Content page')
@section('content')
<div class="sidenav">
    <a href="{{ route('teacher.profile') }}">Profile</a>
    <a href="{{ route('teacher.courses') }}">Courses</a>
    <a href="{{ route('logout') }}">Logout</a>
    
</div>

<div class="container" style="margin-left: 250px; padding: 20px;">
    <div id="files">
<div class="navbar">
    <ul>
        <li><a class="list-links" href="{{ route('courses.display', ['course' => $course]) }}">Announcments</a></li>
        <li><a class="list-links" href="">Content</a></li>
        <li><a class="list-links" href="">Assessments</a></li>
        <li><a class="list-links" href="{{ route('course.participants', ['course' => $course]) }}">Participants</a></li>
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

    <button class="btn" onclick="toggleForm()">add content</button>
    </div>

    <form id="contentForm" method='POST' enctype="multipart/form-data" style="display: none;">
        @csrf
        <input type="text" placeholder="File name" name="name">
        <input type="file" name="file">
        <button type="submit" class="btn" onclick="setAction('addContent')">Add content</button>
        <button type="button" class="btn" onclick="setAction('back')">Back</button>
    </form>

</div>

<script>
    function toggleForm() {
        document.getElementById('files').style.display = 'none';
        document.getElementById('contentForm').style.display = 'block';
    }
   
    function setAction(action) {
    const form = document.getElementById('contentForm');
    const courseId = "{{ $course->id }}"; 

    if (action === 'addContent') {
        form.action = "{{ route('add.teacher.content', ['course' => ':courseId']) }}".replace(':courseId', courseId);
    } else if (action === 'back') {
        form.action = "javascript:window.history.back()";
    }

    form.submit();
}

</script>


@endsection