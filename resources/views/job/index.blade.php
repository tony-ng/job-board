<x-layout>
    <x-breadcrumbs :links="['Jobs' => route('jobs.index')]" class="mb-4" />
    <x-card class="mb-4" x-data="">
        <form x-ref="filter" action="{{ route('jobs.index') }}" method="GET">
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <div class="mb-1 text-semibold">Search</div>
                    <x-text-input name="search" value="{{ request('search') }}" placeHolder="Search for any text" form-ref="filter" />
                </div>
                <div>
                    <div class="mb-1 text-semibold">Salary</div>
                    <div class="flex gap-2">
                        <x-text-input name="min_salary" value="{{ request('min_salary') }}" placeHolder="From" form-ref="filter" />
                        <x-text-input name="max_salary" value="{{ request('max_salary') }}" placeHolder="To" form-ref="filter" />
                    </div>
                </div>
                <x-radio-group name="experience" :options="array_combine(array_map('ucfirst', \App\Models\Job::$experience), \App\Models\Job::$experience)" :is-full="true"/>
                <x-radio-group name="category" :options="\App\Models\Job::$category" :is-full="true"/>
            </div>
            <x-button class="w-full">Search</x-button>
        </form>
    </x-card>
    @foreach ($jobs as $job)
        <x-job-card :$job>
            <x-link-button :href="route('jobs.show', $job)">
                Show
            </x-link-button>
        </x-job-card>
    @endforeach
</x-layout>