<?php
/*
 * 添加人  徐文志
* 时间    2014年3月5日 22:56
* 站点归属 ：IT联盟(哈尔滨理工大学创新实验)
* 处理添加   和删除 项目合作信息
*/
header("Content-Type:text/html; charset=utf8");
session_start();
require_once 'SqlHelper.class.php';
$sqlHelper = new SqlHelper();
if(isset($_GET['pi'])){
	//如果存在 pi  则进行删除
	//首先删除项目视图文件
	$sql_g_p_view = "select K_ProjectView from t_project where K_ProjectId = {$_GET['pi']}";
	$arr_g_p_view = $sqlHelper-> execute_dql2($sql_g_p_view);
	if($arr_g_p_view[0]['K_ProjectView'] != ''){
		unlink("../".$arr_g_p_view[0]['K_ProjectView']);
	}
	//执行删除项目合作的数据库所有信息
	$sql_d_p = "Delete from t_project where K_ProjectId  = {$_GET['pi']}";
	$res_d_p = $sqlHelper -> execute_dql($sql_d_p);
	if($res_d_p != null){
		//如果删除成功,返回项目合作列表
		header("Location:../pp_l.php?t=s");
		exit;
	}else{
		header("Location:../p_c.php?pi=".$_GET['pi']."&t=f");
		exit;
	}
}else{
	//如果不存在pi ,则进行添加
	require_once 'Upload.class.php';
	$upload = new Upload();
	$upload->ImgName = &$_FILES['p_view']; //获取文件的名称
	$upload->ImgPath = '../Upload/Images'; //设定文件存放路径
	$upload->ImgMaxSize = 10000000;   //设定文件的最大尺寸
	$upload->ImgType = array('image/jpeg','image/jpg', 'image/png', 'image/gif');
	if(!$upload->checkImg()){
		echo '<script> alert("图片类型不符合要求,请重新选择。"); location.replace("../n_pp.php")</script>';
		exit();
	}
	$filename = substr($upload->finishUpload(), 3);	//finishUpload()返回文件的路径地址,要将它加入数据库
	//
	//首先执行将图片存入文件夹
	$p_title = $_POST['p_title'];
	$p_union = $_POST['user_code'];
	$p_start_t =  $_POST['p_start_time'];
	$p_end_time = $_POST['p_end_time'];
	$p_open = $_POST['p_o_y'];
	$p_trade = $_POST['trade_code'];
	$p_con = $_POST['content1'];
	$p_view = $filename;
	$sql_i_p = "Insert into t_project (K_ProjectName, K_ProjectContent, K_ProjectUserId, K_ProjectUnion, K_ProjectStartTime, K_ProjectEndTime, K_ProjectTrade, K_ProjectView, K_ProjectOpen) ";
	$sql_i_p .= " values ('".$p_title."','".$p_con."',".$_SESSION['USERID'].",'".$p_union."' , '".$p_start_t."', '".$p_end_time."', '".$p_trade."', '".$p_view."', '".$p_open."')";
	$res_i_p = $sqlHelper -> execute_dql($sql_i_p);
	if($res_i_p != null){
		$ri = mysql_insert_id();
		header("Location:../p_c.php?pi=".$ri."&t=s");
		exit;
	}else{
		header("Location:../n_pp.php?t=f");
		exit;
	}
	
}
?>