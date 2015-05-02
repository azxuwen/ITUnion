<!--创建者 : 吴德森 创建时间 : 2014 02 25    11:07 站点归属 ：IT联盟(哈尔滨理工大学创新实验)  联盟资讯内容显示-->
<?php
require_once 'Include/SqlHelper.class.php';
require_once 'Include/ComFunction.php';
require_once 'Include/config.inc.php';
$sqlHelper = new SqlHelper();
//联盟资讯内容显示首先获取该联盟资讯的id
if(isset($_GET['ni']) && $_GET['ni']!=""){
	$ni = $_GET['ni'];//资讯id
	//下面从数据库中获取该信息中的内容start
	$sql_get_pn_c = "Select * from t_news where K_NewsId = $ni";
	$arr_get_pn_c = $sqlHelper -> execute_dql2($sql_get_pn_c);
	/*if(count($arr_get_pn_c) == 0){
		header('Location:notfound.php');
		exit;
	}*/
	$sql_add_view_times = "Update t_news set K_NewsVisitTimes = K_NewsVisitTimes+1 where K_NewsId = $ni";//没点一次，就将浏览量+1
	$sqlHelper->execute_dql($sql_add_view_times);
	$pn_c_title = $arr_get_pn_c[0]['K_NewsTitle'];//新闻标题
	$pn_c_content = $arr_get_pn_c[0]['K_NewsContent'];//新闻内容
	$pn_c_visitimes = $arr_get_pn_c[0]['K_NewsVisitTimes'];//浏览次数
	$pn_c_ManagerId = $arr_get_pn_c[0]['K_ManagerId'];//添加人的ID
	//获取新闻关键字
	$pn_c_categoryid = $arr_get_pn_c[0]['K_NewsCategory'];
	$sql_get_CategoryName = "select CodeName from t_basecode where 
	CodeCategoryId=$pn_c_ManagerId";
	$arr_get_CategoryName = $sqlHelper -> execute_dql2($sql_get_CategoryName);
	$pn_c_goryname = $arr_get_CategoryName[0]['CodeName'];
	$pr_c_time = date('Y-m-d', strtotime($arr_get_pn_c[0]['K_NewsTime']));//添加新闻的时间
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
<div id="fit_body_center_90">
<div id="fit_body_70_float">
<?php
//输出新闻信息
echo "<div class='center_title'>{$pn_c_title}</div>";
echo "<div class='time_vtimes'>{$pn_c_goryname} | {$pr_c_time} | {$pn_c_visitimes}次</div>";
echo $pn_c_content;
?>
</div>
<div id="fit_body_30_float"><!-- 最外第二层右侧div  样式为 宽度30% 高度不限制  向左浮动-->

<div class="main_col">
	<span class="main_title"><img src="Images/messages_48x48.png" width="25px" height="28px" />　最新资讯</span><br/><br/>
    <?php
	//置顶资讯显示10条
	$sql_news_same = "Select * From t_news where K_NewsId != ".$_GET['ni']." Order By K_NewsTime Desc Limit 0,10";
	$arr_news_same = $sqlHelper->execute_dql2($sql_news_same);
	//var_dump($arr_news_same);
	for($i=0;$i<10;$i++) {
		$arr_news_same_array = explode(",",$arr_news_same[$i]['K_NewsTitle']);
		echo "<a href='pn_c.php?ni=".$arr_news_same[$i]['K_NewsId']."'><span style='font-size:15px'>".$arr_news_same[$i]['K_NewsTitle']."</span></a><hr width='100%'>";
	}
?>
</div><!--main_col-->
</div><!-- fit_body_30_float -->
</div><!-- fit_body_center_90 -->
</body>
</html>