<?php
/**
 * The Header for our theme.
 *
 */
?>
<?php global $etheme_responsive; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php if($etheme_responsive): ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
<?php endif; ?>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
  /*
   * Print the <title> tag based on what is being viewed.
   */
  global $page, $paged;

  wp_title( '|', true, 'right' );

  // Add the blog name.
  bloginfo( 'name' );

  // Add the blog description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) )
    echo " | $site_description";

  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 )
    echo ' | ' . sprintf( __( 'Page %s', ETHEME_DOMAIN ), max( $paged, $page ) );

  ?></title>
  <link rel="shortcut icon" href="//www.urbanmodesty.com/wp-content/uploads/2015/12/favicon.jpg" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <script type="text/javascript">
        var etheme_wp_url = '<?php echo home_url(); ?>'; 
        var succmsg = '<?php _e('All is well, your e&ndash;mail has been sent!', ETHEME_DOMAIN); ?>';
        var menuTitle = '<?php _e('Menu', ETHEME_DOMAIN); ?>';
        var nav_accordion = false;
        var ajaxFilterEnabled = <?php echo (etheme_get_option('ajax_filter')) ? 1 : 0 ; ?>;
        var isRequired = ' <?php _e('Please, fill in the required fields!', ETHEME_DOMAIN); ?>';
        var someerrmsg = '<?php _e('Something went wrong', ETHEME_DOMAIN); ?>';
    var successfullyAdded = '<?php _e('Successfully added to your shopping cart', ETHEME_DOMAIN); ?>';
    </script>
  <!--[if IE]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
    
<?php
  if ( is_singular() && get_option( 'thread_comments' ) )
    wp_enqueue_script( 'comment-reply' );

  wp_head();
