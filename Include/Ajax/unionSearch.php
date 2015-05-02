<?php
header("Content-Type:text/html; charset=utf8");
require_once '../SqlHelper.class.php';
$sqlHelper = new SqlHelper();
$userName = $_POST['userName'];
$sql_get_user = "Select K_UserName,K_UserId,K_UserType From t_user Where (K_UserName = '$userName' Or K_UserName Like '%$userName%') And K_UserType='c'";
$arr = $sqlHelper->execute_dql2($sql_get_user);
echo json_encode($arr);

?>