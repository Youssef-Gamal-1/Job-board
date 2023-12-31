<x-card class="mb-4">
    <div class="mb-4 flex justify-between align-items-center">
        <h2 class="text-lg font-medium">{{$job->title}}</h2>
        <span class="text-slate-500">
            ${{number_format($job->salary)}}
        </span>
    </div>
    <div class="mb-4 flex justify-between text-sm text-slate-500 items-center">
        <div>
            <span class="mr-2 font-medium">{{$job->employer->company_name}}</span>
            <span class="mr-2 font-medium">{{$job->location}}</span>
            @if($job->deleted_at)
                <span class="text-xs text-red-500">Deleted</span>
            @endif
        </div>
        <div>
            <x-tag class="mr-2">
                <a href="{{route('jobs.index',['experience' => $job->experience])}}">
                    {{ucfirst($job->experience)}}
                </a>
            </x-tag>
            <x-tag>
                <a href="{{route('jobs.index',['category' => $job->category])}}">
                    {{$job->category}}
                </a>
            </x-tag>
        </div>
    </div>
    {{$slot}}
</x-card>
