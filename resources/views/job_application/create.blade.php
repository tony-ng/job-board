<x-layout>
     <x-breadcrumbs :links="['Jobs' => route('jobs.index'), $job->title => route('jobs.show', $job), 'Apply' => '#']" class="mb-4" />
    <x-job-card :$job />
    <x-card class="py-8 px-16">
        <h2 class="mb-4 text-lg font-medium">
            Your Job application
        </h2>
        <form action="{{ route('jobs.applications.store', $job) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-8">
                <x-label for="expected_salary" :required="true">Expected Salary</x-label>
                <x-text-input name="expected_salary" type="number" />
            </div>
            <div class="mb-8">
                <x-label for="cv" :required="true">Upload CV</x-label>
                <x-text-input name="cv" type="file" />
            </div>
            <x-button class="w-full bg-green-300 hover:bg-green-500">Apply</x-button>
        </form> 
    </x-card>
</x-layout>