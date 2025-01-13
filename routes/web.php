<?php

use App\Http\Controllers\ChildController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\GradeLevelController;
use App\Http\Controllers\GuardianAccessController;
use App\Http\Controllers\GuardianController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::resource('classrooms', ClassroomController::class)->middleware(['auth']);
Route::resource('grade-levels', GradeLevelController::class)->middleware(['auth']);

Route::resource('child', ChildController::class)->middleware(['auth']);
Route::get('/child/{child}/add-guardian', [GuardianController::class, 'create'])->middleware(['auth'])->name('child.add-guardian');
Route::post('/child/{child}/add-guardian', [GuardianController::class, 'store'])->middleware(['auth'])->name('child.store-guardian');

Route::resource('guardians', GuardianController::class)->middleware(['auth']);
Route::get('/guardian-access', [GuardianAccessController::class, 'showForm'])->name('guardian.access');
Route::post('/guardian-access', [GuardianAccessController::class, 'verify'])->name('guardian.verify');
Route::get('/guardian-profile/{guardian}', [GuardianAccessController::class, 'profile'])->name('guardian.profile');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
