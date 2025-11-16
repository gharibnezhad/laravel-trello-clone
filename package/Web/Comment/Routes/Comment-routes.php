<?php

use Illuminate\Support\Facades\Route;
use Web\Comment\Http\Controllers\CommentController;

Route::group(['namespace'=>'Web\Comment\Http\Controllers',
    'middleware' => ['web', 'auth', 'verified']],function (){

    Route::resource('comments','CommentController');

});

