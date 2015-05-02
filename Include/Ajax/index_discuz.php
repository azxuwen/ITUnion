<?php
header("Content-Type:text/html; charset=utf8");
require_once '../SqlHelper.class.php';
require_once '../ComFunction.php';
$sqlHelper = new SqlHelper();

	/*显示最新的论坛话题，按项目开始时间的先后顺序取22条------START-----*/
	$start = 0;
	$end = 2;
	$sql_get_discuz = sprintf("Select * From t_discuz Order By K_DiscuzTime desc Limit %d,%d",$start,$end);
	$arr_get_discuz = $sqlHelper->execute_dql2($sql_get_discuz);
	for($i=0;$i<count($arr_get_discuz);$i++) {
		$pdis_user = getUserName($arr_get_discuz[$i]['K_DiscuzUserId'],$sqlHelper);//获取发布人
		$arr_get_discuz[$i]['K_DiscuzUserId'] = $pdis_user;
	}
	
	/*显示最新的论坛话题，按项目开始时间的先后顺序取22条------END-----*/

echo json_encode($arr_get_discuz);

?>