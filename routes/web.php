<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth', ['mode' => 'login']);
})->name('login');

Route::get('/register', function () {
    return view('auth', ['mode' => 'register']);
})->name('register');
