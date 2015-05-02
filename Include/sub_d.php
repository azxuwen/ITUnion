<?php

/*
*添加人  张健平
*时间  2014 3 2 
* 站点归属 ：IT联盟(哈尔滨理工大学创新实验)
*功能  添加帖子	
*/
header("Content-Type:text/html; charset=utf8");
session_start();
require_once 'SqlHelper.class.php';
$sqlHelper = new SqlHelper();
if(isset($_POST['s_button'])=="发布帖子") {
	if($_POST['d_title']!="") {
		$d_title = $_POST['d_title'];
	}
	if($_POST['d_cate']!="") {
		$d_cate = $_POST['d_cate'];
	}
	$sql_i_discuz = "Insert Into t_discuz(K_DiscuzTitle,K_DiscuzContent,K_DiscuzUserId,K_DiscuzCategory,K_DiscuzTime,K_DiscuzVisitTimes) Values('".$d_title."','".$_POST['content1']."',{$_SESSION['USERID']},'".$d_cate."',now(),0)";
	$res_i_dis = $sqlHelper->execute_dql($sql_i_discuz);
	$getID=mysql_insert_id();//$getID即为最后一条记录的ID
	if($res_i_dis != null){
		header("Location:../pdis_c.php?pi=".$getID);
		exit;
	}else{
		header("Location:../fatie.php");
		exit;
	}
}
if(isset($_POST['reply'])=="回复") {
	$id = $_GET['pi'];
	if($_POST['content1']!="") {
		$reply = $_POST['content1'];
		$sql_i_reply = "Insert Into t_discuzreply(K_ReplyDiscuzId,K_ReplyUserId,K_ReplyContent,K_ReplyTime) Value(".$id.",{$_SESSION['USERID']},'".$reply."',now())";
		$res_i_reply = $sqlHelper->execute_dql($sql_i_reply);
		$sql_user = "Select K_DiscuzUserId From t_discuz Where K_DiscuzId = $id";
		$arr_user = $sqlHelper->execute_dql2($sql_user);
		$sql_user_address = "Select K_UserEmail From t_user Where K_UserId = ".$arr_user[0][0];
		$arr_user_address = $sqlHelper->execute_dql2($sql_user_address);
		if($res_i_reply != null) {
//发送邮件start
require '../Libs/Phpmailer/class.phpmailer.php';
try {
	$to = $arr_user_address[0][0];
	$mail_string = "有人回复你了";
	$mail = new PHPMailer(true);
	$mail->IsSMTP();
	$mail->CharSet='UTF-8'; //设置邮件的字符编码，这很重要，不然中文乱码
	$mail->SMTPAuth   = true;                  //开启认证
	$mail->Port       = 25;
	$mail->Host       = "smtp.163.com";
	$mail->Username   = "azxuwen701@163.com";
	$mail->Password   = "AzXuwen_163";
	//$mail->IsSendmail(); //如果没有sendmail组件就注释掉，否则出现“Could  not execute: /var/qmail/bin/sendmail ”的错误提示
	$mail->AddReplyTo("azxuwen701@163.com","IT联盟信息平台");//回复地址
	$mail->From       = "azxuwen701@163.com";
	$mail->FromName   = "IT联盟信息平台";
	$mail->AddAddress($to);
	$mail->Subject  = "IT联盟信息平台注册";
	$mail->Body = $mail_string;
	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略
	$mail->WordWrap   = 80; // 设置每行字符串的长度
	//$mail->AddAttachment("f:/test.png");  //可以添加附件
	$mail->IsHTML(true);
	$mail->Send();
} catch (phpmailerException $e) {
	//如果发送不成功，什么都不做
}

			header("Location:../pdis_c.php?pi=$id");
			exit;
		}else {
			header("Location:../pdis_l.php");
		}
	}
}


?>