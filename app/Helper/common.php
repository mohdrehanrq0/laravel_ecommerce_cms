<?php 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

function prx($arr){
    echo '<pre>';
    print_r($arr);
    die();
}
function getNavCat(){
    $category = DB::table('categories')->where('status',1)->get();
    $arr = [];
   foreach ($category as $row) {
      $arr[$row->id]['category_name'] = $row->category_name;
      $arr[$row->id]['parent_category_id'] = $row->parent_category_id;
      $arr[$row->id]['category_slug'] = $row->category_slug;
   }
   $str = buildTreeView($arr,0);
   return $str;
}

function buildTreeView($arr,$parent,$level=0,$prelevel=-1){
      global $html;  
      foreach ($arr as $id=>$data) {
         if ($parent == $data['parent_category_id']) {
            if ($level>$prelevel) {
              if($html==''){
                  $html.='<ul class="nav navbar-nav">';
               }else{
                  $html.='<ul class="dropdown-menu">';
               }
            }
            if($level==$prelevel){
               $html.='</li>';
            }
            $html.='<li><a href="/category/'.$data['category_slug'].'">'.$data['category_name'].'<span class="caret"></span></a>';
            if($level>$prelevel){
               $prelevel=$level;
            }
            $level++;
            buildTreeView($arr,$id,$level,$prelevel);
            $level--;
            }
      }
      if($level==$prelevel){
         $html.='</li></ul>';
      }
      return $html;
   }

function TempUserId(){
   if(session()->has('TEMP_ID')){
      return session()->get('TEMP_ID');
   }else{
      $rand = rand(11111111,99999999);
      session()->put('TEMP_ID',$rand);
      return $rand;
   }
}
	
function getCartNav(){
   if(session()->has('FRONT_LOGGEDIN')){
      $userid = session()->get('FRONT_USERID');
      $user_type = "Reg";
  }else{
      $userid = TempUserId();
      $user_type = "Not-Reg";
  }

  $result = DB::table('cart')
          ->leftJoin('products','products.id','=','cart.product_id')
          ->leftJoin('product_attr','product_attr.id','=','cart.product_attr_id')
          ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
          ->leftJoin('colors','colors.id','=','product_attr.color_id')
          ->where('user_id',$userid)
          ->where('user_type',$user_type)
          ->select('products.id as pid','products.name','product_attr.price','product_attr.id as attr_id','products.image','sizes.size','colors.color','cart.qty','products.slug')
          ->get();

   return $result;
}

function applyCoupon($coupon){
   $coupon_name = $coupon;
        $result['data'] = DB::table('coupons')->where('code',$coupon_name)->get();
        $total = 0;
        $couponValue = 0;

        if(isset($result['data'][0])){
            $coupon_value = $result['data'][0]->value;
            $coupon_type = $result['data'][0]->type;
            if($result['data'][0]->status == 1){
                if($result['data'][0]->is_one_time == 1){
                    $status = 'error';
                    $msg = 'Coupon Code already used';
                }else{
                    $min_amount = $result['data'][0]->min_order_amount;
                    if($min_amount >= 0){
                        $cart = getCartNav();
                        $total = 0;
                        foreach($cart as $list){
                            $total += $list->price * $list->qty;
                        }
                        if($total > $min_amount){
                            $status = 'success';
                            $msg = 'Coupon applied successfully';
                        }else{
                            $status = 'error';
                            $msg = 'Cart amount must be greater than '.$min_amount;
                        }
                    }
                }
            }else{
                $status = 'error';
                $msg = 'Coupon Code Expired';
            }
        }else{
            $status = 'error';
            $msg = 'Coupon Code invalid';
        }
        
        if($status=='success'){
            if($coupon_type == 'value'){
                $total -= $coupon_value;
                $couponValue = (int)$coupon_value;
            }else if($coupon_type == 'percentage'){
                $value = $coupon_value/100;
                $val_type = $total*$value;
                $total -= $val_type;
                $total = round($total);  
                $couponValue = round($val_type);
            }
        }

        return json_encode(['status'=>$status,'msg'=>$msg,'cart_total'=>$total,'couponValue'=>$couponValue,'couponName'=>$coupon_name]);
    }

    function getCartQty($product_id,$attr_id){
        $result = DB::table('order_details')
                  ->leftJoin('orders','orders.id','=','order_details.order_id')
                  ->leftJoin('product_attr','product_attr.id','=','order_details.product_attr_id')
                  ->where('order_details.product_id',$product_id)
                  ->where('order_details.product_attr_id',$attr_id)
                  ->select('order_details.qty','product_attr.qty as pqty')
                  ->get();
        return $result;
    }
    

?>