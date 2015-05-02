<?php
session_start();
header("Content-Type:text/html; charset=utf8");
require_once '../SqlHelper.class.php';
$sqlHelper = new SqlHelper();
$pr_all_con = explode('&', $_POST['pr_all_con']);//要感兴趣的招聘信息的内容
$UserId = $_SESSION['USERID'];//用户id
if(count($pr_all_con) == 1){
	$pr_id = $pr_all_con[0];//招聘信息ID
	$pr_con = "";//应聘宣言
}else{
	$pr_id = $pr_all_con[0];//招聘信息ID
	$pr_con = $pr_all_con[1];
}

//首先需要判断这个用户之前有没有对该招聘信息感兴趣，如果已经感兴趣了，就提示一下
$sql_judge_j_r = "Select count(K_AcceptId) from t_accept where K_RecruitId = {$pr_id} and K_UserId = {$UserId}";
$arr_judge_j_r = $sqlHelper -> execute_dql2($sql_judge_j_r);
if($arr_judge_j_r[0][0] != 0){
	echo "al";//已经对该条招聘信息感兴趣过了
	exit;
}else{
	//那么这里执行加入
	//首先获取t_basecode中的未处理代表的 ID,可能会有些多此一举，但是这样会活
	$sql_get_not_depose = "Select CodeId from t_basecode where CodeName = '未处理'";
	$arr_get_not_depose = $sqlHelper->execute_dql2($sql_get_not_depose);
	$sql_insert_j_r = "Insert into t_accept (K_UserId, K_RecruitId, K_AcceptContent, K_AcceptStatus, K_AcceptTime)";
	$sql_insert_j_r .= " values ({$UserId}, {$pr_id}, '".$pr_con."', {$arr_get_not_depose[0]['CodeId']}, now())";
	$res_update_j_r = $sqlHelper -> execute_dql($sql_insert_j_r);
	if($res_update_j_r != null){
		echo "1";
	}else{
		echo "0";
	}
}
?>