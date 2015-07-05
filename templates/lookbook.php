<?php
/*
Template Name: Lookbook
*/


global $wp_query;

// define upload directory
$upload_dir = wp_upload_dir()['baseurl'];

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
			
				<!-- Content Area START -->
				<?php
				$arrs = array(
					'lavish-pleated-sleeves-maxi-dress' => 'Lavish Pleated Sleeves Maxi Dress',
					'summer-nights-maxi-dress' => 'Summer Nights Maxi Dress',
					'cherry-blossom-maxi-dress' => 'Cherry Blossom Maxi Dress',
					'boho-chic-maxi-dress' => 'Boho Chic Maxi Dress',
					'black-lattice-maxi-dress' => 'Black Lattice Maxi Dress',
					'go-with-the-floral-maxi-dress' => 'Go With The Floral Maxi Dress',
					'black-out-lace-maxi-dress' => 'Black Out Lace Maxi Dress',
					'after-dark-lace-maxi-dress' => 'After Dark Lace Maxi Dress',
					'hope-maxi-dress' => 'Hope Maxi Dress',
					'snake-skin-kimono-cardigan' => 'Snake Skin Kimono Cardigan',
					'the-noreen-maxi-dress' => 'The Noreen Maxi Dress',
					'venice-maxi-dress' => 'Venice Maxi Dress',
					'zebra-pleated-maxi-skirt' => 'Zebra Pleated Maxi Skirt'
				);

				$i = 1;
				
				$small = '';

				// if( wp_is_mobile() ){
				// 	$small = '_360';
				// }

				foreach ( $arrs as $arrk => $arrv ): ?>
				
				<!-- <?php echo $arrv ?> -->
				<div class="row">
					<?php if( $i%2 ): ?>
					<div class="span12">
						<h2 class="text-center page-header"><?php echo $arrv ?></h2>
						<h4><?php echo $arrv ?> (Front)</h4>
					</div>
					<div class="span3">
						<a href="/shop/<?php echo $arrk; ?>/" title="Click to Buy Now">
							<?php $img = '<img src="' . home_url() . '/wp-content/uploads/lookbook/' . $arrk . '_1.jpg" alt="'. $arrk .'_1" width="800" height="1500" class="alignnone size-full" />';
							echo get_lazyloadxt_html( $img ); ?>
						</a>
					</div>
					<div class="span9">
						<video class="video" preload="none"  loop="loop">
						<source src="/wp-content/uploads/lookbook/<?php echo $arrk . $small; ?>_1.mp4" type="video/mp4">
							<?php echo $arrv ?> Front View
						</video>
					</div>
				  <?php else: ?>
				  <div class="span12">
						<h2 class="text-center page-header"><?php echo $arrv ?></h2>
						<h4 class="text-right"><?php echo $arrv ?> (Front)</h4>
					</div>
			  	<div class="span9">
						<video class="video" preload="none"  loop="loop">
						<source src="/wp-content/uploads/lookbook/<?php echo $arrk . $small; ?>_1.mp4" type="video/mp4">
							<?php echo $arrv ?> Front View
						</video>
					</div>
					<div class="span3">
						<a href="/shop/<?php echo $arrk; ?>/" title="Click to Buy Now">
							<?php $img = '<img src="' . home_url() . '/wp-content/uploads/lookbook/' . $arrk . '_1.jpg" alt="'. $arrk .'_1" width="800" height="1500" class="alignnone size-full" />';
							echo get_lazyloadxt_html( $img ); ?>
						</a>
					</div>
				  <?php endif; ?>
				</div>

				<div class="row">
					<?php if( $i%2 ): ?>
					<div class="span12">
						<h4 class="text-right"><?php echo $arrv . ' ';
						if( $arrk == 'venice-maxi-dress' ){
							echo '(Lace detail)';
						} else {
							echo '(Rear)';
						} ?></h4>
					</div>
					<div class="span9">
						<video class="video" preload="none"  loop="loop">
						<source src="/wp-content/uploads/lookbook/<?php echo $arrk . $small; ?>_2.mp4" type="video/mp4">
							<?php echo $arrv ?> Rear View
						</video>
					</div>
					<div class="span3">
						<a href="/shop/<?php echo $arrk; ?>/" title="Click to Buy Now">
							<?php $img = '<img src="' . home_url() . '/wp-content/uploads/lookbook/' . $arrk . '_2.jpg" alt="'. $arrk .'_2" width="800" height="1500" class="alignnone size-full" />';
							echo get_lazyloadxt_html( $img ); ?>
						</a>
					</div>
					<?php else: ?>
					<div class="span12">
						<h4><?php echo $arrv . ' ';
						if( $arrk == 'venice-maxi-dress' ){
							echo '(Lace detail)';
						} else {
							echo '(Rear)';
						} ?></h4>
					</div>
					<div class="span3">
						<a href="/shop/<?php echo $arrk; ?>/" title="Click to Buy Now">
							<?php $img = '<img src="' . home_url() . '/wp-content/uploads/lookbook/' . $arrk . '_2.jpg" alt="'. $arrk .'_2" width="800" height="1500" class="alignnone size-full" />';
							echo get_lazyloadxt_html( $img ); ?>
						</a>
					</div>
					<div class="span9">
						<video class="video" preload="none"  loop="loop">
						<source src="/wp-content/uploads/lookbook/<?php echo $arrk . $small; ?>_2.mp4" type="video/mp4">
							<?php echo $arrv ?> Rear View
						</video>
					</div>
					<?php endif; ?>
				</div>

				<div class="row">
					<?php if( $i%2 ): ?>
					<div class="span12">
						<h4><?php echo $arrv . ' ';
						if( $arrk == 'hope-maxi-dress' || $arrk == 'after-dark-lace-maxi-dress' ){
							echo '(Lace detail)';
						} else {
							echo '(Side)';
						} ?></h4>
					</div>
					<div class="span3">
						<a href="/shop/<?php echo $arrk; ?>/" title="Click to Buy Now">
							<?php $img = '<img src="' . home_url() . '/wp-content/uploads/lookbook/' . $arrk . '_3.jpg" alt="'. $arrk .'_3" width="800" height="1500" class="alignnone size-full" />';
							echo get_lazyloadxt_html( $img ); ?>
						</a>
					</div>
					<div class="span9">
						<video class="video" preload="none"  loop="loop">
						<source src="/wp-content/uploads/lookbook/<?php echo $arrk . $small; ?>_3.mp4" type="video/mp4">
							<?php echo $arrv ?> Side View
						</video>
					</div>
					<?php else: ?>
					<div class="span12">
						<h4 class="text-right"><?php echo $arrv . ' ';
						if( $arrk == 'hope-maxi-dress' || $arrk == 'after-dark-lace-maxi-dress' ){
							echo '(Lace detail)';
						} else {
							echo '(Side)';
						} ?></h4>
					</div>
					<div class="span9">
						<video class="video" preload="none"  loop="loop">
						<source src="/wp-content/uploads/lookbook/<?php echo $arrk . $small; ?>_3.mp4" type="video/mp4">
							<?php echo $arrv ?> Side View
						</video>
					</div>
					<div class="span3">
						<a href="/shop/<?php echo $arrk; ?>/" title="Click to Buy Now">
							<?php $img = '<img src="' . home_url() . '/wp-content/uploads/lookbook/' . $arrk . '_3.jpg" alt="'. $arrk .'_3" width="800" height="1500" class="alignnone size-full" />';
							echo get_lazyloadxt_html( $img ); ?>
						</a>
					</div>
					<?php endif; ?>
				</div>
				<div class="row">
					<div class="span12 buynowbtn">
						<a class="big active button alt" href="/shop/<?php echo $arrk; ?>/">Buy Now</a>
					</div>
				</div>
				<!-- END - <?php echo $arrv ?> -->

				<p>&nbsp;</p>
				<p>&nbsp;</p>
				
				<?php
				$i++;
				endforeach; ?>
				<!-- Content Area END -->
				
				<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', ETHEME_DOMAIN ), 'after' => '' ) ); ?>
				<?php edit_post_link( __( 'Edit', ETHEME_DOMAIN ), '', '' ); ?>
		<div class="clear"></div>    			
	</div>
	<div class="clear"></div>
</div>
</div><!-- .container -->

<?php if( !wp_is_mobile() ): ?>

<script>
var videos = document.getElementsByTagName("video"),
fraction = 0.8;

function checkScroll() {
	for(var i = 0; i < videos.length; i++) {

		var video = videos[i];

	  var x = video.offsetLeft, y = video.offsetTop, w = video.offsetWidth, h = video.offsetHeight, r = x + w, //right
	      b = y + h, //bottom
	      visibleX, visibleY, visible;

    visibleX = Math.max(0, Math.min(w, window.pageXOffset + window.innerWidth - x, r - window.pageXOffset));
    visibleY = Math.max(0, Math.min(h, window.pageYOffset + window.innerHeight - y, b - window.pageYOffset));

    visible = visibleX * visibleY / (w * h);

    if (visible > fraction) {
    	video.play();
    } else {
    	video.pause();
    }

    // video.addEventListener('mouseover', function(){
    // 	video.pause();
    // }, false);
  }
}
window.addEventListener('scroll', checkScroll, false);
window.addEventListener('resize', checkScroll, false);
</script>

<?php endif;

get_footer(); ?>