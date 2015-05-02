<?php
/*
 * 创建者 : 徐文志 
 * 创建时间 : 2014 01 27  13:27 
 * 站点归属 ：IT联盟(哈尔滨理工大学创新实验)
 * 页面功能 : 处理登录
*/
header("Content-Type:text/html; charset=utf8");
require_once 'SqlHelper.class.php';
$sqlHelper = new SqlHelper();
	$UserName = trim($_POST['UserName']);//用户名
	$UserPass = trim($_POST['UserPass']);//密码
	//审核登录信息start
	$sql_check_login = "Select K_UserId,K_UserPass,K_Verify from t_user where K_UserEmail = '".$UserName."'";
	$arr_check_login = $sqlHelper -> execute_dql2($sql_check_login);
	if(count($arr_check_login) != 0 ){
		//首先查看该登录账号是否已经通过邮箱验证
		if($arr_check_login[0]['K_Verify'] == 'n'){
			echo '<script> alert("请先通过邮箱验证账号"); location.replace("../Login.php")</script>';
			exit;
		}else{
			//检查密码是否核对
			if($arr_check_login[0]['K_UserPass'] == md5($UserPass)){
				//密码核对成功，所以将数据库表中的登录次数和登录时间修改
				$sql_update_land_data = "Update t_user set K_UserLandTimes = K_UserLandTimes+1, K_UserLandTime=now() where K_UserId = {$arr_check_login[0]['K_UserId']} ";
				$sqlHelper -> execute_dql($sql_update_land_data);
				//开启session
				session_start();
				$_SESSION['USERID'] = $arr_check_login[0]['K_UserId'];
				$_SESSION['USERNAME'] = $UserName;
				//下面要处理链接，因为要让用户回到刚才浏览的页面上
				if(isset($_GET['l'])){
					$l = $_GET['l'].".php";//这个是要回到的页面的文件名
					$link = $_SERVER['QUERY_STRING'];//.php后面的部分
					$link = substr($link, strpos($link, '&')+1);
					header("Location:../".$l."?".$link);
				}else{
					header("Location:../index.php");
				}
				exit;
			}else{
				echo '<script> alert("密码错误，请重新填写"); location.replace("../Login.php")</script>';
				exit;
			}
		}
	}//如果从数据库中获取的密码 和用户提交的密码相符
	else{
		header("Location:../Login.php");
		exit;
	}
?>