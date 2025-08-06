<?php
use Illuminate\Support\Facades\Route;


Route::group(["namespace" => "Web\TaskActivity\Http\Controllers",
    "middleware" => ['web', 'auth', 'verified']], function () {

    Route::resource('taskActivities', 'TaskActivityController');

});
