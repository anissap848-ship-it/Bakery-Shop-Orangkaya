<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

// Homepage (simple welcome)
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (dengan stats & products)
Route::get('/dashboard', function () {
    $totalProducts = Product::count();
    $totalUnits = Product::sum('stock');
    $inStock = Product::where('stock', '>', 0)->count();
    $lowStock = Product::where('stock', '>', 0)->where('stock', '<=', 10)->count();
    $outOfStock = Product::where('stock', 0)->count();

    $inStockPercentage = $totalProducts > 0 ? round(($inStock / $totalProducts) * 100) : 0;

    // Products by category
    $artisanBreads = Product::where('category', 'Artisan Breads')->latest()->get();
    $sweetPastries = Product::where('category', 'Sweet Pastries')->latest()->get();
    $signatureCakes = Product::where('category', 'Signature Cakes')->latest()->get();

    return view('dashboard', compact(
        'totalProducts',
        'totalUnits',
        'inStock',
        'lowStock',
        'outOfStock',
        'inStockPercentage',
        'artisanBreads',
        'sweetPastries',
        'signatureCakes'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

// Auth routes (perlu login)
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Product CRUD (admin only)
    Route::resource('products', ProductController::class);
});

require __DIR__.'/auth.php';
