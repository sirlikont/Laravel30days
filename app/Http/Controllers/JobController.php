<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobPosted;

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

        $job = Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1 // Assuming a static employer_id for simplicity,
         ]);

        // send email
        Mail::to($job->employer->user)->queue(new JobPosted($job));

         return redirect('/jobs');


    }

    public function edit(Job $job) {

        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job) {

        Gate::authorize('edit-job', $job);

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
        Gate::authorize('edit-job', $job);

        // delete
        $job->delete();
        // redirect
        return redirect('/jobs');

    }
}
