<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Mail;

use Illuminate\Http\Request;

class FrontController extends Controller
{

    public function index(Request $request)
    {
        $result['category'] = DB::table('categories')->where('status',1)->where('is_home',1)->get();
        
        foreach($result['category'] as $category){
            $result['product_home'][$category->id] = 
                DB::table('products')
                ->where('status',1)
                ->where('category_id',$category->id)
                ->get();  
            
                foreach ($result['product_home'][$category->id] as $product_attr) {
                    $result['product_attr'][$product_attr->id] = 
                    DB::table('product_attr')
                    ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
                    ->leftJoin('colors','colors.id','=','product_attr.color_id')
                    ->where('product_attr.product_id',$product_attr->id)->get();
                }



            $result['featured_home'][$category->id] = 
                DB::table('products')
                ->where('status',1)
                ->where('is_featured',1)
                ->get();  
            
                foreach ($result['featured_home'][$category->id] as $product_attr) {
                    $result['featured_home_arr'][$product_attr->id] = 
                    DB::table('product_attr')
                    ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
                    ->leftJoin('colors','colors.id','=','product_attr.color_id')
                    ->where('product_attr.product_id',$product_attr->id)->get();
                }




                $result['discounted_home'] = 
                DB::table('products')
                ->where('status',1)
                ->where('is_discounted',1)
                ->get();  
            
                foreach ($result['discounted_home'] as $product_attr) {
                    $result['discounted_home_arr'][$product_attr->id] = 
                    DB::table('product_attr')
                    ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
                    ->leftJoin('colors','colors.id','=','product_attr.color_id')
                    ->where('product_attr.product_id',$product_attr->id)->get();
                }

                $result['trending_home'] = 
                DB::table('products')
                ->where('status',1)
                ->where('is_trending',1)
                ->get();  
            
                foreach ($result['trending_home'] as $product_attr) {
                    $result['trending_home_arr'][$product_attr->id] = 
                    DB::table('product_attr')
                    ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
                    ->leftJoin('colors','colors.id','=','product_attr.color_id')
                    ->where('product_attr.product_id',$product_attr->id)->get();
                }
            
        }

        $result['home_brands'] = DB::table('brands')->where('status',1)->where('is_home',1)->get();
        $result['banner'] = DB::table('home_models')->where('status',1)->get();


        //dd($result);
        
        return view('front.home',$result);
    }
    public function productShow(Request $req,$slug){
        $result['product'] = 
                DB::table('products')
                ->where('products.status',1)
                ->where('products.slug',$slug)
                ->join('brands','brands.id','=','products.brand_id')
                ->select('products.*','brands.brand')
                ->get();  
            
            foreach ($result['product'] as $product_attr) {
                $result['product_arr'][$product_attr->id] = 
                DB::table('product_attr')
                ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
                ->leftJoin('colors','colors.id','=','product_attr.color_id')
                ->where('product_attr.product_id',$product_attr->id)->get();
            }

            foreach($result['product'] as $productArr){
                $result['product_image'][$productArr->id] = DB::table('product_images')->where('product_id',$productArr->id)->get();
            }
           
        $result['related_product'] = 
            DB::table('products')
            ->where('status',1)
            ->where('category_id',$result['product'][0]->category_id)
            ->where('slug','!=',$slug)
            ->get();

            foreach ($result['related_product'] as $product_attr) {
                $result['related_product_arr'][$product_attr->id] = 
                DB::table('product_attr')
                ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
                ->leftJoin('colors','colors.id','=','product_attr.color_id')
                ->where('product_attr.product_id',$product_attr->id)->get();
            }

            
            if($req->session()->has('FRONT_LOGGEDIN')){
                $uid = $req->session()->get('FRONT_USERID');
                $product_id = $result['product'][0]->id;
                $result['verify'] = DB::table('orders')
                ->leftJoin('order_details','order_details.order_id','=','orders.id')
                ->where('orders.customer_id',$uid)
                ->where('order_details.product_id',$product_id)
                ->select('order_details.*','order_details.id as order_detail_id','orders.*')
                ->get();
            }else{
                $result['verify'] = [];
            }
            $result['review'] = DB::table('reviews')->where('status',1)->get();
            foreach($result['review'] as $list){
                $result['review_customer'][$list->id] = DB::table('customers')->where('id',$list->customer_id)->get();
            }

            //prx($result);

        return view('front.product',$result);
    }

