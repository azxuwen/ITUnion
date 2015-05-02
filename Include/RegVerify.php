<?php
/*
 * 创建者 : 徐文志
* 创建时间 : 2014 2 3  14:54
* 站点归属 ：IT联盟(哈尔滨理工大学创新实验)
* 页面功能 : 点击邮箱链接到该页面，该页面进行验证
*/
header("Content-Type:text/html; charset=utf8");
include_once 'ComFunction.php';
require_once 'SqlHelper.class.php';
$sqlHelper = new SqlHelper();
//localhost/Include/RegVerify.php?ue={$UserEmail}&c={$VerifyCode}&t=n";//验证链接
if(!isset($_GET['ue']) || !isset($_GET['c']) || !isset($_GET['t']) ){
	header("Location:../notfound.php");
}else{
	//该页面会收到3个变量内容 一个是邮箱，一个是已经在数据库中的验证码 一个是一个是否验证成功的
	if($_GET['t'] != 'n'){
		echo '<script> alert("您的账号已经验证完成啦，直接登录吧!"); location.replace("../Login.php")</script>';
		exit;
	}else{
		//下面就剩下了邮箱和验证码了，可以这样，先通过邮箱来获取验证码，然后判断验证码是否相同
		require_once 'SqlHelper.class.php';
		$sqlHelper = new SqlHelper();
		$sql_get_verifycode = "Select K_VerifyCode from t_user where K_Verify='n' and K_UserEmail = '".$_GET['ue']."'";
		$arr_get_verifycode = $sqlHelper -> execute_dql2($sql_get_verifycode);	
		if(!empty($arr_get_verifycode[0][0])){
			if($arr_get_verifycode[0][0] == $_GET['c']){
				//如果验证码都相同就执行将数据库表中的 K_Verify 改为 y 
				$sql_update_verify_to_y = "Update t_user set K_Verify = 'y' where K_UserEmail = '".$_GET['ue']."'";
				$res_update_verify_to_y = $sqlHelper -> execute_dql($sql_update_verify_to_y);
				if($res_update_verify_to_y != null){
					echo "<meta http-equiv='refresh' content='2; url=../Login.php' />";
					echo "恭喜您，验证成功<br/>";
					echo "2秒后跳转到登录页面，如果页面没有跳转，点击<a href='../Login.php'>这里</a>";
				}else{
					echo "非常抱歉，出现了系统错误，您可以按F5来刷新本页面完成验证";
				}
			}else{
				//如果邮箱中的验证码和数据库中存放的验证码并不相符，则跳转到404页面
				header("Location:../notfound.php");
			}
		}else{
			echo '<script> alert("您的账号已经验证完成啦，直接登录吧!"); location.replace("../Login.php")</script>';
			exit;
		}
	}
}


?>