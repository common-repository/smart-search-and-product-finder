<?php
function esse_call_api($method, $url, $data = false, $api_key = '', $site_url = '')
{
	$options = get_option('esse_plugin_options');
	if ($api_key == '') {
		$api_key = $options['api_key'];
	}
	if ($site_url == '') {
		$site_url = get_site_url();
	}
	switch ($method) {
		case "GET":
			$args = array(
				'headers' => array(
					'x-api-key' => $api_key,
					'x-site-url' => $site_url
				)
			);
			$response = wp_remote_get($url, $args);
			$result     = wp_remote_retrieve_body($response);
			$http_code = wp_remote_retrieve_response_code($response);
			$esse_api_result = array(
				"httpcode" => $http_code,
				'result' => $result
			);
			return $esse_api_result;
			break;
		case "POST":
			if ($data) {
				$args = array(
					'body'    => $data,
					'headers' => array(
						'x-api-key' => $api_key,
						'x-site-url' => $site_url
					)
				);
			} else {
				$args = array(

					'headers' => array(
						'x-api-key' => $api_key,
						'x-site-url' => $site_url
					)
				);
			}
			$response = wp_remote_post($url, $args);
			$http_code = wp_remote_retrieve_response_code($response);
			$result = wp_remote_retrieve_body($response);
			$esse_api_result = array(
				"httpcode" => $http_code,
				'result' => $result
			);
			return $esse_api_result;
			break;
		case "PUT":
			if ($data) {
				$args     = array(
					'body'    => $data,
					'headers' => array(
						'x-api-key' => $api_key,
						'x-site-url' => $site_url
					),
					'method' => 'PUT',
				);
				$response = wp_remote_request($url, $args);
				$result = wp_remote_retrieve_body($response);
				$esse_api_result = array(
					"httpcode" => $http_code,
					'result' => $result
				);
				return $esse_api_result;
			}
			break;
		case "DELETE":
			$args     = array(
				'headers' => array(
					'x-api-key' => $api_key,
					'x-site-url' => $site_url
				),
				'method' => 'DELETE',
			);
			$response = wp_remote_request($url, $args);
			$http_code = wp_remote_retrieve_response_code($response);
			$result = wp_remote_retrieve_body($response);
			$esse_api_result = array(
				"httpcode" => $http_code,
				'result' => $result
			);
			return $esse_api_result;
			break;
	}
}
