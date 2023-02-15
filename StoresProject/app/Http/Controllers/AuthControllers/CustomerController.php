<?php

namespace App\Http\Controllers\AuthControllers;

use App\Http\Controllers\Controller;
use App\Models\customer;
use App\Models\Cart;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Auth;


class CustomerController extends Controller
{
    public function index()
    {
        return view('customer.login');
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
        if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            foreach ($request->session('cart') as $cart){
                $product_check = Product::where('id', $cart)->exists();
                if($product_check) {
                    $alreadyAdded= Cart::where('product_id', $cart)->where('customer_id', \Illuminate\Support\Facades\Auth::guard('customer')->id())->first();
                    if($alreadyAdded){
                        DB::table('carts')->where('id', $alreadyAdded->id)->update(['product_quantity'=> $alreadyAdded->product_quantity+$cart['product_quantity']]);
                    }else{
                        $cartItem = new Cart();
                        $cartItem->product_id = $cart;
                        $cartItem->customer_id = Auth::guard('customer')->id();
                        $cartItem->product_quantity = $cart['product_quantity'];
                        $cartItem->save();
                    }
                }
            }
            $request->session()->forget('cart');
            return redirect()->route('website');
        }else{
            return back()->with('error', 'invalid email or password');
        }
    }
    public function logout(Request $request)
    {
        \Illuminate\Support\Facades\Auth::guard('customer')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect()->route('customer-login-form');
    }
    public function create()
    {
        return view('customer.register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Customer::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $admin = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('customer-login-form')->with('error', 'customer created succesfully');;
    }
}
