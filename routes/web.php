<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app'); // Serve the Vue application
});
