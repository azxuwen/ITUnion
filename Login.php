<!--创建者 : 徐文志 创建时间 : 2014 01 17    19:00 站点归属 ：IT联盟(哈尔滨理工大学创新实验)   页面功能:用户登录 -->
<!DOCTYPE HTML>
<html>
<head>
<!-- 网页描述信息 start-->
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="target-densitydpi=device-dpi,width=device-width,initial-scale=1,minimum-scale=0.1,maximum-scale=1" />
<meta name="开发团队" content="哈尔滨理工大学管理学院创新实验" />
<meta name="keywords" content="哈尔滨理工大学管理学院创新实验|魏玲|王金石|郭新朋|张健平|吴德森|徐文志">
<meta name="description" content="哈尔滨理工大学管理学院创新实验">
<!-- 网页描述信息 end-->
<!---标题 start-->
<title>用户登录</title>
<!--标题-->
<!--CSS   start-->
<link href="Css/main.css" rel="stylesheet" type="text/css"/>
<!--CSS   end-->
<!--Js  start-->
<script src="Js/jquery-2.0.2.js" type="text/javascript"></script>
<script src="Js/main.js" type="text/javascript"></script>
<script src="Js/script.js" type="text/javascript"></script>
<!--Js  end-->
</head>
<body>
<!--引入页头文件start-->
<?php
include 'header.php';
?>
<!--引入页头文件end-->
<!--  这里显示页面内容  start-->
<div id="fit_for_body_height">
<!-- 这里显示的是登录框表单start -->
<div id="fit_for_body_height_half">
<form class="form-2" action="Include/LoginControl.php?<?php echo $_SERVER['QUERY_STRING']; ?>" method="post">
			<br>
			<h1><span class="log-in">用户登录</span></h1>
			<p class="float">
				<input type="text" id="UserName" name="UserName" required pattern="^\w+[\w-\.]*\@\w+((-\w+)|(\w*))\.[a-z]{2,3}$" placeholder="请输入您的企业邮箱OR个人邮箱 "/>
			</p>
			<p class="float">
				<input type="password" id="UserPass" name="UserPass" required min="6" max="15" pattern="^[0-9a-zA-Z].{5,16}$" placeholder="请输入6-15位密码" class="showpassword">
			</p>
			<p class="float">
				<span class="logininfor">
				</span>
			</p>
			<p class="clearfix">
			<br/> 
				<input type="button" id="LoginSubmit" name="LoginSubmit" value="马上登录" />
				<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
				<a href="losepass.php" class="login_other_link">忘记密码?</a>
				<a href="reg.php" class="login_other_link">没有账户,去注册</a>
			</p>
</form>
 
</div>
<!-- 这里显示的是登录框表单end -->
<!-- 这里显示登录框表单右侧的内容，可以是一些公共的东西，可以放一个iframe窗口 start-->
<?php 
//如果是从注册成功页面跳转过来的
if(isset($_GET['reg'])){
?>
<div id="fit_for_body_height_half">
<div>
<font color="red"><font size="6">恭</font>喜您</font>,注册成功,非常感谢您成为本信息平台会员，
</div>
</div>
<?php 
}else{
?>
<div id="fit_for_body_height_half">
这里是登录的右侧，放一些联盟近期的动态，热点文章什么的
</div>
<?php 
}
?>
<!-- 这里显示登录框表单右侧的内容，可以是一些公共的东西，可以放一个iframe窗口 end-->
</div>
<!--  这里显示页面内容  end-->
<!--引入页尾文件start-->
<?php
	include 'footer.php';
?>
<!--引入页尾文件end-->
</body>
</html>