    public function add_cart_url(Request $req){

        if($req->session()->has('FRONT_LOGGEDIN')){
            $userid = $req->session()->get('FRONT_USERID');
            $user_type = "Reg";
        }else{
            $userid = TempUserId();
            $user_type = "Not-Reg";
        }
        $pqty = $req->post('pqty');
        $color = $req->post('color_id_hidden');
        $size = $req->post('size_id_hidden');
        $product_id = $req->post('product_id');

        $product_attr_id = DB::table('product_attr')
                  ->select('product_attr.id')
                  ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
                  ->leftJoin('colors','colors.id','=','product_attr.color_id')
                  ->where('sizes.size',$size)
                  ->where('colors.color',$color)
                  ->where('product_attr.product_id',$product_id)->get();

        $check = DB::table('cart')
                ->where('user_id',$userid)
                ->where('user_type',$user_type)
                ->where('product_id',$product_id)
                ->where('product_attr_id',$product_attr_id[0]->id)
                ->get();

        
        $inventoryCart = getCartQty($product_id,$product_attr_id[0]->id);
        
        if(isset($inventoryCart[0])){
            $finalQty = $inventoryCart[0]->pqty - $inventoryCart[0]->qty;
        
            if($finalQty < $pqty) {
                return response()->json(['status'=>'warning','msg'=>'Only '.$finalQty.' item left']);
            }
            
        }
        

        if(isset($check[0])){
            $update_id = $check[0]->id;
            if($pqty == 0){
                DB::table('cart')->where('id',$update_id)->delete();
                $msg = "Product Deleted Successfully";
            }else{
                DB::table('cart')->where('id',$update_id)->update(['qty'=>$pqty]);
                $msg = "Product Updated Successfully";
            }
            
        }else{
            $id = DB::table('cart')->insertGetId([
                'user_id'=>$userid,
                'user_type'=>$user_type,
                'qty'=>$pqty,
                'product_id'=>$product_id,
                'product_attr_id'=>$product_attr_id[0]->id
            ]);
            $msg = "Product Added Successfully";
        }

        $data = DB::table('cart')
                ->leftJoin('products','products.id','=','cart.product_id')
                ->leftJoin('product_attr','product_attr.id','=','cart.product_attr_id')
                ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
                ->leftJoin('colors','colors.id','=','product_attr.color_id')
                ->where('user_id',$userid)
                ->where('user_type',$user_type)
                ->select('products.id as pid','products.name','product_attr.price','product_attr.id as attr_id','products.image','sizes.size','colors.color','cart.qty','products.slug')
                ->get();

        return response()->json(['msg'=>$msg,'data'=>$data,'dataCount'=>count($data)]);

    }

    function cart(Request $req){

        if($req->session()->has('FRONT_LOGGEDIN')){
            $userid = $req->session()->get('FRONT_USERID');
            $user_type = "Reg";
        }else{
            $userid = TempUserId();
            $user_type = "Not-Reg";
        }

        $result['list'] = DB::table('cart')
                ->leftJoin('products','products.id','=','cart.product_id')
                ->leftJoin('product_attr','product_attr.id','=','cart.product_attr_id')
                ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
                ->leftJoin('colors','colors.id','=','product_attr.color_id')
                ->where('user_id',$userid)
                ->where('user_type',$user_type)
                ->select('products.id as pid','products.name','product_attr.price','product_attr.id as attr_id','products.image','sizes.size','colors.color','cart.qty','products.slug')
                ->get();
    
        return view('front.cart' ,$result);
    }

