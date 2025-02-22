<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SearchController;


// Route untuk halaman utama
Route::get('/', function () {
    return view('search'); // Pastikan file view 'search.blade.php' ada
});

// Route untuk pencarian
Route::get('/search', [SearchController::class, 'search']);