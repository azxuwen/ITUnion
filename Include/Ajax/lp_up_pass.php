<?php
header("Content-Type:text/html; charset=utf8");
require_once '../SqlHelper.class.php';
$sqlHelper = new SqlHelper();
$lp_up_vars = $_POST['lp_up_vars'];
$arr_lp_up_vars = explode('-', $lp_up_vars);//里面有邮件地址 和 验证码 需要发送给用户
//执行修改
$sql_up_pass = "Update t_user set K_UserPass = '".md5($arr_lp_up_vars[1])."' where K_UserEmail='".$arr_lp_up_vars[0]."'";
$res_up_pass = $sqlHelper->execute_dql($sql_up_pass);
if($res_up_pass != null){
	echo "1";
}else{
	echo "0";
}


?>