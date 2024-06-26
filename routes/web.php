<?php

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
Route::middleware(['backend'])
    ->prefix('backend')
    ->name('backend.')
    ->namespace('Cpkm\ErpStock\Http\Controllers\Backend')->group(function(){
        Route::middleware(['auth:backend', 'admin.permission'])->group(function(){
            //採購進貨管理
            Route::prefix('restock')->name('restock.')->group(function(){
                /* 請購單 */
                Route::resource('pre_purchase_order', Restock\PrePurchaseOrderController::class);
                // /* 詢價單 */
                // Route::resource('inquiry_order', Restock\InquiryOrderController::class);
                // /* 採購單 */
                // Route::resource('purchase_order', Restock\PurchaseOrderController::class);
                // /* 進貨單 */
                // Route::resource('restock_order', Restock\RestockOrderController::class);
                // /* 進貨退貨單 */
                // Route::resource('restock_return_order', Restock\RestockReturnOrderController::class);
            });

            //訂購銷貨管理
            Route::prefix('sales')->name('sales.')->group(function(){
                // /* 報價單 */
                Route::resource('quote_order', Sales\QuoteOrderController::class);
                // /* 訂購單 */
                Route::resource('order', Sales\OrderController::class);
                // /* 銷貨單 */
                Route::resource('sold_order', Sales\SoldOrderController::class);
                /* 銷貨退回單 */
                Route::resource('sold_return_order', Sales\SoldReturnOrderController::class);
            });
        });
    });