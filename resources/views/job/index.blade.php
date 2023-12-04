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
                        <x-text-input name="min_salary" placeholder="From" value=""/>
                        <x-text-input name="max_salary" placeholder="To" value=""/>
                    </div>
                </div>
                <div>3</div>
                <div>4</div>
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

