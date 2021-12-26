<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         if($request->session()->has('admin_login') && $request->session()->has('user') && $request->session()->has('user_id')){
             return redirect('admin/dashboard');
         }else{
            return view('admin.login');
         }
    }

   
    public function auth(Request $request)
    {
       $email =$request->input('email');
       $password =$request->input('password');
       $user = admin::where('email',$email)->first();
       if($user && Hash::check($password, $user->password)){
           $request->session()->put('user',$user);
           $request->session()->put('admin_login',true);
           $request->session()->put('user_id',$user->id);
           return redirect('admin/dashboard');
       }else{
           $request->session()->flash('msg','Please enter the correct email and password');
           return redirect('admin');
       }
    }
    public function dashboard(){
        return view('admin.dashboard');
    }

}