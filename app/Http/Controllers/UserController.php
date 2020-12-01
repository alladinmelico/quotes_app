<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getSignup(){
        return view('user.signup');
    }

    public function postSignup(Request $request){
        $this->validate($request, [
        'name' => 'required| min:4',
        'email' => 'email|required|unique:users',
        'password' => 'required| min:4'
        ]);

        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
            ]);

        $user->save();
        auth()->login($user);
        return redirect()->route('user.profile');
    }
    public function getSignin(){
        return view('user.signin');
    }

    public function postSignin(Request $request){
        $this->validate($request, [
            'email' => 'email| required',
            'password' => 'required| min:4'
        ]);
         if(Auth::attempt(['email' => $request->input('email'),'password' => $request->input('password')])){
            return redirect()->route('user.profile');
        }else{
            return redirect()->back();
        };
     }

     public function getProfile() {
        //$orders = Auth::user()->with('orders')->get();
        $orders = Auth::user()->orders;
        // dd($orders);
        $orders->transform(function($order, $key){
            $order->cart = unserialize($order->cart);
            return $order;
        });

        return view('user.profile',compact('orders'));
    }
    public function getLogout(){
        auth()->logout();
        return redirect()->route('product.index');
    }
}