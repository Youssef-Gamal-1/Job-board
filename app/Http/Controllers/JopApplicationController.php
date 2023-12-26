<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JopApplicationController extends Controller
{

    public function create(Job $job)
    {
        $this->authorize('apply',$job);
        return view('job_application.create',['job' => $job]);
    }
    public function store(Job $job, Request $request)
    {
        $validatedData = $request->validate([
            'expected_salary' => 'required|min:1|max:100000',
            'cv' => 'required|file|mimes:pdf,docx|max:2048'
        ]);

        $file = $request->file('cv');
        $path = $file->store('cvs','private');

        $job->jobApplications()->create([
            'user_id' => $request->user()->id,
            'expected_salary' => $validatedData['expected_salary'],
            'cv_path' => $path
        ]);

        return redirect()->route('jobs.show',$job)
            ->with('success','Job application submitted.');
    }

    public function destroy(string $id)
    {

    }
}
