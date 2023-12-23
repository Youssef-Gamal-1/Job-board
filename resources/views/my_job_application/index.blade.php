<x-layout>
    <x-breadcrumbs class="mb-4"
        :links="['My job applications' => '#']"
    />
    @forelse($applications as $application)
        <x-job-card :job="$application->job">
            <div>
                <x-link-button :href="route('jobs.show',$application->job)">
                    Show details
                </x-link-button>
            </div>
        </x-job-card>
    @empty
    @endforelse
</x-layout>
