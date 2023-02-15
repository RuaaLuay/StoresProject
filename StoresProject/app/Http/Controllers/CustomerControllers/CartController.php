<?php

namespace App\Http\Controllers\CustomerControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\productRequest;
use App\Models\Cart;
use App\Models\Product;
use App\Models\customer;
use App\Notifications\addedToCart;
use Illuminate\Http\Request;
use Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Response;
use Illuminate\Notifications\Notifiable;



class CartController extends Controller
{
    use Notifiable;

    public function store(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_quantity = 1;
        if(Auth::guard('customer')->check()){
            $product_check = Product::where('id', $product_id)->exists();
            if($product_check) {
                $alreadyAdded= Cart::where('product_id', $product_id)->where('customer_id', Auth::guard('customer')->id())->first();
                if($alreadyAdded){
                    DB::table('carts')->where('id', $alreadyAdded->id)->update(['product_quantity'=> $alreadyAdded->product_quantity+1]);
                }else{
                $cartItem = new Cart();
                $cartItem->product_id = $product_id;
                $cartItem->customer_id = Auth::guard('customer')->id();
                $cartItem->product_quantity = $product_quantity;
                $cartItem->save();
                }
            }
            $customer = Customer::find(Auth::guard('customer')->id());
            $customer->notify(new addedToCart());
           // Notification::send($customer,new addedToCart());
        }else{
            $product = Product::where('id', $product_id)->first();
            $cart = $request->session()->get('cart');
            if( $request->session()->has('cart.'.$product_id)){
                $q = $cart[$product_id]['product_quantity'];
                $cart[$product_id] = [
                    'name'=>$product->name,
                    'product_quantity'=> $q+1,
                    'description'=>$product->description,
                    'price'=>$product->base_price
                ];
                session()->put(
                    'cart',$cart
                );

//            if(session()->has('cart')->has($product_id)){
//
////                $cart[$product_id] = [
////                    'product_quantity'=> $cart[$product_id]['product_quantity']+1
////                ];
            }else{
                $cart[$product_id] = [
                    'name'=>$product->name,
                    'product_quantity'=> 1,
                    'description'=>$product->description,
                    'price'=>$product->base_price
                ];
                session()->put(
                    'cart',$cart
                );
            }
//            if($request->session()->has($product_id)){
//                $request->session()->increment('product_id', $incrementBy = 1);
////                session(['product_id'=> ['product_quantity'=>]]);
//            }else{
//                session([$product_id=> 1]);
//               // $cart = $request->session()->get('cart');
//            }

        }
        return redirect()->back();
    }
    public function index(Request $request)
    {
        if(Auth::guard('customer')->check()){
            $cartItems= Cart::where('customer_id', Auth::guard('customer')->id())->with('product')->select('*')->paginate(6);
        }else{
            $cartItems = $request->session()->get('cart');
            //dd($cartItems);
        }
        return view('WebSiteViews.MainViews.cart')->with('cartItems',$cartItems);
    }
    public function destroy (Request $request, $id) {
        if(Auth::guard('customer')->check()){
            $deleted = cart::where('id', $id)->delete();
            //return redirect()->back();
            return response()->json([
                'success' => $deleted,
                'state' => 'CA',
            ]);
        }else{
            $request->session()->forget('cart.'.$id);

        }

    }
    public function update(Request $request, $id)
    {
        $product_id = $id;
        if(Auth::guard('customer')->check()){
            DB::table('carts')->where('id', $product_id)->update(['product_quantity'=> $request->product_quantity]);
        }else{
            $cart = $request->session()->get('cart');
//            $q = $cart[$id]['product_quantity'];
            $cart[$product_id]['product_quantity']=$request->product_quantity;
            $q = $cart[$product_id]['product_quantity'];
            session()->put('cart.'.$id.'.product_quantity',$q);
//            $cart[$id] = [
//                'name'=>$cart[$product_id]['name'],
//                'description'=>$cart[$product_id]['description'],
//                'price'=>$cart[$product_id]['base_price'],
//                'product_quantity'=>$request->product_quantity
//            ];
//            session()->put(
//                'cart',$cart
//            );
        }
    }
}
