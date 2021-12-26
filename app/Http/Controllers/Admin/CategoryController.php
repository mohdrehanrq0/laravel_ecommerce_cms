<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
   
    public function index()
    {
        $result['data'] = category::all();
        // echo '<pre>';
        // print_r($result);
        // die();

        
        return view('admin.category',$result);
    }
    public function manage_category(Request $req,$id=''){
        if($id>0){
           $arr = category::find($id);
           $result['cat_name'] = $arr->category_name;
           $result['cat_slug'] = $arr->category_slug;
           $result['parent_category_id'] = $arr->parent_category_id;
           $result['category_image'] = $arr->category_image;
           $result['is_home'] = $arr->is_home;
           $result['id'] = $arr->id;
        }else{
            $result['cat_name'] = '';
            $result['cat_slug'] = '';
            $result['parent_category_id'] = '';
           $result['category_image'] = '';
           $result['is_home'] = '';
            $result['id'] = 0;
        }

        $result['cat_table'] = DB::table('categories')->where('id','!=',$id)->where('status','1')->get();
        return view('admin.manage-category',$result);
    }
    public function manage_category_process(Request $req){
        $req->validate([
            'category_name'=>'required',
            'category_image'=>'mimes:jpg,jpeg,png',
            'category_slug'=>'required|unique:categories,category_slug,'.$req->input('id'),
        ]);
        if($req->input('id') != 0){
            $category = category::find($req->input('id'));
            $msg = 'Category Updated Successfully';
        }else{
            $category = new category;
            $msg = 'Category added successfully';
        }        
        if ($req->hasfile('category_image')) {
            
            $procat = DB::table('categories')->where(['id'=>$req->input('id')])->get();
            if($req->input('id') != 0){
                if (file_exists('upload/media/category/'.$procat['0']->category_image)) {
                    unlink('upload/media/category/'.$procat['0']->category_image);
                }
            }

            $file = $req->file('category_image');
            $ext = $file->extension();
            $filename = time() . '.' . $ext;
            $file->move('upload/media/category/',$filename);
            $category->category_image = $filename;
        }
        $category->category_name = $req->category_name;
        $category->category_slug = $req->category_slug;
        $category->parent_category_id = $req->parent_category_id;
        $category->is_home = $req->is_home;
        $category->status = 1;
        $category->save();
        $req->session()->flash('msg',$msg);
        return redirect('admin/category');
    }
    public function delete(Request $req,$id){
        $category = category::find($id);
        $category->delete();
        $req->session()->flash('msg','Category deleted successfully');
        return redirect('admin/category');
    }
    public function status(Request $req,$status,$id){
        $category = category::find($id);
        $category->status = $status;
        $category->save();
        $req->session()->flash('msg','Status Updated successfully');
        return redirect('admin/category');
    }


}