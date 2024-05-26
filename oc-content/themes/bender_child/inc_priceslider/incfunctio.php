<?php
 $cur_theme = osc_current_web_theme();

function zara_search_params() {
 return array(
   'sCategory' => Params::getParam('sCategory'),
   'sCountry' => Params::getParam('sCountry'),
   'sRegion' => Params::getParam('sRegion'),
   'sCity' => Params::getParam('sCity'),
   'sPriceMin' => Params::getParam('sPriceMin'),
   'sPriceMin' => Params::getParam('sPriceMax'),
   'sCompany' => Params::getParam('sCompany'),
   'sShowAs' => Params::getParam('sShowAs')
  );
}

function zara_max_price($cat_id = null, $country_code = null, $region_id = null, $city_id = null) {
  $maxSearch = new Search();
  $maxSearch->addCategory($cat_id);
  $maxSearch->addCountry($country_code);
  $maxSearch->addRegion($region_id);
  //$maxSearch->addCity($city_id);
  $maxSearch->order('i_price', 'DESC');
  $maxSearch->limit(0, 2);

  $result = $maxSearch->doSearch();

  $max_price = 0;
  $max_currency = '';
  $ids = '';
  foreach($result as $item) {
    $ids .= ' - ' . $item['pk_i_id'];
    if($max_price < $item['i_price']) {
      $max_price = $item['i_price'];
      $max_currency = $item['fk_c_currency_code'];
    }
  }

  if($max_currency <> '') {
    $cur = Currency::newInstance()->findByPrimaryKey($max_currency);
    $cur_symbol = $cur['s_description'];
  }

  return array(
    'max_price' => $max_price/1000000,
    //'max_currency' => osc_get_preference('def_cur', 'zara_theme')
     'max_currency' => osc_get_preference('def_cur', $cur_theme)
    //'max_currency' => $cur_symbol
  );
}

