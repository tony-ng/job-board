<x-layout>
    <x-breadcrumbs :links="['Jobs' => route('jobs.index'), $job->title => '#']" class="mb-4" />
    <x-job-card :$job>
        <p class="text-sm text-slate-500 mb-4">{!! nl2br(e($job->description)) !!}</p>
        @auth
            @can('apply', $job)
                <x-link-button :href="route('jobs.applications.create', $job)">
                    Apply
                </x-link-button>
            @else
                <div class="text-center text-sm font-medium text-slate-500">
                    You have applied this job
                </div>
            @endcan
        @else
            <x-link-button :href="route('jobs.applications.create', $job)">
                Apply
            </x-link-button>
        @endauth
    </x-job-card>
    @if (count($job->employer->jobs) > 1)
        <x-card class="mb-4">
            <h2 class="mb-4 text-xl font-medium">
                {{ $job->employer->company_name }} Jobs
            </h2>
            @foreach ($job->employer->jobs as $otherJob)
                @if ($otherJob->id != $job->id)
                    <div class="mb-2 flex justify-between">
                        <div>
                            <div class="text-lg text-slate-500">
                                <a href="{{ route('jobs.show', $otherJob) }}">
                                    {{ $otherJob->title }}
                                </a>
                            </div>
                            <div class="text-sm text-slate-400">
                                {{ $otherJob->created_at->diffForHumans() }}
                            </div>
                        </div>
                        <div class="text-base text-slate-500">
                            ${{ number_format($otherJob->salary) }}
                        </div>
                    </div>
                @endif
            @endforeach
        </x-card>
    @endif
</x-layout>