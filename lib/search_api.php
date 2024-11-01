<?php
function esse_only_search_for_full_phrase($query)
{
	if ($query->is_search() && $query->is_main_query()) {
		$url = str_replace(' ', '%20', sanitize_text_field($_GET['s']));
		$result = esse_call_api('GET', ESSE_DOMAIN . "/products/search?search=" . $url, '', '', '');
		if ($result['httpcode'] == 200) {
			$result = json_decode($result['result'], true);
			if ($result == null) {
				$result = array(0);
				$query->set('s', sanitize_text_field($_GET['s']));
			} else {
				if (count($result) == 0) {
					$result = array(0);
				}
				$query->set('post__in', $result);
				$query->set('s', '');
				add_filter('get_search_query', function ($user_search_query) {
					return  sanitize_text_field($_GET['s']);
				}, 999);
			}
		}
	}
}

?>