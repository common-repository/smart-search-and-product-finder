<?php 
function esse_get_product_details($product_id)
{
	$product = wc_get_product($product_id);
	$data['id'] = $product->get_id();
	$data['title'] = $product->get_title();
	$data['price'] = $product->get_price();
	$data['description'] = wp_strip_all_tags($product->get_description());
	if (wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'single-post-thumbnail') != false)
		$data['image'] = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'single-post-thumbnail')[0];
	$data['height'] = $product->get_height(); // Returns the product height.
	$data['length'] = $product->get_length(); // Returns the product length.
	$data['weight'] = $product->get_weight(); // Returns the product's weight.
	$data['width'] = $product->get_width(); // Returns the product width.

	$data['review_count'] = $product->get_review_count();
	$data['rating_count'] = $product->get_rating_count();
	$data['average_rating'] = $product->get_average_rating();
	$data['short_description'] = wp_strip_all_tags($product->get_short_description());
	$data['slug'] = $product->get_slug();
	$data['link'] = $product->get_permalink();
	$data['add_to_cart_url'] = $product->add_to_cart_url();
	$data['status'] = $product->get_status();
	$data['sku'] = $product->get_sku();
	$data['categories'] = wp_strip_all_tags($product->get_categories());
	$data['stock_quantity'] = $product->get_stock_quantity(); // get product stock quantity
	$data['stock_status'] = $product->is_in_stock(); // get stock status
	

	$data['product_type'] = $product->product_type; // get stock status
	if ($product->product_type == 'variable') {
		$data['childrens'] = $product->get_children();
		$data['variations'] = [];
		foreach($data['childrens'] as $key=>$val){ 
			$variable_product= new WC_Product_Variation( $val);
			$is_in_stock=$variable_product ->is_in_stock();
			$a = array(
				'variation_id' => $val,
				"attributes" => $variable_product->get_attributes()
			);
			array_push($data['variations'],$a);
			if($is_in_stock=='true'){
				$data['stock_status'] = true;
			}
	   }
	}

	$terms = get_terms('product_tag');
	$term_array = array();
	if (!empty($terms) && !is_wp_error($terms)) {
		foreach ($terms as $term) {
			if (count($product->get_tag_ids()) != 0) {
				if ($term->id = $product->get_tag_ids()[0]);
				$term_array[] = $term->name;
			}
		}
	}
	$data['tags'] = $term_array;
	$json = $product->get_attributes();
	foreach ($json as $key => $val) {
		$data['attributes'][$key] = $product->get_attribute($key);
	}
	$product_data = array(
		'product' => $data
	);
	return $product_data;
}
function esse_save_new_product($new_status, $old_status, $post)
{
	if (
		$old_status != 'publish'
		&& $new_status == 'publish'
		&& !empty($post->ID)
		&& in_array(
			$post->post_type,
			array('product')
		)
	) {
		$product_data = esse_get_product_details($post->ID);
		$result = esse_call_api('POST', ESSE_DOMAIN . "/products/new", $product_data, '', '');
	}
}
function esse_update_product($meta_id, $post_id, $meta_key, $meta_value)
{
	if ($meta_key == '_edit_lock') { // we've been editing the post
		if (get_post_type($post_id) == 'product') { // we've been editing a product
			$product_data = esse_get_product_details($post_id);
			$result = esse_call_api('PUT', ESSE_DOMAIN . "/products/" . $post_id, $product_data, '', '');
		}
	}
}
function esse_delete_product($product_id)
{
	if (get_post_type($product_id) !== 'product') return;
	$product_data = esse_get_product_details($product_id);
	$result = esse_call_api('DELETE', ESSE_DOMAIN . "/products/" . $product_id, $product_data, '', '');
}
function esse_save_untrash_product($product_id)
{
	if (get_post_type($product_id) !== 'product') return;
	$product_data = esse_get_product_details($product_id);
	$result = esse_call_api('POST', ESSE_DOMAIN . "/products/new", $product_data, '', '');
}

function esse_wpse211367_comment( $comment_ID, $comment_approved, $commentdata ) {
    // The id for the post that the comment is related to is available
    // in the $commentdata array:
    $product_id = $commentdata['comment_post_ID'];
	if (get_post_type($product_id) !== 'product') return;
	$product_data = esse_get_product_details($product_id);
	$result = esse_call_api('PUT', ESSE_DOMAIN . "/products/" . $product_id, $product_data, '', '');
}
add_action( 'comment_post', 'esse_wpse211367_comment', 10, 3 );
