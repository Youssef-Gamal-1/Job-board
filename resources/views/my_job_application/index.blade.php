<x-layout>
    <x-breadcrumbs class="mb-4"
        :links="['My job applications' => '#']"
    />
    @forelse($applications as $application)
        <x-job-card :job="$application->job">
           <div class="flex items-center justify-between text-xs text-slate-500">
                <div>
                    <div>
                        Applied {{$application->created_at->diffForHumans()}}
                    </div>
                    <div>
                        Other {{Str::plural('applicant'),$application->job->job_applications_count - 1}} {{-- Not adding our own application --}}
                         {{$application->job->job_applications_count - 1}}
                    </div>
                    <div>
                        Your asking salary is ${{number_format($application->expected_salary)}}
                    </div>
                    <div>
                        Average asking salary is ${{number_format($application->job->job_applications_avg_expected_salary)}}
                    </div>
                </div>
               <div>
                   right
               </div>
           </div>
        </x-job-card>
    @empty
    @endforelse
</x-layout>
