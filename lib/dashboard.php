<?php

include dirname(__FILE__)  . '/init_dashboard.php'; // Dashboard on start functions
include dirname(__FILE__)  . '/dashboard_ui.php'; // Dashboard Ui
add_action('admin_menu', 'esse_init_dashboard');
add_action('admin_init', 'esse_register_settings');
include dirname(__FILE__)  . '/search_customizations.php'; // Search customisation options