    function category(Request $req,$slug){

        $sort = "";
        $sort_txt = "";
        $lower_val = "";
        $upper_val = "";
        $color_filter = "";
        $colorFilterArr = [];

        if($req->get('sort')!=''){
            $sort = $req->get('sort');
        }
     
        $pquery = DB::table('products');
        $pquery = $pquery->leftJoin('categories','categories.id','=','products.category_id');
        $pquery = $pquery->leftJoin('product_attr','product_attr.product_id','=','products.id');
        $pquery = $pquery->where('categories.category_slug',$slug);
        $pquery = $pquery->where('products.status',1);
        if($sort=='name'){
            $pquery = $pquery->orderBy('products.name','asc');
            $sort_txt = "Name";
        }
        if($sort=='date'){
            $pquery = $pquery->orderBy('products.id','desc');
            $sort_txt = "Date";
        }
        if($sort=='price_desc'){
            $pquery = $pquery->orderBy('product_attr.price','desc');
            $sort_txt = "Price Descending Order";
        }
        if($sort=='price_asc'){
            $pquery = $pquery->orderBy('product_attr.price','asc');
            $sort_txt = "Price Acending Order";
        }
        if($req->get('lower_val')!=null && $req->get('upper_val')!=null){
            $lower_val = $req->get('lower_val');
            $upper_val = $req->get('upper_val');
            if($lower_val>0 && $upper_val>0){
                $pquery = $pquery->whereBetween('product_attr.price',[$lower_val,$upper_val]);
            }
        }
        if($req->get('color_filter')!=null){
            $color_filter = $req->get('color_filter');
            $colorFilterArr = explode(':',$color_filter);
            $colorFilterArr = array_filter($colorFilterArr);
            $pquery = $pquery->where('product_attr.color_id',$req->get('color_filter'));
            
        }
        $pquery = $pquery->select('products.*','categories.category_name');
        $pquery = $pquery->distinct()->get();
        $result['product'] = $pquery;


        foreach($result['product'] as $product){
            $result['product_attr'][$product->id] = DB::table('product_attr')
                                      ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
                                      ->leftJoin('colors','colors.id','=','product_attr.color_id')
                                      ->where('product_attr.product_id',$product->id)
                                      ->get();
        }       

        $result['cat_name'] = DB::table('categories')->where('category_slug',$slug)->select('category_name')->get();
        $result['left_cat'] = DB::table('categories')->where('status',1)->get();

        $result['slug'] = $slug;
        $result['sort'] = $sort;
        $result['sort_txt'] = $sort_txt;

        $result['lower_val'] = $lower_val;
        $result['upper_val'] = $upper_val;
        $result['color_filter'] = $color_filter;
        $result['colorFilterArr'] = $colorFilterArr;


        $result['colors'] = DB::table('colors')->where('status',1)->get();


        return view('front.category',$result);
    }
    function search($str){

     
        $pquery = DB::table('products');
        $pquery = $pquery->leftJoin('categories','categories.id','=','products.category_id');
        $pquery = $pquery->leftJoin('product_attr','product_attr.product_id','=','products.id');
        $pquery = $pquery->where('products.status',1);
        $pquery = $pquery->where('products.name','like',"%$str%");
        $pquery = $pquery->orwhere('products.model','like',"%$str%");
        $pquery = $pquery->orwhere('products.short_desc','like',"%$str%");
        $pquery = $pquery->orwhere('products.description','like',"%$str%");
        $pquery = $pquery->orwhere('products.keywords','like',"%$str%");
        $pquery = $pquery->orwhere('products.technical_specification','like',"%$str%");
        $pquery = $pquery->orwhere('products.uses','like',"%$str%");
        $pquery = $pquery->select('products.*','categories.category_name');
        $pquery = $pquery->distinct()->get();
        $result['product'] = $pquery;


        foreach($result['product'] as $product){
            $result['product_attr'][$product->id] = DB::table('product_attr')
                                      ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
                                      ->leftJoin('colors','colors.id','=','product_attr.color_id')
                                      ->where('product_attr.product_id',$product->id)
                                      ->get();
        }       

        //$result['cat_name'] = DB::table('categories')->where('category_slug',$slug)->select('category_name')->get();
       
        
        return view('front.search',$result);
    }

