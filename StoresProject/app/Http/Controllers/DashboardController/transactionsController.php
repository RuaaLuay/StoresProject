<?php

namespace App\Http\Controllers\DashboardController;

use App\Http\Controllers\Controller;
use App\Models\product;
use App\Models\purchaseTransaction;
use App\Models\store;
use Illuminate\Http\Request;

class transactionsController extends Controller
{
    public function index()
    {
        $transactions = purchaseTransaction::with('product')->with('product.store')->withTrashed()->select('*')->get();
        $totalTransactions = purchaseTransaction::select('*')->selectRaw("SUM(purchase_price) as sum")->with('product')->withTrashed()->groupBy('product_id')->get();
        return view('DashboardViews.MainDashboardViews.transactions')->with('transactions',$transactions)->with('totalTransactions',$totalTransactions);
    }
    public function index2()
    {
        $totalTransactions = purchaseTransaction::with('product')->withTrashed()->sum('purchase_price')->groupBy('product_id')->get();
        return view('DashboardViews.MainDashboardViews.transactions')->with('totalTransactions',$totalTransactions);
    }
}
