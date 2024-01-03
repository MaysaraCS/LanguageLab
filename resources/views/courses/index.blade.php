<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">


                <div class="p-6 text-gray-900">
                    @if (auth()->user()->type == 'teacher')
                        <a class="btn btn-primary" href="{{ route('courses.create') }}"> Create New Course</a>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>name</th>
                                @if (auth()->user()->type == 'student')
                                <th>Assessments</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if (auth()->user()->type == 'teacher')
                                @foreach ($courses as $course)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $course->name }}</td>
                                    </tr>
                                @endforeach
                            @endif

                            @if (auth()->user()->type == 'student')
                                @foreach ($courses as $course)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $course->course->name }}</td>
                                        <td>
                                        @foreach ($course->course->assessments as $index => $assessment)
                                        <a href="{{ route('assessments.show',$assessment->id) }}" class="underline" title="click to see assessment page">
                                            Assessment{{   $index +1 }}</a>
                                        @endforeach
                                    </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
