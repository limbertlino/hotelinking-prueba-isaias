<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('App');
})->name('home');


Route::get('/{any}', function () {
    return Inertia::render('App');
})->where('any', '^(?!api).*$');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
