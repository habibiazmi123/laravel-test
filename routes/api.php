<?php

use App\Http\Controllers\API\UserControllerAPI;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserControllerAPI::class)->only(['index', 'store']);
