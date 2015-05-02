<!--创建者 : 徐文志 创建时间 : 2014 02 24    20:22   站点归属 ：IT联盟(哈尔滨理工大学创新实验)   页面功能:项目列表 -->
<?php
require_once 'Include/SqlHelper.class.php';
require_once 'Include/ComFunction.php';
require_once 'Include/AssPage.class.php';
$assPage = new AssPage();//建立分页对象
?>
<?php
//引入页头文件start
include 'header.php';
//引入页头文件 end
//判断是否有页码start
if(isset($_GET['p'])){
	//如果有页码
	$assPage->pageNow = $_GET['p'];
}else{
	$assPage->pageNow = 1;//如果没有页面 则认为是第一页
}
//判断是否有页码end
$assPage->pageSize = 4;//每页显示数量

/*
 *这个页面希望做的活起来，
*1、用户登录了，想看他参与的项目  通过在url中添加一个变量&u=y 同样会有分页
*2、默认显示所有的项目    同样要有分页
*/
if(isset($_GET['u']) && $_GET['u'] == 'y'){
	//证明用户想要看他参与的项目
	$uid = $_SESSION['USERID'];//这个时候肯定会有用户登录的ID 所以获取
	//构造sql语句
	$sql_g_p_c = "Select count(K_ProjectId) from t_project where K_ProjectUnion like '".$uid."%' or K_ProjectUnion like '%".$uid."' or K_ProjectUnion = '".$uid."'";//查询数据库项目表数据量
	$start = ($assPage->pageNow-1) * $assPage->pageSize;//每一页的起始位置
	$end = $start+$assPage->pageSize;
	$sql_g_p_n_l = "Select  K_ProjectUnion,K_ProjectId, K_ProjectName, K_ProjectContent, K_ProjectUserId,K_ProjectStartTime,K_ProjectTrade,K_ProjectView from t_project where K_ProjectUnion like '".$uid."%' or K_ProjectUnion like '%".$uid."' or K_ProjectUnion = '".$uid."' order by K_ProjectStartTime desc limit $start, $end";
	$sqlHelper -> excute_dql_asspage($sql_g_p_c, $sql_g_p_n_l, $assPage);//获取本页内容到对象 $assPage中
}else{
	//如果不存在GET['u']，那么应该是查看全部的项目
	//构造sql语句
	$sql_g_p_c = "Select count(K_ProjectId) from t_project ";//查询数据库项目表数据量
	$start = ($assPage->pageNow-1) * $assPage->pageSize;//每一页的起始位置
	$end = $start+$assPage->pageSize;
	$sql_g_p_n_l = "Select  K_ProjectUnion,K_ProjectId, K_ProjectName, K_ProjectContent, K_ProjectUserId,K_ProjectStartTime,K_ProjectTrade,K_ProjectView from t_project  order by K_ProjectStartTime desc limit $start, $end";
	$sqlHelper -> excute_dql_asspage($sql_g_p_c, $sql_g_p_n_l, $assPage);//获取本页内容到对象 $assPage中
}
if(count($assPage->pageArr) == 0){
	header("Location:notfound.php");
	exit;
}

?>

<div id="fit_body_center_90">
<div id="fit_body_70_float">
<?php
if(isset($_GET['t']) && $_GET['t'] == 's'){
	echo "<div class='error_infor'>";
	echo "<table style='position:relative;top:-20px;' width='100%'>";
	echo "<tr><td valign='top' align='right'><a href='#close' id='clo_infor' title='关闭该信息'><img src='Images/cross_48x48.png' width='17px' height='17px'/></a></td></tr>";
	echo "<tr><td valign='bottom' align='center'>恭喜您，项目合作删除成功!</td></tr>";
	echo "</table>";
	echo "</div>";
}

