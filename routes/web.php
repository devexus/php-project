<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\WelcomeController;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WelcomeController::class, 'index']);






Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    Route::get('/events', [EventController::class, 'index'])->name('events');

    Route::get('/event', [EventController::class, 'create'])->name('event');

    Route::post('/event', [EventController::class, 'store'])->name('event.store');

    Route::delete('/event/{event}', [EventController::class, 'destroy'])->name('event.destroy');

    Route::get('/event/edit/{event}', [EventController::class, 'edit'])->name('event.edit');

    Route::patch('/event/edit/{event}', [EventController::class, 'update'])->name('event.update');


    Route::patch('/category/edit/{category}', [CategoryController::class, 'update'])->name('category.update');

    Route::get('/category', function () {
        return view('category');
    })->middleware(['auth', 'verified'])->name('category');

    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');

    Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/category', function () {
        return view('category/add');
    })->middleware(['auth', 'verified'])->name('category');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

    Route::get('/category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
});




require __DIR__ . '/auth.php';
