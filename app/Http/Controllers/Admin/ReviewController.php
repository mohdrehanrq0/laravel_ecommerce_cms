<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    function index(){
        $result['review'] = DB::table('reviews')->leftJoin('products','products.id','=','reviews.product_id')->orderBy('reviews.status','asc')->select('products.name as pname','reviews.*')->get();
        foreach($result['review'] as $list){
            $result['review_customer'][$list->id] = DB::table('customers')->where('id',$list->customer_id)->get();
        }
        
        return view('admin.review',$result);
    }

    function review_process(Request $req,$status,$id){
        DB::table('reviews')->where('id',$id)->update(['status'=>$status]);
        $req->session()->flash('msg','Review status updated successfully');
        return redirect('/admin/reviews');   
    }
}
