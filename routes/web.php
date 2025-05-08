<?php

use Illuminate\Support\Facades\Route;

Route::get('/pdf', function(){
    return generate_pdf();
});

Route::get('/test_pdf', function(){
    return test_pdf();
});

Route::get('/', function () {
    return view('welcome');
});
