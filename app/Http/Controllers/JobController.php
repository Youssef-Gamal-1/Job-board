<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $filters = request()->only('search','min_salary','max_salary','experience','category');
        // scope function in the model scopeFilter()
        return view('job.index',['jobs' => Job::with('employer')->filter($filters)->get()]);
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function show(Job $job)
    {
        return view('job.show',['job' => $job->load('employer.jobs')]);
    }

    public function edit(string $id)
    {
        //
    }
    public function update(Request $request, string $id)
    {
        //
    }
    public function destroy(string $id)
    {
        //
    }
}
