
jQuery(function ($) {
    $('.esse_checkbox').change(function () {
        if ($(this).is(':checked')) {
            $(this).next().next().children().css('display', 'block');
        } else {
            $(this).next().next().children().css('display', 'none');
        }
    });
    $('#title_font_color_enable').change(function () {
        if ($(this).is(':checked')) {
            $(this).parent().append('<input id="title_font_color" name="search_bar_options[title_font_color]" type="color" value />');
        } else {
            $('#title_font_color').remove();
        }
    });

    $('#add_to_cart_background_enable').change(function () {
        if ($(this).is(':checked')) {
            $(this).parent().append('<input id="add_to_cart_background" name="search_bar_options[add_to_cart_background]" type="color" value />');
        } else {
            $('#add_to_cart_background').remove();
        }
    });
    $('#view_cart_background_enable').change(function () {
        if ($(this).is(':checked')) {
            $(this).parent().append('<input id="view_cart_background" name="search_bar_options[view_cart_background]" type="color" value />');
        } else {
            $('#view_cart_background').remove();
        }
    });
    $('#out_of_stock_background_enable').change(function () {
        if ($(this).is(':checked')) {
            $(this).parent().append('<input id="out_of_stock_background" name="search_bar_options[out_of_stock_background]" type="color" value />');
        } else {
            $('#out_of_stock_background').remove();
        }
    });
    const urlParams = new URLSearchParams(window.location.search);
    const api_key = urlParams.get('api_key');
    const is_valid_api_key = document.getElementById("valid_plugin_api_key");
    if (api_key && !is_valid_api_key) {
        if (api_key != $('#sk_plugin_setting_api_key').val()) {
            $('#sk_plugin_setting_api_key').val(api_key);
            $('#sk_plugin_setting_api_update_btn').click();
            $('<span class="spinner is-active" style="float:left;margin: auto;opacity: 1;margin-top: -3px;margin-left: -5px;"></span>').insertBefore("#save_btn_text");
            setTimeout(() => {
                $("#sk_plugin_setting_api_update_btn").attr("disabled", "disabled");
            }, 10);
        }
    }
    $('#sk_plugin_setting_api_update_btn').click(function () {
        $('<span class="spinner is-active" style="float:left;margin: auto;opacity: 1;margin-top: -3px;margin-left: -5px;"></span>').insertBefore("#save_btn_text");
        setTimeout(() => {
            $("#sk_plugin_setting_api_update_btn").attr("disabled", "disabled");
        }, 10);

    });
    $('#card_round_border').on('keypress', function (e) {
        if (e.which == 32) {
            setTimeout(() => { $('#card_round_border').val($('#card_round_border').val().replace(' ', '')); }, 10);
        }
    });
});