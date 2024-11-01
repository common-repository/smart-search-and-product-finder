<?php
function esse_init_dashboard()
{
    $options = get_option('esse_plugin_options');
    if ($options['api_key']) {
        $key_status = esse_call_api('POST', ESSE_DOMAIN . "/validate_api_key", array(), $options['api_key'], get_bloginfo('wpurl'));
        if ( $key_status['httpcode'] != 200) {
            $options['api_key_invalid_messsage'] = $key_status['result'];
            update_option('esse_plugin_options',$options);
        } else {
            $result = json_decode($key_status['result'], true);
            $options['products_synced'] = $result['products_synced'];
            $options['api_key_invalid_messsage'] = '';
            update_option('esse_plugin_options',$options);
        }
    }

    $plugin_icon = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjUwIiBoZWlnaHQ9IjI1MCIgdmlld0JveD0iMCAwIDI1MCAyNTAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxwYXRoIGQ9Ik0yMTMuMjk0IDIwNS4yMDdMMTY2LjgyMSAxNTkuNDc3QzE3OC45OTEgMTQ2LjI1NSAxODYuNDY4IDEyOC43NjggMTg2LjQ2OCAxMDkuNTI2QzE4Ni40NjIgNjguMzYzOSAxNTIuNTU4IDM1IDExMC43MzIgMzVDNjguOTA1OSAzNSAzNS4wMDE4IDY4LjM2MzkgMzUuMDAxOCAxMDkuNTI2QzM1LjAwMTggMTUwLjY4OCA2OC45MDU5IDE4NC4wNTIgMTEwLjczMiAxODQuMDUyQzEyOC44MDQgMTg0LjA1MiAxNDUuMzc5IDE3Ny44MDIgMTU4LjM5OCAxNjcuNDFMMjA1LjA1MiAyMTMuMzJDMjA3LjMyNSAyMTUuNTYgMjExLjAxNSAyMTUuNTYgMjEzLjI4OSAyMTMuMzJDMjE1LjU2NyAyMTEuMDgxIDIxNS41NjcgMjA3LjQ0NyAyMTMuMjk0IDIwNS4yMDdaTTExMC43MzIgMTcyLjU4NkM3NS4zNDI2IDE3Mi41ODYgNDYuNjUzOSAxNDQuMzUzIDQ2LjY1MzkgMTA5LjUyNkM0Ni42NTM5IDc0LjY5OTEgNzUuMzQyNiA0Ni40NjYzIDExMC43MzIgNDYuNDY2M0MxNDYuMTIyIDQ2LjQ2NjMgMTc0LjgxIDc0LjY5OTEgMTc0LjgxIDEwOS41MjZDMTc0LjgxIDE0NC4zNTMgMTQ2LjEyMiAxNzIuNTg2IDExMC43MzIgMTcyLjU4NloiIGZpbGw9IndoaXRlIiBzdHJva2U9IndoaXRlIiBzdHJva2Utd2lkdGg9IjUiLz4KPC9zdmc+Cg==';
    add_menu_page(esse_plugin_details['name'], esse_plugin_details['name'], 'manage_options', esse_plugin_details['admin_path'], 'esse_render_settings_page', $plugin_icon, '55.5');


    /**
     * Check if WooCommerce is active
     **/
    if (
        !in_array(
            'woocommerce/woocommerce.php',
            apply_filters('active_plugins', get_option('active_plugins'))
        )
    ) {
        add_action('admin_notices', 'esse_wpb_admin_notice_warn');
    }

    function esse_wpb_admin_notice_warn()
    {
        echo '<div class="notice notice-error" style="padding:10px;line-height:2">' . esse_plugin_details['woocommerce_missing'] .
            '</div>';
        $options = get_option('esse_plugin_options');
        if ($options['api_key_invalid_messsage'] != '') {
            echo '<div class="notice notice-error" style="padding:10px;line-height:2">' . esse_plugin_details['invalid_key_message'] .
                '</div>';
        }
    }

}
?>