<?php

use App\Http\Controllers\ApiController\TeamController;
use App\Http\Controllers\ApiController\UserController;
use App\Http\Middleware\JwtAuthMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



/** 
 * Register , Delete , Show user 
 */
Route::apiResource('user', UserController::class);

/**
 * Login Use Case
 */
Route::post('user/login', [UserController::class , 'login'])->name('login');

/**
 * Register , Delete , Show team
 */
Route::apiResource('team' , TeamController::class)
->middleware(JwtAuthMiddleware::class);

