<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\InvoiceController;
use App\Http\Controllers\Api\V1\CustomerController;

Route::get('/', function () {
    return view('welcome');
});
