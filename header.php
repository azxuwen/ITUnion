<?php
session_start();
require_once 'Include/ComFunction.php';
require_once 'Include/SqlHelper.class.php';
$sqlHelper = new SqlHelper(); 
?>
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
<title>云环境下IT联盟信息平台</title>
<!--标题-->
<!--CSS   start-->
<link href="Css/main.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="Public/Kindeditor/themes/default/default.css" /><!-- 引入kindedit库 css文件-->
<link rel="stylesheet" href="Public/Kindeditor/plugins/code/prettify.css" /><!-- 引入kindedit库 css文件-->
<link rel="stylesheet" href="Css/share.css" type="text/css" />
<link rel="stylesheet" href="Css/button.css" type="text/css" />
<link rel="stylesheet" href="Css/discuz.css" type="text/css" />
<link rel="stylesheet" href="Css/jquery.confirmon.css" type="text/css" />
<link rel="stylesheet" href="Css/person.css" type="text/css" />
<link rel="stylesheet" href="Css/product.css" type="text/css" />
<link rel="stylesheet" href="Css/project.css" type="text/css" />
<link rel="stylesheet" href="Css/recruit.css" type="text/css" />
<link rel="stylesheet" href="Css/sample.css" type="text/css" />
<link rel="stylesheet" href="Css/seo.css" type="text/css" />

<!--CSS   end-->
<!--Js  start-->
<script src="Js/jquery-2.0.2.js" type="text/javascript"></script>
<script src="Js/main.js" type="text/javascript"></script>
<script charset="utf-8" src="Public/Kindeditor/kindeditor.js"></script><!-- 引入kindedit库 js文件-->
<script charset="utf-8" src="Public/Kindeditor/lang/zh_CN.js"></script><!-- 引入kindedit库  js文件-->
<script charset="utf-8" src="Public/Kindeditor/plugins/code/prettify.js"></script><!-- 引入kindedit库 js文件 -->
<script charset="utf-8" src="Js/kindeditor.js"></script><!-- 引入kindedit配置文件 -->
<script charset="utf-8" src="Js/jquery.confirmon.min.js"></script>
<script charset="utf-8" src="Js/p.js"></script>
<script charset="utf-8" src="Js/r.js"></script>
<script charset="utf-8" src="Js/script.js"></script>
<script charset="utf-8" src="Js/select.js"></script>
<script charset="utf-8" src="Js/seo.js"></script>
<script charset="utf-8" src="Js/slides.js"></script>
<script charset="utf-8" src="Js/upload.js"></script>
<script charset="utf-8" src="Js/window.js"></script>
<script charset="utf-8" src="Libs/DatePicker/WdatePicker.js"></script>
<!--Js  end-->
</head>
<body>
<div id="header">
	<div class="logo"><a href="index.php"><img src="Images/logo.jpg" /></a></div>
    <div class="navigator">
    	<div class="wrapper">
	
		<!-- BEGIN Dark navigation bar -->
		<nav class="blue">
			<ul class="clear">
				<li><a href="index.php">主页</a></li>
				<li><a href="pd_l.php">产品推介</a>
                	<ul>
						<li><a href="#">发布产品</a></li>
						<li><a href="#">撤销产品</a></li>
					</ul>
                </li>
				<li><a href="pp_l.php">项目合作</a>

				</li>
				<li><a href="pr_l.php">招聘应聘</a>
                <ul>
						<li><a href="pr_l.php?n=y">我的招聘</a></li>
						<li><a href="n_pr.php">发布新职位</a></li>                        
					</ul>
                </li>
				<li><a href="ps_l.php">知识共享</a></li>
				<li><a href="pn_l.php">联盟资讯</a></li>
				<li><a href="pdis_l.php">在线交流</a></li>
				<?php 
				if(isset($_SESSION['USERID']) && $_SESSION['USERID']!=null){
					if(getUserHead($_SESSION['USERID'], $sqlHelper) !=""){
                		echo "<li><a href='mz.php?i=$_SESSION[USERID]'><img src='".getUserHead($_SESSION['USERID'], $sqlHelper)."' width='30px' height='25px'/>我</a>";
					}else{
						echo "<li><a href='mz.php?i=$_SESSION[USERID]'><img src='Upload/Images/default_u.jpg' width='30px' height='25px'/>我</a>";
					}
                	echo "<ul>";
                	if(getUserHead($_SESSION['USERID'], $sqlHelper) !=""){
                		echo "<li><a href='mz.php' title='点击进入个人中心'><img src='".getUserHead($_SESSION['USERID'], $sqlHelper)."' width='125px' height='125px'/></a></li>";
                	}else{
                		echo "<li><a href='mz.php' title='点击进入个人中心'><img src='Upload/Images/default_u.jpg' width='125px' height='125px'/></a></li>";
                	}
                	echo "<li style='background:rgba(211,211,232,1.00);;border-radius:2px;-moz-border-radius:2px;-webkit-border-radius:2px;'><font color='black'>".utf8Substr(getUserName($_SESSION['USERID'], $sqlHelper), 0, 6)."</font><br/><font size='2'>".utf8Substr($_SESSION['USERNAME'], 0, 16)."</font></li>";
                	echo "<li><a href='mz.php' title='点击进入个人中心'>个人中心</a></li>";
                	echo "<li><a href='mi.php' title='点击查看积分设置情况'>我的积分 ".getUserInteger($_SESSION['USERID'], $sqlHelper)."</a></li>";
                	//这里取得当前页面的信息，例如 index.php  或者p_c.php?pi=3 要将这些信息传递给Login.php
                	$string = $_SERVER['PHP_SELF'];///ITUnion/index.php 这样的字符串
                	//下面将前面的/ITUnion/去掉
                	$arr_string = explode('/',$string);
                	for($i = 0; $i < count($arr_string);$i++){
                		if($arr_string[$i] == 'ITUnion'){
                			break;
                		}
                	}
                	$f = $arr_string[$i+1];//文件名
                	$f = substr($f,0,strrpos($f,'.'));//除去.php后的文件名
                	$l = $_SERVER['QUERY_STRING'];//文件名后面的参数
                	echo "<li><a href='Logout.php?l=".$f."&".$l."' title='点击退出登录'>退出登录</a></li>";
                	echo "</ul>";
                	echo "</li>";
				}else{
					//这里取得当前页面的信息，例如 index.php  或者p_c.php?pi=3 要将这些信息传递给Login.php
					$string = $_SERVER['PHP_SELF'];///ITUnion/index.php 这样的字符串
					//下面将前面的/ITUnion/去掉 
					$arr_string = explode('/',$string);
					for($i = 0; $i < count($arr_string);$i++){
						if($arr_string[$i] == 'ITUnion'){
							break;
						}
					}
					$f = $arr_string[$i+1];//文件名
					$f = substr($f,0,strrpos($f,'.'));//除去.php后的文件名
					$l = $_SERVER['QUERY_STRING'];//文件名后面的参数
					echo "<li><a href='Login.php?l=".$f."&".$l."'>登录</a></li>";
				}
                ?>
			</ul>
		</nav>
		<!-- END Dark navigation bar -->
	</div>
    </div>
</div><!--header-->
