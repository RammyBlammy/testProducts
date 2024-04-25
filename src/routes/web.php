<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadDataController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductListController;

Route::get('/', function () {
    return view('upload');
});
Route::post('/upload-data', [UploadDataController::class, 'index'])->name('upload.index');

Route::get('/products', [ProductListController::class, 'index'])->name('products.index');

Route::get('/products/{id}', [ProductController::class, 'showDetails'])->name('product.showDetails');
