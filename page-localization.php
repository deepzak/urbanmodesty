<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 */

global $wp_query;

get_header(); ?>
<div class="container <?php echo $sidebarname; ?>">
  <div class="row">
    <?php blog_breadcrumbs(); ?>
    <?php if($position && $responsive == 'top'): ?>
      <div class="span3 sidebar_grid sidebar_<?php echo $position ?>">
        <?php get_sidebar($sidebarname); ?>
      </div>
    <?php endif; ?>
    <div class="<?php echo ($position)? 'span9':'span12'; ?> grid_content with-sidebar-<?php echo $position ?>">
      <?php $post_id = $wp_query->get_queried_object_id();
      $title = get_post_field( 'post_title', $post_id ); ?>
      <h1 class="page-title"><?php echo $title; ?></h1>
      
      <ul class="countries unstyled">
        <li>
          <i class="flag spriteCA"></i>
          <a href="?currency=CAD" data-country="CA">
            Canada (C$)
          </a>
        </li>

        <li>
          <i class="flag spriteNL"></i>
          <a href="?currency=EUR" data-country="NL">
            Netherlands (€)
          </a>
        </li>

        <li>
          <i class="flag spriteGB"></i>
          <a href="?currency=GBP" data-country="GB">
            United Kingdom (£)
          </a>
        </li>

        <li>
          <i class="flag spriteUS"></i>
          <a href="?currency=USD" data-country="US">
            United States ($)
          </a>
        </li>
      </ul>
      
      <div class="clear"></div>         
    </div>
    <?php if($position && $responsive == 'bottom'): ?>
      <div class="span3 sidebar_grid sidebar_<?php echo $position ?>">
        <?php get_sidebar($sidebarname); ?>
      </div>
    <?php endif; ?>
    <div class="clear"></div>
  </div>
</div><!-- .container -->
<?php get_footer(); ?>
