<!--创建者 : 徐文志 创建时间 : 2014 02 13    14:41 站点归属 ：IT联盟(哈尔滨理工大学创新实验)  项目合作内容显示-->
<?php
require_once 'Include/SqlHelper.class.php';
require_once 'Include/ComFunction.php';
require_once 'Include/config.inc.php';
$sqlHelper = new SqlHelper();
//项目合作内容显示首先获取该项目的id
if(isset($_GET['pi']) && $_GET['pi']!=""){
	$pi = $_GET['pi'];//项目id
	//下面从数据库中获取该项目中的内容start
	$sql_get_p_c = "Select * from t_project where K_ProjectId = $pi";
	$arr_get_p_c = $sqlHelper -> execute_dql2($sql_get_p_c);
	if(count($arr_get_p_c) == 0){
		header('Location:notfound.php');
		exit;
	}
	$p_title = $arr_get_p_c[0]['K_ProjectName'];//项目名称
	$p_content = $arr_get_p_c[0]['K_ProjectContent'];//项目内容
	$p_user = getUserName($arr_get_p_c[0]['K_ProjectUserId'], $sqlHelper);//项目负责人同时也是添加人
	$p_time = date('Y-m-d', strtotime($arr_get_p_c[0]['K_ProjectStartTime']));
	$p_trades = $arr_get_p_c[0]['K_ProjectTrade'];//项目涉及到的行业代码 现在是个字符串，如果是多个是通过 逗号 隔开的
	$p_arr_trades = explodeToArr($p_trades, ',');//存有涉及到行业代码的数组
	$p_company = $arr_get_p_c[0]['K_ProjectUnion'];//项目参与的企业  多个是用逗号隔开的
	$p_arr_company =  explodeToArr($p_company, ',');//项目参与的企业 保存在数组中
	$p_open = $arr_get_p_c[0]['K_ProjectOpen'];
	//下面从数据库中获取该项目中的内容end
} else{
	header('Location:notfound.php');
	exit;
}
?>
<?php
include 'header.php';
?>
<!-- 这里显示具体内容 -->
<div id="fit_body_center_90"><!-- 最外层的div  样式为 居中 宽度 90% 高度不限制 -->
<div id="fit_body_70_float"><!-- 最外第二层左侧div  样式为 宽度70% 高度不限制  向左浮动-->
<?php
if(isset($_GET['t']) && $_GET['t'] == 's'){
	echo "<div class='error_infor'>";
	echo "<table style='position:relative;top:-20px;' width='100%'>";
	echo "<tr><td valign='top' align='right'><a href='#close' id='clo_infor' title='关闭该信息'><img src='Images/cross_48x48.png' width='17px' height='17px'/></a></td></tr>";
	echo "<tr><td valign='bottom' align='center'>恭喜您，添加项目成功!</td></tr>";
	echo "</table>";
	echo "</div>";
}
if(isset($_GET['t']) && $_GET['t'] == 'f'){
	echo "<div class='error_infor'>";
	echo "<table style='position:relative;top:-20px;' width='100%'>";
	echo "<tr><td valign='top' align='right'><a href='#close' id='clo_infor' title='关闭该信息'><img src='Images/cross_48x48.png' width='17px' height='17px'/></a></td></tr>";
	echo "<tr><td valign='bottom' align='center'>很抱歉，删除失败，请重试!</td></tr>";
	echo "</table>";
	echo "</div>";
}



	echo "<div class='center_title'>{$p_title}</div>";//项目名称
	echo "<div class='time_vtimes'>{$p_user} | {$p_time} |";//项目负责人 添加人 和添加时间 
	//通过for循环来将涉及到的行业展示start
	for($i = 0 ; $i < count($p_arr_trades); $i++){
		if($i < count($p_arr_trades)-1){
			echo "<a href='seo.php?k=".getGradeName($p_arr_trades[$i], $sqlHelper)."' title='点击查找该行业信息' ><font size='2'>".getGradeName($p_arr_trades[$i], $sqlHelper).",</font></a>";
		}else{
			echo "<a href='seo.php?k=".getGradeName($p_arr_trades[$i], $sqlHelper)."' title='点击查找该行业信息' ><font size='2'>".getGradeName($p_arr_trades[$i], $sqlHelper)."</font></a>";
		}
		if($i == 5){
			//如果标签超过5个就跳出循环
			break;
		}
	}
	if(isset($_SESSION['USERID']) && $_SESSION['USERID'] == $arr_get_p_c[0]['K_ProjectUserId']){
		echo "<input type='hidden' class='p_id' value=".$pi.">";
		echo " | <a href='#p_delete' id='p_delete'><img src='Images/note_delete.png' width='20 px' height='20px' /><font color='black' size='2.5'>删除</font></a>";
	}
	echo "</div>";
	//通过for循环来将涉及到的行业展示end
	//项目具体介绍 start
	echo "<p id='p_con'>".$p_content."</p>";
	//项目具体介绍 end
	
?>
</div><!-- fit_body_70_float -->

<div id="fit_body_30_float"><!-- 最外第二层右侧div  样式为 宽度30% 高度不限制  向左浮动-->
<div class="main_col">
	<span class="main_title"><img src="Images/messages_48x48.png" width="25px" height="28px" />　合作企业</span>
