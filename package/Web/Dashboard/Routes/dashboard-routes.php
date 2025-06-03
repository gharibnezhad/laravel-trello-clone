<?php
use Illuminate\Support\Facades\Route;
use Web\Dashboard\Http\Controllers\DashboardController;


Route::middleware(['web','auth','verified'])->group(function (){
    Route::get('/home',[DashboardController::class,'home'])->name('home');
});
