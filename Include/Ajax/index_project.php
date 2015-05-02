<?php
header("Content-Type:text/html; charset=utf8");
require_once '../SqlHelper.class.php';
$sqlHelper = new SqlHelper();

	/*显示最新的项目合作，按项目开始时间的先后顺序取15条--------START--------*/
	$start=0;
	$end=2;
	$sql_get_project = sprintf("Select K_ProjectName,K_ProjectId,K_ProjectStartTime,K_ProjectView,K_ProjectContent From t_project Order By K_ProjectStartTime desc Limit %d,%d",$start,$end);
	$arr_get_project = $sqlHelper->execute_dql2($sql_get_project);
	/*显示最新的项目合作，按项目开始时间的先后顺序取15条--------END--------*/

	echo json_encode($arr_get_project);

?>