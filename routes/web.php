<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/about', [AboutController::class, 'index'])->name('about');

    Route::resource('category', CategoryController::class)->only(['index']);

    Route::middleware('can:manage-category')->group(function () {
        Route::resource('category', CategoryController::class)->only([
            'create',
            'store',
            'edit',
            'update',
            'destroy',
        ]);
    });

    // Product Page
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');

    // Route Export - Diamankan dengan Gate 'export-product' (hanya admin)
    // Harus didefinisikan SEBELUM route /product/{id} agar tidak konflik
    Route::get('/product/export', [ProductController::class, 'export'])
        ->middleware('can:export-product')
        ->name('product.export');

    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';