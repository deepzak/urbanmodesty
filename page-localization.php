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
        <!-- <li>
          <i class="flag spriteAU"></i>
          <a href="?currency=AUD" data-country="AU">
            Australia (A$)
          </a>
        </li>

        <li>
          <i class="flag spriteBH"></i>
          <a href="?currency=USD" data-country="BH">
            Bahrain (BD)
          </a>
        </li> -->

        <li>
          <i class="flag spriteCA"></i>
          <a href="?currency=CAD" data-country="CA">
            Canada (C$)
          </a>
        </li>

        <!-- <li>
          <i class="flag spriteDK"></i>
          <a href="?currency=DKK" data-country="DK">
            Denmark (kr)
          </a>
        </li>

        <li>
          <i class="flag spriteFI"></i>
          <a href="?currency=EUR" data-country="FI">
            Finland (€)
          </a>
        </li>

        <li>
          <i class="flag spriteFR"></i>
          <a href="?currency=EUR" data-country="FR">
            France (€)
          </a>
        </li>

        <li>
          <i class="flag spriteDE"></i>
          <a href="?currency=EUR" data-country="DE">
            Germany (€)
          </a>
        </li>

        <li>
          <i class="flag spriteIN"></i>
          <a href="?currency=USD" data-country="IN">
            India (₹)
          </a>
        </li>

        <li>
          <i class="flag spriteID"></i>
          <a href="?currency=USD" data-country="ID">
            Indonesia (Rp)
          </a>
        </li>

        <li>
          <i class="flag spriteIT"></i>
          <a href="?currency=EUR" data-country="IT">
            Italy (€)
          </a>
        </li>

        <li>
          <i class="flag spriteKW"></i>
          <a href="?currency=USD" data-country="KW">
            Kuwait (د.ك)
          </a>
        </li>

        <li>
          <i class="flag spriteLI"></i>
          <a href="?currency=USD" data-country="LI">
            Liechtenstein (Fr)
          </a>
        </li>

        <li>
          <i class="flag spriteMY"></i>
          <a href="?currency=USD" data-country="MY">
            Malaysia (RM)
          </a>
        </li>

        <li>
          <i class="flag spriteMX"></i>
          <a href="?currency=MXN" data-country="MX">
            Mexico (M$)
          </a>
        </li> -->

        <li>
          <i class="flag spriteNL"></i>
          <a href="?currency=EUR" data-country="NL">
            Netherlands (€)
          </a>
        </li>

        <!-- <li>
          <i class="flag spriteQA"></i>
          <a href="?currency=USD" data-country="QA">
            Qatar (ر.ق)
          </a>
        </li>

        <li>
          <i class="flag spriteSA"></i>
          <a href="?currency=USD" data-country="SA">
            Saudi Arabia (SAR)
          </a>
        </li>

        <li>
          <i class="flag spriteSG"></i>
          <a href="?currency=SGD" data-country="SG">
            Singapore (S$)
          </a>
        </li>

        <li>
          <i class="flag spriteSE"></i>
          <a href="?currency=SEK" data-country="SE">
            Sweden (kr)
          </a>
        </li>

        <li>
          <i class="flag spriteCH"></i>
          <a href="?currency=USD" data-country="CH">
            Switzerland (CHF)
          </a>
        </li>

        <li>
          <i class="flag spriteTR"></i>
          <a href="?currency=USD" data-country="TR">
            Turkey (TL)
          </a>
        </li>

        <li>
          <i class="flag spriteAE"></i>
          <a href="?currency=USD" data-country="AE">
            United Arab Emirates (AED)
          </a>
        </li> -->

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
<script type="text/javascript">
  jQuery(document).ready(function ($) {
    $('.countries a').click(function(){
      var cun = $(this).data('country');
      $.cookie('countryinit', cun, { expires: 1, path: '/' });
    });
  });
</script>
<?php get_footer(); ?>


