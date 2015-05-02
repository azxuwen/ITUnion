<?php
session_start();
header("Content-Type:text/html; charset=utf8");
require_once '../SqlHelper.class.php';
$sqlHelper = new SqlHelper();
$pj_id = $_POST['pj_id'];//要加入的合作项目ID
$UserId = $_SESSION['USERID'];//用户id
//首先需要判断这个用户到底之前加没加入过这个项目
$sql_judge_j_p = "Select K_ProjectUnion from t_project where K_ProjectId = {$pj_id} and (K_ProjectUnion like '".$UserId."' or K_ProjectUnion like '%".$UserId."' or K_ProjectUnion like '".$UserId."%')";
$arr_judge_j_p = $sqlHelper -> execute_dql2($sql_judge_j_p);
if(count($arr_judge_j_p) != 0){
	echo "al";//已经加入了
	exit;
}else{
	//那么这里执行加入
	$sql_update_j_p = "update t_project set K_ProjectUnion = concat(K_ProjectUnion,',".$UserId."') where K_ProjectId = {$pj_id}";
	$res_update_j_p = $sqlHelper -> execute_dql($sql_update_j_p);
	if($res_update_j_p != null){
		echo "1";
	}else{
		echo "0";
	}
}
?>