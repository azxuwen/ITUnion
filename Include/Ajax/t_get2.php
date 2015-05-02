<?php
//改变招聘信息可见性的ajax文件
header("Content-Type:text/html; charset=utf8");
require_once '../SqlHelper.class.php';
$sqlHelper = new SqlHelper();
$trade1 = $_POST['trade1'];//省份Code

$sql_get_t_2 = "Select * from t_trade where K_TradeId like '".$trade1."%' and K_TradeId != '".$trade1."' ";
$arr_get_t_2 = $sqlHelper->execute_dql2($sql_get_t_2);
echo json_encode($arr_get_t_2);
?>