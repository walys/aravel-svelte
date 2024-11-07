<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    return Inertia::render('Welcome');
});
// Route::get('/csrf-token', function () {
//     return response()->json(['csrfToken' => csrf_token()])->header('Access-Control-Allow-Origin', '*');
// });

// Route::get('/sanctum/csrf-cookie', function () {
//     return response()->json(['csrfToken' => csrf_token()])->header('Access-Control-Allow-Origin', '*');
// });
