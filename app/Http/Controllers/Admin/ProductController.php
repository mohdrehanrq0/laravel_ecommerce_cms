<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\product;
use Illuminate\Support\Facades\DB;
use Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $result['data'] = product::all();
        // echo '<pre>';
        // foreach ($result['data'] as $list){
        //     $cat = DB::table('categories')->where(['id'=>$list->category_id])->get();
        //     print_r($cat['0']->category_name);
        // }
        //     echo '<br>';
        // die();
        // $result['category'] = DB::table('categories')->where(['id'=>$arr->category_id])->get();
        return view('admin.product',$result);
    }
    public function manage_product(Request $req,$id=''){

        if($id>0){
           $arr = product::find($id);
           $result['id'] = $arr->id;
           $result['category_id'] = $arr->category_id;
           $result['name'] = $arr->name;
           $result['image'] = $arr->image;
           $result['slug'] = $arr->slug;
           $result['brand_id'] = $arr->brand_id;
           $result['model'] = $arr->model;
           $result['short_desc'] = $arr->short_desc;
           $result['description'] = $arr->description;
           $result['keywords'] = $arr->keywords;
           $result['technical_specification'] = $arr->technical_specification;
           $result['uses'] = $arr->uses;
           $result['warranty'] = $arr->warranty;    
           $proAttr = DB::table('product_attr')->where(['product_id'=>$id])->get();
           $proImage = DB::table('product_images')->where(['product_id'=>$id])->get();

           
           if (!isset($proImage['0'])) {
                $result['productimgArr']['0']['id'] = '';
                $result['productimgArr']['0']['product_id'] = '';
                $result['productimgArr']['0']['image'] = '';
           }else{
               $result['productimgArr'] = $proImage;    
           } 
           
           if(!isset($proAttr['0'])) {
                $result['productattrArr']['0']['id'] = '';
                $result['productattrArr']['0']['product_id'] = '';
                $result['productattrArr']['0']['sku'] = '';
                $result['productattrArr']['0']['image_attr'] = '';
                $result['productattrArr']['0']['mrp'] = '';
                $result['productattrArr']['0']['price'] = '';
                $result['productattrArr']['0']['qty'] = '';
                $result['productattrArr']['0']['size_id'] = '';
                $result['productattrArr']['0']['color_id'] = '';
           }else{
                $result['productattrArr'] = $proAttr;
           }

           $result['lead_time'] = $arr->lead_time;
           $result['tax_id'] = $arr->tax_id;
           $result['is_promo'] = $arr->is_promo;
           $result['is_featured'] = $arr->is_featured;
           $result['is_discounted'] = $arr->is_discounted;
           $result['is_trending'] = $arr->is_trending;
           

        //    echo '<pre>';
        //     print_r($proAttr);
        //     die();
           
        

        }else{
            $result['id'] = 0;
            $result['category_id'] = '';
            $result['name'] = '';
            $result['image'] = '';
            $result['slug'] = '';
            $result['brand_id'] = '';
            $result['model'] = '';
            $result['short_desc'] = '';
            $result['description'] = '';
            $result['keywords'] = '';
            $result['technical_specification'] = '';
            $result['uses'] = '';
            $result['warranty'] = '';

            $result['lead_time'] = '';
            $result['tax_id'] = '';
            $result['is_promo'] = '';
            $result['is_featured'] = '';
            $result['is_discounted'] = '';
            $result['is_trending'] = '';

            $result['productattrArr']['0']['id'] = '';
            $result['productattrArr']['0']['product_id'] = '';
            $result['productattrArr']['0']['sku'] = '';
            $result['productattrArr']['0']['image_attr'] = '';
            $result['productattrArr']['0']['mrp'] = '';
            $result['productattrArr']['0']['price'] = '';
            $result['productattrArr']['0']['qty'] = '';
            $result['productattrArr']['0']['size_id'] = '';
            $result['productattrArr']['0']['color_id'] = '';

            $result['productimgArr']['0']['id'] = '';
            $result['productimgArr']['0']['product_id'] = '';
            $result['productimgArr']['0']['image'] = '';
        }

        
        $result['category'] = DB::table('categories')->where(['status'=>1])->get();
        $result['brand'] = DB::table('brands')->where(['status'=>1])->get();
        $result['sizes'] = DB::table('sizes')->where(['status'=>1])->get();
        $result['colors'] = DB::table('colors')->where(['status'=>1])->get();
        $result['tax'] = DB::table('taxes')->where(['status'=>1])->get();
        return view('admin.manage-product',$result);
    }
    public function manage_product_process(Request $req){
        // echo '<pre>';
        // print_r($pimage_idArr);
        // die();
        if($req->input('id') != 0){
            $imageValidation = 'image|mimes:jpeg,png,jpg';
        }else{
            $imageValidation = 'required|image|mimes:jpeg,png,jpg';
        }
        
        $req->validate([
            'category_id'=>'required',
            'name'=>'required',
            'image'=>$imageValidation,
            'brand_id'=>'required',
            'model'=>'required',
            'short_desc'=>'required',
            'description'=>'required',
            'keywords'=>'required',
            'technical_specification'=>'required',
            'uses'=>'required',
            'warranty'=>'required',
            'slug'=>'required|unique:products,slug,'.$req->input('id'),
            'image_attr.*' => 'mimes:jpeg,jpg,png',
        ]);
        if($req->input('id') != 0){
            $product = product::find($req->input('id'));
            $msg = 'product Updated Successfully';
        }else{
            $product = new product;
            $msg = 'product added successfully';
        }
        
        if($req->hasfile('image')){
            
            $procat = DB::table('products')->where(['id'=>$req->input('id')])->get();
            if($req->input('id') != 0){
                if (file_exists('upload/media/product/'.$procat['0']->image)) {
                    unlink('upload/media/product/'.$procat['0']->image);
                }
            }

            $file = $req->file('image');
            $file_extension = $file->extension();
            $file_name = time() . '.' . $file_extension;
            $file->move('upload/media/product/',$file_name);
            $product->image = $file_name;
        }


        $product->category_id = $req->category_id;
        $product->name = $req->name;
        $product->slug = $req->slug;
        $product->brand_id = $req->brand_id;
        $product->model = $req->model;
        $product->short_desc = $req->short_desc;
        $product->description = $req->description;
        $product->keywords = $req->keywords;
        $product->technical_specification = $req->technical_specification;
        $product->uses = $req->uses;
        $product->warranty = $req->warranty;

        $product->lead_time = $req->lead_time;
        $product->tax_id = $req->tax_id;
        $product->is_promo = $req->is_promo;
        $product->is_featured = $req->is_featured;
        $product->is_discounted = $req->is_discounted;
        $product->is_trending = $req->is_trending;
        

        $product->status = 1;
        $product->save();
        $product_id = $product->id;

        /*Product Attribute Controller start */
        $pattr_idArr = $req->pattr_id;
        $skuArr = $req->sku;
        $image_attrArr = $req->image_attr;
        $mrpArr = $req->mrp;
        $priceArr = $req->price;
        $qtyArr = $req->qty;
        $size_idArr = $req->size;
        $color_idArr = $req->color;

        // Product Attribbute Validation Start here
        foreach ($skuArr as $key=>$val) {
            $check = DB::table('product_attr')->where('sku',$skuArr[$key])->where('id','!=',$pattr_idArr[$key])->get();

            if (isset($check['0'])) {
                $req->session()->flash('skuerror',$skuArr[$key].' SKU already exists.');
                return back();
                die();
            }
        }
        // Product Attribbute Validation End here
    
        foreach ($skuArr as $key=>$val) {
            $ins = [];
            $ins['product_id'] = $product_id;
            $ins['sku'] = $skuArr[$key];
            //$ins['image_attr'] = $image_attrArr[$key];
            $ins['price'] = (int)$priceArr[$key];
            $ins['mrp'] = (int)$mrpArr[$key];
            $ins['qty'] = (int)$qtyArr[$key];
            if($size_idArr[$key] == ''){
                $ins['size_id'] = 0;
            }else{
                $ins['size_id'] = $size_idArr[$key];
            }
            if($color_idArr[$key] == ''){
                $ins['color_id'] = 0;
            }else{
                $ins['color_id'] = $color_idArr[$key];
            }           
            $ins['updated_at'] = date('Y-m-d H:i:s');
            $ins['created_at'] = date('Y-m-d H:i:s');

            if($req->hasfile("image_attr.$key")){
                if($pattr_idArr[$key] != ''){
                    // dd($pattr_idArr[$key]);
                    $productAttrArray = DB::table('product_attr')->where(['id'=>$pattr_idArr[$key]])->get();
                    if (file_exists('upload/media/product/'.$productAttrArray['0']->image_attr)) {
                        unlink('upload/media/product/'.$productAttrArray['0']->image_attr);
                    }
                }
                $rand = rand('111111111','999999999');
                $file = $req->file("image_attr.$key");
                $file_extension = $file->extension();
                $file_name = time().$rand. '.' . $file_extension;
                $file->move('upload/media/product/',$file_name);
                $ins['image_attr'] = $file_name;
            }
            // else{
            //     $ins['image_attr'] = 'no-image.png';
            // }

            if ($pattr_idArr[$key] != '') {
                DB::table('product_attr')->where(['id' => $pattr_idArr[$key]])->update($ins);

            }else{
                DB::table('product_attr')->insert($ins);
            }
        }
        /*Product Attribute Controller end */

        // Product Image Controller Start
        
        $pimage_idArr = $req->pimage_id;

        foreach($pimage_idArr as $key=>$val){
            $insProduct = [];

            if($req->hasfile("pro_image.$key")){
                if($pimage_idArr[$key] != ''){
                    // dd($pattr_idArr[$key]);
                    $productAttrArray = DB::table('product_images')->where(['id'=>$pimage_idArr[$key]])->get();
                    if (file_exists('upload/media/product/'.$productAttrArray['0']->image)) {
                        unlink('upload/media/product/'.$productAttrArray['0']->image);
                    }
                }

                $rand = rand('111','999');
                $file = $req->file("pro_image.$key");
                $file_extension = $file->extension();
                $file_name = time().$rand. '.' . $file_extension;
                $file->move('upload/media/product/',$file_name);
                $insProduct['image'] = $file_name;
            }
            else{
                $insProduct['image'] = 'no-image.png';

            }

            
            $insProduct['product_id'] = $product_id;

            if ($pimage_idArr[$key] != '') {
                DB::table('product_images')->where(['id' => $pimage_idArr[$key]])->update($insProduct);

            }else{
                DB::table('product_images')->insert($insProduct);
            }
        }


        // Product Image Controller End


        $req->session()->flash('msg',$msg);
        return redirect('admin/product');
    }
    public function delete(Request $req,$id){
        $product = product::find($id);
        $product->delete();
        $req->session()->flash('msg','Product deleted successfully');
        return redirect('admin/product');
    }
    public function product_attr_delete(Request $req,$id){
        $productAttrArray = DB::table('product_attr')->where(['id'=>$id])->get();
        // dd($imageArray['0']->image);
        if (file_exists('upload/media/product/'.$productAttrArray['0']->image_attr)) {
            unlink('upload/media/product/'.$productAttrArray['0']->image_attr);
        }
        DB::table('product_attr')->where(['id'=>$id])->delete();
        $req->session()->flash('msg','Product Attribute deleted successfully');
        return back();
    }
    public function product_image_delete(Request $req,$id){

        $imageArray = DB::table('product_images')->where(['id'=>$id])->get();
        // dd($imageArray['0']->image);
        if (file_exists('upload/media/product/'.$imageArray['0']->image)) {
            unlink('upload/media/product/'.$imageArray['0']->image);
        }
        
        DB::table('product_images')->where(['id'=>$id])->delete();
        $req->session()->flash('msg','Product Image deleted successfully');
        return back();
    }
    public function status(Request $req,$status,$id){
        $product = product::find($id);
        $product->status = $status;
        $product->save();
        $req->session()->flash('msg','Status Updated successfully');
        return redirect('admin/product');
    }
}