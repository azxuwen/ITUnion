<?php
//改变招聘信息可见性的ajax文件
header("Content-Type:text/html; charset=utf8");
require_once '../SqlHelper.class.php';
$sqlHelper = new SqlHelper();
$c_r_v = $_POST['c_r_v'];

$c_r_v = explode('-', $c_r_v);

$status = $c_r_v[0];//要修改的状态
$pr_id = $c_r_v[1];//要修改的招聘信息的ID

$sql_up_r_v = "Update t_recruit set K_RecruitVisible = '".$status."' where K_RecruitId = {$pr_id}";
$res_up_r_v = $sqlHelper -> execute_dql($sql_up_r_v);
if($res_up_r_v != null){
	echo "1";
}else{
	echo "0";
}
?>