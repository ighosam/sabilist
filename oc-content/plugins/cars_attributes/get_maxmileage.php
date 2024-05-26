<?php

function get_max_mileage() {

$conn = DBConnectionClass::newInstance();
$data = $conn->getOsclassDb();
$comm = new DBCommandClass($data);
$db_prefix = DB_TABLE_PREFIX;


            $query =  "SELECT `oc_t_item_car_attr`.`i_kilometers` FROM `oc_t_item_car_attr` ORDER BY `oc_t_item_car_attr`.`i_kilometers` DESC LIMIT 0,1"; 

         $result = $comm->query($query);

         $item = $result->result();

  
return array(
    'max_mileage' => $item[0]['i_kilometers'],
    'kilometer' =>'km');


}

function get_min_year() {
  
$conn = DBConnectionClass::newInstance();
$data = $conn->getOsclassDb();
$comm = new DBCommandClass($data);
$db_prefix = DB_TABLE_PREFIX;


            $query =  "SELECT `oc_t_item_car_attr`.`i_year` FROM `oc_t_item_car_attr` ORDER BY `oc_t_item_car_attr`.`i_year` ASC LIMIT 0,1"; 

         $result = $comm->query($query);

         $item = $result->result();

  
return array(
    'min_year' => $item[0]['i_year']);	

}
