<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\websiteController;
use App\Http\Controllers\DashboardController\productsController;
use App\Http\Controllers\DashboardController\storesController;
use App\Http\Controllers\DashboardController\transactionsController;
use App\Http\Controllers\DashboardController\MainDashboardController;
use App\Http\Controllers\AuthControllers\AdminController;
use App\Http\Controllers\AuthControllers\ManagerController;
use App\Http\Controllers\AuthControllers\CustomerController;
use App\Http\Controllers\managerDashboardControllers\ManagerDashboardController;
use App\Http\Controllers\CustomerControllers\CartController;






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

//Auth routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'index'])->name('login-form');
    Route::post('/login', [AdminController::class, 'login'])->name('admin-login');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin-logout');
    Route::get('/register', [AdminController::class, 'create']);
    Route::post('/register/store', [AdminController::class, 'store']);
});

Route::prefix('manager')->group(function (){
    Route::get('/login', [ManagerController::class, 'index'])->name('manager-login-form');
    Route::post('/login', [ManagerController::class, 'login'])->name('manager-login');
    Route::post('/logout', [ManagerController::class, 'logout'])->name('manager-logout');
    Route::get('/register', [ManagerController::class, 'create']);
    Route::post('/register/store', [ManagerController::class, 'store']);
});

Route::prefix('customer')->group(function (){
    Route::get('/login', [CustomerController::class, 'index'])->name('customer-login-form');
    Route::post('/login', [CustomerController::class, 'login'])->name('customer-login');
    Route::post('/logout', [CustomerController::class, 'logout'])->name('customer-logout');
    Route::get('/register', [CustomerController::class, 'create']);
    Route::post('/register/store', [CustomerController::class, 'store']);
});


Route::get('/', function () {
    return view('WebSiteViews.MainViews.index');
});


//public website routes
Route::get('website/stores', [websiteController::class, 'index'])->name('website');
Route::get('website/stores/products/{id}', [websiteController::class, 'viewProducts']);
Route::get('website/products/search/{id}', [websiteController::class, 'search']);
Route::post('website/products/purchase/{id}', [websiteController::class, 'purchase']);


//Dashboard routes
Route::prefix('admin')->middleware(['admin'])->group(function (){
    Route::get('dashboard', [MainDashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard/products', [productsController::class, 'index']);
    Route::post('dashboard/product/delete/{id}', [productsController::class, 'destroy']);
    Route::post('dashboard/product/deleteSelected', [productsController::class, 'destroySelectedProducts']);
    Route::post('dashboard/product/restore/{id}', [productsController::class, 'restore']);
    Route::post('dashboard/product/restoreSelected', [productsController::class, 'restoreSelectedProducts']);
    Route::get('dashboard/product/create', [productsController::class, 'create']);
    Route::post('dashboard/product/store', [productsController::class, 'store']);
    Route::get('dashboard/product/edit/{id}', [productsController::class, 'edit']);
    Route::post('dashboard/product/update/{id}', [productsController::class, 'update']);
});
Route::get('dashboard', [MainDashboardController::class, 'index'])->middleware('admin');

Route::controller(storesController::class)->prefix('dashboard')->middleware(['admin'])->group(function () {
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

//manager's stores routes
Route::controller(ManagerDashboardController::class)->prefix('mystore')->middleware('manager')->group(function (){
    Route::get('/index',  'index');
    Route::get('/products/{id}',  'products');
    Route::post('/product/delete/{id}', 'destroy');
    Route::post('/product/deleteSelected', 'destroySelectedProducts');
    Route::post('/product/restore/{id}', 'restore');
    Route::post('/product/restoreSelected', 'restoreSelectedProducts');
    Route::get('/product/create/{store_id}', 'create');
    Route::post('/product/store', 'store');
    Route::get('/product/edit/{id}', 'edit');
    Route::post('/product/update/{id}', 'update');
});

//cart
Route::controller(CartController::class)->prefix('cart')->group(function (){
    Route::get('/index','index');
    Route::post('/store', 'store');
    Route::delete('/delete/{id}', 'destroy');
    Route::post('/update/{id}', 'update');

});


Route::get('dashboard/transactions', [transactionsController::class, 'index'])->middleware(['admin']);
Route::get('about',[websiteController::class,'about']);
Route::get('shop/contact',[websiteController::class,'contact']);



require __DIR__.'/auth.php';
