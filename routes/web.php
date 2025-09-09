<?php

use Illuminate\Support\Facades\Route;

// User routes
Route::get('/', function () {
    return view('user/index');  
});

Route::get('/about', function () {
    return view('user/about');
})->name('about');

Route::get('/contact', function () {
    return view('user/contact');
})->name('contact');

Route::get('/features', function () {
    return view('user/features');
})->name('features');

Route::get('/event', function () {
    return view('user/event');
})->name('event');

Route::get('/event/{id}', function ($id) {
    return view('user/event_detail', ['id' => $id]);
})->name('event.detail');

Route::get('/team', function () {
    return view('user/team');
})->name('team');

Route::get('/testimonial', function () {
    return view('user/testimonial');
})->name('testimonial');

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin.index');
    
    Route::get('/form', function () {
        return view('admin.forms');
    })->name('admin.form');
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});