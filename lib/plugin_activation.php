<?php
function esse_create_default_options()
{

	delete_option("esse_plugin_options");
	$options = get_option('esse_plugin_options');
	if (!$options) {
		$a = array(
			'api_key' => '',
			"api_key_updated" => "false",
			"api_key_invalid_messsage" => "",
			"api_key_expired" => "false",
			"api_key_invalid" => "false",
			"products_synced" => "false"
		);
		add_option("esse_plugin_options", $a);
	}

	delete_option("search_bar_options");
	$search_options = get_option('search_bar_options');
	if (!$search_options) {
		$search = array(
			"card_round_border_enable" => 'on',
			"card_round_border" => "26px",
			"image_enable" => "on",
			"card_background_color" => "#FFFFFF",
			"input_background_color" => "auto",
			"scrollbar_background" => "#C7D2FE",
			"input_border_color" => "#C7D2FE",
			"input_background_color_enable" => 'off',
			"out_of_stock_background_enable" => 'off',
			"card_background_color_enable" => 'on',
			"scrollbar_background_enable" => 'on',
			"input_border_color_enable"=>'on'
		);
		add_option("search_bar_options", $search);
	}
}
?>