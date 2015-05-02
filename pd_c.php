<!--创建者 : 张健平 创建时间 : 2014 02 15    18:33 站点归属 ：IT联盟(哈尔滨理工大学创新实验)  产品推介内容显示-->
<?php
require_once 'Include/SqlHelper.class.php';
require_once 'Include/ComFunction.php';
require_once 'Include/config.inc.php';
$sqlHelper = new SqlHelper();
//招聘信息内容显示首先获取该招聘信息的id
if(isset($_GET['pi']) && $_GET['pi']!=""){
	$pi = $_GET['pi'];//信息id
	//下面从数据库中获取该信息中的内容start
	$sql_get_pd_c = "Select * from t_product where K_ProductId = $pi";
	$arr_get_pd_c = $sqlHelper -> execute_dql2($sql_get_pd_c);
	if(count($arr_get_pd_c) == 0){
		header('Location:notfound.php');
		exit;
	}
	//将浏览量+1
	$sql_add_view_times = "Update t_product set K_ProductVisitTimes = K_ProductVisitTimes+1 where K_ProductId = $pi";
	$sqlHelper->execute_dql($sql_add_view_times);
	//获取产品图片
	$pd_address_array = explode(",",$arr_get_pd_c[0]['K_ProductPicAddress']);
	//计算图片有多少
	$pd_address_array_num = count($pd_address_array);
	$pd_kind = $arr_get_pd_c[0]['K_ProductKind'];//获取产品类别
	
	$sql_get_product_kind = "Select CodeName From t_basecode Where CodeId = $pd_kind";
	$arr_get_product_kind = $sqlHelper->execute_dql2($sql_get_product_kind);
	$pd_kind_name = $arr_get_product_kind[0]['CodeName'];
	$pd_title = $arr_get_pd_c[0]['K_ProductTitle'];//信息名称
	$pd_content = $arr_get_pd_c[0]['K_ProductContent'];//信息内容
	$pd_user = $arr_get_pd_c[0]['K_ProductUserId'];
	//获取发布者
	$pd_user = getUserName($pd_user, $sqlHelper);
	$pd_time = date('Y-m-d', strtotime($arr_get_pd_c[0]['K_ProductTime']));

	$pd_visittime = $arr_get_pd_c[0]['K_ProductVisitTimes'];//信息的浏览次数
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
	echo "<div class='center_title'>{$pd_title}</div>";//信息名称
	echo "<div class='time_vtimes'>{$pd_kind_name} | {$pd_user} | {$pd_time} | {$pd_visittime}次</div>";//信息添加人 和添加时间
	//产品信息
	echo "<hr width='100%' style='color:white;'>";
	echo "<div class='left_title' style='position:relative;left:24px;'>产品展示</div>";
	for($i=0;$i<$pd_address_array_num;$i++) {
		echo "<div class='productpic'><img src='".$pd_address_array[$i]."' width='270px' height='200px'/></div>";
	}
	echo "<table class='chanpinjianjie'>";
	echo "<tr><td><p class='left_title'>产品简介</p></td></tr>";
	echo "<tr><td><hr></hr></td></tr>";
	echo "<tr><td>".$pd_content."</td></tr>";
	echo "</table>";
?>
</div>
<div id="fit_body_30_float">
<div class="main_col">
	<span class="main_title"><img src="Images/messages_48x48.png" width="25px" height="28px" />其他同类产品</span><br/><br/>
<?php
	//查找同类型的产品且浏览次数最高的 3个
	$sql_product_same = "Select * From t_product Where K_ProductKind = $pd_kind And K_ProductId != $pi Order By K_ProductVisitTimes Desc Limit 0,3";
	//echo $sql_product_same;
	$arr_product_same = $sqlHelper->execute_dql2($sql_product_same);
	//只取第一张图片
	for($i=0;$i<count($arr_product_same);$i++) {
		$arr_product_same_array = explode(",",$arr_product_same[$i]['K_ProductPicAddress']);
		echo "<a href='pd_c.php?pi=".$arr_product_same[$i]['K_ProductId']."' title='".$arr_product_same[$i]['K_ProductTitle']."'><img src='".$arr_product_same_array[0]."' width='270px'/><br/><center style='font-size:15px'>".$arr_product_same[$i]['K_ProductTitle']."</center></a><hr></hr>";
	}
?>
</div>
</div>

</div>
</body>
</html>