    function register(Request $req){
        if($req->session()->has('FRONT_LOGGEDIN') && $req->session()->has('FRONT_LOGGEDIN') != null){
            return redirect('/');
        }
        $result['country'] = DB::table('countries')->orderBy('name', 'ASC')->get();
        return view('front.register',$result);
    }
    function statefinder(Request $req){
        $cid = $req->post('cid');
        $html = '<option value="0">Select State</option>';
        $states = DB::table('states')->where('country_id',$cid)->orderBy('name','ASC')->get();
        foreach($states as $state){
            $html .= '<option value="'.$state->id.'">'.$state->name.'</option>'; 
        }
        return $html;
    }
    
    function cityfinder(Request $req){
        $sid = $req->post('sid');
        $html = '<option value="0">Select Cities</option>';
        $cities = DB::table('cities')->where('state_id',$sid)->orderBy('name','ASC')->get();
        foreach($cities as $city){
            $html .= '<option value="'.$city->id.'">'.$city->name.'</option>'; 
        }
        return $html;
    }


    function frmRegistration(Request $req){
        $valid = Validator::make($req->all(),[
             'name'=>'required',
             'email'=>'required|email|unique:customers,email',
             'mobile'=>'required|min:10',
             'country'=>'required',
             'state'=>'required',
             'city'=>'required',
             'zip'=>'required',
             'address'=>'required'
        ]);

        if(!$valid->passes()) {
            return response()->json(['status'=>'error','msg'=>$valid->errors()]);
        }else{
            $pass = $req->post('pwd');
            $cpass = $req->post('cpwd');
            $rand_id = Crypt::encrypt(rand(11111111,99999999));
           
            if($pass == $cpass){
                $arr = [
                    'name'=> $req->post('name'),
                    'email'=>$req->post('email'),
                    'mobile'=>$req->post('mobile'),
                    'country'=>$req->post('country'),
                    'state'=>$req->post('state'),
                    'city'=>$req->post('city'),
                    'zip'=>$req->post('zip'),
                    'is_verify'=>0,
                    'rand_id'=>$rand_id,
                    'address'=>$req->post('address'),
                    'company'=>$req->post('company'),
                    'password'=>Crypt::encrypt($req->post('pwd')),
                    'gstin'=>$req->post('gstin'),
                    'status'=>1
                ];
                DB::table('customers')->insert($arr);

                $data = ['name'=>$req->post('name'), 'rand_id'=>$rand_id];
                $user = ['to'=>$req->post('email')];
                Mail::send('front/email_template',$data,function($message) use($user) {
                    $message->to($user['to']);
                    $message->subject('Email Verification for FastShop');
                });
                return response()->json(['status'=>'success','msg'=>'Registration done successful.Please check your email for verification.']);
            }else{
                return response()->json(['status'=>'errorpwd','msg'=>"Password doesn't match"]);

            }
        }
    }
    function frmLogin(Request $req){
        $user = DB::table('customers')->where('email',$req->post('lemail'))->get();
        if(isset($user[0])){
            $dbpass = Crypt::decrypt($user[0]->password);
            $pass = $req->post('lpass');
            
            if($pass == $dbpass){

                if($user[0]->is_verify == 0){
                    return response()->json(['status'=>'usererror','msg'=>'This Username is not Verified.']);
                }
                if($user[0]->rand_id != null){
                    return response()->json(['status'=>'usererror','msg'=>'This Username is not Verified.']);
                }

                if($req->post('rememberme') !== null){
                    setcookie('lemail', $user[0]->email,time()+60*60*24*30);
                    setcookie('lpass',$pass,time()+60*60*24*30);
                }else{
                    setcookie('lemail', $user[0]->email,30);
                    setcookie('lpass',$pass,30);
                }
           
                $req->session()->put('FRONT_LOGGEDIN',true);
                $req->session()->put('FRONT_USERNAME',$user[0]->name);
                $req->session()->put('FRONT_USERID',$user[0]->id);
                $req->session()->flash('loginmsg','login successful');
                return response()->json(['status' => 'loginsuccess','msg'=>'Logging Successfully. ']);
            }else{
                return response()->json(['status'=>'passerror','msg'=>'Invalid Password']);
            }
        }else{
            return response()->json(['status'=>'usererror','msg'=>'Invalid Username']);
        }
    }
    function verification(Request $req,$id){
        $is_login = $req->session()->has('FRONT_LOGGEDIN');
        if($is_login){
            $login_id = $req->session()->get('FRONT_USERID');
            $user = DB::table('customers')->where('rand_id',$id)->get();
            
            if(isset($user[0])){
                if($user[0]->id == $login_id){
                    DB::table('customers')->where('id',$login_id)->update(['is_verify'=>1,'rand_id'=>'']);
                    return view('front.verify');
                }else{
                    return redirect('/');
                }
            }else{
                return redirect('/');
            }

        }else{
            $req->session()->flash('verify_msg','Please Login to verify your email.');
            return redirect('/');
        }
    } 
    function forget_pass_email(Request $req){
        $forget_email = $req->post('forgot_email_address');
        $rand_id = Crypt::encrypt(rand(11111111,99999999));
        $valid = Validator::make($req->all(),[
            'forgot_email_address'=>'required|email'
        ]);
        if(!$valid->passes()){
            return response()->json(['status' => 'error','msg'=>$valid->errors()]);
        }else{
            $check_user = DB::table('customers')->where('email',$forget_email)->where('is_verify',1)->get();
            if(isset($check_user[0])){
                DB::table('customers')->where('email',$forget_email)->update(['is_forgot_password'=>1,'rand_id'=>$rand_id]);
                $data = ['name'=>$check_user[0]->name,'rand_id'=>$rand_id];
                $user = ['to'=>$forget_email];
                Mail::send('front/forgot_password_template',$data,function($message) use($user){
                    $message->to($user['to']);
                    $message->subject('Forgot Password ...');
                });
                return response()->json(['status' => 'success','msg'=>'Please check your email']);
            }else{
                return response()->json(['status' => 'merror','msg'=>'Invalid Email Address']);
            }
        }
        

    }
    function forgot_password(Request $req,$id){
        $user = DB::table('customers')->where('rand_id',$id)->get();
        if(isset($user[0])){
            $req->session()->put('FORGOT_RAND_ID',$id);
            return view('front.forgot_password');
        }else{
            return redirect('/');
        }
    }
    function update_password_process(Request $req){
        $id = $req->session()->get('FORGOT_RAND_ID');
        $pass = $req->post('npass');
        $cpass = $req->post('ncpass');
        if($cpass == $pass){
            DB::table('customers')->where('rand_id', $id)->update(['is_forgot_password'=>0,'rand_id'=>'','password'=>Crypt::encrypt($pass)]);
            return response()->json(['status' => 'success','msg' => 'Please login password updated successfully.']);
        }else{
            return response()->json(array('status'=>'error','msg'=>"Password doesn't match."));
        }
    }

