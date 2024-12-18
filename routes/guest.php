<?php

use Illuminate\Support\Facades\Route;

// Define your guest-specific routes here
Route::get('/', function () {
    return view('welcome');
});
