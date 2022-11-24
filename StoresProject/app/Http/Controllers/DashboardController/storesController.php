<?php

namespace App\Http\Controllers\DashboardController;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeRequest;
use App\Models\product;
use Illuminate\Http\Request;
use App\Models\store;


class storesController extends Controller
{
    public function index()
    {
        $stores = store::select('*')->get();
        $trashedStores = store::select('*')->onlyTrashed()->get();
        return view('DashboardViews.MainDashboardViews.stores')->with('stores',$stores)->with('trashedStores',$trashedStores);
    }
    public function destroy ($id) {
        store::where('id', $id)->delete();
        return redirect()->back();
    }
    public function destroySelectedStores (Request $request) {
        if ($request['DeleteStores']!=null){
            $selectedStores = $request['DeleteStores'];
            foreach ($selectedStores as $selectedStore){
                store::where('id', $selectedStore)->delete();
            }
        }
        return redirect()->back();
    }
    public function restore ($id) {
        store::where('id', $id)->restore();
        return redirect()->back();
    }
    public function restoreSelectedStores (Request $request) {
        if($request['RestoreStores']!= null){
            $selectedStores = $request['RestoreStores'];
            foreach ($selectedStores as $selectedStore) {
                store::where('id', $selectedStore)->restore();
            }
        }
        return redirect()->back();
    }
    public function create()
    {
        return view('DashboardViews.MainDashboardViews.add-store');
    }
    public function store(storeRequest $request)
    {
        $name = $request->input('name');
        $address = $request->input('address');
        $image = $request->file('image');
        $image_name = time();
        $extension = $image->extension();
        $path = "uploads/Logos/$image_name".'.'.$extension;
        \Storage::disk('public')->put($path, file_get_contents($image));

        $store = new store();
        $store->name = $name;
        $store->address = $address;
        $store->Logo_path = $path;

        $store->save();
        return redirect()->back();
    }
    public function edit ($id) {
        $store = store::select('*')
            ->where('id', $id)
            ->first();
        return view('DashboardViews.MainDashboardViews.edit-store')->with('id', $id)->with('store', $store);
    }
    public function update (storeRequest $request, $id) {
        $name = $request->input('name');
        $address = $request->input('address');
        $store = store::find($id);
        $image = $request->file('image');
        $image_name = time();
        $extension = $image->extension();
        $path = "uploads/Logos/$image_name".'.'.$extension;
        \Storage::disk('public')->put($path, file_get_contents($image));
        $store->name = $name;
        $store->address = $address;
        $store->Logo_path = $path;
        $store->save();
        return redirect()->back();
    }
}
