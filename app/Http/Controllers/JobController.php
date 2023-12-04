<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::query();
        $jobs->when(request('search'),
            fn($query) =>
                $query->where('title','like','%' . request('search') . '%')
                ->orWhere('description','like','%' . request('search') . '%')
        );
        return view('job.index',['jobs' => $jobs->get()]);
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
        return view('job.show',['job' => $job]);
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
