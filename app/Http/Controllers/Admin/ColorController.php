<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $result['data'] = color::all();
        // echo '<pre>';
        // print_r($result);
        // die();
        return view('admin.color',$result);
    }
    public function manage_color(Request $req,$id=''){
        if($id>0){
           $arr = color::find($id);
           $result['color'] = $arr->color;
           $result['id'] = $arr->id;
        }else{
            $result['color'] = '';
            $result['id'] = 0;
        }
        return view('admin.manage-color',$result);
    }
    public function manage_color_process(Request $req){
        $req->validate([
            'color'=>'required|unique:colors,color,'.$req->input('id'),
        ]);
        if($req->input('id') != 0){
            $color = color::find($req->input('id'));
            $msg = 'Color Updated Successfully';
        }else{
            $color = new color;
            $msg = 'Color added successfully';
        }        
        $color->color = $req->color;
        $color->status = 1;
        $color->save();
        $req->session()->flash('msg',$msg);
        return redirect('admin/color');
    }
    public function delete(Request $req,$id){
        $color = color::find($id);
        $color->delete();
        $req->session()->flash('msg','Color deleted successfully');
        return redirect('admin/color');
    }
    public function status(Request $req,$status,$id){
        $color = color::find($id);
        $color->status = $status;
        $color->save();
        $req->session()->flash('msg','Status Updated successfully');
        return redirect('admin/color');
    }
}