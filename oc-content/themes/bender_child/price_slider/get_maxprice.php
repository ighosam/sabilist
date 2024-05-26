<?php

function get_max_price($cat_id = null, $country_code = null, $region_id = null, $city_id = null) {
  // Search by all parameters
  $allSearch = new Search();
  $allSearch->addCategory($cat_id);
  $allSearch->addCountry($country_code);
  $allSearch->addRegion($region_id);
  $allSearch->addCity($city_id);
  $allSearch->order('i_price', 'DESC');
  $allSearch->limit(0, 1);

  $result = $allSearch->doSearch();
  $result = $result[0];

  $max_price = isset($result['i_price']) ? $result['i_price'] : 0;


  // FOLLOWING BLOCK LOOKS FOR MAX-PRICE IF IT IS 0
  // City is set, find max price by Region
  if($max_price <= 0 && isset($city_id) && $city_id <> '') {
    $regSearch = new Search();
    $regSearch->addCategory($cat_id);
    $regSearch->addCountry($country_code);
    $regSearch->addRegion($region_id);
    $regSearch->order('i_price', 'DESC');
    $regSearch->limit(0, 1);

    $result = $regSearch->doSearch();
    $result = $result[0];

    $max_price = isset($result['i_price']) ? $result['i_price'] : 0;
  }


  // Region is set, find max price by Country
  if($max_price <= 0 && isset($region_id) && $region_id <> '') {
    $regSearch = new Search();
    $regSearch->addCategory($cat_id);
    $regSearch->addCountry($country_code);
    $regSearch->order('i_price', 'DESC');
    $regSearch->limit(0, 1);

    $result = $regSearch->doSearch();
    $result = $result[0];

    $max_price = isset($result['i_price']) ? $result['i_price'] : 0;
  }


  // Country is set, find max price WorldWide
  if($max_price <= 0 && isset($country_code) && $country_code <> '') {
    $regSearch = new Search();
    $regSearch->addCategory($cat_id);
    $regSearch->order('i_price', 'DESC');
    $regSearch->limit(0, 1);

    $result = $regSearch->doSearch();
    $result = $result[0];

    $max_price = isset($result['i_price']) ? $result['i_price'] : 0;
  }


  // Category is set, find max price in all Categories
  if($max_price <= 0 && isset($region_id) && $region_id <> '') {
    $regSearch = new Search();
    $regSearch->addCategory($cat_id);
    $regSearch->order('i_price', 'DESC');
    $regSearch->limit(0, 1);

    $result = $regSearch->doSearch();
    $result = $result[0];

    $max_price = isset($result['i_price']) ? $result['i_price'] : 0;
  }


  // If max_price is still 0, set it to 1 to avoid slider defect
  if($max_price <= 0) {
    $max_price = 1000000;
  }


  return array(
    'max_price' => $max_price/1000000,
    'max_currency' => osc_get_preference('def_cur', 'zara_theme')
  );
}