    function checkout(Request $req){
        $cart = getCartNav();
        $cartCount = count($cart);
        if($cartCount==0){
            return redirect('/');
        }
        $result['country'] = DB::table('countries')->orderBy('name', 'ASC')->get();
        $result['cart_list'] = getCartNav();
        if($req->session()->has('FRONT_LOGGEDIN') && $req->session()->has('FRONT_USERID')){
            $user_id = session()->get('FRONT_USERID');
            $user = DB::table('customers')->where('id', $user_id)->get();
            $result['name'] = $user[0]->name;
            $result['email'] = $user[0]->email;
            $result['mobile'] = $user[0]->mobile;
            $result['country_id'] = $user[0]->country;
            $result['state_id'] = $user[0]->state;
            $result['city_id'] = $user[0]->city;
            $result['zip'] = $user[0]->zip;
            $result['company'] = $user[0]->company;
            $result['address'] = $user[0]->address;
        }else{
            $result['name'] = '';
            $result['email'] = '';
            $result['mobile'] = '';
            $result['country_id'] = '';
            $result['state_id'] = '';
            $result['city_id'] = '';
            $result['zip'] = '';
            $result['company'] = '';
            $result['address'] = '';
        }
        return view('front.checkout',$result);
        
    }
    function coupon_process(Request $req){
        $coupon = applyCoupon($req->post('couponVal'));
        $coupon = json_decode($coupon,true);

        return response()->json(['status'=>$coupon['status'],'msg'=>$coupon['msg'],'cart_total'=>$coupon['cart_total']]);
    }
    function couponRemove(Request $req){
        $total = 0;
        $cart = getCartNav();
        
        foreach($cart as $list){
            $total += $list->price * $list->qty;
        }

        return response()->json(['status'=>'success','msg'=>'Coupon removed successfully.','cart_total'=>$total]);
    }
    function frmCheckout(Request $req){
        //return $req->post();
        $payment_url = '';
        $txn_id ='';
        $cart = getCartNav();
        $cartCount = count($cart);
        if($cartCount==0){
            return redirect('/');
        }
        $country_id = $req->post('country');
        $state_id = $req->post('state');
        $city_id = $req->post('city');
        $country = DB::table('countries')->where('id',$country_id)->get();
        $country_name = $country[0]->name;  

        $states = DB::table('states')->where('id',$state_id)->get();
        $state_name = $states[0]->name;  

        $city = DB::table('cities')->where('id',$city_id)->get();
        $city_name = $city[0]->name;  

        if($req->session()->has('FRONT_LOGGEDIN') && $req->session()->has('FRONT_LOGGEDIN') != null){

        }else{
            $valid = Validator::make($req->all(),[
                'name'=>'required',
                'email'=>'required|email|unique:customers,email',
                'mobile'=>'required|min:10',
                'country'=>'required',
                'state'=>'required',
                'city'=>'required',
                'zip'=>'required',
                'address'=>'required'
           ]);
   
           if(!$valid->passes()) {
               return response()->json(['status'=>'validator_error','msg'=>$valid->errors(),'payment_url'=>'']);
           }else{
                $rand_id = rand(11111111,99999999);
                $arr = [
                    'name'=> $req->post('name'),
                    'email'=>$req->post('email'),
                    'mobile'=>$req->post('mobile'),
                    'country'=>$req->post('country'),
                    'state'=>$req->post('state'),
                    'city'=>$req->post('city'),
                    'zip'=>$req->post('zip'),
                    'is_verify'=>1,
                    'rand_id'=>Crypt::encrypt($rand_id),
                    'address'=>$req->post('address'),
                    'company'=>$req->post('company'),
                    'password'=>Crypt::encrypt($rand_id),
                    'status'=>1
                ];
                $userId = DB::table('customers')->insertGetId($arr);
                $req->session()->put('FRONT_LOGGEDIN',true);
                $req->session()->put('FRONT_USERNAME',$req->post('name'));
                $req->session()->put('FRONT_USERID',$userId);
                $tempId = TempUserId();
                DB::table('cart')->where(['user_id'=>$tempId,'user_type'=>'Not-Reg'])->update(['user_id'=>$userId, 'user_type'=>'Reg']);

                $data = ['name'=>$req->post('name'),'pass'=>$rand_id];
                $user = ['to'=>$req->post('email')];
                Mail::send('front/password_template',$data,function($message) use($user) {
                    $message->to($user['to']);
                    $message->subject('Password for FastShop');
                });

           }
        }
        
            $uid = $req->session()->get('FRONT_USERID');
            $total = 0;
            
            foreach($cart as $list){
                $total += $list->price * $list->qty;  
            }
            $coupon_total = $total;
            if($req->post('couponInput')!= '' || $req->post('couponValhide')!= ''){
                $coupon = applyCoupon($req->post('couponInput'));
                $coupon = json_decode($coupon,true);
               
                if($coupon['status'] == 'success'){
                    $couponValue = $coupon['couponValue'];
                    $coupon_total = $coupon['cart_total'];
                    $coupon = $req->post('couponInput');
                }else{
                    $status = 'error';
                    $msg = 'Coupon Code is Invalid.';
                }
                
            }else{
                $coupon = 'NO COUPON';
                $couponValue = 0;
            }
            
            if($req->post('payment_type') ==  'ONLINE'){
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
                curl_setopt($ch, CURLOPT_HEADER, FALSE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
                curl_setopt($ch, CURLOPT_HTTPHEADER,
                            array("X-Api-Key:test_d0e215d17d75e604011267e451b",
                                "X-Auth-Token:test_85e26d409489da0640118d504e6"));
                $payload = Array(
                    'purpose' => 'Buy Products',
                    'amount' => $coupon_total,
                    'phone' => $req->post('mobile'),
                    'buyer_name' => $req->post('name'),
                    'redirect_url' => 'http://127.0.0.1:8000/online_payment',
                    'send_email' => true,
                    'send_sms' => true,
                    'email' => $req->post('email'),
                    'allow_repeated_payments' => false
                );
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
                $response = curl_exec($ch);
                curl_close($ch); 
                $response = json_decode($response);
                if(!isset($response->payment_request)){
                    foreach($response->message as $key => $value){
                        $msg = strtoupper($key).": ".$value[0];
                        return response()->json(['status'=>'error', 'msg'=>$msg, 'payment_url'=>'']);
                    }
                }
                $txn_id = $response->payment_request->id;
                $payment_url = $response->payment_request->longurl;

            }
            if($req->post('payment_type') == 'COD'){
                $payment_url='';
            }
            

            $arr = [
                'customer_id'=>$uid,
                'name' => $req->post('name'),
                'email' => $req->post('email'),
                'mobile' => $req->post('mobile'),
                'country' => $country_name,
                'state' => $state_name,
                'city' => $city_name,
                'zip' => $req->post('zip'),
                'company' => $req->post('company'),
                'address' => $req->post('address'),
                'coupon_code' => $coupon,
                'coupon_value' => $couponValue,
                'order_status' => 'PLACED ORDER',
                'payment_type' => $req->post('payment_type'),
                'payment_status' =>'PENDING',
                'payment_id' => 'No ID',
                'txn_id' => $txn_id,
                'total_amt' => $total,
                'coupon_total_amt' => $coupon_total,
            ];
            $order_id = DB::table('orders')->insertGetId($arr);
            
            if($order_id > 0){
                foreach($cart as $list){
                    $arr_detail = [
                        'order_id'=>$order_id,
                        'product_id'=>$list->pid,
                        'product_attr_id'=>$list->attr_id,
                        'price'=>$list->price,
                        'qty'=>$list->qty
                    ];
                    DB::table('order_details')->insert($arr_detail);
                    DB::table('cart')->where(['user_id'=>$uid,'user_type'=>'Reg','qty'=>$list->qty,'product_id'=>$list->pid,'product_attr_id'=>$list->attr_id])->delete();
                }
                $status = 'success';
                $msg = 'Order Placed Successfully';
            }else{
                $status = 'error';
                $msg = 'Please try again after some time';
            }

            
        

        if($status == 'success'){
            $req->session()->put('ORDER_ID',$order_id);
        }
        
        return response()->json(['status'=>$status,'msg'=>$msg,'payment_url'=>$payment_url]);
    }

    function orderplaced(Request $req){
        if($req->session()->has('ORDER_ID')){
            $result['order_id'] = $req->session()->get('ORDER_ID');
            return view('front.order',$result);
        }else{
            return redirect('/');
        }
    }
    function online_payment(Request $req){
        $payment_id = $req->get('payment_id');
        $payment_status = $req->get('payment_status');
        $payment_request_id = $req->get('payment_request_id');
        
        if($payment_id !== null && $payment_status !== null && $payment_request_id !== null){
            if($payment_status == 'Credit'){
                DB::table('orders')->where('id',$req->session()->get('ORDER_ID'))->where('txn_id',$payment_request_id)->update(['payment_status'=>$payment_status,'payment_id'=>$payment_id]);
                return redirect('/orderplaced');
            }else{
                $req->session()->flash('paymentError','Something went wrong.Please try again after some time');
                return redirect('/');
            }
        }else{
            $req->session()->flash('paymentError','Something went wrong.Please try again after some time');
            return redirect('/');
        }
        
    }
    function order(Request $req){
        $uid = $req->session()->get('FRONT_USERID');
        $result['order'] = DB::table('orders')->where('customer_id',$uid)->get();

        return view('front.myorder',$result);
    }
    function order_detail(Request $req,$id){
        $id = base64_decode($id);
        $uid = $req->session()->get('FRONT_USERID');
        $result['order_details'] = DB::table('order_details')
                                   ->leftJoin('orders','orders.id','=','order_details.order_id')
                                   ->leftJoin('products','products.id','=','order_details.product_id')
                                   ->leftJoin('product_attr','product_attr.id','=','order_details.product_attr_id')
                                   ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
                                   ->leftJoin('colors','colors.id','=','product_attr.color_id')
                                   ->select('order_details.price as order_price','order_details.qty as order_qty','orders.*','products.name as product_name','sizes.size','colors.color','product_attr.image_attr')
                                   ->where('orders.customer_id',$uid)
                                   ->where('orders.id',$id)
                                   ->get();
        
        return view('front.myorder_detail',$result);
        
    }
    function newsetter_process(Request $req){
        $email = $req->post('newsletterEmail');
        $check = Validator::make($req->all(),[
            'newsletterEmail'=>'required|email|unique:newsletter,emails'
        ]);
        if(!$check->passes()) {
            return response()->json(['status'=>'validator_error','msg'=>$check->errors()]);
        }else{
            DB::table('newsletter')->insert(['emails'=>$email]);
            return response()->json(['status'=>'success','msg'=>'Thankyou for registering in our newsletter']);
        }


    }
    function rating_process(Request $req){
        if($req->session()->has('FRONT_LOGGEDIN')){
            $uid = $req->session()->get('FRONT_USERID');
            $product_id = $req->post('product_id');
            $verify = DB::table('orders')
                      ->leftJoin('order_details','order_details.order_id','=','orders.id')
                      ->where('orders.customer_id',$uid)
                      ->where('order_details.product_id',$product_id)
                      ->select('order_details.*','order_details.id as order_detail_id','orders.*')
                      ->get();
            if(isset($verify[0])){
                $exist = DB::table('reviews')->where('customer_id',$uid)->where('product_id',$product_id)->get();
                if(isset($exist[0])){
                    return response()->json(['status' => 'error','msg' => 'You already review this product.']);
                }else{
                    $arr = [
                        'customer_id'=>$uid,
                        'product_id'=>$product_id,
                        'rating'=>$req->post('star_rating'),
                        'reviews'=>$req->post('review'),
                        'status'=>1
                    ];
                    DB::table('reviews')->insert($arr);
                    return response()->json(['status' =>'success','msg'=>'Thankyou for your feedback.']);
                }
                
            }else{
                return response()->json(['status' => 'error','msg' => 'You are not eligible.']);
            }
                    
        }else{
            return response()->json(['status'=>'error','msg'=>'Only the person who is login and purchase the product can submit there review']);
        }
    }





}


