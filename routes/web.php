<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () {
    return view('jobs', [
        'jobs'=> [
            ['id'=> 1, 'title' => 'Software Engineer', 'salary' => '50000'],
            ['id'=> 2, 'title' => 'Data Analyst', 'salary' => '40000'],
            ['id'=> 3, 'title' => 'Web Developer', 'salary' => '50000'],
        ]
    ]);
});

Route::get('/jobs/{id}', function ($id) {
    $jobs = [
        ['id'=> 1, 'title' => 'Software Engineer', 'salary' => '50000'],
        ['id'=> 2, 'title' => 'Data Analyst', 'salary' => '40000'],
        ['id'=> 3, 'title' => 'Web Developer', 'salary' => '50000'],
    ];

    $job = Arr::first($jobs, fn($job) => $job['id'] == $id);
    //dd($job);

    return view('job', [
        'job' => $job
    ]);
});

Route::get('/contact', function () {
    return view('contact');
});
