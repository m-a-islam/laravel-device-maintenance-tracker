<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TicketApiController;

Route::middleware('api.key')->group(function () {
    Route::get('/devices/{device}/tickets', [TicketApiController::class, 'index']);
    Route::post('/devices/{device}/tickets', [TicketApiController::class, 'store']);
});
