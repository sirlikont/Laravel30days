<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    public function index() {
        //dd('List of jobs here');
        $jobs = Job::with('employer')->latest()->simplePaginate(3);

        return view('jobs.index', [
            'jobs'=> $jobs
        ]);
    }

    public function create() {
        return view('jobs.create');

    }

    public function show(Job $job) {
        return view('jobs.show', ['job' => $job]);

    }

    public function store() {
        $validated = request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required'],
         ]);

        Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1 // Assuming a static employer_id for simplicity,
         ]);
         return redirect('/jobs');

    }

    public function edit(Job $job) {
        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job) {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ]);

        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);

        return redirect('/jobs/' . $job->id);
    }

    public function destroy(Job $job) {
        // authorize

        // delete
        $job->delete();
        // redirect
        return redirect('/jobs');

    }
}
