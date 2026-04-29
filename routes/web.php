<?php

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Models\Portfolio;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/home', function(){ return Inertia::render('Home');})->middleware('auth')->name('home');

Route::get('/portfolios', [PortfolioController::class , 'index'])->name('portfolios.index');
Route::get('/portfolios/create', [PortfolioController::class , 'create']);
Route::post('/portfolios', [PortfolioController::class , 'store']);

Route::delete('/portfolios/{portfolio}',[PortfolioController::class,'destroy'])->middleware('auth')->name('portfolios.destroy');


Route::get('/portfolios/{portfolio}/edit',[PortfolioController::class,'edit'])->middleware('auth')->name('portfolios.edit');


Route::put('/portfolios/{portfolio}',[PortfolioController::class,'update'])->name('portfolios.update');







require __DIR__.'/auth.php';
