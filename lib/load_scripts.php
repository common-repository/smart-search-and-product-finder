<?php
function esse_load_dashboard_scripts()
{
	wp_enqueue_style('bootstrap_css', esse_serach_custom_url . 'css/bootstrap.css', true, ESSE_EDD_VERSION);
	wp_enqueue_script('bootstrap_js', esse_serach_custom_url . 'js/bootstrap.js', array('jquery'), ESSE_EDD_VERSION);
	wp_enqueue_script('custom_script_admin', esse_serach_custom_url . 'js/dashboard_scripts.js', array('jquery'), ESSE_EDD_VERSION);
	wp_enqueue_style('custom_style', esse_serach_custom_url . 'css/dashboard_styles.css', true, ESSE_EDD_VERSION);
	wp_enqueue_style('custom_style1', esse_serach_custom_url . 'css/dashboard_styles_old.css', true, ESSE_EDD_VERSION);
}
function esse_load_scripts()
{
	wp_enqueue_script('custom_script_admin', esse_serach_custom_url . 'js/scripts.js', array('jquery'), ESSE_EDD_VERSION);
	wp_enqueue_style('custom_style1', esse_serach_custom_url . 'css/styles.css', true, ESSE_EDD_VERSION);
}
?>