<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $result['order'] = DB::table('orders')->get();

        return view('admin.order',$result);
    }
    function order_detail(Request $req,$id){
        
        $result['order_details'] = DB::table('order_details')
                                   ->leftJoin('orders','orders.id','=','order_details.order_id')
                                   ->leftJoin('products','products.id','=','order_details.product_id')
                                   ->leftJoin('product_attr','product_attr.id','=','order_details.product_attr_id')
                                   ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
                                   ->leftJoin('colors','colors.id','=','product_attr.color_id')
                                   ->select('order_details.price as order_price','order_details.qty as order_qty','orders.*','products.name as product_name','sizes.size','colors.color','product_attr.image_attr')
                                   ->where('orders.id',$id)
                                   ->get();

        $result['orderStatus'] = ['PLACED ORDER','ON THE WAY','DELIVERED'];
        $result['paymentStatus'] = ['Pending','Success','Fail'];
        
        return view('admin.order_detail',$result);
        
    }
    function orderStatus($status,$id){
        if($status != '' && $id != ''){
            DB::table('orders')->where('id',$id)->update(['order_status'=>$status]);
            return redirect()->back();
        }
    }
    function paymentStatus($status,$id){
        if($status != '' && $id != ''){
            DB::table('orders')->where('id',$id)->update(['payment_status'=>$status]);
            return redirect()->back();
        }
    }
    function trackStatus(Request $req){
            DB::table('orders')->where('id',$req->post('orderId'))->update(['track_detail'=>$req->post('track_detail')]);
            return redirect('/admin/order_detail/'.$req->post('orderId'));
    }


}
