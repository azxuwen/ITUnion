<?php
/*
 * 创建者 : 徐文志
* 创建时间 : 2014 01 29  21:39
* 站点归属 ：IT联盟(哈尔滨理工大学创新实验)
* 页面功能 : 处理注册
*/
header("Content-Type:text/html; charset=utf8");
include_once 'ComFunction.php';
require_once 'SqlHelper.class.php';
$sqlHelper = new SqlHelper();

//获取表单信息  start
$UserType = trim($_POST['UserType']);//注册用户的类型
$UserEmail = trim($_POST['UserEmail']);//邮箱
$UserPass = trim($_POST['UserPass1']);//密码
$UserName = trim($_POST['UserName']);//企业名称 或个人名称
//获取表单信息  end

//虽然执行过了HTML5表单验证和JS验证，但是还需要加上PHP验证start
//处理邮箱start
if(strlen($UserEmail) == 0){
	echo '<script> alert("未填写注册邮箱，请重新填写"); location.replace("../reg.php")</script>';
	exit;
}else if(!preg_match ('/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/', $UserEmail)){
	echo '<script> alert("邮箱格式不正确，请重新填写"); location.replace("../reg.php")</script>';
	exit;
}
$sql_check_user_exists = "Select K_UserId from t_user where K_UserEmail = '".$UserEmail ."'";
$arr_check_user_exists = $sqlHelper -> execute_dql2($sql_check_user_exists);
if(count($arr_check_user_exists) != 0){
	echo '<script> alert("该邮箱已经注册过账户，无法重复注册"); location.replace("../reg.php")</script>';
	exit;
}
//处理邮箱end
//处理密码 start
if(strlen($UserPass) == 0){
	echo '<script> alert("您未填写密码，为了您的账户安全，请重新注册"); location.replace("../reg.php")</script>';
	exit;
}else if(!preg_match ('/^[a-z | A-Z | 0-9]\w{5,15}/', $UserPass)){
	echo '<script> alert("密码只能包字母和数字，请重新填写"); location.replace("../reg.php")</script>';
	exit;
}
if(strlen($UserPass) > 15){
	echo '<script> alert("密码长度有点过长，请相信我们会妥善保存您的密码"); location.replace("../reg.php")</script>';
	exit;
}
//处理密码 end
//处理企业名称 或 个人姓名 start
if(strlen($UserName) == 0){
	if($UserType == 'c'){
		echo '<script> alert("您未填写企业名称，请补充信息"); location.replace("../reg.php")</script>';
		exit;
	}else if($UserType == 'p'){
		echo '<script> alert("您未填写个人姓名，请补充信息"); location.replace("../reg.php")</script>';
		exit;
	}
}
if(strlen($UserName) > 48){
	echo '<script> alert("企业名称过长，请缩短"); location.replace("../reg.php")</script>';
	exit;
}
//处理企业名称 或 个人姓名 end
//虽然执行过了HTML5表单验证和JS验证，但是还需要加上PHP验证end

//将注册表单信息填入数据库start
$UserPass = md5($UserPass);//将密码加密
$VerifyCode = getRandomCode(10);
$sql_insert_user_infor = "Insert into t_user(K_UserName, K_UserPass, K_UserEmail, K_UserType,K_UserJoinTime,K_UserIntegral,K_UserLandTimes,K_UserLandTime,K_Verify, K_VerifyCode) value('".$UserName."', '".$UserPass."', '".$UserEmail."', '".$UserType."', now(),0, 0, now(), 'n', '".$VerifyCode."')";
$result_insert_user_infor = $sqlHelper->execute_dql($sql_insert_user_infor);
if($result_insert_user_infor != null){
	header("Location:../reg.php?res&c=$VerifyCode&uuid=$UserEmail");
}else{
	echo '<script> alert("非常抱歉，注册失败，请重试"); location.replace("../reg.php")</script>';
}
//将注册表单信息填入数据库end

?>