?>
<?php $header_type = ''; $header_type = apply_filters('custom_header_filter', $header_type); ?>
</head>
<body <?php $fixed = ''; if(etheme_get_option('fixed_nav')) $fixed .= ' fixNav-enabled '; if($header_type == 'variant6' && is_front_page()) $fixed .= ' header-overlapped '; body_class('no-svg '.etheme_get_option('main_layout').' banner-mask-'.etheme_get_option('banner_mask').$fixed); ?>>
  
  <div class="wrapper">
  
    <?php if(etheme_get_option('loader')): ?>
      <div id="loader">
        <div id="loader-status">
          <p class="center-text">
            <em><?php _e('Loading the content...', ETHEME_DOMAIN); ?></em>
            <em><?php _e('Loading depends on your connection speed!', ETHEME_DOMAIN); ?></em>
          </p>
        </div>
      </div>
    <?php endif; ?>
    
    <p class="above-header-notice"><span>FREE 2-DAY PRIORITY MAIL US SHIPPING</span> over $49 &amp; FREE GLOBAL SHIPPING over $249<br>EZ RETURNS &amp; GENEROUS 60 DAY EXCHANGES</p>
    <p class="header-notice top"><span>SALE:</span> <span>35% OFF</span> $399 code spring35, <span>20% OFF</span> $199 code spring20, <span>15% OFF</span> $149 code spring15, <span>10% OFF</span> $99 code spring10</p>

  <?php if((etheme_get_option('search_form') || (class_exists('Woocommerce') && !etheme_get_option('just_catalog') && etheme_get_option('cart_widget')) || etheme_get_option('top_links') || etheme_get_option('header_phone') != '')): ?>
    <div class="header-top header-top-<?php echo $header_type; ?> <?php if($header_type == "default") echo 'hidden-desktop'; ?>">
      <div class="container">
        <div class="row header-variant2">
          <div class="span12">
          <?php if(etheme_get_option('search_form')): ?>
           <div class="search_form">
             <?php get_search_form(); ?>
           </div>
          <?php endif; ?>
          <div class="checkout-top-btn"><a href="<?php global $woocommerce; echo $woocommerce->cart->get_checkout_url(); ?>"><i class="moon-cart-2" style=""></i></a></div>
          <!-- Currency Switcher -->
          <p class="currency-wrap"><a href="/localization" id="currency" title="click to change your currency"><?php
              global $WOOCS;
              $currency = $WOOCS->current_currency;
              
              switch ( $currency ) {
                case 'USD':
                  $value = array('&#36;', 'US');
                break;

                case 'CAD':
                  $value = array('C&#36;', 'CA');
                break;

                case 'EUR':
                  $value = array('&euro;', 'NL');
                break;

                case 'GBP':
                  $value = array('&pound;', 'UK');
                break;

                default:
                  $value = array('&#36;', 'US');
                break;
              }
              echo $value[0] . ' <i id="flag" class="flag sprite' . $value[1] . '"></i>';
              ?></a></p>
          <!-- END Currency Switcher -->

          <?php if(class_exists('Woocommerce') && !etheme_get_option('just_catalog') && etheme_get_option('cart_widget')): ?>
           <div id="top-cart" class="shopping-cart-wrapper widget_shopping_cart">
             <?php $cart_widget = new Etheme_WooCommerce_Widget_Cart(); $cart_widget->widget(); ?>
           </div>
         <?php endif ;?> 
         <?php if(etheme_get_option('top_links')): ?>
          <?php  get_template_part( 'et-links' ); ?>
        <?php endif; ?>
      </div>

      </div>
      </div>
    </div>
  <?php endif; ?>

    
   <?php if(etheme_get_option('fixed_nav')): ?> 
    <div class="fixed-header-area visible-desktop">
      <div class="fixed-header container">
        <div class="row">
          <div class="span3 logo">
            <a href="<?php echo home_url(); ?>"><img src="//www.urbanmodesty.com/wp-content/uploads/2013/11/umlogosite5.png" alt="<?php bloginfo( 'description' ); ?>" /></a>
          </div>
          <div id="main-nav" class="span9">
            <?php etheme_header_wp_navigation(); ?>
          </div>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <?php endif; ?>
    
    <div class="header-bg header-type-<?php echo $header_type; ?>">
    <div class="container header-area"> 
      
      <header class="row header ">
        <div class="span5 logo">
          <a href="<?php echo home_url(); ?>"><img src="//www.urbanmodesty.com/wp-content/uploads/2013/11/umlogosite5.png" alt="<?php bloginfo( 'description' ); ?>" /></a>
        </div>

        <?php if($header_type == 'default'): ?>
          <div class="span3 visible-desktop">
            <?php if(etheme_get_option('header_phone') && etheme_get_option('header_phone') != ''): ?>
              <span class="search_text">
                <?php etheme_option('header_phone') ?>
              </span>
            <?php endif; ?>
            <?php if(etheme_get_option('search_form')): ?>
              <div class="search_form">
                <?php get_search_form(); ?>
              </div>
            <?php endif; ?>
          </div>

          <div class="span3 shopping_cart_wrap visible-desktop">

            <?php if(class_exists('Woocommerce') && !etheme_get_option('just_catalog') && etheme_get_option('cart_widget')): ?>
              <div id="top-cart" class="shopping-cart-wrapper widget_shopping_cart">
                <?php $cart_widget = new Etheme_WooCommerce_Widget_Cart(); $cart_widget->widget(); ?> 
              </div>
            <?php endif ;?> 
            <div class="clear"></div>
            <?php if(etheme_get_option('top_links')): ?>
              <?php  get_template_part( 'et-links' ); ?>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <?php if($header_type == 'variant2' || $header_type == 'variant5' || $header_type == 'variant6'): ?>
          <div id="main-nav">
            <?php etheme_header_wp_navigation(); ?>
            <!-- <p class="header-notice"><span>30% OFF $499</span> code hot30 <span>20% OFF $299</span> code hot20 <br><span>10% OFF $149</span> code hot10 <span>5% OFF $99</span> code hot5 - ENDS Oct. 31st</p> -->
          </div>
        <?php endif; ?>
      </header>
      <p class="shop-now visible-mobile"><a class="button small active" href="/shop/">Shop Now</a></p>
      <?php if($header_type == 'default' || $header_type == 'variant3') etheme_header_menu(); ?>
    </div>
    <?php if($header_type == 'variant4') etheme_header_menu(); ?>
    
    <?php 
    get_template_part( 'et-styles' ); 
    if($etheme_responsive){
      get_template_part('large-resolution');
    }
    ?>
</div>