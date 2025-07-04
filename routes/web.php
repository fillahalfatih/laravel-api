<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\InvoiceController;
use App\Http\Controllers\Api\V1\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api/v1')->group(function () {
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('invoices', InvoiceController::class);
});
