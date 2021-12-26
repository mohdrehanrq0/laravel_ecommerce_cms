<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $result['data'] = size::all();
        // echo '<pre>';
        // print_r($result);
        // die();
        return view('admin.size',$result);
    }
    public function manage_size(Request $req,$id=''){
        if($id>0){
           $arr = size::find($id);
           $result['size'] = $arr->size;
           $result['id'] = $arr->id;
        }else{
            $result['size'] = '';
            $result['id'] = 0;
        }
        return view('admin.manage-size',$result);
    }
    public function manage_size_process(Request $req){
        $req->validate([
            'size'=>'required|unique:sizes,size,'.$req->input('id'),
        ]);
        if($req->input('id') != 0){
            $size = size::find($req->input('id'));
            $msg = 'Size Updated Successfully';
        }else{
            $size = new size;
            $msg = 'Size added successfully';
        }        
        $size->size = $req->size;
        $size->status = 1;
        $size->save();
        $req->session()->flash('msg',$msg);
        return redirect('admin/size');
    }
    public function delete(Request $req,$id){
        $size = size::find($id);
        $size->delete();
        $req->session()->flash('msg','Size deleted successfully');
        return redirect('admin/size');
    }
    public function status(Request $req,$status,$id){
        $size = size::find($id);
        $size->status = $status;
        $size->save();
        $req->session()->flash('msg','Status Updated successfully');
        return redirect('admin/size');
    }
}