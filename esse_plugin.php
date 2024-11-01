<?php

/*
 * Plugin Name:       Smart search & product finder
 * Description:       The most advanced WooCommerce product search plugin using AI. It offers natural language search capabilities that allow customers to quickly enter everyday language queries and receive accurate results. By improving search efficiency and enhancing the customer experience, our plugin can help increase sales and boost your online store's success.
 * Version:           1.0.0
 * Requires at least: 4.4.0
 * Requires PHP: 7.4.33
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */


use LDAP\Result;

define('esse_serach_custom_url', plugin_dir_url(__FILE__));
define('ESSE_EDD_VERSION', '1.0.0');
// define('ESSE_DOMAIN', 'http://localhost:8000');
define('ESSE_DOMAIN', 'https://search.ria.rocks');
include dirname(__FILE__)  . '/lib/load_scripts.php'; // load javascript and css files
add_action('admin_enqueue_scripts', 'esse_load_dashboard_scripts');
add_action('wp_enqueue_scripts', 'esse_load_scripts');
include dirname(__FILE__)  . '/lib/api_call.php'; // External Api call 
$result = esse_call_api('GET', ESSE_DOMAIN . "/plugin_details", '', 'api_key', '');
$result = json_decode($result['result'], true);
define('esse_plugin_details', $result);
add_action('wp_trash_post', 'esse_delete_product', 10, 1);
add_action('untrash_post', 'esse_save_untrash_product', 10, 1);
add_action('transition_post_status', 'esse_save_new_product', 10, 3);
add_action('updated_post_meta', 'esse_update_product', 10, 4);
include dirname(__FILE__)  . '/lib/update_product_changes.php';  //Update product changes using external API
include dirname(__FILE__)  . '/lib/plugin_activation.php';  //Create default options and redirect to settings page
include dirname(__FILE__)  . '/lib/dashboard.php'; // dashboard functions
include dirname(__FILE__)  . '/lib/search_api.php'; // search external API call
add_action('pre_get_posts', 'esse_only_search_for_full_phrase');
include dirname(__FILE__)  . '/lib/sync_products.php'; // search products to external API
include dirname(__FILE__)  . '/lib/shortcode_content.php'; // short code content
add_shortcode(esse_plugin_details['short_code'], 'esse_short_code');
add_action('rest_api_init', 'esse_rest_apis');
include dirname(__FILE__)  . '/lib/rest_apis.php'; // short code content
function esse_activation_redirect($plugin)
{
	if ($plugin == plugin_basename(__FILE__)) {
		exit(wp_redirect(admin_url('admin.php?page=' . esse_plugin_details['admin_path'])));
	}
}
add_action('activated_plugin', 'esse_activation_redirect');

register_activation_hook(__FILE__, 'esse_create_default_options');
