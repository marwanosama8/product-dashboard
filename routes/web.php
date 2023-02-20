<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        
        // index route
        Route::get('/', function () {
            return view('welcome');
        });

        // dashboard route
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard');

        //category routes
        Route::prefix('category')->group(function () {
            Route::get('/', function () {
                return view('category.category');
            })->middleware(['auth', 'verified'])->name('category');
            Route::post('store', [CategoryController::class, 'store'])->name('category.store');
            Route::get('edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
            Route::post('update/{category}', [CategoryController::class, 'update'])->name('category.update');
            Route::delete('delete/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
        }); // end category routes

        //product routes
        Route::prefix('product')->group(function () {
            Route::get('/', function () {
                return view('product.product');
            })->middleware(['auth', 'verified'])->name('product');
            Route::post('store', [ProductController::class, 'store'])->name('product.store');
            Route::get('edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
            Route::post('update/{product}', [ProductController::class, 'update'])->name('product.update');
            Route::delete('delete/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
        }); // end product routes

        // auth routes
        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        }); // end auth routes
    }
);

require __DIR__ . '/auth.php';
