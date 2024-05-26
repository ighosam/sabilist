<?php

//osc_enqueue_style('style3', osc_current_web_theme_url('css/style10.css'));
//osc_enqueue_style('style', osc_base_url() . 'oc-content/themes/zara/css/style.css');
//osc_enqueue_style('style2', osc_base_url() . 'oc-content/themes/zara_child/css/style.css');
osc_enqueue_style('style', osc_current_web_theme_url('css/style2.css'));

//osc_register_script('priceFormat', osc_current_web_theme_js_url('jquery.priceFormat.js'));
osc_register_script('priceFormat', osc_base_url() . 'oc-content/themes/bender_child/js/jquery.priceFormat.js');
osc_enqueue_script('priceFormat');

osc_register_script('uitouch', osc_base_url() . 'oc-content/themes/bender_child/js/jquery.ui.touch-punch.min.js','jquery-ui');
osc_enqueue_script('uitouch');

/*
osc_add_hook("pre_item_add", function($aItem) {
    if($aItem["year"] !== "") {
        osc_add_flash_error_message(_e("Please select a city", "zara"));
        $this->redirectTo(osc_item_post_url());
    }
});

*/
