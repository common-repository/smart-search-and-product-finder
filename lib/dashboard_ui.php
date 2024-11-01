<?php
function esse_render_settings_page()
{
    $result = esse_plugin_details;
    $options = get_option('esse_plugin_options');
    $search_options = get_option('search_bar_options');
?>
    <form action="options.php" method="post">
        <?php
        settings_fields('esse_plugin_options');
        $allowed_tags = array( 'br' => array() );
        $kses_defaults = wp_kses_allowed_html( 'post' );
        $svg_args = array(
            'svg'   => array(
                'class'           => true,
                'aria-hidden'     => true,
                'aria-labelledby' => true,
                'role'            => true,
                'xmlns'           => true,
                'width'           => true,
                'height'          => true,
                'viewbox'         => true, // <= Must be lower case!
            ),
            'g'     => array( 'fill' => true ),
            'title' => array( 'title' => true ),
            'path'  => array( 
                'd'               => true, 
                'fill'            => true ,
                'stroke'          =>true,
                'fill-rule' =>true,
            ),
            'xmlns' =>true,
            'width' =>true,
            'height' =>true,
            'viewBox' =>true,
            'version' =>true,
        );
        
        $logo_tags = array_merge( $kses_defaults, $svg_args );

        ?>
        <?php
        if (esc_attr($options['api_key']) && esc_attr($options['api_key_invalid_messsage']) == '' && esc_attr($options['products_synced']) == true) {  ?>
            <div class="row esse_main_row px-4 pt-5">
                <div class="col-lg-6 px-4 pt-5 text-end col-sm-12">
                    <div class="esse_card_start">
                        <div class="esse_logo">
                            <?php echo wp_kses($result['logo'],$logo_tags) ?>
                        </div>
                        <div class="esse_description">
                            <?php echo wp_kses($result['admin_short_description_start'],$allowed_tags) ?> <span class="esse_search"><?php echo wp_kses($result['admin_short_description_blue_text'],$allowed_tags) ?></span> <?php echo wp_kses($result['admin_short_description_end'],$allowed_tags) ?>
                        </div>
                        <div class="esse_description_2">
                            <?php echo wp_kses($result['admin_second_description'],$allowed_tags) ?>
                        </div>
                        <div class="esse_api_key"><?php echo esc_html($result['key_name']) ?></div>
                        <input value='<?php echo esc_html($options['api_key']) ?>' disabled class="esse_key_input">
                        <div class="esse_message">
                            <?php echo wp_kses($result['admin_plugin_activated_text_start'],$allowed_tags) ?>
                            <a href="<?php echo esc_url(ESSE_DOMAIN) ?>/login?site_url=<?php echo esc_url(get_bloginfo('wpurl')) ?>" class="esse_a_href">
                                <?php echo esc_html($result['admin_plugin_activated_text_redirect']) ?>
                            </a> <?php echo wp_kses($result['admin_plugin_activated_text_end'],$allowed_tags) ?>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 px-4 pt-5 text-start col-sm-12">
                    <div class="esse_card_end">
                        <div class="customise_plugin"><?php echo esc_html($result['customise_plugin_heading']) ?></div>
                        <form action="options.php" method="post">
                            <?php
                            settings_fields('search_bar_options');
                            ?>
                            <div class="esse_field_box">
                                <div class="esse_field_loop">
                                    <input <?php if (esc_attr($search_options['image_enable']) == 'on') { ?> checked="true" <?php }  ?> id='image_enable' name="search_bar_options[image_enable]" type="checkbox" class="esse_checkbox"><span class="esse_field_name">
                                        <?php echo esc_html($result['show_product_image']) ?></span>
                                </div>
                                <div class="esse_field_loop">
                                    <input <?php if (esc_attr($search_options['card_background_color_enable']) == 'on') { ?> checked="true" <?php }  ?> id='card_background_color_enable' name='search_bar_options[card_background_color_enable]' type="checkbox" class="esse_checkbox"><span class="esse_field_name">
                                        <?php echo esc_html($result['custom_background_color']) ?>
                                    </span>
                                    <div class="esse_color_input_box">
                                        <input <?php if (esc_attr($search_options['card_background_color_enable']) == 'on') { ?> style="display:block" <?php } else { ?>style="display:none" <?php } ?> id='card_background_color' name='search_bar_options[card_background_color]' class="esse_color_input" value=<?php echo esc_attr($search_options['card_background_color']) ?> type="color" class="esse_color_input">
                                    </div>
                                </div>
                                <div class="esse_field_loop">
                                    <input <?php if (esc_attr($search_options['input_background_color_enable']) == 'on') { ?> checked="true" <?php }  ?> id='input_background_color_enable' name='search_bar_options[input_background_color_enable]' type="checkbox" class="esse_checkbox"><span class="esse_field_name">
                                        <?php echo esc_html($result['input_background_color']) ?>
                                    </span>
                                    <div class="esse_color_input_box">
                                        <input <?php if (esc_attr($search_options['input_background_color_enable']) == 'on') { ?> style="display:block" <?php } else { ?>style="display:none" <?php } ?> id='input_background_color' name='search_bar_options[input_background_color]' class="esse_color_input" value=<?php echo esc_attr($search_options['input_background_color']) ?> type="color" class="esse_color_input">
                                    </div>
                                </div>
                                <div class="esse_field_loop">
                                    <input <?php if (esc_attr($search_options['input_border_color_enable']) == 'on') { ?> checked="true" <?php }  ?> id='input_border_color_enable' name='search_bar_options[input_border_color_enable]' type="checkbox" class="esse_checkbox"><span class="esse_field_name">
                                        <?php echo esc_html($result['input_border_color']) ?>
                                    </span>
                                    <div class="esse_color_input_box">
                                        <input <?php if (esc_attr($search_options['input_border_color_enable']) == 'on') { ?> style="display:block" <?php } else { ?>style="display:none" <?php } ?> id='input_border_color' name='search_bar_options[input_border_color]' class="esse_color_input" value=<?php echo esc_attr($search_options['input_border_color']) ?> type="color" class="esse_color_input">
                                    </div>
                                </div>

                                <div class="esse_field_loop">
                                    <input <?php if (esc_attr($search_options['scrollbar_background_enable']) == 'on') { ?> checked="true" <?php }  ?> id='scrollbar_background_enable' name='search_bar_options[scrollbar_background_enable]' type="checkbox" class="esse_checkbox"><span class="esse_field_name">
                                        <?php echo esc_html($result['scrolbar_color']) ?>
                                    </span>
                                    <div class="esse_color_input_box">
                                        <input <?php if (esc_attr($search_options['scrollbar_background_enable']) == 'on') { ?> style="display:block" <?php } else { ?>style="display:none" <?php } ?> id='scrollbar_background' name='search_bar_options[scrollbar_background]' class="esse_color_input" value=<?php echo esc_attr($search_options['scrollbar_background']) ?> type="color" class="esse_color_input">
                                    </div>
                                </div>

                                <div class="esse_field_loop">
                                    <input <?php if (esc_attr($search_options['card_round_border_enable']) == 'on') { ?> checked="true" <?php }  ?> id='card_round_border_enable' name='search_bar_options[card_round_border_enable]' type="checkbox" class="esse_checkbox"><span class="esse_field_name">
                                        <?php echo esc_html($result['enable_rounded_corners']) ?>
                                    </span>
                                    <div class="esse_color_input_box">
                                        <input <?php if (esc_attr($search_options['card_round_border_enable']) == 'on') { ?> style="display:block" <?php } else { ?>style="display:none" <?php } ?> id='card_round_border' name='search_bar_options[card_round_border]' class="esse_text_input" value=<?php echo esc_attr($search_options['card_round_border']) ?> type="text">
                                    </div>
                                </div>
                            </div>
                            <button type='submit' class="esse_save_and_submit esse_save_and_submit_2"><span class="esse_save_and_submit_text">
                                    <?php echo esc_html($result['save_changes_btn']) ?>
                                </span></button>
                            <button id="search_bar_options[reset_to_default]" name="search_bar_options[reset_to_default]" class="reset_to_default" type="submit" value="true">
                                <?php echo esc_html($result['reset_to_default_btn']) ?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>





        <?php } else {  ?>
            <div style="margin-top:15vh;">
                <div style="text-align:center">
                
                    <h1 class="esse_logo_old">
                        <?php echo wp_kses($result['logo'],$logo_tags) ?>
                    </h1>
                    <span class="esse_description_old"><?php echo wp_kses($result['admin_short_description_start'],$allowed_tags) ?> <span class="esse_search"><?php echo wp_kses($result['admin_short_description_blue_text'],$allowed_tags) ?></span> <?php echo wp_kses($result['admin_short_description_end'],$allowed_tags) ?></span><br>
                    <br>


                    <span class="esse_description_2_old"><?php echo wp_kses($result['admin_second_description'],$allowed_tags) ?></span><br>
                    <?php
                    if (esc_attr($options['api_key']) == '' || esc_attr($options['api_key_invalid_messsage']) != '') { ?>

                        <a class="esse_a_href_old" href="<?php echo esc_url(ESSE_DOMAIN) ?>/login?site_url=<?php echo  esc_url(get_bloginfo('wpurl')) ?>">
                            <div class="esse_get_started">
                                <span class="esse_get_started_text">
                                    <?php echo esc_html($result['admin_get_started_button_text']) ?>
                                </span>
                            </div>
                        </a>
                    <?php }  ?>
                    <?php
                    if (esc_attr($options['api_key']) && esc_attr($options['api_key_invalid_messsage']) == '') { ?>
                        <br><br><br>
                    <?php }  ?>
                    <br>
                    <div style="display:flex; justify-content: center;">
                        <span class="esse_api_key_old"><?php echo esc_html($result['key_name']) ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input class="esse_key_input_old" <?php
                                                            if (esc_attr($options['api_key']) && esc_attr($options['api_key_invalid_messsage']) == '' && esc_attr($options['products_synced']) == true) { ?> disabled style="width:412px!important;" <?php }  ?> placeholder="enter API key here" id='sk_plugin_setting_api_key' name='esse_plugin_options[api_key]' type='text' value='<?php echo esc_html($options['api_key']) ?>'>

                        <button <?php if (esc_attr($options['api_key']) && esc_attr($options['api_key_invalid_messsage']) == '' && esc_attr($options['products_synced']) == true) { ?> style="display:none" <?php }  ?> class="esse_save_and_submit_old" id='sk_plugin_setting_api_update_btn' class='button  page-title-action' type='submit'>
                            <span class="esse_save_and_submit_text_old" id="save_btn_text">
                                <?php echo esc_html($result['admin_save_button_text']) ?>
                            </span>
                        </button>
                    </div>
                    <br><br>
                    <?php
                    if (!esc_attr($options['api_key'])) { ?>
                        <div class="esse_message_old"><?php echo wp_kses($result['admin_purchase_plugin_text_start'],$allowed_tags) ?> <a target="_blank" rel="noopener noreferrer" href="<?php echo esc_url(ESSE_DOMAIN) ?>/login?site_url=<?php echo  esc_url(get_bloginfo('wpurl')) ?>"><?php echo esc_html($result['admin_purchase_plugin_text_redirect']) ?></a> <?php echo wp_kses($result['admin_purchase_plugin_text_end'],$allowed_tags) ?>
                        </div>
                    <?php } else 
        if (esc_attr($options['api_key_invalid_messsage'])) { ?>
                        <div class="esse_message_old"> <?php echo wp_kses($options['api_key_invalid_messsage'],$allowed_tags) ?>, <?php echo wp_kses($result['admin_purchase_plugin_text_start'],$allowed_tags) ?> <a target="_blank" rel="noopener noreferrer" href="<?php echo esc_url(ESSE_DOMAIN) ?>/login?site_url=<?php echo  esc_url(get_bloginfo('wpurl')) ?>"><?php echo esc_html($result['admin_purchase_plugin_text_redirect']) ?></a> <?php echo wp_kses($result['admin_purchase_plugin_text_end'],$allowed_tags) ?></div>
                    <?php } else { ?>
                        <div class="esse_message_old" id="valid_plugin_api_key"><?php echo wp_kses($result['admin_plugin_activated_text_start'],$allowed_tags) ?> <a target="_blank" rel="noopener noreferrer" href="<?php echo esc_url(ESSE_DOMAIN) ?>/login?site_url=<?php echo  esc_url(get_bloginfo('wpurl')) ?>"><?php echo esc_html($result['admin_plugin_activated_text_redirect']) ?></a> <?php echo wp_kses($result['admin_plugin_activated_text_end'],$allowed_tags) ?></div>
                    <?php }  ?>
                </div>
            <?php }  ?>
    </form>
<?php
}
function esse_plugin_options_validate($input)
{
    $input['api_key']=sanitize_key($input['api_key']);

    $result = esse_call_api('POST', ESSE_DOMAIN . "/validate_api_key", array(), $input['api_key'], get_bloginfo('wpurl'));
    if ($result['httpcode'] != 200) {
        $input['api_key_invalid_messsage'] = sanitize_text_field($result);
        return $input;
    } else {
        $input['api_key_invalid_messsage'] = '';
        esse_api_key_update($input['api_key']);
        $input['products_synced'] = 'true';
        return $input;
    }
}
?>