$sqlHelper = new SqlHelper();//这里新建一个对象
//这里将本页的数据展示出来
for($i=0;$i<count($assPage->pageArr);$i++) {
	//获取项目发布者
	$sql_get_user_name = "Select K_UserName from t_user where K_UserId = {$assPage-> pageArr[$i]['K_ProjectUserId']}";
	$arr_get_user_name = $sqlHelper -> execute_dql2($sql_get_user_name);
	$pp_user = getUserName($assPage-> pageArr[$i]['K_ProjectUserId'], $sqlHelper);
	//获取时间
	$pp_time = date('Y-m-d', strtotime($assPage-> pageArr[$i]['K_ProjectStartTime']));
	//获取图片
	$pp_address_array = explode(",",$assPage-> pageArr[$i]['K_ProjectView']);
	//布局
	echo "<table id='chanpinliebiao'>";
	echo "<tr><td colspan='2'><a href='p_c.php?pi=".$assPage-> pageArr[$i]['K_ProjectId']."'><b>".$assPage-> pageArr[$i]['K_ProjectName']."</a></b></td></tr>";
	echo "<tr><td colspan='2' class='time'>".$pp_time." | 发布者：".$pp_user." ";
	//获取项目设计到的行业start
	if(strlen($assPage->pageArr[$i]['K_ProjectTrade'])!= 0){
		$arr_trade = explode(',', $assPage->pageArr[$i]['K_ProjectTrade']);
		echo "|  ";
		for($j = 0; $j < count($arr_trade); $j++){
			if($j < count($arr_trade) -1){
				echo getGradeName($arr_trade[$j], $sqlHelper).",";
			}else{
				echo getGradeName($arr_trade[$j], $sqlHelper);
			}
		}
	}
	echo "<tr><td width='126' class='content'><img src=".$pp_address_array[0]." width='125' height='90'/></td><td valign='top'>".utf8Substr($assPage->pageArr[$i]['K_ProjectContent'],0,220)."</td></tr>";
	//获取项目设计到的行业end
	echo "<tr><td colspan='2'>";
	$arr_comp = explode(',', $assPage->pageArr[$i]['K_ProjectUnion']);
	for($k = 0 ; $k< 5; $k++){
		if($k < 4){
			//echo "<a href='my.php?i=".$arr_comp[$k]."' title='点击进入".getUserName($arr_comp[$k], $sqlHelper)."'><font  style='color:gray;font-size:15px;'>".getUserName($arr_comp[$k], $sqlHelper)."</font></a><font  style='color:gray;font-size:15px;'> |</font> ";
		}else{
			//echo "<a href='my.php?i=".$arr_comp[$k]."' title='点击进入".getUserName($arr_comp[$k], $sqlHelper)."'><font  style='color:gray;font-size:15px;'>".getUserName($arr_comp[$k], $sqlHelper)."</font></a>";
		}
	}
	echo "</td></tr>";
	//这里列出几个该项目中设计到的企业
	
	echo "</table>";
	echo "<hr style='border:0.5px dashed gray' size=0.5></hr>";
}

//分页
echo "<div class='fenye'>";
echo "<table width='100%'><tr><td align='left'>";
if($assPage->pageNow==1) {
	echo "<a class='pageButton button' href='pp_l.php?p=1'>首页</a>";
}else {
	echo "<a class='pageButton button' href='pp_l.php?p=".($assPage->pageNow-1)."'>上一页</a>";
}
echo "</td><td align='right'>";
//这里显示一共多少页，然后有一个自动跳到多少页start
echo "<font size='3'>{$assPage->pageNow}/{$assPage->pageCount}页　　</font>";
echo "<input type='number' id='w_page' value='' style='width:30px;' />";
echo "<a id='go_w_page' href='#_ff'>跳到指定页</a>  ";
echo "<input type='hidden' class='page_count' value='".$assPage->pageCount."'/>";//将页数隐藏于表单之中
//这里显示一共多少页，然后有一个自动跳到多少页end
if($assPage->pageNow < $assPage->pageCount) {
	echo "<a class='pageButton button' href='pp_l.php?p=".($assPage->pageNow+1)."'>下一页</a>";
}else{
	echo "<font size='3' color='red'>已经是最后一页喽　</font>";
}
echo "</td></tr></table>";
echo "</div>";

?>
</div><!-- fit_body_70_float -->

<div id="fit_body_30_float">

</div><!-- fit_body_30_float -->
</div><!-- fit_body_center_90 -->

</body>
</html>
