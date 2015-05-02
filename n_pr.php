<!--创建者 : 徐文志 创建时间 : 2014 02 15    19:58 站点归属 ：IT联盟(哈尔滨理工大学创新实验)  发布新职位-->
<!--引入页头文件start-->
<?php
include 'header.php';
require_once 'Include/ComFunction.php';
//刚进入页面的处理start,例如判断一下有没有用户登录，和登录用户的类型是 个人 还是 企业
if(isset($_SESSION['USERID'])){
	if(!judgeUserType($_SESSION['USERID'], $sqlHelper) == 'c' || judgeUserType($_SESSION['USERID'], $sqlHelper) == 'C'){
		echo '<script> alert("您不是企业用户，无法发布新职位"); location.replace("pr_l.php")</script>';
		exit();
	}
}else{
	echo '<script> alert("您还未登录，无法发布新职位"); location.replace("Login.php?l=n_pr")</script>';//登录后还要保证可以回到本页面
	exit();
}
//刚进入页面的处理end
//接下来要处理的是什么呢，因为想把这一个页面不仅当做添加 还要可以修改 这两种情况的判断就是判断有没有ID，有ID的情况下是修改，否则是添加start
if(isset($_GET['ri'])){
	//如果存在ID的情况，那就是修改，要将数据库中原有的内容取出来
	$sql_get_r_i = "Select * from t_recruit where K_RecruitId = {$_GET['ri']}";
	$arr_get_r_i = $sqlHelper -> execute_dql2($sql_get_r_i);
	if(count($arr_get_r_i) != 0){
		//如果在数据库中存在以此为ID的招聘信息，那就将数据取出
		//首先判断取出的 K_UserId  是不是 与 当前登录的这个人的 ID是同一个，如果不是，那就是在恶意篡改别人的招聘信息，那就踢出
		if(!($_SESSION['USERID'] == $arr_get_r_i[0]['K_UserId'])){
			echo '<script> alert("您在恶意篡改他人的招聘信息，请不要这样做，谢谢配合"); location.replace("index.php")</script>';//登录后还要保证可以回到本页面
			exit();
		}
		$r_trade = $arr_get_r_i[0]['K_RecruitTrade'];//招聘信息的行业
		$r_title = $arr_get_r_i[0]['K_RecruitTitle'];//招聘信息的标题
		$r_con = $arr_get_r_i[0]['K_RecruitContent'];//职位描述
		$r_position = $arr_get_r_i[0]['K_RecruitPosition'];//职位
		$r_location = $arr_get_r_i[0]['K_RecruitLocation'];//地点
		$r_salary = $arr_get_r_i[0]['K_RecruitSalary'];//薪资
		$r_degree = $arr_get_r_i[0]['K_RecruitDegree'];//要求的学历
	}else{
		//如果在数据库中不存在以此为ID的招聘信息，那就not found
		header('Location:notfound.php');
	}
}else{
	//不存在ID，那就是添加，设置一些变量，让他们为空
	$r_trade = "";//招聘信息的行业
	$r_title = "";//招聘信息的标题
	$r_con = "";//职位描述
	$r_position = "";//职位
	$r_location = "";//地点
	$r_salary = "";//薪资
	$r_degree = "";//要求的学历
}
//接下来要处理的是什么呢，因为想把这一个页面不仅当做添加 还要可以修改 这两种情况的判断就是判断有没有ID，有ID的情况下是修改，否则是添加end
?>
<!--引入页头文件end-->
<div id="fit_body_center_90">
<div id="fit_body_70_float">
<form name="r_form" id="r_form" class='kindform' method="post" action="Include/sub_r.php<?php if(isset($_GET['ri'])){ echo "?ri=".$_GET['ri']; } if(isset($_GET['t'])){ echo "&t=u";}?>">
<table class="n_pr_form">
<tr><th colspan='4' align="left"><div style='font-size:25px;margin-top:5px;margin-bottom:5px;color:black;font-weight:bolder;'>发布新职位</div></th></tr>
<tr><td colspan='4'>&nbsp;</td></tr>
<tr><td>招聘标题</td><td colspan="3"><input type="text" name="r_title" id="r_title" placeholder="招聘信息的标题,限制30字。" value="<?php echo $r_title;?>"/></td></tr>
<tr><td>招聘职位</td><td colspan="3"><input type="text" name="r_position" id="r_position" placeholder="招聘的职位,限制20字。" value="<?php echo $r_position;?>"/></td></tr>
<tr><td>薪资待遇</td><td>
<select id="r_salary" name="r_salary">
<?php
//从t_basecode中获取薪资
$arr = getCategoryInfor(6, $sqlHelper);
if(count($arr) != 0){
	for($i = 0 ; $i < count($arr); $i++){
		if($r_salary == $arr[$i]['CodeId']){
			echo "<option value='".$arr[$i]['CodeId']."' selected = 'selected'>".$arr[$i]['CodeName']."</option>";
		}else{
			echo "<option value='".$arr[$i]['CodeId']."'>".$arr[$i]['CodeName']."</option>";
		}
	}
}else{
	echo "<option value='88888'>未有薪资信息</option>";
} 
?>
</select>
</td><td>学历要求</td><td>
<select id="r_degree" name="r_degree">
<?php
//从t_basecode中获取学历
$arr = getCategoryInfor(2, $sqlHelper);
if(count($arr) != 0){
	for($i = 0 ; $i < count($arr); $i++){
		if($r_degree == $arr[$i]['CodeId']){
			echo "<option value='".$arr[$i]['CodeId']."' selected = 'selected'>".$arr[$i]['CodeName']."</option>";
		}else{
			echo "<option value='".$arr[$i]['CodeId']."'>".$arr[$i]['CodeName']."</option>";
		}
	}
}else{
	echo "<option value='88888'>未有学历信息</option>";
} 
?>
</select>
</td></tr>
<tr><td>行业类型</td><td colspan="3">
<select id='r_trade1' name='r_trade1' onchange="g_grade_s_2()">
<?php
//从t_trade中获取行业
$arr = getTrade($sqlHelper);
if(count($arr) != 0){
	for($i = 0 ; $i < count($arr); $i++){
		if(substr($r_trade, 0, 2) == $arr[$i]['K_TradeId']){
			echo "<option value='".$arr[$i]['K_TradeId']."' selected='selected'>".$arr[$i]['K_TradeName']."</option>";
		}else{
			echo "<option value='".$arr[$i]['K_TradeId']."'>".$arr[$i]['K_TradeName']."</option>";
		}
	}
}else{
	echo "<option value='88888'>未有行业信息</option>";
}
?>
</select>
<select id='r_trade2' name='r_trade2'>
<?php
//如果是修改招聘信息的话，那么这里要将之前选择的拿出来，在数据库中存储的是t_trade中的行业代码 例如 0802  $r_trade也就是存储着这个东西
if($r_trade != ""){
	//如果现在是修改招聘信息
	$sql_get_t_2 = "Select * from t_trade where K_TradeId like '".substr($r_trade, 0, 2)."%' and length(K_TradeId) != 2";
	$arr_get_t_2 = $sqlHelper -> execute_dql2($sql_get_t_2);
	for($i = 0 ; $i < count($arr_get_t_2); $i ++){
		if($arr_get_t_2[$i]['K_TradeId'] == $r_trade){
			echo "<option value='".$arr_get_t_2[$i]['K_TradeId']."' selected='selected'>".$arr_get_t_2[$i]['K_TradeName']."</option>";
		}else{
			echo "<option value='".$arr_get_t_2[$i]['K_TradeId']."'>".$arr_get_t_2[$i]['K_TradeName']."</option>";
		}
	}
}else{
	//如果是添加招聘信息，行业小类这里要对应行业大类出现在这个位置 如果 行业大类显示机械设备 那么行业子类应该显示 机械设备下的小类
	$sql_get_t_2 = "select * from t_trade where K_TradeId like '".$arr[0]['K_TradeId']."%' and K_TradeId != {$arr[0]['K_TradeId']}";
	$arr_get_t_2 = $sqlHelper -> execute_dql2($sql_get_t_2);
	for($i = 0 ; $i < count($arr_get_t_2); $i ++){
		echo "<option value='".$arr_get_t_2[$i]['K_TradeId']."'>".$arr_get_t_2[$i]['K_TradeName']."</option>";
	}
}
?>
</select>
</td></tr>
<tr><td>工作地点</td><td colspan="3">
<!-- 这里做成这样的，两个下拉菜单和一个输入框，第一个下拉菜单 是省份或直辖市  第二个下来菜单是具体的市县  第三个输入框输入具体的街道信息 -->
<?php
if($r_location != ""){
$arr_locat = explode('&', $r_location);
$r_locat_2 = $arr_locat[0];//第二个下拉菜单的值
$r_locate_text = $arr_locat[1];//具体街道信息
}else{
	$r_locat_2 = "";
	$r_locate_text = "";
}
?>
<select id="r_prov" name="r_prov" onchange="g_locate_s_2()">
<?php
if($r_location == ""){
	//如果地点为空，那么证明这是在添加招聘信息
	$sql_get_l_p = "Select * from t_city where length(K_CityId) = 2";
	$arr_get_l_p = $sqlHelper -> execute_dql2($sql_get_l_p);
	for($i = 0; $i < count($arr_get_l_p); $i ++){
		echo "<option value='".$arr_get_l_p[$i]['K_CityId']."'>".$arr_get_l_p[$i]['K_CityName']."</option>";
	}
}else{
	//如果地点不为空，那么是在修改这个招聘信息,如果之前选择的是 黑龙江哈尔滨南岗区，代表的是230103 ，那么需要将之前的 23 拿到并且到数据库中获取
	$sql_get_l_p = "Select * from t_city where K_CityName = '".$r_locat_2."'";
	$arr_get_l_p = $sqlHelper -> execute_dql2($sql_get_l_p);
	$l_p_code = substr($arr_get_l_p[0]['K_CityId'],0, 2);
	$sql_get_l_p = "Select * from t_city where length(K_CityId) = 2";
	$arr_get_l_p = $sqlHelper -> execute_dql2($sql_get_l_p);
	for($i = 0; $i < count($arr_get_l_p); $i ++){
		if($arr_get_l_p[$i]['K_CityId'] == $l_p_code){
			echo "<option value='".$arr_get_l_p[$i]['K_CityId']."' selected='selected'>".$arr_get_l_p[$i]['K_CityName']."</option>";
		}else{
			echo "<option value='".$arr_get_l_p[$i]['K_CityId']."'>".$arr_get_l_p[$i]['K_CityName']."</option>";
		}
	}
}
?>
</select>
<select id="r_city" name="r_city">
<?php
//还是需要判断到底是添加还是修改
if($r_location != ""){
	//修改的情况下，需要获取到第一个下拉菜单省下对应的市县，并且还要对已经选择的市县优先显示
	$sql_get_l_c = "Select * from t_city where K_CityId like '".$l_p_code."%' and K_CityId != {$l_p_code}";
	$arr_get_l_c = $sqlHelper -> execute_dql2($sql_get_l_c);
	for($i=0; $i < count($arr_get_l_c); $i ++){
		if($arr_get_l_c[$i]['K_CityName'] == $r_locat_2){
			echo "<option value='".$arr_get_l_c[$i]['K_CityName']."' selected='selected'>".$arr_get_l_c[$i]['K_CityName']."</option>";
		}else{
			echo "<option value='".$arr_get_l_c[$i]['K_CityName']."'>".$arr_get_l_c[$i]['K_CityName']."</option>";
		}
	}
}else{
	//添加的情况下
	$sql_get_l_2 = "Select * from t_city where K_CityId like '".$arr_get_l_p[0]['K_CityId']."%' and K_CityId != {$arr_get_l_p[0]['K_CityId']}";
	$arr_get_l_2 = $sqlHelper -> execute_dql2($sql_get_l_2);
	for($i = 0 ; $i < count($arr_get_l_2); $i ++){
		echo "<option value='".$arr_get_l_2[$i]['K_CityName']."'>".$arr_get_l_2[$i]['K_CityName']."</option>";
	}
}
?>
</select>
<input type='text' id='r_l_3' name='r_l_3' style='width:200px;' placeholder='具体的街道地址' value='<?php echo $r_locate_text;?>'/><!-- 具体街道信息 -->
</td></tr>
<tr><td>职位描述</td><td colspan="3"><textarea name="content1" id="content1" style="width:700px;height:500px;visibility:hidden;"><?php echo $r_con;?></textarea></td></tr>
<tr><td colspan='4' align='center'><div class='r_infor'></div></td></tr>
<?php 
if(!isset($_GET['ri'])){
	echo "<tr><td colspan='4' align='center'><input style='width:80px;height:30px;background:rgba(211,211,232,1.0)' type='button' id='r_button' name='r_button' value='提交内容' /> <font size='2'>(提交快捷键: Ctrl + Enter)</font></td></tr>";
}else{
	echo "<tr><td colspan='4' align='center'><input style='width:80px;height:30px;background:rgba(211,211,232,1.0)' type='button' id='r_button' name='r_button' value='修改' /> <font size='2'>(提交快捷键: Ctrl + Enter)</font></td></tr>";
}
?>
</table>
</form>
</div><!-- fit_body_70_float -->

