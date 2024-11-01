<?php 
function esse_short_code($atts)
{

	$plugin_options= array(
		"search_result_maximum_height" => esse_plugin_details['search_result_maximum_height'],
		"remaining_stock_count_below" => esse_plugin_details['remaining_stock_count_below'],
		"currency_symbol"=>get_woocommerce_currency_symbol()
	);
	$search_options = get_option('search_bar_options');
	$content = '<div class="search_main_card_esse"><form class="esse_form_class" id="esse_form_id" role="search" method="get"  action="' . get_site_url() . '">' .
		'<div style="position: relative;">' .
		'<input  autocomplete="off" id="esse_form_submit" value type="search" name="s" esse_search_bar_options=' . json_encode([$search_options]) . ' esse_plugin_options=' . json_encode([$plugin_options]) . '  class="search_bar_esse" placeholder="'.esse_plugin_details['search_place_holder'].'">' .
		'<svg style="position:absolute;left:18px;top:20px" width="18" height="18" viewBox="0 0 18 18" fill="none"' .
		'xmlns="http://www.w3.org/2000/svg">' .
		'<path fill-rule="evenodd" clip-rule="evenodd"' .
		'd="M7.33333 2.33317C4.57191 2.33317 2.33333 4.57175 2.33333 7.33317C2.33333 10.0946 4.57191 12.3332 7.33333 12.3332C10.0948 12.3332 12.3333 10.0946 12.3333 7.33317C12.3333 4.57175 10.0948 2.33317 7.33333 2.33317ZM0.666668 7.33317C0.666668 3.65127 3.65144 0.666504 7.33333 0.666504C11.0152 0.666504 14 3.65127 14 7.33317C14 8.87376 13.4774 10.2923 12.5999 11.4212L17.0893 15.9106C17.4147 16.236 17.4147 16.7637 17.0893 17.0891C16.7638 17.4145 16.2362 17.4145 15.9107 17.0891L11.4214 12.5997C10.2925 13.4773 8.87393 13.9998 7.33333 13.9998C3.65144 13.9998 0.666668 11.0151 0.666668 7.33317Z"' .
		'fill="#475569" />' .
		'</svg>' .
		'</div></form>' .
		'<div  class="esse_scroll_div"><div style="display:none" class="esse_card_margin" id="search-content">' .
		'<div style="height: 23px;"></div></div>' .
		'</div><div style="display:none" id="esse_scroll_balance_div"><div style="height:20px"></div></div>' .
		'</div>';
	return $content;
}
?>