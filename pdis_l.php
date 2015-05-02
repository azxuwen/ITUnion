<?php
require_once 'Include/SqlHelper.class.php';
require_once 'Include/AssPage.class.php';
require_once 'Include/ComFunction.php';
$sqlHelper = new SqlHelper();

$assPage = new AssPage();
//每页显示1个
$assPage->pageSize = 4;
//下面查看是否存在pageNow
if(isset($_GET['p'])){
	$assPage->pageNow = $_GET['p'];
}else{
	$assPage->pageNow = 1;
}
if(isset($_GET['cate'])) {
	$sql_where = " Where K_DiscuzCategory = ".$_GET['cate'];
}else {
	$sql_where = "";
}
//查询所有信息
$sql_all_dis = "Select count(K_DiscuzId) From t_discuz";
$sql_all_dis.=$sql_where;
$arr_all_dis = $sqlHelper->execute_dql2($sql_all_dis);
//建立查询 获取当前页面的数据
$aa = ($assPage->pageNow-1)*$assPage->pageSize;//每一页的起始位置
$bb = $assPage->pageSize;
//获取当前页面的信息
$sql_pagenow_dis = "Select * From t_discuz";
$sql_order = " Order By K_DiscuzTime desc Limit $aa,$bb";
$sql_pagenow_dis.=$sql_where;
$sql_pagenow_dis.=$sql_order;
//执行改查询
$sqlHelper->excute_dql_asspage($sql_all_dis, $sql_pagenow_dis, $assPage);
//查询后 该页面的信息已经被保存到$assPage->pageArr中

?>
<?php
include 'header.php';
?>
<div id="fit_body_center_90">
<div id="fit_body_70_float">
<div id="banner">
<table>
<tr><td width="150px" rowspan="2"><a href="pdis_l.php"><img src="Images/talk.jpg" width="100px" height="80px" /></a></td><td valign="top" class="title">IT联盟</td></tr>
<tr><td valign="top" class="time">帖子数:<?php echo $arr_all_dis[0][0];?></td></tr>
</table>
<hr style='border:0.1px solid gray' ></hr>

