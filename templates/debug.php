<?php
/*
Template Name: Debug Page
*/



// $old_order = new WC_Order( 17977 );
// $items = $old_order->get_items();

// foreach ( $items as $item ) {
// 	echo '<pre>';
// 	var_dump($item);
// 	echo '</pre>';

//     // $product_name = $item['name'];
//     // $product_id = $item['product_id'];
//     // $product_variation_id = $item['variation_id'];


//     // echo $product_name .' '. $product_id .' '. $product_variation_id;
// }

// die();











// $address = $old_order->get_address();

// $order = wc_create_order();
// $order->add_product( get_product( '12' ), 2 ); //(get_product with id and next is for quantity)
// $order->set_address( $address, 'billing' );
// $order->set_address( $address, 'shipping' );
// $order->add_coupon('Fresher','10','2'); // accepted param $couponcode, $couponamount,$coupon_tax
// $order->calculate_totals();












// ********* Get all products and variations and sort alphbetically, return in array (title, sku, id)*******
?>

<form action="<?php echo WC()->cart->get_checkout_url(); ?>" method="GET">

<select id="um-ws-list" name="um_org_pro_id"><?php
	$full_product_list = array();
	$loop = new WP_Query( array( 'post_type' => array('product', 'product_variation'), 'posts_per_page' => 10, 'post_status' => 'publish' ) );

	while ( $loop->have_posts() ) : $loop->the_post();
		$theid = get_the_ID();
		$parent_id = wp_get_post_parent_id($theid );
		$product = new WC_Product($theid);

		if( get_post_type() == 'product_variation' ){
			if( $product->stock ){
				$full_product_list[] = '<option value="'.$theid.'">'.get_the_title($parent_id).' - '.get_post_meta($theid,'attribute_pa_sizes',true).'</option>';
				// var_dump($product->stock);
				// var_dump(get_post_meta($theid));
			}
		} else {
			// echo '<li>'. get_the_id() .' '. get_the_title() .'</li>';
		}
	  // $umcurrent = array();

	  // if( empty($umallvar) ){
	  // 	foreach ( $umallvar as $umsvar ) {
		 //    echo get_the_title() . $umsvar['attributes']['attribute_pa_sizes'];
		 //  }
	  // }
	  


		// if( get_post_type() == 'product_variation' ){
		// 	$parent_id = wp_get_post_parent_id($theid );
		// 	$sku = get_post_meta($theid, '_sku', true );
		// 	$thetitle = wc_get_product_terms( $parent_id, 'pa_sizes', array( 'fields' => 'names' ) );
		// 	// $thetitle = get_post_meta( $theid, 'pa_sizes', true);
		// }

	  // $full_product_list[] = array($thetitle, $sku, $theid);
	endwhile;
	wp_reset_postdata();


	sort($full_product_list);
	foreach( $full_product_list as $item ){
		echo $item;
	}

	
  
  // sort into alphabetical order, by title
	// sort($full_product_list);
	// return $full_product_list;

?></select>
<input type="submit">
</form>


<pre>
<?php //var_dump(get_product(17853)) ?>
</pre>