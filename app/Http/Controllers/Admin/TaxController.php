<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function index()
    {
        $result['data'] = tax::all();
        // echo '<pre>';
        // print_r($result);
        // die();
        return view('admin.tax',$result);
    }
    public function manage_tax(Request $req,$id=''){
        if($id>0){
           $arr = tax::find($id);
           $result['tax_desc'] = $arr->tax_desc;
           $result['tax_value'] = $arr->tax_value;
           $result['id'] = $arr->id;
        }else{
            $result['tax_desc'] = '';
            $result['tax_value'] = '';
            $result['id'] = 0;
        }
        return view('admin.manage-tax',$result);
    }
    public function manage_tax_process(Request $req){
        $req->validate([
            'tax_value'=>'required|unique:taxes,tax_value,'.$req->input('id'),
        ]);
        if($req->input('id') != 0){
            $tax = tax::find($req->input('id'));
            $msg = 'Tax Updated Successfully';
        }else{
            $tax = new tax;
            $msg = 'Tax added successfully';
        }        
        $tax->tax_desc = $req->tax_desc;
        $tax->tax_value = $req->tax_value;
        $tax->status = 1;
        $tax->save();
        $req->session()->flash('msg',$msg);
        return redirect('admin/tax');
    }
    public function delete(Request $req,$id){
        $tax = tax::find($id);
        $tax->delete();
        $req->session()->flash('msg','Tax deleted successfully');
        return redirect('admin/tax');
    }
    public function status(Request $req,$status,$id){
        $tax = tax::find($id);
        $tax->status = $status;
        $tax->save();
        $req->session()->flash('msg','Status Updated successfully');
        return redirect('admin/tax');
    }
}