<!--
<table id="caidan">
<tr><td>1</td><td>2</td><td>3</td><td>4</td></tr>
</table>
-->
<?php
if($arr_all_dis[0][0]==0) {
	echo "暂时没有该类的帖子！";
}else {
	if($assPage->pageCount==$assPage->pageNow) {
		$pageSize = count($assPage->pageArr);
	}else {
		$pageSize = $assPage->pageSize;
	}
for($i=0;$i<$pageSize;$i++) {
	//获取帖子的信息
	$dis_title = $assPage->pageArr[$i]['K_DiscuzTitle'];//帖子标题
	$dis_content = $assPage->pageArr[$i]['K_DiscuzContent'];//帖子内容
	$dis_user = getUserName($assPage->pageArr[$i]['K_DiscuzUserId'],$sqlHelper);//帖子发布人
	//帖子类别
	$sql_get_cate = "Select CodeName From t_basecode Where CodeId = ".$assPage->pageArr[$i]['K_DiscuzCategory'];
	$arr_get_cate = $sqlHelper->execute_dql2($sql_get_cate);
	$dis_cate = $arr_get_cate[0][0];
	//帖子发布时间
	$dis_time = $assPage->pageArr[$i]['K_DiscuzTime'];
	//帖子浏览次数
	$dis_visittimes = $assPage->pageArr[$i]['K_DiscuzVisitTimes'];
	//帖子的回复数
	$sql_num_reply = "Select count(K_ReplyId) From t_discuzreply Where K_ReplyDiscuzId = ".$assPage->pageArr[$i]['K_DiscuzId'];
	$arr_num_reply = $sqlHelper->execute_dql2($sql_num_reply);
	$reply_num = $arr_num_reply[0][0];
	
	echo "<a href='pdis_c.php?pi=".$assPage->pageArr[$i]['K_DiscuzId']."'><table id='discuz'  width='100%'>";
	echo '<tr><td  colspan="2" class="discuz_title">'.$dis_title.'</td></tr>';
	echo '<tr><td colspan="2" class="discuz_content">'.$dis_content.'</td></tr>';
	echo '<tr><td><img src="Images/talk.jpg" width="20px" height="20px">'.$reply_num.'<span class="cate">['.$dis_cate.']</span></td><td class="time" align="right">'.$dis_user.'&nbsp;发表于&nbsp;'.$dis_time.'</td></tr>';
	echo '<tr><td height="5px" colspan="2"></td></tr>';
	echo "</table></a>";
	echo "<hr style='color:white;'></hr>";
}
//分页
	echo "<div class='fenye'>";
	if($assPage->pageNow==1) {
		if(isset($_GET['cate'])=="") {
			echo "<a href='pdis_l.php?p=1'>首页</a>";
		}else {
			echo "<a href='pdis_l.php?p=1&cate=".$_GET['cate']."'>首页</a>";
		}
	}else {
		if(isset($_GET['cate'])=="") {
			echo "<a href='pdis_l.php?p=1'>首页</a>";
			echo "<a href='pdis_l.php?p=".($assPage->pageNow-1)."'>上一页</a>";
		}else {
			echo "<a href='pdis_l.php?p=1&cate=".$_GET['cate']."'>首页</a>";
			echo "<a href='pdis_l.php?p=".($assPage->pageNow-1)."&cate=".$_GET['cate']."'>上一页</a>";
		}
	}
	if($assPage->pageNow < $assPage->pageCount) {
		if(isset($_GET['cate'])=="") {
			echo "<a href='pdis_l.php?p=".($assPage->pageNow+1)."'>下一页</a>";
		}else {
			echo "<a href='pdis_l.php?p=".($assPage->pageNow+1)."&cate=".$_GET['cate']."'>下一页</a>";
		}
	}
	echo "</div>";
}
?>
</div>
</div>
<div id="fit_body_30_float">
<?php
	//查找热门帖子
	$sql_hot_discuz = "Select t_discuz.*,t_discuzreply.* From t_discuz,t_discuzreply Order By count(t_discuzreply.K_ReplyDiscuzId) desc,t_discuzreply.K_ReplyTime desc Limit 0,10";
	$arr_hot_discuz = $sqlHelper->execute_dql2($sql_hot_discuz);
	if(isset($_SESSION['USERID'])) {
		//查找我发过的帖子
		$sql_my_discuz = "Select * From t_discuz Where K_DiscuzUserId =".$_SESSION['USERID'];
		$arr_my_discuz = $sqlHelper->execute_dql2($sql_my_discuz);
		
		echo '<div class="main_col">';
		echo '<span class="main_title"><img src="Images/messages_48x48.png" width="25px" height="28px" />　我的帖子</span>';
		echo '</div>';
		if(count($arr_my_discuz)>0) {
			for($i=0;$i<count($arr_my_discuz);$i++) {
				echo "<a href='pdis_c.php?pi=".$arr_my_discuz[$i]['K_DiscuzId']."'>".$arr_my_discuz[$i]['K_DiscuzTitle']."</a><br/>";
			}
		}else {
			echo "您暂时还没有发帖哦!";
		}
	}
?>
<div class="main_col">
	<span class="main_title"><img src="Images/messages_48x48.png" width="25px" height="28px" />　热门帖子</span>
</div>
<?php
	for($j=0;$j<count($arr_hot_discuz);$j++) {
		echo "<a href='pdis_c.php?pi=".$arr_hot_discuz[$j]['K_DiscuzId']."'>".$arr_hot_discuz[$j]['K_DiscuzTitle']."</a><br/>";
	}
?>
</div>
</div>
<?php 
	if(isset($_SESSION['USERID'])) {
?>
<div id="rightBottom"style=" width:50px; height:400px; position:absolute;">
<table id="caidan">
<tr><td><a href="pdis_l.php?p=1&cate=33">云计算</a></td></tr>
<tr><td><a href="pdis_l.php?p=1&cate=34">云开发环境</a></td></tr>
<tr><td><a href="pdis_l.php?p=1&cate=35">云服务</a></td></tr>
<tr><td><a href="pdis_l.php?p=1&cate=36">云数据库</a></td></tr>
<tr><td><a href="pdis_l.php?p=1&cate=37">企业计算</a></td></tr>
<tr><td><a href="pdis_l.php?p=1&cate=38">信息化</a></td></tr>
<tr><td><a href="pdis_l.php?p=1&cate=39">移动互联</a></td></tr>
<tr><td><a href="pdis_l.php?p=1&cate=40">整机外设</a></td></tr>
<tr><td><a href="pdis_l.php?p=1&cate=41">大数据</a></td></tr>
<tr><td><a href="pdis_l.php?p=1&cate=42">互联网</a></td></tr>
<tr><td><a href="pdis_l.php?p=1&cate=43">服务器</a></td></tr>
<tr><td><a href="pdis_l.php?p=1&cate=44">存储</a></td></tr>
</table>
<a href="fatie.php"><img src="Images/l_fatie.jpg"></a>
</div>
<?php
	}
?>
</body>