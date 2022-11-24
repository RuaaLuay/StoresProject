<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\purchaseTransaction;
use Illuminate\Http\Request;
use App\Models\store;

class websiteController extends Controller
{
    public function index()
    {
        $stores = store::select('*')->paginate(9);
        return view('webSiteViews.MainViews.shop')->with('stores',$stores);
    }
    public function viewProducts($id)
    {
        $products = product::where('store_id',$id)->select('*')->paginate(9);
        $store = store::where('id',$id)->select('id','name')->first();
        return view('webSiteViews.MainViews.products')->with('products',$products)->with('store', $store);
    }
    public function search($id)
    {
        $search_text = $_GET['q'];
        $products = product::where('store_id',$id)->where('name', 'LIKE', '%' . $search_text . '%')->paginate(9);
        $store = store::where('id',$id)->select('id','name')->first();
        return view('webSiteViews.MainViews.products')->with('products',$products)->with('store', $store);
    }
    public function purchase($id, Request $request)
    {
        $price = $request['product_price'];
        $purchase_transaction = new purchaseTransaction();
        $purchase_transaction->purchase_price= $price;
        $purchase_transaction->product_id= $id;
        $purchase_transaction->save();
        return redirect()->back();
    }
    public function about()
    {
        return view('WebSiteViews.MainViews.about');
    }
    public function contact()
    {
        return view('WebSiteViews.MainViews.contact');
    }
}
