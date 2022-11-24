<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\websiteController;
use App\Http\Controllers\DashboardController\productsController;
use App\Http\Controllers\DashboardController\storesController;
use App\Http\Controllers\DashboardController\transactionsController;
use App\Http\Controllers\DashboardController\MainDashboardController;




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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    return view('WebSiteViews.MainViews.index');
});


//public website routes
Route::get('website/stores', [websiteController::class, 'index']);
Route::get('website/stores/products/{id}', [websiteController::class, 'viewProducts']);
Route::get('website/products/search/{id}', [websiteController::class, 'search']);
Route::post('website/products/purchase/{id}', [websiteController::class, 'purchase']);


//Dashboard routes

Route::get('dashboard/products', [productsController::class, 'index']);
Route::post('dashboard/product/delete/{id}', [productsController::class, 'destroy']);
Route::post('dashboard/product/deleteSelected', [productsController::class, 'destroySelectedProducts']);
Route::post('dashboard/product/restore/{id}', [productsController::class, 'restore']);
Route::post('dashboard/product/restoreSelected', [productsController::class, 'restoreSelectedProducts']);
Route::get('dashboard/product/create', [productsController::class, 'create']);
Route::post('dashboard/product/store', [productsController::class, 'store']);
Route::get('dashboard/product/edit/{id}', [productsController::class, 'edit']);
Route::post('dashboard/product/update/{id}', [productsController::class, 'update']);


Route::get('dashboard', [MainDashboardController::class, 'index'])->middleware('auth');

Route::controller(storesController::class)->prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/stores',  'index');
    Route::post('/store/delete/{id}', 'destroy');
    Route::post('/store/deleteSelected', 'destroySelectedStores');
    Route::post('/store/restore/{id}', 'restore');
    Route::post('/store/restoreSelected', 'restoreSelectedStores');
    Route::get('/store/edit/{id}', 'edit');
    Route::post('/store/update/{id}', 'update');
    Route::get('/store/create',  'create');
    Route::post('/store/store', 'store');
});





Route::get('dashboard/transactions', [transactionsController::class, 'index']);







Route::get('about',[websiteController::class,'about']);
Route::get('shop/contact',[websiteController::class,'contact']);



require __DIR__.'/auth.php';
