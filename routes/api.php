<?php

use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * Login Use Case
 */
Route::post('user/login', [UserController::class , 'login']);

/** 
 * Register , Delete , Show user 
 */
Route::apiResource('user', UserController::class);

/**
 * Register , Delete , Show team
 */
Route::apiResource('team' , TeamController::class);

