<?php

namespace App\Http\Controllers\managerDashboardControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\productRequest;
use App\Models\product;
use App\Models\store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerDashboardController extends Controller
{
    public function index()
    {
        $stores = store::select('*')->where('manager_id',Auth::guard('manager')->id())->get();
        return view('DashboardViews.ManagerDashboardViews.stores')->with('stores',$stores);
    }
    public function products($id){
        $products = product::where('store_id',$id)->select('*')->get();
        $trashedProducts = Product::where('store_id',$id)->onlyTrashed()->select('*')->get();
        $store = store::find($id);
        return view('DashboardViews.ManagerDashboardViews.products')->with('products',$products)->with('trashedProducts',$trashedProducts)->with('store', $store);
    }
    public function create($store_id)
    {
        $store = store::find($store_id);
        return view('DashboardViews.ManagerDashboardViews.add-product')->with('store',$store);
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
        $store = store::find($product->store_id);
        return view('DashboardViews.ManagerDashboardViews.edit-product')->with('id', $id)->with('product', $product)->with('store', $store);
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
