<?php
/**
 * Main functions of child theme
 *
 */


add_action( 'after_setup_theme', 'remove_project_custom_init' );
function remove_project_custom_init() {
  remove_action('init', 'etheme_portfolio_init');
  remove_action('save_post', 'etheme_portfolio_post_meta_box_save', 1, 2);
  remove_action("admin_init", "etheme_add_portfolio_meta_boxes");

  /**
  Add Option of counter value
  */
  // add_option( 'um_coupon_counter' );
  // add_option( 'um_coupon_name' );
}



/**
Include child theme scripts
*/
add_action( 'wp_enqueue_scripts', 'urban_theme_scripts', 11 );
function urban_theme_scripts(){
  wp_dequeue_style( 'cbpQTRotator' );
  wp_dequeue_script( 'flexslider' );
  // wp_dequeue_script( 'et_masonry' );

  wp_dequeue_style( 'style' );
	wp_enqueue_style( 'parent', get_template_directory_uri() .'/style.css' );
	wp_enqueue_style( 'style', get_stylesheet_uri() );

  wp_deregister_script( 'wc-add-to-cart-variation' );
  wp_enqueue_script( 'wc-add-to-cart-variation', get_stylesheet_directory_uri() . '/js/add-to-cart-variation.min.js', array('jquery', 'woocommerce'), null, true );
  // wp_enqueue_script('hoverIntent', get_template_directory_uri().'/js/hoverIntent.js',array(),false,true);
  
  // FlipClock script
  // wp_enqueue_style( 'flipclock', get_stylesheet_directory_uri() . '/flipclock/flipclock.css' );
  // wp_enqueue_script( 'flipclock', get_stylesheet_directory_uri() . '/flipclock/flipclock.js', array('jquery') );

  // wp_enqueue_style( 'owl-carousel', get_stylesheet_directory_uri() . '/owl-carousel/owl.carousel.css' );
  // wp_enqueue_style( 'owl-theme', get_stylesheet_directory_uri() . '/owl-carousel/owl.theme.css' );
  // wp_enqueue_script( 'owl-carousel', get_stylesheet_directory_uri() . '/owl-carousel/owl.carousel.js', array('jquery') );
  
  wp_enqueue_script( 'child-script', get_stylesheet_directory_uri() . '/js/child-script.js', array('jquery') );
}



// Add small image size for product 
add_image_size( 'product-list', 220, 426, true );



// Display all products per page. Goes in functions.php
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return -1;' ), 20 );



/**
Add Buy Now button right after add to cart button 
*/
add_action('woocommerce_after_single_variation','urm_buy_now_cart_button');
function urm_buy_now_cart_button(){ 
  ?><script type="text/javascript">
    jQuery(document).ready(function($){ 
      $('.single_checkout_button').on('click',function(e){
        $(this).siblings('.buy-now-field').val('1');
      });
    });
  </script>
  <input type="hidden" name="urm_buy_now_field" class="buy-now-field" value="">
  <button type="submit" class="single_checkout_button button big alt">Buy Now</button><?php
} // END 'urm_buy_now_cart_button'

add_filter ('add_to_cart_redirect', 'urm_buy_now_checkout_redirect');
function urm_buy_now_checkout_redirect() {
  global $woocommerce;

  if( isset($_REQUEST['urm_buy_now_field']) ){
    if( $_POST['urm_buy_now_field'] == 1 ){
      return $woocommerce->cart->get_checkout_url();
    }
  }
} // END 'urm_buy_now_checkout_redirect'




/**
Custom Add To Cart Messages

add_filter( 'wc_add_to_cart_message', 'custom_add_to_cart_message' );
function custom_add_to_cart_message( $message ) {
  $minimum = 48;
  $maximum = 50;
  $current = WC()->cart->subtotal;

  if( ( $current > 48 ) && ( $current < 50 ) ):
    $content = $message. ' <strong style="color: #fc5a5a;">you can order as many dresses as you would like for $39.99 and cover ups for $24.99';
  else:
    $content = $message;
  endif;

  return $content;
} // END 'custom_add_to_cart_message'
*/



/**
Add Sold Out notice in single product page 
*/
add_filter( 'woocommerce_short_description', 'um_sold_out_notice' );
function um_sold_out_notice( $content ){
  global $post, $product;

  $umallvar = $product->get_available_variations();
  $umcurrent = array();

  foreach ( $umallvar as $umsvar ) {
    $umcurrent[] = $umsvar['attributes']['attribute_pa_sizes'];
  }

  $umresult = array_diff( array('small', 'medium', 'large'), $umcurrent );
  $umresult = array_values($umresult);

  if( !count($umresult) == 0  ){

    if( count($umresult) == 1 ){
      $umprint = $umresult[0];
    } elseif( count($umresult) == 2 ){
      $umprint = $umresult[0] . ' & ' . $umresult[1];
    } elseif( count($umresult) == 3 ){
      $umprint = $umresult[0] . ' , ' . $umresult[1] . ' & ' . $umresult[2];
    }
    $text = '<p class="umnotice">Sold Out in ' . ucwords($umprint) .'.<br>Very Limited Quantities in all other sizes.<br>We never restock (with minor exceptions).</p>';

  } else {
    $text = '<p class="umnotice">Very Limited Quantities remain.<br>We never restock (with minor exceptions).</p>';
  }

  $content = $content . $text;

  return $content;

} // END - 'um_sold_out_notice'




