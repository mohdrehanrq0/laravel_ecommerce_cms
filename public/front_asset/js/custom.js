/** 
  * Template Name: Daily Shop
  * Version: 1.0  
  * Template Scripts
  * Author: MarkUps
  * Author URI: http://www.markups.io/

  Custom JS
  

  1. CARTBOX
  2. TOOLTIP
  3. PRODUCT VIEW SLIDER 
  4. POPULAR PRODUCT SLIDER (SLICK SLIDER) 
  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  6. LATEST PRODUCT SLIDER (SLICK SLIDER) 
  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  9. PRICE SLIDER  (noUiSlider SLIDER)
  10. SCROLL TOP BUTTON
  11. PRELOADER
  12. GRID AND LIST LAYOUT CHANGER 
  13. RELATED ITEM SLIDER (SLICK SLIDER)

  
**/

jQuery(function($){


  /* ----------------------------------------------------------- */
  /*  1. CARTBOX 
  /* ----------------------------------------------------------- */
    
     jQuery(".aa-cartbox").hover(function(){
      jQuery(this).find(".aa-cartbox-summary").fadeIn(500);
    }
      ,function(){
          jQuery(this).find(".aa-cartbox-summary").fadeOut(500);
      }
     );   
  
  /* ----------------------------------------------------------- */
  /*  2. TOOLTIP
  /* ----------------------------------------------------------- */    
    jQuery('[data-toggle="tooltip"]').tooltip();
    jQuery('[data-toggle2="tooltip"]').tooltip();

  /* ----------------------------------------------------------- */
  /*  3. PRODUCT VIEW SLIDER 
  /* ----------------------------------------------------------- */    

    jQuery('#demo-1 .simpleLens-thumbnails-container img').simpleGallery({
        loading_image: 'demo/images/loading.gif'
    });

    jQuery('#demo-1 .simpleLens-big-image').simpleLens({
        loading_image: 'demo/images/loading.gif'
    });

  /* ----------------------------------------------------------- */
  /*  4. POPULAR PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-popular-slider').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    }); 

  
  /* ----------------------------------------------------------- */
  /*  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-featured-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });
    
  /* ----------------------------------------------------------- */
  /*  6. LATEST PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      
    jQuery('.aa-latest-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });

  /* ----------------------------------------------------------- */
  /*  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */     
    
    jQuery('.aa-testimonial-slider').slick({
      dots: true,
      infinite: true,
      arrows: false,
      speed: 300,
      slidesToShow: 1,
      adaptiveHeight: true
    });

  /* ----------------------------------------------------------- */
  /*  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */  

    jQuery('.aa-client-brand-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });

  /* ----------------------------------------------------------- */
  /*  9. PRICE SLIDER  (noUiSlider SLIDER)
  /* ----------------------------------------------------------- */        

    jQuery(function(){
      if($('body').is('.productPage')){
       var skipSlider = document.getElementById('skipstep');
        noUiSlider.create(skipSlider, {
            range: {
                'min': 0,
                '10%': 100,
                '20%': 200,
                '30%': 300,
                '40%': 400,
                '50%': 500,
                '60%': 600,
                '70%': 700,
                '80%': 800,
                '90%': 900,
                'max': 1000
            },
            snap: true,
            connect: true,
            start: [0, 1000]
        });
        // for value print
        var skipValues = [
          document.getElementById('skip-value-lower'),
          document.getElementById('skip-value-upper')
        ];

        skipSlider.noUiSlider.on('update', function( values, handle ) {
          skipValues[handle].innerHTML = values[handle];
        });
      }
    });


    
  /* ----------------------------------------------------------- */
  /*  10. SCROLL TOP BUTTON
  /* ----------------------------------------------------------- */

  //Check to see if the window is top if not then display button

    jQuery(window).scroll(function(){
      if ($(this).scrollTop() > 300) {
        $('.scrollToTop').fadeIn();
      } else {
        $('.scrollToTop').fadeOut();
      }
    });
     
    //Click event to scroll to top

    jQuery('.scrollToTop').click(function(){
      $('html, body').animate({scrollTop : 0},800);
      return false;
    });
  
  /* ----------------------------------------------------------- */
  /*  11. PRELOADER
  /* ----------------------------------------------------------- */

    jQuery(window).load(function() { // makes sure the whole site is loaded      
      jQuery('#wpf-loader-two').delay(200).fadeOut('slow'); // will fade out      
    })

  /* ----------------------------------------------------------- */
  /*  12. GRID AND LIST LAYOUT CHANGER 
  /* ----------------------------------------------------------- */

  jQuery("#list-catg").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-product-catg").addClass("list");
  });
  jQuery("#grid-catg").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-product-catg").removeClass("list");
  });


  /* ----------------------------------------------------------- */
  /*  13. RELATED ITEM SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-related-item-slider').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    }); 
    
});

function show_attr_image(img_path , size, color){
  jQuery('#color_id_hidden').val(color);
  jQuery('.simpleLens-big-image-container').html('<a data-big-image="'+ img_path +'" data-lens-image="'+ img_path +'" class="simpleLens-lens-image" href="javascript:void(0)"><img src="'+ img_path +'" class="simpleLens-big-image" ></a>');
  jQuery('.aa-color-green').css('border','none');
  jQuery('.color_pallete_'+size).css('border','1px solid #000');
}

function showColor(size){
  jQuery('#size_id_hidden').val(size);
  jQuery('.aa-color-green').hide();
  jQuery('.color_pallete_'+size).show();
  jQuery('.size_btn').css('border','1px solid #ddd');
  jQuery('#size_name_'+size).css('border','1px solid #000');
}

function home_addCart(id,color_pid,size_pid){
  var size =   jQuery('#size_id_hidden').val(size_pid);
  var color =   jQuery('#color_id_hidden').val(color_pid);
  addCart(id,color_pid,size_pid);
}


function addCart(id,color_pid,size_pid){
  jQuery('#pqty').val(jQuery('#qty').val());
  jQuery('#product_id').val(id);
  jQuery('.cart_error').html('')
  var size =   jQuery('#size_id_hidden').val();
  var color =   jQuery('#color_id_hidden').val();

  if(color_pid == 0){
    var color = 'no';
  }
  if(size_pid == 0){
    var size = 'no';
  }
  

  if(size == ''){
    jQuery('.cart_error').html('<div class="alert alert-danger alert-dismissible show" style="margin-top:10px;" role="alert"><strong>Error!</strong> Please Select the Size of the Product<button type="button" class="close" data-dismiss="alert"   aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
  }else if(color == ''){
    jQuery('.cart_error').html('<div class="alert alert-danger alert-dismissible show" style="margin-top:10px;" role="alert"><strong>Error!</strong> Please Select the Color of the Product<button type="button" class="close" data-dismiss="alert"   aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
  }else{
    jQuery.ajax({
      url: '/add_cart_url',
      data: jQuery('#frm-cart').serialize(),
      type: 'post',
      success: function(result){
        if(result.status == 'warning'){
          swal({
            title: result.msg,
            icon: "warning",
            button: "Close",
          });
        }else{
          swal({
            title: result.msg,
            icon: "success",
            button: "Close",
          });
          if(result.dataCount==0){
            jQuery('.aa-cartbox-summary').remove();
            jQuery('.aa-cart-notify').html(0);
            jQuery('.aa-subtotal').html('$ 0');
            jQuery('.aa-total').html('$ 0');
          }else{
            jQuery('.aa-cart-notify').html(result.dataCount);
            var html = '<div class="aa-cartbox-summary"><ul>';
            var total = 0;
            result.data.forEach(data => {
              total = total + (data.qty*data.price);
              html+='<li id="product-'+data.attr_id+'"><a class="aa-cartbox-img" href="/products/'+data.slug+'"><img src="/upload/media/product/'+data.image+'" alt="img"></a><div class="aa-cartbox-info"><h4><a href="/products/'+data.slug+'">'+data.name+'</a></h4><p>'+data.qty+' x $ '+data.price+'</p></div><a class="aa-remove-product" href="javascipt:void(0)" onclick="deleteQtyNav("'+data.pid+'","'+data.attr_id+'","'+data.size+'","'+data.color+'")"><span class="fa fa-times"></span></a></li>';
            });
            html+='<li><span class="aa-cartbox-total-title">Total</span><span class="aa-cartbox-total-price">$'+total+'</span></li></ul><a class="aa-cartbox-checkout aa-primary-btn" href="javascript:void(0)">Checkout</a></div>';
            jQuery('.aa-cartbox-summary').remove();
            jQuery('.aa-cart-link').after(html);
            jQuery('.aa-subtotal').html('$'+total);
            jQuery('.aa-total').html('$'+total);
          }        
        }
        
      }
    });
  }
}

function changeQty(pid,attr_id,size,color,price){
  jQuery('#size_id_hidden').val(size);
  jQuery('#color_id_hidden').val(color);
  let qty = jQuery('#qty'+attr_id).val();
  jQuery('#qty').val(qty);
  addCart(pid,color,size);
  jQuery('#total'+attr_id).html('$'+ qty*price);
}

function deleteQty(pid,attr_id,size,color){
  jQuery('#size_id_hidden').val(size);
  jQuery('#color_id_hidden').val(color);
  jQuery('#qty').val(0);
  addCart(pid,color,size);
  jQuery('.row-'+attr_id).remove();
}
function deleteQtyNav(pid,attr_id,size,color){
  jQuery('#size_id_hidden').val(size);
  jQuery('#color_id_hidden').val(color);
  jQuery('#qty').val(0);
  addCart(pid,color,size);
  jQuery('#product-'+attr_id).remove();
}

function sortBy(){
  let sort_filter = jQuery('#sort_filter').val();
  jQuery('#sort').val(sort_filter);
  jQuery('#filter_form').submit();
}

jQuery('.price_filter_btn').on('click',()=>{
    let lower_val = jQuery('#skip-value-lower').html();
    let upper_val = jQuery('#skip-value-upper').html();
    lower_val = Math.trunc(lower_val);
    upper_val = Math.trunc(upper_val);
    jQuery('#lower_val').val(lower_val);
    jQuery('#upper_val').val(upper_val);  
    jQuery('#filter_form').submit();
});

function setColor(id,type){
  let color = jQuery('#color_filter').val();
  if(type == 1){
    let new_str = color.replace(id+':',"");
    jQuery('#color_filter').val(new_str);
  }else{
    jQuery('#color_filter').val(id+':'+color);
  }
  
  jQuery('#filter_form').submit();
}

function searchOn(){
  let str = jQuery('#search_str').val();
  if(str!=''){
    window.location.href = '/search/'+str;
  }
}

jQuery('#frmRegistrationBtn').click(function(e){
  e.preventDefault();
  jQuery('.error_field').html('');
  jQuery.ajax({
    url: '/frmRegistration',
    type: 'POST',
    data: jQuery('#frmRegistration').serialize(),
    success: function(result){
      if(result.status == 'errorpwd'){
        jQuery('#errorpwd').html(result.msg);
      }
      if(result.status == 'error'){
        jQuery.each(result.msg,function(key,val){
          jQuery('#'+key+'_error').html(val[0]);
        });
      }
      if(result.status == 'success'){
        jQuery('#reg_done').html('<div class="alert alert-success alert-dismissible show" role="alert"><strong>Success ! </strong> '+result.msg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        jQuery(':input','#frmRegistration')
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .removeAttr('checked')
        .removeAttr('selected');
      }
    }
  });
});

jQuery('#frmLoginBtn').click(function(e){
  e.preventDefault();
  jQuery('.error_field').html('');
  jQuery.ajax({
    url: '/frmLogin',
    type: 'POST',
    data: jQuery('#frmLogin').serialize(),
    success: function(result){
      if(result.status == 'passerror'){
        jQuery('#lpass_error').html(result.msg);
      }
      if(result.status == 'usererror'){
          jQuery('#lemail_error').html(result.msg);
      }
      if(result.status == 'loginsuccess'){
        jQuery('#login_done').html('<div class="alert alert-success alert-dismissible show" role="alert"><strong>Success ! </strong> '+result.msg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        jQuery(':input','#frmLogin')
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .removeAttr('checked')
        .removeAttr('selected');
        window.location.href = window.location.href;
      }
    }
  });
});

function change_pass(){
  jQuery('#loginFrmdiv').hide();
  jQuery('#forgotPassFrmdiv').show();
}
function loginFrmShow(){
  jQuery('#loginFrmdiv').show();
  jQuery('#forgotPassFrmdiv').hide();
}
jQuery('#frmForgotBtn').click(function(e){
  e.preventDefault();
  jQuery('#frmForgotBtn').html('Please wait....');
  jQuery('#frmForgotBtn').prop('disabled', true);
  jQuery('.error_field').html('');
  jQuery.ajax({
    'url': '/forget_pass_email',
    'type': 'POST',
    'data': jQuery('#frmForgot').serialize(),
    'success': function(data){
        jQuery('#frmForgotBtn').html('Get Email');
        if(data.status == 'error'){
          jQuery('#msg_error').css('color','red');
          jQuery('#forgot_email_address').html(data.msg.forgot_email_address);
        }
        if(data.status == 'merror'){
          jQuery('#msg_error').css('color','red');
          jQuery('#forgot_email_address').html(data.msg);
        }
        if(data.status == 'success'){
          jQuery('#forgot_email_address').css('color','green');
          jQuery('#forgot_email_address').html(data.msg);
        }
    }
  });
});
$('form').submit(function() {
  return false;
});
jQuery('#updatePassBtn').click(function(e) {
  e.preventDefault();
  jQuery('#updatePassBtn').html('Updating....');
  jQuery('#updatePassBtn').prop('disabled', true);
  jQuery('.error_field').html('');
  jQuery.ajax({
    url: '/update_password_process',
    type: 'POST',
    data: jQuery('#updatePass').serialize(),
    success: function(data) {
      jQuery('#updatePassBtn').html('Update password');
      if(data.status == 'success'){
          jQuery('#msg_error').css('color','green');
          jQuery('#msg_error').html(data.msg);
      }
      if(data.status == 'error'){
        jQuery('#msg_error').css('color','red');
          jQuery('#msg_error').html(data.msg);
    }
    }
  });

});
jQuery('#CouponBtn').click(function(e){
  e.preventDefault();
  let couponVal = jQuery('#couponInput').val();
  jQuery('#CouponError').html('');
  jQuery.ajax({
    url: '/coupon_process',
    type: 'POST',
    data: 'couponVal='+couponVal+'&_token='+jQuery('input[name="_token"]').val(),
    success: function(data){
      console.log(data);
      if(data.status == 'error'){
        jQuery('#CouponError').css('color', 'red');
        jQuery('#CouponError').html(data.msg);
      }
      if(data.status == 'success'){
        jQuery('#CouponError').css('color', 'green');
        jQuery('#CouponError').html(data.msg);
        jQuery('#couponInput').hide();
        jQuery('#CouponBtn').hide();
        jQuery('#CouponError').addClass('apply_coupon');
        jQuery('.couponBox').removeClass('hide');
        jQuery('#couponText').html(couponVal);
        jQuery('#totalAmt').html('$'+data.cart_total);
        jQuery('#couponValhide').val(couponVal);
      }
    }
  });
});

jQuery('.couponRemoveBtn').click(function(e){
  e.preventDefault();
  let couponVal = jQuery('#couponInput').val();
  jQuery('#CouponError').html('');
  jQuery.ajax({
    url: '/couponRemove',
    type: 'POST',
    data: 'couponVal='+couponVal+'&_token='+jQuery('input[name="_token"]').val(),
    success: function(data){

      if(data.status == 'success'){
        jQuery('#CouponError').css('color', 'green');
        jQuery('#CouponError').html(data.msg);
        jQuery('#couponInput').show();
        jQuery('#CouponBtn').show();
        jQuery('#CouponError').removeClass('apply_coupon');
        jQuery('.couponBox').addClass('hide');
        jQuery('#couponText').html('');
        jQuery('#totalAmt').html('$'+data.cart_total);
      }
    }
  });
});

jQuery('#frmCheckoutBtn').click(function(e){
  e.preventDefault();
//  console.log(jQuery('#checkname').val());
  jQuery('.error_field').html('');
  jQuery('#frmCheckoutBtn').html('Please Wait...');
  
  if(jQuery('#country').val() == 0){
    jQuery('#countryerror').html('Please select country.');
  }else if(jQuery('#states').val() == 0){
    jQuery('#countryerror').html('');
    jQuery('#stateerror').html('Please select State.');
  }else if(jQuery('#cities').val() == 0){
    jQuery('#countryerror').html('');
    jQuery('#stateerror').html('');
    jQuery('#cityerror').html('Please select city.');
  }else if(jQuery('#checkname').val() == ''){
    jQuery('#checkout_error').html('Name is required');
  }else if(jQuery('#checkemail').val() == ''){
    jQuery('#checkout_error').html('Email is required');
  }else if(jQuery('#checkmobile').val() == ''){
    jQuery('#checkout_error').html('Mobile Number is required');
  }else if(jQuery('#checkzip').val() == ''){
    jQuery('#checkout_error').html('Zip code is required');
  }else if(jQuery('#checkaddress').val() == ''){
    jQuery('#checkout_error').html('Address is required');
  }else{
    jQuery('#countryerror').html('');
    jQuery('#stateerror').html('');
    jQuery('#cityerror').html('');
    jQuery.ajax({
      url: '/frmCheckout',
      type: 'post',
      data: jQuery('#frmCheckout').serialize(),
      success: function(data){
        jQuery('#frmCheckoutBtn').html('Place Order');
        if(data.status == 'validator_error'){
          jQuery.each(data.msg, function(key, val){
            jQuery('#error_'+key).html(val[0]);
          });
        }else if(data.payment_url != '' && data.payment_url != undefined){
          window.location.href = data.payment_url;
        }else if(data.status === 'error'){
          jQuery('#checkout_error').html(data.msg);
        }else{
          window.location.href = '/orderplaced';
        }
        // (data.status === 'success')
      }
    });
  }


  });

  jQuery('#frmNewsletterBtn').click(function(e){
    e.preventDefault();
    jQuery('#errorNewsletter').html('');
    $email = jQuery('#newsletterEmail').val();    
    if($email == ''){
      jQuery('#errorNewsletter').html('Above Email Field is Required.');
    }else{
      jQuery.ajax({
        url: '/newsetter_process',
        type: 'POST',
        data: jQuery('#frmNewsletter').serialize(),
        success: function(data){
          console.log(data);
          if(data.status == 'validator_error'){
            var msg = data.msg.newsletterEmail[0];
            jQuery('#errorNewsletter').html(msg);
            jQuery('#errorNewsletter').css('color','red');
          }
          if(data.status == 'success'){
            jQuery('#errorNewsletter').html(data.msg);
            jQuery('#errorNewsletter').css('color','green');
          }
        }
      });
    }


  });


$(document).ready(function() {  
          $("#st1").click(function() {  
              $(".fa-star-o").css("color", "black");  
              $("#st1").css("color", "#ff6600");  
  
          });  
          $("#st2").click(function() {  
              $(".fa-star-o").css("color", "black");  
              $("#st1, #st2").css("color", "#ff6600");  
  
          });  
          $("#st3").click(function() {  
              $(".fa-star-o").css("color", "black")  
              $("#st1, #st2, #st3").css("color", "#ff6600");  
  
          });  
          $("#st4").click(function() {  
              $(".fa-star-o").css("color", "black");  
              $("#st1, #st2, #st3, #st4").css("color", "#ff6600");  
  
          });  
          $("#st5").click(function() {  
              $(".fa-star-o").css("color", "black");  
              $("#st1, #st2, #st3, #st4, #st5").css("color", "#ff6600");  
  
          });  
        });  


jQuery('#reviewFrmBtn').click(function(){
  var check = jQuery('input[name="star_rating"]:checked').val();
  if(check != undefined){
    var review = jQuery('#review_message').val();
    if(review != ''){
      jQuery.ajax({
        url: '/rating_process',
        type: 'POST',
        data: jQuery('#reviewFrm').serialize(),
        success: function(data){
          console.log(data);
          if(data.status == 'error'){
            jQuery('#reviewError').html(data.msg);
            jQuery('#reviewError').css('color', 'red');
          }
          if(data.status == 'success'){
            jQuery('#reviewError').html(data.msg);
            jQuery('#reviewError').css('color', 'green');
            setInterval(() => {
              window.location.reload();
            }, 3000);
          }
        }
      });
    }else{
      jQuery('#reviewError').html('Please write a review');
    }
  }else{
    jQuery('#reviewError').html('Please rate the product.');
  }
});