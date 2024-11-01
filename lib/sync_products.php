<?php
function esse_api_key_update($api_key)
{
	$args = array(
		'status' => 'publish', 'limit' => -1
	);
	$products = wc_get_products($args);
	$data = [];
	$i = 0;
	foreach ($products as $product) {
		$data[$i]['id'] = $product->get_id();
		$data[$i]['title'] = $product->get_title();
		$data[$i]['price'] = $product->get_price();
		$data[$i]['description'] = wp_strip_all_tags($product->get_description());
		if (wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'single-post-thumbnail') != false)
			$data[$i]['image'] = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'single-post-thumbnail')[0];
		$data[$i]['height'] = $product->get_height(); // Returns the product height.
		$data[$i]['length'] = $product->get_length(); // Returns the product length.
		$data[$i]['weight'] = $product->get_weight(); // Returns the product's weight.
		$data[$i]['width'] = $product->get_width(); // Returns the product width.

		$data[$i]['review_count'] = $product->get_review_count();
		$data[$i]['rating_count'] = $product->get_rating_count();
		$data[$i]['average_rating'] = $product->get_average_rating();
		$data[$i]['short_description'] = wp_strip_all_tags($product->get_short_description());
		$data[$i]['slug'] = $product->get_slug();
		$data[$i]['link'] = $product->get_permalink();
		$data[$i]['add_to_cart_url'] = $product->add_to_cart_url();
		$data[$i]['status'] = $product->get_status();
		$data[$i]['sku'] = $product->get_sku();
		$data[$i]['categories'] = wp_strip_all_tags($product->get_categories());
		$data[$i]['stock_quantity'] = $product->get_stock_quantity(); // get product stock quantity
		$data[$i]['stock_status'] = $product->is_in_stock(); // get stock status
		$data[$i]['product_type'] = $product->product_type; // get stock status

	if ($product->product_type == 'variable') {
		$data[$i]['childrens'] = $product->get_children();
		$data[$i]['variations'] = [];
		foreach($data[$i]['childrens'] as $key=>$val){ 
			$variable_product= new WC_Product_Variation( $val);
			$is_in_stock=$variable_product ->is_in_stock();
			$a = array(
				'variation_id' => $val,
				"attributes" => $variable_product->get_attributes()
			);
			array_push($data[$i]['variations'],$a);
			if($is_in_stock=='true'){
				$data[$i]['stock_status'] = true;
			}
	   }
	}


		$json = $product->get_attributes();
		foreach ($json as $key => $val) {
			$data[$i]['attributes'][$key] = $product->get_attribute($key);
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
		$data[$i]['tags'] = $term_array;
		$i++;
	}
	$product_data = array(
		'products' => $data
	);
	$result = esse_call_api('POST', ESSE_DOMAIN . "/products", $product_data, $api_key, '');
	return $result;
}
