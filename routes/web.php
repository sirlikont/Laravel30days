<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {

    return view('home');
});

// index
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->simplePaginate(3);

    return view('jobs.index', [
        'jobs'=> $jobs
    ]);
});

// create
Route::get('jobs/create', function () {
    //dd('Create a job form here');
    return view('jobs.create');
});

// show
Route::get('/jobs/{job}', function (Job $job) {
    return view('jobs.show', ['job' => $job]);
});

// store
Route::post('/jobs', function () {
  //dd('Store a job here');
  //dd(request()->all());

  // Validate the request data
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
});

// edit
Route::get('/jobs/{job}/edit', function (Job $job) {
    return view('jobs.edit', ['job' => $job]);
});

// update
Route::patch('/jobs/{job}', function (Job $job) {
    // authorize

    // validate
    request()->validate([
      'title' => ['required', 'min:3'],
      'salary' => ['required'],
  ]);

    // update
    $job->update([
      'title' => request('title'),
      'salary' => request('salary'),
      // 'employer_id' => 1 // Assuming a static employer_id for simplicity,
  ]);

    // redirect to the job listing
    return redirect('/jobs/' . $job->id);

});

// destroy
Route::delete('/jobs/{job}', function (Job $job) {
  // authorize

  // delete
  $job->delete();
  // redirect
    return redirect('/jobs');
});


Route::get('/contact', function () {
    return view('contact');
});
