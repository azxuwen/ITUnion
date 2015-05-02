<?php
// 创建者 : 徐文志 创建时间 : 2014 02 26    19:57 站点归属 ：IT联盟(哈尔滨理工大学创新实验)   页面功能:发布招聘信息的人处理有人感兴趣 
?>

<!--引入页头文件start-->
<?php
include 'header.php';
require_once 'Include/SqlHelper.class.php';
include_once 'Include/ComFunction.php';
$sqlHelper = new SqlHelper();
if(isset($_GET['ri'])){
	$ri = $_GET['ri'];//招聘信息的ID
	$r_a_count = $_GET['c'];//感兴趣的人数
	$sql_g_r_accept = "Select * from t_accept where K_RecruitId = {$ri} ";//首先取10条，如果会有更多的话，会在最下面来个加载更多
	$arr_g_r_accept = $sqlHelper -> execute_dql2($sql_g_r_accept);	
}else{
	header("Location:notfound.php");
}

?>
<!--引入页头文件end-->

<div id="fit_body_center_90">
<div id="fit_body_70_float">
<?php
if(!(count($arr_g_r_accept)== 0 || isset($_GET['n'])) ){
echo "<div class='error_infor'>";
echo "<table style='position:relative;top:-20px;' width='100%'>";
echo "<tr><td valign='top' align='right'><a href='#close' id='clo_infor' title='关闭该信息'><img src='Images/cross_48x48.png' width='17px' height='17px'/></a></td></tr>";
echo "<tr><td valign='top' align='center'>如果处理状态为未处理，您可以点击右侧的已阅来告知应聘者当前的状态</td></tr>";
echo "</table>";
echo "</div>";
}



echo "<table id='recruit_accept_list' width='100%' >";
if(count($arr_g_r_accept)!= 0){
	echo "<div id='accept_all_div'><a href='#ffd' class='button blue' id='do_accept_change' >选中标记为已阅</a><span class='accept_status_infor'></span></div>";
}
//将招聘信息的ID隐藏于表单之中
echo "<input type='hidden' class='ri' value='".$ri."'/>";
if(count($arr_g_r_accept)!= 0){
	echo "<tr style='font-weight:bolder;'><td width='80px' align='center'>姓名</td><td width='400px;' align='center'>应聘宣言</td><td align='center'>时间</td><td width='100px' align='center'>处理状态</td></tr>";
}
	 if(count($arr_g_r_accept)!= 0){
	 	//如果感兴趣的人不为空 那就显示出来
	 	for($i = 0 ; $i < count($arr_g_r_accept);$i++){
	 		if($arr_g_r_accept[$i]['K_AcceptContent'] == ''){
	 			$arr_g_r_accept[$i]['K_AcceptContent'] = '未填写';
	 		}
	 		echo "<tr style='font-size:15px;'>";
	 		echo "<td align='center'>".getUserName($arr_g_r_accept[$i]['K_UserId'], $sqlHelper)."</td><td align='center'>".$arr_g_r_accept[$i]['K_AcceptContent']."</td><td align='center'>{$arr_g_r_accept[$i]['K_AcceptTime']}</td><td align='center'>".getStatus($arr_g_r_accept[$i]['K_AcceptStatus'], $sqlHelper)."</td>";
	 		echo "</tr>";
	 	}
	 }else{
	 	echo "";
	 }
echo "</table>";
?>
</div>

<div id="fit_body_30_float">
</div><!-- fit_body_30_float-->
</div>


</body>
</html>
