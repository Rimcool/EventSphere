<?php

use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\FeedbackController;


Route::get('/', [EventController::class, 'showHomepageEvents'])->name('home');

Route::get('/about', function () {
    return view('user/about');
})->name('about');

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/features', function () {
    return view('user/features');
})->name('features');

Route::get('/team', function () {
    return view('user/team');
})->name('team');

Route::get('/testimonial', function () {
    return view('user/testimonial');
})->name('testimonial');

Route::get('/feedback', [FeedbackController::class, 'create'])->name('feedback.create');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

Route::get('/events', [EventController::class, 'showPublicEvents'])->name('events');
Route::get('/event/{id}', [EventController::class, 'showEventDetail'])->name('event.detail');
Route::post('/event/{id}/book', [EventController::class, 'bookEvent'])->name('event.book');



Route::middleware(['auth', 'is_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    
    Route::get('/panel', function () {
        return view('admin.index');
    })->name('index');

    
    Route::resource('galleries', GalleryController::class);

    
    Route::resource('events', EventController::class)->except(['index']);

    
    Route::get('/form', [EventController::class, 'create'])->name('form');


    
    Route::resource('contacts', ContactController::class);

    
    Route::resource('feedback', FeedbackController::class)->only(['index']);
    Route::get('/feedback/export', [FeedbackController::class, 'exportPDF'])->name('feedback.export');

    Route::get('/admin/users', [UsersController::class, 'showUsers'])->name('admin.users');
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

// Profile routes 
// -------------------------------

// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', [UserProfileController::class, 'dashboard'])->name('user.dashboard');

//     Route::get('/profile/edit', [UserProfileController::class, 'editProfile'])->name('user.editProfile');
//     Route::put('/profile/update', [UserProfileController::class, 'updateProfile'])->name('user.updateProfile');

//     Route::get('/profile/change-password', [UserProfileController::class, 'changePasswordForm'])->name('user.changePassword');
//     Route::post('/profile/change-password', [UserProfileController::class, 'changePassword'])->name('user.updatePassword');

//     Route::post('/logout', [UserProfileController::class, 'logout'])->name('user.logout');
// });