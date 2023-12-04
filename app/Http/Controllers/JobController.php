<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::query();
        $jobs->when(// search for job by any text
            request('search'),
            function($query) {
                $query->where(
                    fn($query) => $query->where('title','like','%' . request('search') . '%')
                        ->orWhere('description','like','%' . request('search') . '%')
                );
            }
        )->when( // filtering by min salary
            request('min_salary'),
            fn($query) =>
                $query->where('salary', '>=' , request('min_salary'))
        )->when( // filtering by max salary
            request('max_salary'),
            fn($query) =>
            $query->where('salary', '<=' , request('max_salary'))
        )->when(//filtering by experience
            request('experience'),
            fn($query) => $query->where('experience',request('experience'))
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
