<x-layout>
    <x-bread-crumbs
        class="mb-4"
        :links="['Jobs' => route('jobs.index')]"
    />
    <x-card class="mb-4 text-sm">
        <form action="{{route('jobs.index')}}" method="GET">
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <div class="mb-1 font-semibold">Search</div>
                    <x-text-input name="search" placeholder="Search for any text" value="{{request('search')}}"/>
                </div>
                <div>
                    <div class="mb-1 font-semibold">Salary</div>
                    <div class="flex space-x-2">
                        <x-text-input name="min_salary" placeholder="From" value="{{request('min_salary')}}"/>
                        <x-text-input name="max_salary" placeholder="To" value="{{request('max_salary')}}"/>
                    </div>
                </div>
                <div>
                    <div class="mb-1 font-semibold">Experience</div>
                    <x-radio-group name="experience" :options="array_combine(array_map('ucfirst',App\Models\Job::$experience),
                                                                             App\Models\Job::$experience
                                                                            )"
                    />
                </div>
                <div>
                    <div class="mb-1 font-semibold">Category</div>
                    <x-radio-group name="category"
                                   :options="array_combine(array_map('ucfirst',\App\Models\Job::$categories),
                                                           \App\Models\Job::$categories
                                                          )"
                    />
                </div>
            </div>
            <button class="w-full">Filter</button>
        </form>
    </x-card>
    @foreach($jobs as $job)
        <x-job-card class="mb-4" :$job> <!-- :$job => :job="$job" -->
            <div>
                <x-link-button :href="route('jobs.show',$job)">
                    Show details
                </x-link-button>
            </div>
        </x-job-card>
    @endforeach
</x-layout>

