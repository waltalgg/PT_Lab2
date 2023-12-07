<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [MainController::class, 'home' ]);

Route::get('/review', [MainController::class, 'review' ]);

Route::post('/review/check', [MainController::class, 'review_check' ]);

Route::get('/clear', [MainController::class, 'clear']);
