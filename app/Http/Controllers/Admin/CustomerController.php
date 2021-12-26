<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $result['data'] = customer::all();
        // echo '<pre>';
        // print_r($result);
        // die();
        return view('admin.customer',$result);
    }
    public function show(Request $req,$id=''){
        $arr = customer::find($id);
        $result['customer_list'] = $arr;
        //dd($result['customer_list']);
        return view('admin.show_customer',$result);
    }

    public function status(Request $req,$status,$id){
        $customer = customer::find($id);
        $customer->status = $status;
        $customer->save();
        $req->session()->flash('msg','Status Updated successfully');
        return redirect('admin/customer');
    }
}
