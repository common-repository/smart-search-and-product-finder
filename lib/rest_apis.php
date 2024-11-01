<?php
function esse_rest_apis(){
        register_rest_route('esse_api/v0.1', 'search', [
            'method' => 'GET',
            'callback' => __NAMESPACE__ . '\\esse_search_ajax_api',
            'args'     => array(
                'query' => array(
                    'required'          => true,
                    'default'           => '',
                    'type'              => 'string',
                    'sanitize_callback' => 'sanitize_text_field',
                )
            ),
        ]);
    
}
function esse_search_ajax_api(\WP_REST_Request $request)
{
	$result = esse_call_api('GET', ESSE_DOMAIN . "/products/search_esse?search=" . urlencode($request['query']), '', '', '');
	if ($result['httpcode'] == 200) {
		$result = json_decode($result['result'], true);
		return $result;
	}
}
?>