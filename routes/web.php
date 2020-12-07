<?php

use App\Http\Controllers\SalesOrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('sales-orders.new');
});

Route::get('/sales-orders/new', [SalesOrderController::class, 'newSalesOrder'])->name('sales-orders.new');
Route::get('/sales-orders/{salesOrder}', [SalesOrderController::class, 'show'])->name('sales-orders.show');
Route::post('/sales-orders/{salesOrder}/update-status', [SalesOrderController::class, 'updateStatus']);
