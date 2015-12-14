<?php
/*
Template Name: Lookbook New
*/

if( isset( $_GET['lookbook_category'] )){
	$lookbook = esc_attr( $_GET['lookbook_category'] );
} else {
	$lookbook = 'maxi-dress';
}

get_header();

?><div class="container <?php echo $sidebarname; ?>">
	<div class="row">
		<?php blog_breadcrumbs(); ?>
		<div class="span12 grid_content with-sidebar-">
			<h1 class="page-title">Lookbook</h1>
			<ul class="lookbook-cat-list">
				<?php
				$terms = get_terms( 'lookbook_type' );
				if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
					foreach ( $terms as $term ) {
						$slug = esc_attr( $term->slug );
						echo '<li class="' . ($lookbook == $slug ? 'active' : '') . '"><a href="?lookbook_category=' . $slug . '">' . $term->name . '</a></li>';
					}
				}
				?>
			</ul>

			<?php
				$query = new WP_Query( array(
			 		'post_type' => 'lookbook',
			 		'posts_per_page'=> -1,
			 		'tax_query' => array(
						array(
							'taxonomy' => 'lookbook_type',
							'field'    => 'slug',
							'terms'    => $lookbook,
						),
					),
			 	));

				while ( $query->have_posts() ): $query->the_post(); ?>

					<h2 class="text-center page-header"><?php the_title(); ?></h2>

					<?php
					$field = get_field_object('umlb_view_types');
					$value = $field['value'];
					$choices = $field['choices'];

					$i=1;
					foreach( $value as $v ):

						if( $i%2 ): ?>
						<div class="row">
							<div class="span12">
								<h4><?php echo get_the_title() . ' (' . $choices[ $v ] . ')'; ?></h4>
							</div>
							<div class="span3">
								<a href="<?php echo wp_get_attachment_image_src( get_field( 'umlb_'. $v .'_image' ), 'full' )[0]; ?>" rel="lightbox"><?php echo wp_get_attachment_image( get_field( 'umlb_'. $v .'_image' ), 'medium' ); ?></a>
							</div>
							<div class="span9">
								<video class="video" preload="none"  loop="loop">
									<source src="<?php echo wp_get_attachment_url( get_field('umlb_'. $v .'_video') ); ?>" type="video/mp4">
									<?php echo get_the_title() . $choices[ $v ]; ?> View
								</video>
							</div>
						</div>

						<?php else: ?>
						<div class="row">
							<div class="span12">
								<h4 class="text-right"><?php echo get_the_title() . ' (' . $choices[ $v ] . ')'; ?></h4>
							</div>
							<div class="span9">
								<video class="video" preload="none" loop="loop">
									<source src="<?php echo wp_get_attachment_url( get_field('umlb_'. $v .'_video') ); ?>" type="video/mp4">
									<?php echo get_the_title() . $choices[ $v ]; ?> View
								</video>
							</div>
							<div class="span3">
								<a href="<?php echo wp_get_attachment_image_src( get_field( 'umlb_'. $v .'_image' ), 'full' )[0]; ?>" rel="lightbox"><?php echo wp_get_attachment_image( get_field( 'umlb_'. $v .'_image' ), 'medium' ); ?></a>
							</div>
						</div>
						<?php endif;

					$i++;
					endforeach; ?>

					<div class="row">
						<div class="span12 buynowbtn">
							<a class="big active button alt" href="<?php the_field('umlb_product_link'); ?>">Buy Now</a>
						</div>
					</div>

				<?php
				endwhile;
				wp_reset_query();
				?>
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