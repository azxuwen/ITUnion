<?php
header("Content-Type:text/html; charset=utf8");
require_once '../SqlHelper.class.php';
$sqlHelper = new SqlHelper();
$UserEmail = $_POST['UserEmail'];
$sql_check_user_exists = "Select K_UserId from t_user where K_UserEmail = '".$UserEmail ."'";
$arr_check_user_exists = $sqlHelper -> execute_dql2($sql_check_user_exists);
if(count($arr_check_user_exists) != 0){
	echo "1";
}else{
	echo "0";
}
?>