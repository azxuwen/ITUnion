<?php
header("Content-Type:text/html; charset=utf8");
require_once '../SqlHelper.class.php';
$sqlHelper = new SqlHelper();

	/*显示最新的项目合作，按项目开始时间的先后顺序取22条------START-----*/
	$start=0;
	$end=22;
	$sql_get_share = sprintf("Select K_ShareId,K_ShareTitle,K_ShareTime,K_ShareDownTimes From t_share Order By K_ShareDownTimes Limit %d,%d",$start,$end);
	$arr_get_share = $sqlHelper->execute_dql2($sql_get_share);
	/*显示最新的项目合作，按项目开始时间的先后顺序取22条------END-----*/

echo json_encode($arr_get_share);

?>