<?php

namespace App\Http\Controllers\AuthControllers;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Auth;



class ManagerController extends Controller
{
    public function index()
    {
        return view('manager.login');
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
        if (Auth::guard('manager')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect('mystore/index/');
        }else{
            return back()->with('error', 'invalid email or password');
        }
    }
    public function logout(Request $request)
    {
        \Illuminate\Support\Facades\Auth::guard('manager')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('manager-login-form');
    }
    public function create()
    {
        return view('manager.register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Manager::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $admin = Manager::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('manager-login-form')->with('error', 'manager created succesfully');;
    }
}
