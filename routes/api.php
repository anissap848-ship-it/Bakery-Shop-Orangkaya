<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| Product API Routes (v1)
|--------------------------------------------------------------------------
|
| RESTful API endpoints for Product CRUD operations
| Base URL: http://localhost:8000/api/v1
|
*/

Route::prefix('v1')->group(function () {
    
    // GET all products
    // URL: GET http://localhost:8000/api/v1/products
    Route::get('/products', [ProductApiController::class, 'index']);
    
    // GET single product by ID
    // URL: GET http://localhost:8000/api/v1/products/{id}
    Route::get('/products/{id}', [ProductApiController::class, 'show']);
    
    // POST create new product
    // URL: POST http://localhost:8000/api/v1/products
    Route::post('/products', [ProductApiController::class, 'store']);
    
    // PUT update product
    // URL: PUT http://localhost:8000/api/v1/products/{id}
    Route::put('/products/{id}', [ProductApiController::class, 'update']);
    
    // DELETE product
    // URL: DELETE http://localhost:8000/api/v1/products/{id}
    Route::delete('/products/{id}', [ProductApiController::class, 'destroy']);
    
});