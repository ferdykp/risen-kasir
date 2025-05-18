<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\LaundryController;
use App\Http\Controllers\PurchaseController;
use App\Models\Purchase;

// Route::get('/', function () {
//     return view('/login');
// });


// Route::get('/', [AuthController::class, 'login'])->name('login');
// Route::post('/login', [AuthController::class, 'loginAuth'])->name('auth.login');
// Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('/', [AuthController::class, 'login'])->name('root');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginAuth'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');




// Route::get('/', [AuthController::class, 'login'])->name('login');
// Route::post('/login/auth', [AuthController::class, 'loginAuth'])->name('auth.login');
// Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/laundry/{id}/printpdf', [LaundryController::class, 'printpdf'])->name('laundry.printpdf');
// Route::get('/laundry/{encrypted}/print', [LaundryController::class, 'print'])->name('laundry.print');
Route::get('/laundry/{hash}/print', [LaundryController::class, 'print'])->name('laundry.print');





Route::middleware(['auth.custom'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/product', ProductController::class);
    Route::get('/product', [ProductController::class, 'index'])->name('product');

    Route::resource('/categories', CategoryController::class);
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

    Route::resource('/laundry', LaundryController::class);
    Route::get('/laundry', [LaundryController::class, 'index'])->name('laundry');

    Route::resource('/purchase', PurchaseController::class);
    Route::get('/purchase', [PurchaseController::class, 'index'])->name('purchase');

    Route::resource('/investment', InvestmentController::class);
    Route::get('/investment', [InvestmentController::class, 'index'])->name('investment');


    Route::get('/kasir', [TransactionController::class, 'index']);
    Route::post('/kasir/checkout', [TransactionController::class, 'checkout']);
});
