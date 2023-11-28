<x-layout>
    @foreach($jobs as $job)
        <x-card class="mb-4">
            <div class="mb-4 flex justify-between">
                <h2 class="text-lg font-medium">{{$job->title}}</h2>
                <span class="text-slate-500">
                    ${{number_format($job->salary)}}
                </span>
            </div>
            <div class="mb-4 flex justify-between text-sm text-slate-500 items-center">
                <div>
                    <span class="mr-2">Company name</span>
                    <span class="font-medium">{{$job->location}}</span>
                </div>
                <div>
                    <x-tag class="mr-2">{{ucfirst($job->experience)}}</x-tag>
                    <x-tag>{{$job->category}}</x-tag>
                </div>
            </div>
            <p class="text-sm text-slate-500">
                {!! nl2br(e($job->description)) !!} {{-- e(mixed value) => the alt of echo --}}
            </p>
        </x-card>
    @endforeach
</x-layout>
