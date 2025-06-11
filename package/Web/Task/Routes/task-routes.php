<?php

use Illuminate\Support\Facades\Route;
use Web\Task\Http\Controllers\TaskController;

Route::group(["namespace" => "Web\Task\Http\Controllers",
    "middleware" => ['web', 'auth', 'verified']], function () {

    Route::resource('tasks', 'TaskController');
    Route::get('/taskLists/by-board/{board}', [TaskController::class, 'getByBoard']);

});
