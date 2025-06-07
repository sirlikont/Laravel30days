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
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

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
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);

    return view('jobs.edit', ['job' => $job]);
});

// update
Route::patch('/jobs/{id}', function ($id) {
    // validate
    $validated = request()->validate([
      'title' => ['required', 'min:3'],
      'salary' => ['required'],
  ]);

  // authorize

  // update
    $job = Job::findOrFail($id);
  // one version to update:
    //$job->title = request('title');
    //$job->salary = request('salary');
    //$job->save(); // Save the updated job
  // another update
    $job->update([
      'title' => request('title'),
      'salary' => request('salary'),
      // 'employer_id' => 1 // Assuming a static employer_id for simplicity,
  ]);

  // redirect to the job listing
    return redirect('/jobs/' . $job->id);

});

// destroy
Route::delete('/jobs/{id}', function ($id) {
  // authorize

  // delete
  // longer version:
    //$job = Job::findOrFail($id);
    //$job->delete();
  // shorter version:
    Job::findOrFail($id)->delete();

  // redirect
    return redirect('/jobs');
});


Route::get('/contact', function () {
    return view('contact');
});