// Output the proceed to checkout button.
function woocommerce_button_proceed_to_checkout() {
  $checkout_url = WC()->cart->get_checkout_url();

  echo '<a href="'. $checkout_url .'" class="fl-r checkout-button button big arrow-right active wc-forward"><span>'. __( 'Proceed to Checkout', 'woocommerce' ) .'</span></a>';
}




/**
Disable Adminbar for other users except admin
*/
if ( !current_user_can( 'manage_options' ) && !is_admin() ) {
  show_admin_bar( false );
}




/**
Add Body Class in to detect browser
*/
add_filter('body_class','browser_body_class');
function browser_body_class($classes) {
  global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

  if($is_lynx) $classes[] = 'lynx';
  elseif($is_gecko) $classes[] = 'gecko';
  elseif($is_opera) $classes[] = 'opera';
  elseif($is_NS4) $classes[] = 'ns4';
  elseif($is_safari) $classes[] = 'safari';
  elseif($is_chrome) $classes[] = 'chrome';
  elseif($is_IE) $classes[] = 'ie';
  else $classes[] = 'unknown';

  if($is_iphone) $classes[] = 'iphone';
  return $classes;
}



/**
Clearing the Cache
*/
if( isset($_GET['responsive']) ){
  wp_cache_clear_cache();
}




/**
Remove "click here to enter your code" for coupons
*/
add_filter( 'woocommerce_checkout_coupon_message', 'um_remove_coupon_info');
function um_remove_coupon_info(){
  return 'Have a coupon? Enter your code here';
}




/**

Dynamic coupon generate with timer

*/

/**
Generate or destroy a coupon


// Only for new user
if( !is_user_logged_in() ){


/**
Enqueue FlipClock Scripts

add_action( 'wp_enqueue_scripts', 'um_flipclock_scripts' );
function um_flipclock_scripts(){
  if( !is_user_logged_in() ){
    wp_enqueue_style( 'flipclock', get_stylesheet_directory_uri() . '/flipclock/flipclock.css' );
    wp_enqueue_script( 'flipclock', get_stylesheet_directory_uri() . '/flipclock/flipclock.js', array('jquery') );
  }
}

/**
After form submit

if( $_GET['mailchimp'] == 'complete' ){

  $coupon_code = date("Ymdgi"); // Code
  update_option( 'um_coupon_name', $coupon_code );

  $amount = '10'; // Amount
  $discount_type = 'percent'; // Type: fixed_cart, percent, fixed_product, percent_product
  $coupon = array(
    'post_title' => $coupon_code,
    'post_content' => '',
    'post_status' => 'publish',
    'post_author' => 1,
    'post_type' => 'shop_coupon'
  );
  $new_coupon_id = wp_insert_post( $coupon );
  // Add meta
  update_post_meta( $new_coupon_id, 'discount_type', $discount_type );
  update_post_meta( $new_coupon_id, 'coupon_amount', $amount );
  update_post_meta( $new_coupon_id, 'individual_use', 'yes' );
  update_post_meta( $new_coupon_id, 'product_ids', '' );
  update_post_meta( $new_coupon_id, 'exclude_product_ids', '' );
  update_post_meta( $new_coupon_id, 'usage_limit', 1 );
  update_post_meta( $new_coupon_id, 'expiry_date', date('Y-m-d') );
  update_post_meta( $new_coupon_id, 'apply_before_tax', 'yes' );
  update_post_meta( $new_coupon_id, 'free_shipping', 'no' );
  
  $update_time = time() + 3600;

  /**
  update counter time

  update_option( 'um_coupon_counter', $update_time );

  // Set cookies to calculate 30 minutes timeout

  // Clearing the Cache when coupon created
  wp_cache_clear_cache();

} // END after form submit



/**
NewUser Cookes Script

add_action( 'wp_footer', 'um_set_newuser_cookies' );
function um_set_newuser_cookies(){
  ?><script type="text/javascript">
  function createCookie(name, minutes) {
      var expires;

      if (minutes) {
          var date = new Date();
          date.setTime(date.getTime() + (minutes * 60 * 1000));
          expires = "; expires=" + date.toGMTString();
      } else {
          expires = "";
      }
      document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(1) + expires + "; path=/";
  }

  function readCookie(name) {
      var nameEQ = encodeURIComponent(name) + "=";
      var ca = document.cookie.split(';');
      for (var i = 0; i < ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0) === ' ') c = c.substring(1, c.length);
          if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
      }
      return null;
  }

  function eraseCookie(name) {
      createCookie(name, "", -1);
  }

  <?php if( $_GET['mailchimp'] == 'complete' ){
    $cp_cookie = 'wc_' . get_option('um_coupon_name');
    ?>
  createCookie( '<?php echo $cp_cookie; ?>', 1800 );
  window.location.replace("http://www.urbanmodesty.com/shop/");
  <?php } ?>

  function time() {
    return Math.floor( new Date().getTime() / 1000 );
  }
  </script><?php
}



  /**
  Include Script to display counter

  add_action('wp_footer', 'um_counter_script', 20);
  function um_counter_script(){
    ?><script type="text/javascript">
    jQuery(document).ready(function() {
      var clock;
      var current = <?php echo get_option('um_coupon_counter'); ?> - time();

      clock = jQuery('.clock').FlipClock({
            clockFace: 'MinuteCounter',
            autoStart: false
        });
            
        clock.setTime( current );
        clock.setCountdown(true);
        clock.start();

        if( ( current <= 0 ) || ( jQuery.cookie('<?php echo "wc_" . get_option("um_coupon_name"); ?>') != 1 ) ){
          document.getElementById("coupon-code").style.display = "none";
        }
    });
    </script><?php
  }

} // END Only for new user



/**
Add Coupon code in shortcode

add_shortcode( 'um_coupon', 'um_coupon_code_output' );
function um_coupon_code_output(){
  return get_option('um_coupon_name');
}
*/



