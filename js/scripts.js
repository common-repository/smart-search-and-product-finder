
jQuery(function ($) {
    function customize_search() {
        let esse_search_bar_options = $("#esse_form_submit").attr('esse_search_bar_options');
        esse_search_bar_options = JSON.parse(esse_search_bar_options);
        let esse_plugin_options = $("#esse_form_submit").attr('esse_plugin_options');
        esse_plugin_options = JSON.parse(esse_plugin_options);
        if (esse_search_bar_options[0].image_enable == 'on') {
            $(".esse_item_image").css('display', 'block');
        } else {
            $(".esse_item_image").css('display', 'none');
        }
        if (esse_search_bar_options[0].card_background_color_enable == 'on') {
            $(".search_main_card_esse").css('background-color', esse_search_bar_options[0].card_background_color);
        } else {
            $(".search_main_card_esse").css('background-color', 'transparent');
        }
        if (esse_search_bar_options[0].input_background_color_enable == 'on') {
            $(".search_bar_esse").css('background-color', esse_search_bar_options[0].input_background_color);
        } else {
            $(".search_bar_esse").css('background-color', 'transparent');
        }
        if (esse_search_bar_options[0].input_border_color_enable == 'on') {
            $(".search_bar_esse").css('border-color', esse_search_bar_options[0].input_border_color);
        } else {
            $(".search_bar_esse").css('border-color', 'transparent');
        }

        // if (esse_search_bar_options[0].add_to_cart_background_enable) {
        //     $(".esse_item_add_to_cart_btn").css('background-color', esse_search_bar_options[0].add_to_cart_background);
        // }
        if (esse_search_bar_options[0].scrollbar_background_enable == 'on') {
            if (esse_search_bar_options[0].card_round_border_enable == 'on') {
                $("<style type='text/css'> ::-webkit-scrollbar-thumb { background: " + esse_search_bar_options[0].scrollbar_background + "!important;border-radius: " + esse_search_bar_options[0].card_round_border + ";height: 200px;}</style>").appendTo("head");
                $("<style type='text/css'> ::-webkit-scrollbar-track { border-radius: " + esse_search_bar_options[0].card_round_border + ";}</style>").appendTo("head");
            } else {
                $("<style type='text/css'> ::-webkit-scrollbar-thumb { background: " + esse_search_bar_options[0].scrollbar_background + "!important;border-radius: 0px;height: 200px;}</style>").appendTo("head");
                $("<style type='text/css'> ::-webkit-scrollbar-track { border-radius: 0px;}</style>").appendTo("head");
            }
        } else {
            if (esse_search_bar_options[0].card_round_border_enable == 'on') {
                $("<style type='text/css'> ::-webkit-scrollbar-thumb { background: " + esse_search_bar_options[0].scrollbar_background + "!important;border-radius: " + esse_search_bar_options[0].card_round_border + ";height: 200px;}</style>").appendTo("head");
                $("<style type='text/css'> ::-webkit-scrollbar-track { border-radius: " + esse_search_bar_options[0].card_round_border + ";}</style>").appendTo("head");
            } else {
                $("<style type='text/css'> ::-webkit-scrollbar-thumb { background: " + esse_search_bar_options[0].scrollbar_background + "!important;border-radius: 0px;height: 200px;}</style>").appendTo("head");
                $("<style type='text/css'> ::-webkit-scrollbar-track { border-radius: 0px;}</style>").appendTo("head");
            }
        }
        if (esse_search_bar_options[0].card_round_border_enable == 'on') {
            $(".search_bar_esse").css('border-radius', esse_search_bar_options[0].card_round_border);
            $(".search_main_card_esse").css('border-radius', esse_search_bar_options[0].card_round_border);
        } else {
            $(".search_bar_esse").css('border-radius', '0px');
            $(".search_main_card_esse").css('border-radius', '0px');
        }

        $(".esse_scroll_div").css('max-height', esse_plugin_options[0].search_result_maximum_height);
    }
    function show_result(show, element) {
        if (show) {
            $(element).css('display', 'block');
            $(element).parent().next().css('display', 'block');
            $(element).parent().css('display', 'block');
        } else {
            $(element).css('display', 'none');
            $(element).parent().next().css('display', 'none');
            $(element).parent().css('display', 'none');
        }
    }
    $('document').ready(function () {
        try {
            let esse_plugin_options = $("#esse_form_submit").attr('esse_plugin_options');
            esse_plugin_options = JSON.parse(esse_plugin_options);
            if(!esse_plugin_options[0].currency_symbol)
            esse_plugin_options[0].currency_symbol='';
        customize_search();
        show_result(false, '.esse_card_margin',);
        var xhr = 0;
        $(".search_bar_esse").
            keyup(function (e) {
                if (e.which == 8) { //back space
                    show_result(false, $(this).parent().parent().next().children());
                } else {
                    if ($(this).parent().parent().next().children().children().length == 0) {
                        show_result(false, $(this).parent().parent().next().children());
                    } else {
                        show_result(true, $(this).parent().parent().next().children());
                    }
                }
                if (this.value.length < 3) {
                    $(this).parent().parent().next().children().html('');
                    show_result(false, $(this).parent().parent().next().children());
                    return;
                } else if ((this.value.length == 3 && e.which != 8 && e.which != 46) || (this.value.length > 3 && e.which === 32)) {
                    if (xhr.status == undefined && xhr != 0)
                        xhr.abort();
                    xhr = $.ajax({
                        url: $("#esse_form_id").attr("action") + "/wp-json/esse_api/v0.1/search?query=" + this.value, success: (result) => {
                            $(this).parent().parent().next().children().html('');
                            let resultHtml = '';
                            for (let i = 0; i < result.length; i++) {
                                if (i != (result.length - 1 * 1)) {
                                    {
                                        let stock_status = 'Out of stock'
                                        if (result[i].stock_status == 'true') {
                                            stock_status = 'In Stock'
                                            if (result[i].stock_quantity < 10&&result[i].product_type!='variable') {
                                                stock_status = 'Only ' + result[i].stock_quantity + " Remaining";
                                            }
                                        }
                                        resultHtml = resultHtml + `
                                <div class="esse_loop_item" style="display: flex;">
                                <img class="esse_item_image" src="
                                `+ result[i].image + `
                                ">
                                <div class="loop_item2" style="display: flex;justify-content: space-between;width: 100%;">
                                    <div>
                                        <a href="
                                        `+ $("#esse_form_id").attr("action") + `/product/` + result[i].slug + `
                                        " class="esse_item_name">
                                            `+ result[i].title + `
                                        </a>
                                        <div class="`;
                                        if (result[i].stock_status == 'true') {
                                            if (result[i].stock_quantity < esse_plugin_options[0].remaining_stock_count_below&&result[i].product_type!='variable') {
                                                resultHtml = resultHtml + `esse_item_stock_danger`;
                                            } else {
                                                resultHtml = resultHtml + `esse_item_stock`;
                                            }
                                        } else {
                                            resultHtml = resultHtml + `esse_item_out_of_stock`;
                                        }
                                        resultHtml = resultHtml + `">
                                        `+ stock_status + `
                                        </div>
                                        <div class="esse_item_name">
                                            <div class="esse_item_star_rating">
                                            `+ result[i].average_rating + `/5 </div>
                
                                            <svg width="16" class="esse_star_svg" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M15.9583 6.13748C15.8536 5.81349 15.5662 5.58339 15.2262 5.55275L10.6082 5.13342L8.78208 0.859266C8.64744 0.546026 8.34079 0.343262 8.00008 0.343262C7.65937 0.343262 7.35273 0.546026 7.21808 0.859999L5.39198 5.13342L0.773211 5.55275C0.433847 5.58412 0.147219 5.81349 0.0418692 6.13748C-0.0634802 6.46146 0.0338123 6.81682 0.290533 7.04082L3.78122 10.1022L2.7519 14.6364C2.67658 14.9697 2.80598 15.3143 3.0826 15.5143C3.23128 15.6217 3.40524 15.6764 3.58066 15.6764C3.73191 15.6764 3.88193 15.6356 4.01658 15.5551L8.00008 13.1743L11.9821 15.5551C12.2735 15.7304 12.6408 15.7144 12.9168 15.5143C13.1936 15.3137 13.3229 14.969 13.2475 14.6364L12.2182 10.1022L15.7089 7.04143C15.9656 6.81682 16.0636 6.46207 15.9583 6.13748Z"
                                                    fill="#FFC107" />
                                            </svg>
                                            <div class="esse_item_rating_count">
                                                (`+ result[i].rating_count + ` ratings)
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="`;
                                        if (result[i].stock_status == 'true') {
                                            resultHtml = resultHtml + `esse_item_price`;
                                        } else {
                                            resultHtml = resultHtml + `esse_item_out_of_stock_price`;
                                        }

                                        resultHtml = resultHtml + `">
                                        `+ esse_plugin_options[0].currency_symbol+''+result[i].price + `
                                        </div>`;
                                        // <form method="get" action="`+ result[i].add_to_cart_url + `">
                                        // <input type="hidden" name="add-to-cart" value="`+ result[i].id + `">
                                        // <input type="hidden" name="product_id" value="`+ result[i].id + `">
                                        // <button `;
                                        // if (result[i].stock_status != 'instock') {
                                        //     resultHtml = resultHtml + `disabled `;
                                        // }
                                        // resultHtml = resultHtml + `type="submit" class="esse_item_add_to_cart_btn">`
                                        // if (result[i].stock_status == 'instock') {
                                        //     resultHtml = resultHtml + `Add to Cart`;
                                        // } else {
                                        //     resultHtml = resultHtml + `Out of Stock`;;
                                        // }
                                        // resultHtml = resultHtml + `</button>
                                        // </form>
                                        resultHtml = resultHtml + `</div>
                                </div>
                            </div>`;
                                    }
                                }
                            }
                            if(result.length>0){
                            $(this).parent().parent().next().children().html(resultHtml);
                            show_result(true, $(this).parent().parent().next().children());
                            }else{
                                show_result(false, $(this).parent().parent().next().children());     
                            }
                            customize_search();
                        }
                    });
                }
            });
        $(document).mouseup(function (e) {
            var container2 = $(".esse_form_class");
            container2.each(function (i) {
                if (!$(this).next().children().is(e.target) && $(this).next().children().has(e.target).length || !$(this).is(e.target) && $(this).has(e.target).length === 0) {
                    show_result(false, $(this).next().children());
                }
            });
        });
        $(".search_bar_esse").click(function (e) {
            if ($(this).parent().parent().next().children().css('display') == 'none') {
                if ($(this).parent().parent().next().children().html().length > 3 && this.value.length >= 3) {
                    show_result(true, $(this).parent().parent().next().children());
                }
            }
            setTimeout(() => {
                if (this.value.length < 3) {
                    $(this).parent().parent().next().children().html('');
                    show_result(false, $(this).parent().parent().next().children());
                    return;
                }
            }, 100);
        });
    } catch (err) {
        console.log(err);
        return;
    }
    });
})