<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\RegisteredUserController;


Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/register', [RegisteredUserController::class, 'store']);


Route::middleware('auth')->group(
    function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::get('/item/{item_id}', [ProductController::class, 'detail']);
        Route::post('/item/comment/{item_id}', [ProductController::class, 'postComment']);
        Route::post('/item/like/{item_id}', [ProductController::class, 'toggle']);
        Route::get('/purchase/{item_id}', [ProductController::class, 'getPurchase'])->name('purchase');
        Route::get('/mypage/config', [ProfileController::class, 'getSignUp']);
        Route::post('/mypage/config', [ProfileController::class, 'postSignUp']);
        Route::get('/purchase/address/{item_id}', [ProfileController::class, 'editAddress']);
        Route::post('/purchase/address/{item_id}', [ProfileController::class, 'updateAddress']);
        Route::get('/mypage', [ProfileController::class, 'show']);
        Route::get('/mypage/profile', [ProfileController::class, 'edit']);
        Route::post('/mypage/profile', [ProfileController::class, 'update']);
        Route::post('/purchase/{item_id}', [ProductController::class, 'postPurchase']);
        Route::get('/sell', [ProductController::class, 'getSell']);
        Route::post('/sell', [ProductController::class, 'postSell']);
    }
);
