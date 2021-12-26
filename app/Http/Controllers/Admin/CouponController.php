<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $result['data'] = coupon::all();
        // echo '<pre>';
        // print_r($result);
        // die();
        return view('admin.coupon',$result);
    }
    public function manage_coupon(Request $req,$id=''){
        if($id>0){
           $arr = coupon::find($id);
           $result['title'] = $arr->title;
           $result['code'] = $arr->code;
           $result['value'] = $arr->value;
           $result['type'] = $arr->type;
           $result['min_order_amount'] = $arr->min_order_amount;
           $result['is_one_time'] = $arr->is_one_time;
           $result['id'] = $arr->id;
        }else{
            $result['title'] = '';
            $result['code'] = '';
            $result['value'] = '';
            $result['type'] = '';
            $result['min_order_amount'] = '';
            $result['is_one_time'] = '';
            $result['id'] = 0;
        }
        return view('admin.manage-coupon',$result);
    }
    public function manage_coupon_process(Request $req){
        $req->validate([
            'title'=>'required',
            'code'=>'required|unique:coupons,code,'.$req->input('id'),
            'value'=>'required',
        ]);
        if($req->input('id') != 0){
            $coupon = coupon::find($req->input('id'));
            $msg = 'Coupon Updated Successfully';
        }else{
            $coupon = new coupon;
            $msg = 'Coupon added successfully';
        }        
        $coupon->title = $req->title;
        $coupon->code = $req->code;
        $coupon->value = $req->value;
        $coupon->type = $req->type;
        $coupon->min_order_amount = $req->min_order_amount;
        $coupon->is_one_time = $req->is_one_time;
        $coupon->status = 1;
        $coupon->save();
        $req->session()->flash('msg',$msg);
        return redirect('admin/coupon');
    }
    public function delete(Request $req,$id){
        $coupon = coupon::find($id);
        $coupon->delete();
        $req->session()->flash('msg','Coupon deleted successfully');
        return redirect('admin/coupon');
    }
    public function status(Request $req,$status,$id){
        $coupon = coupon::find($id);
        $coupon->status = $status;
        $coupon->save();
        $req->session()->flash('msg','Status Updated successfully');
        return redirect('admin/coupon');
    }
}