<div id="fit_body_30_float">
<?php
echo "<div class='main_col'>";
echo "<span class='main_title'><img src='Images/tag-2_48x48.png' width='25px' height='28px' />　我的其他招聘</span>";
echo "</div>";
//这里显示当前登录用户的招聘信息
$sql_get_company_other_recruit = "Select K_RecruitId, K_RecruitTitle from t_recruit where K_UserId = ".$_SESSION['USERID']." order by K_RecruitId desc limit 0, 10;";
$arr_get_company_other_recruit = $sqlHelper->execute_dql2($sql_get_company_other_recruit);
if(count($arr_get_company_other_recruit)!= 0){
	for($i = 0; $i < count($arr_get_company_other_recruit); $i++){
		echo "<div id='project' style='width:273px;'><a href='pr_c.php?pi=".$arr_get_company_other_recruit[$i]['K_RecruitId']."' title='".$arr_get_company_other_recruit[$i]['K_RecruitTitle']."'>".utf8Substr($arr_get_company_other_recruit[$i]['K_RecruitTitle'], 0, 21)."</a></div>";
	}
}else{
	echo "<div id='project'><font size='2'>您暂无其他招聘</font></div>";
}
 
?>
</div>
</div><!-- fit_body_center_90 -->
<!--引入页尾文件start-->
<!--引入页尾文件end-->
</body>
</html>
