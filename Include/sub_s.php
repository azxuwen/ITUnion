<?php
/*
 * 添加人  徐文志
* 时间    2014年2月27日 22:16
* 站点归属 ：IT联盟(哈尔滨理工大学创新实验)
* 处理添加   修改 或 删除知识共享的功能
*/
header("Content-Type:text/html; charset=utf8");
session_start();
require_once 'SqlHelper.class.php';
$sqlHelper = new SqlHelper();
if(!isset($_GET['si'])){
	//如果不存在资料下载的ID，那么是要执行添加资料
	//使用文件上传类
	require_once 'Upload.class.php';
	$upload = new Upload();
	$upload->ImgName = &$_FILES['s_file']; //获取文件的名称
	$upload->ImgPath = '../Upload/Files'; //设定文件存放路径
	$upload->ImgMaxSize = 10000000;   //设定文件的最大尺寸
	$upload->ImgType = array('application/octet-stream','application/msword', 'application/vnd.ms-powerpoint', 'application/vnd.ms-excel');
	if(!$upload->checkImg()){
		echo "文件类型不支持";
		exit;
	}
	$filename = substr($upload->finishUpload(), 3);	//finishUpload()返回文件的路径地址，要将它加入数据库
	//下面构造Sql语句将数据填入数据库
	$s_title = $_POST['s_title'];
	$s_content = $_POST['s_content'];
	$s_cate = $_POST['s_cate'];
	$sql_i_share = "Insert into t_share(K_ShareTitle, K_ShareFileAddress,K_ShareContent, K_ShareUserId, K_ShareDownTimes,K_ShareTime, K_ShareCategory)";
	$sql_i_share .= " values('".$s_title."', '".$filename."', '".$s_content."', {$_SESSION['USERID']}, 0 , now() , '".$s_cate."')";
	$res_i_share = $sqlHelper->execute_dql($sql_i_share);
	if($res_i_share != null){
		header("Location:../ps_l.php?t=u");
		exit;
	}else{
		header("Location:../n_ps.php'");
		exit;
	}
	
	
}else{
	//如果存在资料下载的ID，那么可能是修改 或者 删除，通过GET['t']来区分
	if($_GET['t']== 'u'){
		//执行修改
		$si = $_GET['si'];
		$s_title = $_POST['s_title'];
		$s_content = $_POST['content1'];
		$s_cate = $_POST['s_cate'];
		$sql_u_share = "Update t_share set K_ShareTitle = '".$s_title."',K_ShareContent = '".$s_content."', K_ShareCategory='".$s_cate."' where K_ShareId = {$si}";
		$res_u_share = $sqlHelper -> execute_dql($sql_u_share);
		if($res_u_share != null){
			header("Location:../n_ps.php?si=".$si."&t=u&r=y");
			exit;
		}else{
			header("Location:../n_ps.php?si=".$si."&t=u&r=n");
			exit;
		}
	}else{
		//执行删除
		$si = $_GET['si'];
		//首先将文件路径拿到
		$sql_g_share_dir = "Select K_ShareFileAddress from t_share where K_ShareId = {$si}";
		$arr_g_share_dir = $sqlHelper -> execute_dql2($sql_g_share_dir);
		$file_dir = "../".$arr_g_share_dir[0]['K_ShareFileAddress'];
		unlink($file_dir);//执行删除文件
		$sql_d_share = "Delete from t_share where K_ShareId = {$si}";
		$res_d_share = $sqlHelper -> execute_dql($sql_d_share);
		if($res_d_share != null){
			header("Location:../ps_l.php?r=y");
			exit;
		}else{
			header("Location:../n_ps.php?r=n");
			exit;
		}
	}
}
?>