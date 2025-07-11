<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $filter = request()->only([
            'search',
            'min_salary',
            'max_salary',
            'experience',
            'category'
        ]);
        
        return view('job.index', ['jobs' => Job::with('employer')->filter($filter)->latest()->get()]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        return view('job.show', ['job' => $job->load('employer.jobs')]);
    }
}
