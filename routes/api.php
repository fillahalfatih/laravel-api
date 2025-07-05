<?php
// filepath: d:\Web Development\Laravel Project\laravel-api\routes\api.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\InvoiceController;

Route::prefix('v1')->group(function () {
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('invoices', InvoiceController::class);
});
