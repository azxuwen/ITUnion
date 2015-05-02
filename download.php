<!--创建者 : 张健平 创建时间 : 2014 02 26    11:55 站点归属 ：IT联盟(哈尔滨理工大学创新实验)  产品信息列表显示-->
<?php
if(!isset($_GET['si'])) {
	
	echo '<script>alert("连接不合法!");location.replace("ps_l.php")</script>';
	exit();
}
$id = $_GET['si'];
require_once 'Include/SqlHelper.class.php';
require_once 'Include/ComFunction.php';
require_once 'Include/config.inc.php';
$sqlHelper = new SqlHelper();
$sql_file = "Select * From t_share Where K_ShareId = $id";
$arr_file = $sqlHelper->execute_dql2($sql_file);
//添加一次下载次数
$sql_u_times = "Update t_share set K_ShareDownTimes = K_ShareDownTimes +1 where K_ShareId = {$id}";
$sqlHelper->execute_dql($sql_u_times);
$file_dir_name = $arr_file[0]['K_ShareFileAddress'];
$i = strpos($file_dir_name,'.');
$type = substr($file_dir_name,$i);
$file_name = $arr_file[0]['K_ShareTitle'];
$file_name.= $type;
if(!file_exists($file_dir_name))   {   //检查文件是否存在
  		 echo '<script>alert("文件不存在!");location.replace("ps_l.php")</script>';
		 exit();
  	}else{ 
	$file = fopen($file_dir_name,"r"); 
	header("Content-type: application/octet-stream");
	header("Accept-Ranges: bytes");
	header("Accept-Length: ".filesize($file_dir_name));
	header("Content-Disposition: attachment; filename=" . $file_name);
	echo fread($file,filesize($file_dir_name));
	fclose($file);
	exit();
}
?>