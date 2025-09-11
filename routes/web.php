<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\ContactController; // <-- Use only this

// --- Public User-Facing Routes ---
// These routes do not require any authentication or admin privileges.
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

// Event-specific routes
// This route will now pull all events from the database via the controller.
Route::get('/events', [EventController::class, 'showPublicEvents'])->name('events');
Route::get('/event/{id}', [EventController::class, 'showEventDetail'])->name('event.detail');
Route::post('/event/{id}/book', [EventController::class, 'bookEvent'])->name('event.book');


// --- Admin Routes ---
// This group uses the 'admin' prefix for all URLs.
Route::prefix('admin')->group(function () {

    // Main admin dashboard route
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin.index');

    // Use a resource controller for all CRUD operations on events.
    // The `names` method will now correctly create `admin.events.destroy` and other routes.
    Route::resource('events', EventController::class)->except(['index'])->names('admin.events');

    // The 'admin/form' route seems to be for creating a new event.
    // The Route::resource('events', ...) already handles this via events/create,
    // so you can use that instead if you want to follow Laravel conventions.
    Route::get('/form', [EventController::class, 'index'])->name('admin.form');

    // Use only ContactController for admin contacts
    Route::resource('contacts', ContactController::class)->names([
        'index' => 'admin.contacts.index',
        'create' => 'admin.contacts.create',
        'store' => 'admin.contacts.store',
        'show' => 'admin.contacts.show',
        'edit' => 'admin.contacts.edit',
        'update' => 'admin.contacts.update',
        'destroy' => 'admin.contacts.destroy',
    ]);
});

// --- Jetstream-Authenticated Routes ---
// These routes are only accessible to logged-in and verified users.
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