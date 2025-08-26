<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\TicketController;

Route::get('/', fn () => redirect()->route('devices.index'));

Route::resource('devices', DeviceController::class)->except(['show']);

Route::get('devices/{device}/tickets', [TicketController::class, 'index'])->name('tickets.index');
Route::get('devices/{device}/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
Route::post('devices/{device}/tickets', [TicketController::class, 'store'])->name('tickets.store');
Route::patch('tickets/{ticket}/close', [TicketController::class, 'close'])->name('tickets.close');
Route::delete('tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');
