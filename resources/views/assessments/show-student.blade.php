<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Show Assessment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h1">{{ $assessment->title }}</h2>
                            <div class="flex justify-between">
                                <span>{{ $assessment->course->name }}</span>
                                <span>{{ $assessment->created_at->diffForHumans() }}</span>

                            </div>
                        </div>
                        <div class="card-body">
                            <p>
                                {{ $assessment->body }}
                            </p>

                        </div>
                        <div class="card-footer">

                            @if ($assessment->report)
                                <a href="/{{ $assessment->report }}" class="underline">download report</a>
                            @else
                                <span> report: pending</span>
                            @endif

                            
                        <form action="{{ route('submissions.store') }}" method="POST" class="mt-3">
                            @csrf
                            <input type="hidden" name="assessment_id" value="{{ $assessment->id }}">
                            <input type="hidden" name="student_id" value="{{ auth()->user()->id }}">

                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"
                                    name="answer"></textarea>
                                <label for="floatingTextarea2">Your Answer</label>
                            </div>
                            <input class="mt-2 mb-2 btn btn-primary" type="submit"
                            value="Send Answer" style="background-color: rgb(159, 159, 236)"/>
                        </form>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