/**
Add Final Sale notice in single product page 
*/
add_filter( 'woocommerce_short_description', 'um_sale_notice' );
function um_sale_notice( $content ){
  global $post;

  $cats = get_the_terms( $post->ID, 'product_cat' );
  $text = '';
  
  foreach ($cats as $cat) {
    if( $cat->slug == 'sale' ){
      $text = '<p><a href="/customer-care/" class="umnotice">Final Sale</a></p>';
    }
  }

  $content = $text . $content;

  return $content;

} // END - 'um_sale_notice'





/**
Facebook Pixel Code
*/
function um_facebook_pixel_code(){

echo "\n\n";

  ?><!-- Facebook Conversion Code for checkout -->
<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
  var fbds = document.createElement('script');
  fbds.async = true;
  fbds.src = '//connect.facebook.net/en_US/fbds.js';
  var s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(fbds, s);
  _fbq.loaded = true;
  }
  })();
  window._fbq = window._fbq || [];
  window._fbq.push(['track', '6015625283091', {'value':'0.01','currency':'USD'}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6015625283091&amp;cd[value]=0.01&amp;cd[currency]=USD&amp;noscript=1" /></noscript><?php

  echo "\n\n";
}
add_action( 'woocommerce_thankyou', 'um_facebook_pixel_code' );



/**
Slide Servey Script

add_action( 'wp_footer', 'um_inactivity_slide_servey' );
function um_inactivity_slide_servey(){
  ?><script type="text/javascript">
  idleTimer = null;
  idleState = false;
  idleWait = 60000;
  (function ($) {
    $(document).ready(function () {
      
      var start = true;
      $('*').bind('mousemove keydown scroll', function () {
        
        clearTimeout(idleTimer);
        
        idleState = false;
        
        idleTimer = setTimeout(function () { 
          
          // Idle Event
          if( start ){
            $(".stb").slideToggle( 'slow' );
            console.info('ON');
            start = false;
          }
          
          idleState = true;
        }, idleWait);
        
      });
      
      $("body").trigger("mousemove");

      $(".stb-close").click(function(){
        $(".stb").slideToggle( 'slow' );
      });
      
    });
  })(jQuery);
  </script><?php
}
*/



/**
Change the generated SKU to use the product's post ID instead of the slug

function sv_change_sku_value( $sku, $product ) {
  $sku = $product->get_post_data()->ID;
  return $sku;
}
add_filter( 'wc_sku_generator_sku', 'sv_change_sku_value', 10, 2 );
*/




/**
Edit backorder text
*/
add_filter( 'woocommerce_get_availability', 'um_get_availability', 1 );

function um_get_availability( $availability ) {
  global $post;

  if( ( $post->ID == 322 ) || ( $post->ID == 9345 ) ){
    $delivery = 'early August';
  } else {
    $delivery = 'Mid-July';
  }

  if( $availability['availability'] == 'Available on backorder' ){
    $availability['availability'] = 'Pre-Order sold out sizes for '. $delivery .' delivery';
    $availability['class'] = 'available-on-backorder show';
  }
  
  return $availability;
}



/**
Add Size Chart in Shop page
*/
add_action( 'woocommerce_single_product_summary', 'um_size_chart_on_shop', 11 );
function um_size_chart_on_shop(){
  global $post;

  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];

  if(empty($first_img)){ //Defines a default image
    $first_img = "/wp-content/uploads/2014/07/Size-Chart.png";
  }
  echo '<div class="size-chart"><a href="' . $first_img . '" rel="lightbox">Size Chart</a></div>';

}

?>