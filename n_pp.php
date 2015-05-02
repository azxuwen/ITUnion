<!--创建者 : 吴德森 创建时间 : 2014 03 01    19:58 站点归属 ：IT联盟(哈尔滨理工大学创新实验)  发布新项目-->
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
if(isset($_GET['pi'])){
	//如果存在ID的情况，那就是修改，要将数据库中原有的内容取出来
	$sql_get_p_i = "Select * from t_project where K_ProjectId = {$_GET['pi']}";
	$arr_get_p_i = $sqlHelper -> execute_dql2($sql_get_p_i);
	if(count($arr_get_p_i) != 0){
		//如果在数据库中存在以此为ID的招聘信息，那就将数据取出
		//首先判断取出的 K_UserId  是不是 与 当前登录的这个人的 ID是同一个，如果不是，那就是在恶意篡改别人的招聘信息，那就踢出
		if(!($_SESSION['USERID'] == $arr_get_p_i[0]['K_ProjectUserId'])){
			echo '<script> alert("您在恶意篡改他人的招聘信息，请不要这样做，谢谢配合"); location.replace("index.php")</script>';//登录后还要保证可以回到本页面
			exit();
		}
		$p_name = $arr_get_p_i[0]['K_ProjectName'];// 项目合作名称
		$p_con = $arr_get_p_i[0]['K_ProjectContent'];//项目合作内容
		$p_union = explode(',' ,$arr_get_p_i[0]['K_ProjectUnion']);//项目合作企业
		$p_st_time = $arr_get_p_i[0]['K_ProjectStartTime'];//项目开启时间
		$p_end_time = $arr_get_p_i[0]['K_ProjectEndTime'];//项目结束时间
		$p_trade= explode(',', $arr_get_p_i[0]['K_ProjectTrade']);//项目合作涉及到的行业的ID  数组形式 
		$p_views = explode(',',$arr_get_p_i[0]['K_ProjectView']);//项目视图
		$p_open = $arr_get_p_i[0]['K_ProjectOpen'];//是否为开源项目  y-> 开源  n->不开源
	}else{
		//如果在数据库中不存在以此为ID的招聘信息，那就not found
		header('Location:notfound.php');
	}
}else{
	//不存在ID，那就是添加，设置一些变量，让他们为空
		$p_name = '';// 项目合作名称
		$p_con = '';//项目合作内容
		$p_union = '';//项目合作企业
		$p_st_time = '';//项目开启时间
		$p_end_time = '';;//项目结束时间
		$p_trade= '';//项目合作涉及到的行业的ID  数组形式 
		$p_views = '';//项目视图
		$p_open = '';//是否为开源项目  y-> 开源  n->不开源
}
//接下来要处理的是什么呢，因为想把这一个页面不仅当做添加 还要可以修改 这两种情况的判断就是判断有没有ID，有ID的情况下是修改，否则是添加end
?>
<!--引入页头文件end-->
<div id="fit_body_center_90">
<div id="fit_body_70_float">
<?php
if(isset($_GET['t']) && $_GET['t'] == 'f'){
	echo "<div class='error_infor'>";
	echo "<table style='position:relative;top:-20px;' width='100%'>";
	echo "<tr><td valign='top' align='right'><a href='#close' id='clo_infor' title='关闭该信息'><img src='Images/cross_48x48.png' width='17px' height='17px'/></a></td></tr>";
	echo "<tr><td valign='bottom' align='center'>抱歉，您的项目没有添加成功!</td></tr>";
	echo "</table>";
	echo "</div>";
} 
?>
<form name="r_form" id="r_form" class='kindform' method="post"  enctype='multipart/form-data' action="Include/sub_p.php">
<table class="n_pr_form" >
<tr><th colspan='4' align="left"><div style='font-size:25px;margin-top:5px;margin-bottom:5px;color:black;font-weight:bolder;'>发布新项目</div></th></tr>
<tr><td colspan='4'>&nbsp;</td></tr>
<tr><td>项目标题</td><td colspan="3"><input type="text" name="p_title" id="p_title" placeholder="项目信息的标题,限制30字。" value="<?php echo $p_name;?>"/></td></tr>
<tr><td>开启时间</td><td colspan="3"><input type='text' readonly class='Wdate' id='FFirstDate' onClick='WdatePicker()' size='21' name='p_start_time'  value=''  /></tr>
<tr><td>结束时间</td><td colspan="3"><input type='text' readonly class='Wdate' id='FFirstDate' onClick='WdatePicker()' size='21' name='p_end_time'  value=''  /></td></tr>
<tr height='70px'><td>项目视图</td><td colspan="3"><input type='file'  name='p_view'  value='' /><br/><font size='2' color='gray' style='margin-left:30px;'>支持JPG、JPEG、GIF和PNG文件，最大4M</font></td></tr>
<tr><td>是否开源</td><td colspan='3'>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="p_o_y" id='p_o_y' checked="checked"  value='y'/><label for='p_o_y'>是</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="p_o_y"   id='p_o_n' value='n'/><label for='p_o_n'>否</label>
</td></tr>
<tr height='110px'><td>合作企业</td><td colspan="3"><span id='user'></span><input type='hidden' id='user_code' name='user_code' value=''/><br/><font size='2' color='gray' style='margin-left:30px;'>输入您合作的企业，在右侧下拉菜单中选中,或者可以直接在下拉菜单中选择。</font><br/><input type="text" name="r_user" id="r_user" placeholder="搜索您合作的企业。" style="width:200px;" value="" size="20"/>
<select id='r_user1' name='r_user1'>
<option value='选择下列企业'>请选择下列企业</option>
<?php
//从t_union中获取联盟
$sql_get_user = "Select K_UserName,K_UserId From t_user Where K_UserType = 'c'";
echo $sql_get_user;
$arr_get_user = $sqlHelper->execute_dql2($sql_get_user);
if(count($arr_get_user)!=0) {
	for($i=0;$i<count($arr_get_user);$i++) {
		echo "<option value='".$arr_get_user[$i]['K_UserId']."-".$arr_get_user[$i]['K_UserName']."'>".$arr_get_user[$i]['K_UserName']."</option>";
	}
}
?>
</select>
</td></tr>
<tr  height='110px'><td>行业要求</td><td colspan="3">
<input type='hidden' id='trade_code' name='trade_code' value=''/>
<div class='trade'></div>
<br/><font size='2' color='gray' style='margin-left:30px;'>通过左侧的下拉菜单来选中行业大类，从而更精确的得到您项目的行业。</font>
<br/>
<select id='r_trade1' name='r_trade1' onchange="g_grade_s_2()">
<?php
//从t_trade中获取行业
$arr = getTrade($sqlHelper);
if(count($arr) != 0){
	for($i = 0 ; $i < count($arr); $i++){
		echo "<option value='".$arr[$i]['K_TradeId']."'>".$arr[$i]['K_TradeName']."</option>";
	}
}else{
	echo "<option value='88888'>未有行业信息</option>";
}
?>
</select>
<select id='r_trade2' name='r_trade2' id='trade_2' >
<?php
	$sql_get_t_2 = "select * from t_trade where K_TradeId like '".$arr[0]['K_TradeId']."%' and K_TradeId != {$arr[0]['K_TradeId']}";
	$arr_get_t_2 = $sqlHelper -> execute_dql2($sql_get_t_2);
	for($i = 0 ; $i < count($arr_get_t_2); $i ++){
		echo "<option value='".$arr_get_t_2[$i]['K_TradeId']."-".$arr_get_t_2[$i]['K_TradeName']."'>".$arr_get_t_2[$i]['K_TradeName']."</option>";
	}
