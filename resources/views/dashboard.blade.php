<div>
    <h1>
        Dashboard
    </h1>
</div>
<div>
    

@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Dashboard</h1>
        
        <h2>Assessment Deadlines</h2>
        
        <ul>
            @foreach($courses as $course)
                <li>{{ $course->name }}:
                    @foreach($course->assessments as $assessment)
                        {{ $assessment->deadline->format('Y-m-d') }}<br>
                    @endforeach
                </li>
            @endforeach
        </ul>
    </div>
@endsection

</div>