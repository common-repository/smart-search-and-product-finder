<?php
function esse_register_settings()
{
    register_setting('esse_plugin_options', 'esse_plugin_options', 'esse_plugin_options_validate');
    register_setting('search_bar_options', 'search_bar_options', 'esse_search_bar_options_validate');
}
function esse_search_bar_options_validate($input)
{

// sanitize
$input['image_enable']=sanitize_text_field($input['image_enable']);
$input['card_background_color_enable']=sanitize_text_field($input['card_background_color_enable']);
$input['input_background_color_enable']=sanitize_text_field($input['input_background_color_enable']);
$input['input_border_color_enable']=sanitize_text_field($input['input_border_color_enable']);
$input['scrollbar_background_enable']=sanitize_text_field($input['scrollbar_background_enable']);
$input['card_round_border_enable']=sanitize_text_field($input['card_round_border_enable']);

$input['card_background_color']=sanitize_hex_color($input['card_background_color']);
$input['input_background_color']=sanitize_hex_color($input['input_background_color']);
$input['input_border_color']=sanitize_hex_color($input['input_border_color']);
$input['scrollbar_background']=sanitize_hex_color($input['scrollbar_background']);
$input['card_round_border']=sanitize_text_field($input['card_round_border']);

$input['reset_to_default']=rest_sanitize_boolean($input['reset_to_default']);
// sanitize end



    if ($input['image_enable']  != 'on') {
        $input['image_enable'] = 'off';
    }

    if ($input['card_background_color_enable'] != 'on') {
        $input['card_background_color_enable'] = 'off';
        $input['card_background_color'] = 'transparent';
    }
    if ($input['input_background_color_enable'] != 'on') {
        $input['input_background_color_enable'] = 'off';
        $input['input_background_color'] = 'auto';
    }
    if ($input['input_border_color_enable'] != 'on') {
        $input['input_border_color_enable'] = 'off';
        $input['input_border_color'] = 'auto';
    }
    if ($input['scrollbar_background_enable'] != 'on') {
        $input['scrollbar_background_enable'] = 'off';
        $input['scrollbar_background'] = 'auto';
    }
    if ($input['card_round_border_enable'] != 'on') {
        $input['card_round_border_enable'] = 'off';
        $input['card_round_border'] = '0px';
    } 

    if ($input['reset_to_default'] == 'true') {

        $input['card_round_border_enable'] = 'on';
        $input['card_round_border'] = '26px';
        $input['image_enable'] = 'on';
        $input['card_background_color'] = '#FFFFFF';
        $input['input_background_color'] = 'auto';
        $input['scrollbar_background'] = '#C7D2FE';
        $input['input_border_color'] = '#C7D2FE';
        $input['input_background_color_enable'] = 'off';
        $input['card_background_color_enable'] = 'on';
        $input['scrollbar_background_enable'] = 'on';
        $input['input_border_color_enable'] = 'on';
    return $input;
}
return $input;
}


?>