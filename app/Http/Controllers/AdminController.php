<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function getLogin(){
        return view('admin.login');
    }

    public function postLogin(Request $request){
        $this->validate($request,[
            'name' =>'required',
            'password' => 'required'
        ]);

        if(!Auth::attempt(['name'=>$request['name'],'password'=>$request['password']])){
            return redirect()->back()->with(['fail'=>'Could not login']);
        }
        return redirect()->route('admin.dashboard');
    }

    public function getDashboard(){
        if(!Auth::check()){
            return redirect()->back();
        }
        $authors = Author::all();
        return view('admin.dashboard',['authors'=>$authors]);
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->route('index');
    }
}
