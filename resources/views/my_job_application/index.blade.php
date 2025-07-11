<x-layout>
     <x-breadcrumbs :links="['My Job Applications' => '#']" class="mb-4" />
     @forelse ($applications as $application)
          <x-job-card :job="$application->job">
               <div class="flex items-center justify-between text-xs text-slate-500">
                    <div>
                         <div>
                              Applied {{ $application->created_at->diffForHumans() }}
                         </div>
                         <div>
                              Other {{ Str::plural('applicant', $application->job->job_applications_count - 1) }}: {{ $application->job->job_applications_count - 1 }}
                         </div>
                         <div>
                              Your asking salary: $ {{ number_format($application->expected_salary) }}
                         </div>
                         <div>
                              Average asking salary: $ {{ number_format($application->job->job_applications_avg_expected_salary) }}
                         </div>
                    </div>
                    <div>
                         <form action="{{ route('my-job-applications.destroy', $application) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <x-button>Cancel</x-button>
                         </form>
                    </div>
               </div>
          </x-job-card>
     @empty
          <div class="rounded-md border border-slate-300 text-center p-8">
               <div class="font-medium">
                    No job application yet
               </div>
               <div>
                    Go find some job <a href="{{ route('jobs.index') }}" class="text-indigo-500 hover:underline">here!</a>
               </div>
          </div>
     @endforelse
</x-layout>