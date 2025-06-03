<?php

use Illuminate\Support\Facades\Route;


Route::group(["namespace"=>"Web\Project\Http\Controllers",
    "middleware"=>['web','auth','verified']],function (){
    Route::resource('projects','ProjectController');
});
