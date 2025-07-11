<x-card class="mb-4">
    <div class="flex justify-between mb-4">
        <div class="text-lg">
            {{ $job->title }}
            @if ($job->deleted_at)
                <span class="text-xs text-red-500">Deleted</span>
            @endif
        </div>
        <div>${{ number_format($job->salary) }}</div>
    </div>
    <div class="flex justify-between items-center mb-4 text-slate-500 text-sm">
        <div class="flex gap-4">
            <div>{{ $job->employer->company_name }}</div>
            <div>{{ $job->location }}</div>
        </div>
        <div class="flex gap-1 text-xs">
            <x-tag :href="route('jobs.index', ['experience' => $job->experience])">{{ Str::ucfirst($job->experience) }}</x-tag>
            <x-tag :href="route('jobs.index', ['category' => $job->category])">{{ $job->category }}</x-tag>
        </div>
    </div>
    {{ $slot }}
</x-card>