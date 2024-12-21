<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranslationController;

// Route to load the frontend translator page
Route::get('/', function () {
    return view('translator.index');
});

// Route to handle translation API calls
Route::post('/translate', [TranslationController::class, 'translate']);