?>
</select>
</td></tr>

<tr><td>项目描述</td><td colspan="3"><textarea name="content1" id="content1" style="width:700px;height:300px;visibility:hidden;"></textarea></td></tr>
<tr><td colspan='4' align='center'><div class='r_infor'></div></td></tr>
<?php 
echo "<tr><td colspan='4' align='center'><input style='width:80px;height:30px;background:rgba(211,211,232,1.0)' type='submit' id='p_button' name='p_button' value='添加' /> <font size='2'>(提交快捷键: Ctrl + Enter)</font></td></tr>";

?>
</table>
</form>
</div><!-- fit_body_70_float -->

<div id="fit_body_30_float">
<?php
echo "<div class='main_col'>";
echo "<span class='main_title'><img src='Images/tag-2_48x48.png' width='25px' height='28px' />我的其他项目</span>";
echo "</div>";
//这里显示当前登录用户的招聘信息
$sql_get_company_other_project = "Select K_ProjectId, K_ProjectName from T_Project where K_ProjectUserId = ".$_SESSION['USERID']." order by K_ProjectId desc limit 0, 10;";
$arr_get_company_other_project = $sqlHelper->execute_dql2($sql_get_company_other_project);
if(count($arr_get_company_other_project)!= 0){
	for($i = 0; $i < count($arr_get_company_other_project); $i++){
		echo "<div id='project' style='width:273px;'><a href='p_c.php?pi=".$arr_get_company_other_project[$i]['K_ProjectId']."' title='".$arr_get_company_other_project[$i]['K_ProjectName']."'>".utf8Substr($arr_get_company_other_project[$i]['K_ProjectName'], 0, 21)."</a></div>";
	}
}else{
	echo "<div id='project'><font size='2'>您暂无其他项目</font></div>";
}
 
?>
</div>
</div><!-- fit_body_center_90 -->
<!--引入页尾文件start-->
<!--引入页尾文件end-->
</body>
</html>
