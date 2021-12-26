<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function index()
    {
        $result['data'] = brand::all();
        // echo '<pre>';
        // print_r($result);
        // die();
        return view('admin.brand',$result);
    }
    public function manage_brand(Request $req,$id=''){
        if($id>0){
           $arr = brand::find($id);
           $result['brand'] = $arr->brand;
           $result['brand_image'] = $arr->brand_image;
           $result['is_home'] = $arr->is_home;
           $result['id'] = $arr->id;
        }else{
            $result['brand'] = '';
            $result['brand_image'] = '';
            $result['is_home'] = '';
            $result['id'] = 0;
        }
        return view('admin.manage-brand',$result);
    }
    public function manage_brand_process(Request $req){
        $req->validate([
            'brand'=>'required|unique:brands,brand,'.$req->input('id'),
        ]);
        if($req->input('id') != 0){
            $brand = brand::find($req->input('id'));
            $msg = 'Brand Updated Successfully';
        }else{
            $brand = new brand;
            $msg = 'Brand added successfully';
        }   
        if($req->hasfile('brand_image')){

            $procat = DB::table('brands')->where(['id'=>$req->input('id')])->get();
            
            if($req->input('id') != 0){
                if (file_exists('upload/brands/'.$procat['0']->brand_image)) {
                    unlink('upload/brands/'.$procat['0']->brand_image);
                }
            }

            $file = $req->file('brand_image');
            $ext = $file->extension();
            $file_name = time() . '.' . $ext;
            $file->move('upload/brands/',$file_name);
            $brand->brand_image = $file_name;
        }     
        $brand->brand = $req->brand;
        $brand->is_home = $req->is_home;
        $brand->status = 1;
        $brand->save();
        $req->session()->flash('msg',$msg);
        return redirect('admin/brand');
    }
    public function delete(Request $req,$id){
        $brand = brand::find($id);
        $brand->delete();
        $req->session()->flash('msg','Brand deleted successfully');
        return redirect('admin/brand');
    }
    public function status(Request $req,$status,$id){
        $brand = brand::find($id);
        $brand->status = $status;
        $brand->save();
        $req->session()->flash('msg','Status Updated successfully');
        return redirect('admin/brand');
    }
}