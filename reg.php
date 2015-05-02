<!--创建者 : 徐文志 创建时间 : 2014 01 17    20:30 站点归属 ：IT联盟(哈尔滨理工大学创新实验)   页面功能:用户注册 -->
<!--引入页头文件start-->
<?php
include 'header.php';
include_once 'Include/config.inc.php';
/*
 * 下面将整个注册页面分为两个部分，一部分是注册表单，一部分是注册的结果
 * 当完成注册表单后，页面会到Include/RegControl.php中执行注册
 * 然后跳转到本页面的另一部分，也就是注册的结果
 * 注册的结果页面主要展示，我们已经向您的邮箱发送了一个验证链接等等的话
 */
//注册表单部分 start
if(!isset($_GET['res'])){
?>
<!--引入页头文件end-->
<!--  这里显示页面内容  start-->
<div id="fit_for_body_height">
<!-- 这里用户注册表单start -->
<div id="fit_for_body_height_half">
<form class="form-2" id="regForm" action="Include/RegControl.php" method="post">
			<br/>
			<h1><span class="log-in">注册</span></h1>
			<p class="float">
				<input type="radio" id="c" name="UserType" value="c" checked="checked"/><label for='c'>企业注册</label>　<i style="color:black;">OR</i>　
				<input type="radio" id="p" name="UserType" value="p"/><label for='p'>个人注册</label>
				<br/><br/>
				<input type="text" id="UserEmail" name="UserEmail" placeholder="我们需要您的邮箱地址,也是今后您的登录账户名称"/>
				<input type="password" id="UserPass1" name="UserPass1" placeholder="输入您的密码"/>
				<input type="password" id="UserPass2" name="UserPass2" placeholder="确认刚才您输入的密码"/>
				<input type="text" id="UserName" name="UserName" placeholder="最后请如实填写您的企业名称,我们会对此进行核实"/>
			</p>
			<p class="float">
				<span id="reginfor"></span>
			</p>
			<p class="clearfix">
			<br/>
			<p>
				<input type="button" id="RegSubmit" name="RegSubmit" value="OK！注册"/>	
			</p>
</form>
</div>

<!-- 这里用户注册表单end -->
<!-- 这里显示登录框表单右侧的内容，可以是一些公共的东西，可以放一个iframe窗口 start-->
<div id="fit_for_body_height_half">
这里显示该联盟网站的信息
</div>
<!-- 这里显示登录框表单右侧的内容，可以是一些公共的东西，可以放一个iframe窗口 end-->
</div>
<!--  这里显示页面内容  end-->
<!--引入页尾文件start-->
<?php
//注册表单部分 end
}else{
//注册结果部分 start	
echo "<div id='fit_for_body_height'>";
echo "<div id='center_width_70'>";
$UserEmail = $_GET['uuid'];//注册邮箱
$VerifyCode = $_GET['c'];//验证码
$reg_verify_link = "http://".DOMAINNAME."Include/RegVerify.php?ue={$UserEmail}&c={$VerifyCode}&t=n";//验证链接
//这里向用户发送邮件start
$mail_string = <<<END
<h2>感谢您注册IT联盟信息平台</h2>
<p>点击下面的链接即可完成注册</p>
<p><center><a href=$reg_verify_link>$reg_verify_link</a></center></p>
<p align='right'>IT联盟信息平台管理员</p>
END;
require 'Libs/Phpmailer/class.phpmailer.php';
require 'Include/SqlHelper.class.php';
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
	$to = $UserEmail;
	$mail->AddAddress($to);
	$mail->Subject  = "IT联盟信息平台注册";
	$mail->Body = $mail_string;
	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略
	$mail->WordWrap   = 80; // 设置每行字符串的长度
	//$mail->AddAttachment("f:/test.png");  //可以添加附件
	$mail->IsHTML(true);
	$mail->Send();
	echo "<center><img src='Images/openmail.png' width='200px' height='130px'/></center>";
	echo '<h3><center>我们已经向您注册时填写的邮箱发送了一封邮件，请进入您的邮箱执行验证</center></h3>';
} catch (phpmailerException $e) {
	//echo "邮件发送失败：".$e->errorMessage();
	//如果这里发送邮件失败了，那么就是系统的问题，将刚刚注册的这个账号的K_Verify改为y
	$sql_update_verify = "Update t_user set K_Verify = 'y' where K_UserEmail = '".$UserEmail."'";
	$sqlHelper = new SqlHelper();
	$result_update_verify = $sqlHelper -> execute_dql($sql_update_verify);
	if($result_update_verify != null){
		echo "<center><img src='Images/Earth.png' width='300px' height='300px'/></center>";
		echo "<h2><center><font color='red' size='5'>恭喜您</font>已完成注册,点击上方导航链接登录吧</center></h2>";
		echo "<p></p>";
	}
}
//这里向用户发送邮件end
echo "</div>";
}//注册结果部分 end
	include 'footer.php';
?>
<!--引入页尾文件end-->
</body>
</html>
