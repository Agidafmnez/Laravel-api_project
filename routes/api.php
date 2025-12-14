<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Login route
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;
        
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'token' => $token
        ]);
    }

    return response()->json([
        'status' => 'error',
        'message' => 'Invalid credentials'
    ], 401);
});

// Get authenticated user
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json([
        'status' => 'success',
        'user' => $request->user()
    ]);
});

//test route
Route::get('/test', function (Request $request) {
    return response()->json(['message' => 'api working!']);
});

//get all products
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index']);
Route::get('/products/{id}', [App\Http\Controllers\ProductController::class, 'show']);
Route::post('/products', [App\Http\Controllers\ProductController::class, 'store']);
Route::put('/products/{id}', [App\Http\Controllers\ProductController::class, 'update']);
Route::delete('/products/{id}', [App\Http\Controllers\ProductController::class, 'destroy']);
Route::patch('/products/{id}/toggle-status', [App\Http\Controllers\ProductController::class, 'toggleProductStatus']);
Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show']);
Route::post('/users', [App\Http\Controllers\UserController::class, 'store']);
Route::put('/users/{id}', [App\Http\Controllers\UserController::class, 'update']);
Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroy']);
Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index']);
Route::get('/orders/{id}', [App\Http\Controllers\OrderController::class, 'show']);
Route::post('/orders', [App\Http\Controllers\OrderController::class, 'store']);
Route::put('/orders/{id}', [App\Http\Controllers\OrderController::class, 'update']);
Route::delete('/orders/{id}', [App\Http\Controllers\OrderController::class, 'destroy']);
Route::patch('/orders/{id}/update-status', [App\Http\Controllers\OrderController::class, 'updateStatus']);




