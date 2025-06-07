<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {

    return view('home');
});

Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->simplePaginate(3);

    return view('jobs.index', [
        'jobs'=> $jobs
    ]);
});

Route::get('jobs/create', function () {
    //dd('Create a job form here');
    return view('jobs.create');
});

Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    return view('jobs.show', ['job' => $job]);
});

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

Route::get('/contact', function () {
    return view('contact');
});
