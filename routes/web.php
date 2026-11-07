<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user->hasRole('admin')) return redirect()->route('admin.dashboard');
    if ($user->hasRole('client') || $user->hasRole('vendor')) return redirect()->route('client.dashboard');
    if ($user->hasRole('creator') || $user->hasRole('influencer')) return redirect()->route('creator.dashboard');
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [\App\Http\Controllers\AdminController::class, 'users'])->name('users');
    Route::patch('/users/{user}/status', [\App\Http\Controllers\AdminController::class, 'updateUserStatus'])->name('users.updateStatus');
    Route::get('/backgrounds', [\App\Http\Controllers\AdminController::class, 'backgrounds'])->name('backgrounds');
    Route::post('/backgrounds/settings', [\App\Http\Controllers\AdminController::class, 'updateSettings'])->name('backgrounds.settings');
    Route::post('/backgrounds', [\App\Http\Controllers\AdminController::class, 'storeBackground'])->name('backgrounds.store');
    Route::patch('/backgrounds/{background}/toggle', [\App\Http\Controllers\AdminController::class, 'toggleBackground'])->name('backgrounds.toggle');
    Route::delete('/backgrounds/{background}', [\App\Http\Controllers\AdminController::class, 'deleteBackground'])->name('backgrounds.delete');
});

// Client Routes
Route::middleware(['auth', 'role:client|vendor'])->prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\ClientController::class, 'dashboard'])->name('dashboard');
    Route::get('/creator/{id}', [\App\Http\Controllers\ClientController::class, 'showCreator'])->name('creator.show');
    Route::get('/profile', [\App\Http\Controllers\ClientController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [\App\Http\Controllers\ClientController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\ClientController::class, 'updateProfile'])->name('profile.update');
    Route::get('/collaborations', [\App\Http\Controllers\ClientController::class, 'collaborations'])->name('collaborations');
    
    // Send Project Proposal
    Route::post('/endorsements', [\App\Http\Controllers\EndorsementController::class, 'store'])->name('endorsements.store');
});

// Creator (Penyedia Jasa) Routes
Route::middleware(['auth', 'role:creator|influencer'])->prefix('creator')->name('creator.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\CreatorController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [\App\Http\Controllers\CreatorController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [\App\Http\Controllers\CreatorController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\CreatorController::class, 'updateProfile'])->name('profile.update');
    Route::get('/collaborations', [\App\Http\Controllers\CreatorController::class, 'collaborations'])->name('collaborations');
});

// Legacy Aliases
Route::middleware(['auth'])->group(function() {
    Route::get('/vendor/dashboard', fn() => redirect()->route('client.dashboard'))->name('vendor.dashboard');
    Route::get('/influencer/dashboard', fn() => redirect()->route('creator.dashboard'))->name('influencer.dashboard');
    Route::get('/vendor/collaborations', fn() => redirect()->route('client.collaborations'))->name('vendor.collaborations');
    Route::get('/influencer/collaborations', fn() => redirect()->route('creator.collaborations'))->name('influencer.collaborations');
    Route::get('/vendor/profile', fn() => redirect()->route('client.profile'))->name('vendor.profile');
    Route::get('/influencer/profile', fn() => redirect()->route('creator.profile'))->name('influencer.profile');
    Route::get('/vendor/influencer/{id}', fn($id) => redirect()->route('client.creator.show', $id))->name('vendor.influencer.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Media Upload
    Route::post('/media', [\App\Http\Controllers\MediaController::class, 'store'])->name('media.store');
    Route::delete('/media/{mediaUpload}', [\App\Http\Controllers\MediaController::class, 'destroy'])->name('media.destroy');

    // Endorsements / Projects Status
    Route::patch('/endorsements/{endorsement}/status', [\App\Http\Controllers\EndorsementController::class, 'updateStatus'])->name('endorsements.status');

    // Collaborations (Chat & Negotiation)
    Route::prefix('collaborations')->name('collaborations.')->group(function () {
        Route::get('/{endorsement}', [\App\Http\Controllers\CollaborationController::class, 'show'])->name('show');
        Route::post('/{endorsement}/chat', [\App\Http\Controllers\CollaborationController::class, 'sendMessage'])->name('chat');
        Route::post('/{endorsement}/price', [\App\Http\Controllers\CollaborationController::class, 'updatePrice'])->name('price');
        Route::post('/{endorsement}/accept', [\App\Http\Controllers\CollaborationController::class, 'acceptOffer'])->name('accept');
        Route::post('/{endorsement}/reject', [\App\Http\Controllers\CollaborationController::class, 'rejectOffer'])->name('reject');
        Route::post('/{endorsement}/pay', [\App\Http\Controllers\CollaborationController::class, 'simulatePayment'])->name('pay');
        Route::get('/{endorsement}/receipt', [\App\Http\Controllers\CollaborationController::class, 'receipt'])->name('receipt');
        Route::post('/{endorsement}/complete', [\App\Http\Controllers\CollaborationController::class, 'complete'])->name('complete');
        Route::post('/{endorsement}/rate', [\App\Http\Controllers\CollaborationController::class, 'rate'])->name('rate');
    });
});

require __DIR__.'/auth.php';
