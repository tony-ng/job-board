<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class MyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('my_job.index', [
            'jobs' => auth()->user()->employer->jobs()
                ->with(['employer', 'jobApplications.user'])
                ->withTrashed()
                ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('my_job.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        auth()->user()->employer->jobs()->create(
            $request->validated()
        );
        
        return redirect()->route('my-jobs.index')
            ->with('success', 'Job Post created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $myJob)
    {
        Gate::authorize('update', $myJob);
        
        return view('my_job.edit', ['job' => $myJob]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, Job $myJob)
    {
        Gate::authorize('update', $myJob);
        
        $myJob->update($request->validated());

        return redirect()->route('my-jobs.index')
            ->with('success', 'Job updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $myJob)
    {
        Gate::authorize('delete', $myJob);

        $myJob->delete();

        return redirect()->route('my-jobs.index')
            ->with('success', 'Job post deleted successfully');
    }

    public function downloadCV(JobApplication $application)
    {   
        if (!$application){
            return redirect()->route('my-jobs.index')
                ->with('error', 'No job application is found');
        }

        if (!$application->cv_path){
            return redirect()->route('my-jobs.index')
                ->with('error', 'This job application does not have a CV');
        }

        if ($application->job->employer->id !== auth()->user()->employer->id){
            return redirect()->route('my-jobs.index')
                ->with('error', 'You do not have permission to download this CV.');
        }

        if (!Storage::disk('local')->exists($application->cv_path)){
            return redirect()->route('my-jobs.index')
                ->with('error', 'This CV file does not exist');
        }

        return Storage::download($application->cv_path, 'cv.pdf');
    }
}
