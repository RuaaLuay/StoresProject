<?php

namespace App\Http\Controllers\DashboardController;

use App\Http\Controllers\Controller;
use App\Http\Requests\productRequest;
use App\Models\product;
use App\Models\store;
use Illuminate\Http\Request;

class productsController extends Controller
{
    public function index()
    {
        $products = product::with('store')->select('*')->get();
        $trashedProducts = Product::onlyTrashed()->select('*')->get();
        return view('DashboardViews.MainDashboardViews.products')->with('products',$products)->with('trashedProducts',$trashedProducts);
    }
    public function create()
    {
        $stores = store::select('*')->get();
        return view('DashboardViews.MainDashboardViews.add-product')->with('stores',$stores);
    }
    public function store(productRequest $request)
    {
        $name = $request->input('name');
        $desc = $request->input('desc');
        $store_id = $request->input('store');
        $base_price = $request->input('base_price');
        $discount_price = $request->input('discount_price');
        $flag = $request->input('flag');

        $product = new product();
        $product->name = $name;
        $product->description = $desc;
        $product->store_id = $store_id;
        $product->base_price = $base_price;
        $product->discount_price = $discount_price;
        $product->flag = $flag;
        $product->save();

        return redirect()->back();
    }
    public function edit ($id) {
        $product = product::with('store')
            ->select('*')
            ->where('id', $id)
            ->first();
        $stores = store::select('*')->get();
        return view('DashboardViews.MainDashboardViews.edit-product')->with('id', $id)->with('product', $product)->with('stores', $stores);
    }
    public function update (productRequest $request, $id) {
        $name = $request->input('name');
        $desc = $request->input('desc');
        $store_id = $request->input('store');
        $base_price = $request->input('base_price');
        $discount_price = $request->input('discount_price');
        $flag = $request->input('flag');

        $product = product::find($id);
        $product->name = $name;
        $product->description = $desc;
        $product->store_id = $store_id;
        $product->base_price = $base_price;
        $product->discount_price = $discount_price;
        $product->flag = $flag;
        $product->save();
        return redirect()->back();
    }
    public function destroy ($id) {
         product::where('id', $id)->delete();
         return redirect()->back();
    }
    public function destroySelectedProducts (Request $request) {
        if ($request['DeleteProducts']!=null){
            $selectedProducts = $request['DeleteProducts'];
            // dd($request['DeleteProducts']);
            foreach ($selectedProducts as $selectedProduct){
                //dd($selectedProduct);
                product::where('id', $selectedProduct)->delete();
            }
        }
        return redirect()->back();
    }
    public function restore ($id) {
         product::where('id', $id)->restore();
        return redirect()->back();
    }
    public function restoreSelectedProducts (Request $request) {
        if($request['RestoreProducts']!= null){
            $selectedProducts = $request['RestoreProducts'];
            foreach ($selectedProducts as $selectedProduct) {
                product::where('id', $selectedProduct)->restore();
            }
        }
        return redirect()->back();
    }



}
