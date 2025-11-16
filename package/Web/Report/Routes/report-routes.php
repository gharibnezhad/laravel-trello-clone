<?php

use Illuminate\Support\Facades\Route;


Route::group([
    "namespace" => "Web\Report\Http\Controllers",
    "middleware" => ['web', 'auth', 'verified']
], function ($router) {
    $router->resource('reports', 'ReportController');
    $router->get('report/user', 'ReportController@getAllTasksUsers')->name('userTask');
});
