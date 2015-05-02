<?php
//改变招聘信息可见性的ajax文件
header("Content-Type:text/html; charset=utf8");
require_once '../SqlHelper.class.php';
$sqlHelper = new SqlHelper();
$prov = $_POST['prov'];//省份Code

$sql_get_l_2 = "Select * from t_city where K_CityId like '".$prov."%' and K_CityId != '".$prov."' ";
$arr_get_l_2 = $sqlHelper->execute_dql2($sql_get_l_2);
echo json_encode($arr_get_l_2);
?>