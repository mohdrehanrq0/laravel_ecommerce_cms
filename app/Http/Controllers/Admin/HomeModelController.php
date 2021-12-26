<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\homeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeModelController extends Controller
{
   public function index()
    {
        $result['data'] = homeModel::all();
        // echo '<pre>';
        // print_r($result);
        // die();
        return view('admin.banner',$result);
    }
    public function manage_banner(Request $req,$id=''){
        if($id>0){
           $arr = homeModel::find($id);
           $result['title'] = $arr->title;
           $result['description'] = $arr->description;
           $result['btn_text'] = $arr->btn_text;
           $result['btn_link'] = $arr->btn_link;
           $result['image'] = $arr->image;
           $result['id'] = $arr->id;
        }else{
            $result['title'] = '';
            $result['description'] = '';
            $result['btn_text'] = '';
            $result['btn_link'] = '';
            $result['image'] = '';
            $result['id'] = 0;
        }
        return view('admin.manage-banner',$result);
    }
    public function manage_banner_process(Request $req){
        $req->validate([
            'image'=>'required|mimes:jpeg,jpg,png',
            'title'=>'required',
            'description'=>'required',
            'btn_text'=>'required',
            'btn_link'=>'required',
        ]);
        if($req->input('id') != 0){
            $banner = homeModel::find($req->input('id'));
            $msg = 'Banner Updated Successfully';
        }else{
            $banner = new homeModel;
            $msg = 'Banner added successfully';
        }     
        if($req->hasfile('image')){

         $probanner = DB::table('home_models')->where(['id'=>$req->input('id')])->get();
            if($req->input('id') != 0){
                if (file_exists('upload/media/banner/'.$probanner['0']->image)) {
                    unlink('upload/media/banner/'.$probanner['0']->image);
                }
            }

           $file = $req->file('image');
           $ext = $file->extension();
           $filename = time().'.'.$ext;
           $file->move('upload/media/banner/',$filename);
           $banner->image = $filename;
        }
        $banner->title = $req->title;
        $banner->description = $req->description;
        $banner->btn_text = $req->btn_text;
        $banner->btn_link = $req->btn_link;
        $banner->status = 1;
        $banner->save();
        $req->session()->flash('msg',$msg);
        return redirect('admin/banner');
    }
    public function delete(Request $req,$id){
        $banner = homeModel::find($id);
        $banner->delete();
        $req->session()->flash('msg','Banner deleted successfully');
        return redirect('admin/banner');
    }
    public function status(Request $req,$status,$id){
        $banner = homeModel::find($id);
        $banner->status = $status;
        $banner->save();
        $req->session()->flash('msg','Status Updated successfully');
        return redirect('admin/banner');
    }
}
