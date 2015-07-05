<?php
/*
Template Name: Counter
*/

global $wp_query;

extract(etheme_get_page_sidebar());

get_header(); ?>
<div class="container <?php echo $sidebarname; ?>">
  <div class="row">
    <?php blog_breadcrumbs(); ?>
    <?php if($position && $responsive == 'top'): ?>
      <div class="span3 sidebar_grid sidebar_<?php echo $position ?>">
        <?php get_sidebar($sidebarname); ?>
      </div>
    <?php endif; ?>
    <div class="span12 grid_content with-sidebar-">
      <?php $post_id = $wp_query->get_queried_object_id();
      $title = get_post_field( 'post_title', $post_id ); ?>
      <h1 class="page-title"><?php echo $title; ?></h1>
      
      <div class="row">
        <div class="span12">
        <h2 style="text-align: center;">Congratulation!</h2>
          <p style="text-align: center;">Now you will get 10% off based on your next order</p>
          <p style="text-align: center;">Your unique coupon code is <strong style="color: #fa8072;"><?php echo get_option('um_coupon_name') ?></strong></p>
          <p style="text-align: center;">This offer will expired with in next 30 minutes</p>
          <p style="text-align: center;">You will see time countdown in site header</p>
        </div>
      </div>
    <div class="clear"></div>               
  </div>
  <div class="clear"></div>
</div>
</div><!-- .container -->


<?php get_footer(); ?>