<x-layout>
    <x-breadcrumbs
        class="mb-4"
        :links="['Jobs' => route('jobs.index'),$job->title => '']"
    >
    </x-breadcrumbs>
    <x-job-card :$job>
        <p class="text-sm text-slate-500 mb-4">
            {!! nl2br(e($job->description)) !!} {{-- e(mixed value) => the alt of echo --}}
        </p>
     @if(auth()->user())
            @can('apply',$job)
                <x-link-button :href="route('job.application.create',$job)">
                    Apply
                </x-link-button>
            @else
                <div class="text-slate-500 text-center text-sm font-medium">
                    You already applied to this job
                </div>
            @endcan
        @else
            <form action="{{view('auth.create')}}" method="GET">
{{--                    <x-text-input type="hidden" name="job" value="{{$job}}"/>--}}
                    <x-button>Login to apply</x-button>
            </form>
        @endif

    </x-job-card>
    <x-card class="mb-4">
        <h2 class="mb-4 text-lg font-medium">More {{$job->employer->company_name}} Jobs</h2>
        <div class="text-sm text-slate-500">
            @foreach($job->employer->jobs as $otherJob)
                <div class="flex justify-between mb-4">
                    <div>
                        <div class="text-slate-700 font-medium">
                            <a href="{{route('jobs.show',$otherJob)}}">{{$otherJob->title}}</a>
                        </div>
                        <div class="text-xs">
                            {{$otherJob->created_at->diffForHumans()}}
                        </div>
                    </div>
                    <div class="text-xs">
                        ${{number_format($otherJob->salary)}}
                    </div>
                </div>
            @endforeach
        </div>
    </x-card>
</x-layout>
