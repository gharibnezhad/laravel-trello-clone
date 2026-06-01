<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Web\User\Http\Controllers\ProfileController;
use Web\User\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::middleware('web')->group(function () {


    Route::middleware(['web','auth','verified'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // information-users
      Route::patch('users/{user}/manualVerify',[UserController::class,'manualVerify'])->name('users.manualVerify');
      Route::get('users/profile',[UserController::class,'profile'])->name('users.profile');
      Route::post('users/photo',[UserController::class,'updatePhoto'])->name('users.photo');
      Route::get('users/profile/{id}/edit',[UserController::class,'editProfile'])->name('users.editProfile');
      Route::patch('users/profile/{user}/update',[UserController::class,'updateProfile'])->name('users.updateProfile');
      Route::resource('users',UserController::class);


    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');


    require __DIR__ . '/auth.php';
});

