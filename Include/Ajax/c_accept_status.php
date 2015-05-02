<?php
//将招聘信息处理表 t_accept中的处理状态改成已处理
header("Content-Type:text/html; charset=utf8");
require_once '../SqlHelper.class.php';
$sqlHelper = new SqlHelper();
$ri = $_POST['ri'];

$sql_up_r_v = "Update t_accept set K_AcceptStatus = '55' where K_RecruitId = {$ri}";
$res_up_r_v = $sqlHelper -> execute_dql($sql_up_r_v);
if($res_up_r_v != null){
	echo "1";
}else{
	echo "0";
}
?>