<?php
header("Content-Type:text/html; charset=utf8");
require_once '../SqlHelper.class.php';
$sqlHelper = new SqlHelper();
$lp_vars = $_POST['lp_vars'];
$arr_lp_vars = explode('-', $lp_vars);//里面有邮件地址 和 验证码 需要发送给用户
$mail_string = <<<END
您的验证码  $arr_lp_vars[1]
END;
require '../../Libs/Phpmailer/class.phpmailer.php';
try {
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
	$to = $arr_lp_vars[0];
	$mail->AddAddress($to);
	$mail->Subject  = "IT联盟信息平台注册-找回密码";
	$mail->Body = $mail_string;
	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略
	$mail->WordWrap   = 80; // 设置每行字符串的长度
	//$mail->AddAttachment("f:/test.png");  //可以添加附件
	$mail->IsHTML(true);
	$mail->Send();
	echo "1";
} catch (phpmailerException $e) {
	//echo "邮件发送失败：".$e->errorMessage();
	echo "0";
	
}



?>