</div><!--main_col-->
<?php 
//这里显示该项目的合作企业start
//这里经过判断 如果该项目是开源项目，并且判断这人并没有加入该项目 则显示加入该项目的链接
echo "<div class='slider-carousel'>";
for($j = 0; $j < count($p_arr_company); $j ++){
	$p_c_head = getUserHead($p_arr_company[$j], $sqlHelper);
	if($p_c_head != ""){//如果该企业没有头像
		echo "<div class='item'><a href='mz.php?i={$p_arr_company[$j]}' title='".getUserName($p_arr_company[$j], $sqlHelper)."'><img src='".$p_c_head."' width='280px' height='200px' /></a><span class='c_intro'>".getUserName($p_arr_company[$j], $sqlHelper)."</span></div>";
	}else{
		echo "<div class='item'><a href='mz.php?i={$p_arr_company[$j]}' title='".getUserName($p_arr_company[$j], $sqlHelper)."'><img src='Upload/Images/default_c.jpg' width='280px' height='200px' /></a><span class='c_intro'>".getUserName($p_arr_company[$j], $sqlHelper)."</span></div>";
	}
}
echo "</div>";
//这里显示该项目的合作企业end
//下面判断这个项目是否是开源项目，如果是，那么要有一个加入该项目的字样start
echo "<br/>";
if($p_open == 'y'){
	if(isset($_SESSION['USERID'])){
		if(!judgeProjectUserExists($_SESSION['USERID'], $pi, $sqlHelper)){
			echo "<div class='main_col'>";
			echo "<span class='main_title'><img src='Images/network_48x48.png' width='25px' height='28px' />　开源项目</span>";
			echo "</div>";
			echo "<p id='p_con' class='p_al' style='margin-top:10px;margin-left:25px;'>该项目为开源项目，有没有兴趣加入呢?</p>";
			echo "<br/>";
			echo "<div class='j_pj_infor'></div>";
			echo "<center><a class='button blue1' id='j_p' style='width:220px;' href='#j_prpject'>现在加入</a></center>";//现在加入，这里做成JS+Ajax实现
			echo "<input type='hidden' class='pj_id' value='".$pi."'/>";//隐藏项目合作 ID ，便于在加入项目时获取
		}else{
			echo "<div class='main_col'>";
			echo "<span class='main_title'><img src='Images/network_48x48.png' width='25px' height='28px' />　开源项目</span>";
			echo "</div>";
			echo "<p id='p_con'>您已经在此开源项目中了</p>";
		}
	}
}
//下面判断这个项目是否是开源项目，如果是，那么要有一个加入该项目的字样end

//下面推荐一些开源项目或者start
//推荐项目要注意的是 要推荐的必须  ①是开源的 ②不能推荐现在正在访问的项目 ③不能推荐当前登录的用户已经加入的项目
//这里要区分到底现在有没有用户登录
if(isset($_SESSION['USERID'])){//如果现在有用户登录
	$sql_get_instro_p = "Select K_ProjectId, K_ProjectName, K_ProjectStartTime ,K_ProjectUserId from t_project where K_ProjectId != {$pi} and K_ProjectOpen ='y' and (K_ProjectUnion not like '".$_SESSION['USERID']."' and K_ProjectUnion not like '%".$_SESSION['USERID']."' and K_ProjectUnion not like '".$_SESSION['USERID']."%')";
	$arr_get_instro_p = $sqlHelper -> execute_dql2($sql_get_instro_p);//已经获取的推荐项目在这个数组中了
	if(count($arr_get_instro_p) != 0){
		echo "<br/><br/><br/>";
		echo "<div class='main_col'>";
		echo "<span class='main_title'><img src='Images/sound_48x48.png' width='25px' height='28px' />　推荐项目</span>";
		echo "</div>";
		for($k = 0; $k < count($arr_get_instro_p); $k ++){
			echo "<div id='project'><a href='p_c.php?pi=".$arr_get_instro_p[$k]['K_ProjectId']."' title='".$arr_get_instro_p[$k]['K_ProjectName']."'>".utf8Substr($arr_get_instro_p[$k]['K_ProjectName'], 0, 21)."</a></div>";
		}
	}
}

//不管有没有用户登录，把近期的项目摆在这
$sql_get_recent_p = "Select K_ProjectId, K_ProjectName, K_ProjectStartTime from t_project where K_ProjectId != {$pi} order by K_ProjectStartTime desc limit 0, 10";
$arr_get_recent_p = $sqlHelper -> execute_dql2($sql_get_recent_p);//已经获取的近期项目在这个数组中了
if(count($arr_get_recent_p) != 0){
	echo "<br/><br/><br/>";
	echo "<div class='main_col'>";
	echo "<span class='main_title'><img src='Images/clock_48x48.png' width='25px' height='28px' />　近期项目</span>";
	echo "</div>";
	for($k = 0; $k < count($arr_get_recent_p); $k ++){
		echo "<div id='project'><a href='p_c.php?pi=".$arr_get_recent_p[$k]['K_ProjectId']."' title='".$arr_get_recent_p[$k]['K_ProjectName']."'>".utf8Substr($arr_get_recent_p[$k]['K_ProjectName'], 0, 21)."</a></div>";
	}
}
echo "<br>";
if(judgeUserType($_SESSION['USERID'], $sqlHelper) == 'c'){
				echo "<center><a class='button blue1' style='width:220px;' href='n_pp.php'>发布新项目</a></center>";//发布新项目
}
?>

</div><!-- fit_body_30_float -->
</div><!-- fit_body_center_90 -->


</body>
</html>
