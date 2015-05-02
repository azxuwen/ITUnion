<!--创建者 : 张健平 创建时间 : 2014 02 26    11:55 站点归属 ：IT联盟(哈尔滨理工大学创新实验)  产品信息列表显示-->
<?php
require_once 'Include/SqlHelper.class.php';
require_once 'Include/AssPage.class.php';
require_once 'Include/ComFunction.php';
$sqlHelper = new SqlHelper();
$assPage = new AssPage();
//每页显示10个
$assPage->pageSize = 5;
//下面查看是否存在pageNow
if(isset($_GET['p'])){
	$assPage->pageNow = $_GET['p'];
}else{
	$assPage->pageNow = 1;
}
?>

<?php
include 'header.php';

if(isset($_GET['n'])){
	//如果是想看自己上传的资料，那么判断一下是否在url中存在 n
	if(isset($_SESSION['USERID'])){
		//查询数据库中只是共享的条数
		$sql_all_share_count = "Select count(K_ShareId) From t_share where K_ShareUserId = {$_SESSION['USERID']}";
		//建立查询 获取当前页面的数据
		$aa = ($assPage->pageNow-1)*$assPage->pageSize;//每一页的起始位置
		$bb = $aa+$assPage->pageSize;
		$sql_pagenow_share = "Select * From t_share where K_ShareUserId = {$_SESSION['USERID']} Order By K_ShareId desc Limit $aa,$bb";
		//执行改查询
		$sqlHelper->excute_dql_asspage($sql_all_share_count, $sql_pagenow_share, $assPage);
		//查询后 该页面的信息已经被保存到$assPage->pageArr中
		$share_title = "我上传的资料";
	}else{
		//如果想看自己上传的资料，但是根本没有登录
		header("Location:Login.php");
		exit;
	}
}else{
	//查询数据库中只是共享的条数
	$sql_all_share_count = "Select count(K_ShareId) From t_share";
	//建立查询 获取当前页面的数据
	$aa = ($assPage->pageNow-1)*$assPage->pageSize;//每一页的起始位置
	$bb = $aa+$assPage->pageSize;
	$sql_pagenow_share = "Select * From t_share Order By K_ShareId desc Limit $aa,$bb";
	//执行改查询
	$sqlHelper->excute_dql_asspage($sql_all_share_count, $sql_pagenow_share, $assPage);
	//查询后 该页面的信息已经被保存到$assPage->pageArr中
	$share_title = "资料列表";
}

?>
<div id="fit_body_center_90">
<div id="fit_body_70_float">
<?php
if(isset($_GET['t']) && $_GET['t'] == 'u'){
	echo "<div class='error_infor'>";
	echo "<table style='position:relative;top:-20px;' width='100%'>";
	echo "<tr><td valign='top' align='right'><a href='#close' id='clo_infor' title='关闭该信息'><img src='Images/cross_48x48.png' width='17px' height='17px'/></a></td></tr>";
	echo "<tr><td valign='bottom' align='center'>恭喜您，成功添加资料</td></tr>";
	echo "</table>";
	echo "</div>";
}


if(isset($_GET['r'])){
	if($_GET['r'] == 'y'){
		//删除成功
		echo "<div class='error_infor'>";
		echo "<table style='position:relative;top:-20px;' width='100%'>";
		echo "<tr><td valign='top' align='right'><a href='#close' id='clo_infor' title='关闭该信息'><img src='Images/cross_48x48.png' width='17px' height='17px'/></a></td></tr>";
		echo "<tr><td valign='bottom' align='center'>恭喜您，删除成功!</td></tr>";
		echo "</table>";
		echo "</div>";
	}else{
		//删除失败
		echo "<div class='error_infor'>";
		echo "<table style='position:relative;top:-20px;' width='100%'>";
		echo "<tr><td valign='top' align='right'><a href='#close' id='clo_infor' title='关闭该信息'><img src='Images/cross_48x48.png' width='17px' height='17px'/></a></td></tr>";
		echo "<tr><td valign='bottom' align='center'>很抱歉，删除失败，请重试!</td></tr>";
		echo "</table>";
		echo "</div>";
	}
}
$sqlHelper = new SqlHelper();
echo "<div class='share_title'>".$share_title."</div>";
	for($i=0;$i<count($assPage->pageArr);$i++) {
		//获取发布人
		$ps_user = getUserName($assPage->pageArr[$i]['K_ShareUserId'], $sqlHelper);
		//获取标题
		$ps_title = $assPage->pageArr[$i]['K_ShareTitle'];
		//获取时间
		$ps_time = date('Y-m-d',strtotime($assPage->pageArr[$i]['K_ShareTime']));
		//下载次数
		$ps_down = $assPage->pageArr[$i]['K_ShareDownTimes'];
		//文件简介
		$ps_content = $assPage->pageArr[$i]['K_ShareContent'];
		echo "<div>";
		echo "<div class='title share'><a href='download.php?si=".$assPage->pageArr[$i]['K_ShareId']."' title='".$ps_title."'><b>".$ps_title."</b></a></div>";
		echo "<div class='time share'>".$ps_user." | 发布时间:".$ps_time." | 下载次数:".$ps_down."";
		if(isset($_SESSION['USERID'])){
		if(isset($_GET['n']) || $assPage->pageArr[$i]['K_ShareUserId'] == $_SESSION['USERID']){
			echo " | <a href='n_ps.php?si=".$assPage->pageArr[$i]['K_ShareId']."' title='点击编辑'><img src='Images/note_edit.png' width='22px' height='22px' /><font size='2' color='gray'>编辑</font> </a> | <a href='".$assPage->pageArr[$i]['K_ShareId']."' id='s_delete' title='点击删除'><img src='Images/note_delete.png' width='22px' height='22px' /> <font size='2' color='gray'>删除</font></a>";
		}
		}
		echo "</div>";
		if($ps_content !="" ) {
			echo "<div class='content share'>".utf8Substr($ps_content, 0, 50)."</div>";
		}else {
			echo "<div class='content share'>此文件暂无简介！</div>";
		}
		echo "</div>";
		echo "<hr style='border:0.5px dashed gray' size=0.5></hr>";
	}
	//分页
	echo "<div class='fenye'>";
	echo "<table width='100%'><tr><td align='left'>";
	if($assPage->pageNow==1) {
		if(isset($_GET['n'])){		
			echo "<a class='pageButton button' href='ps_l.php?n=y' style='height:16px;'>首页</a>";
		}else{
			echo "<a class='pageButton button' href='ps_l.php' style='height:16px;'>首页</a>";
		}
	}else{
	if($_GET['n']){		
			echo "<a class='pageButton button' href='ps_l.php?n=y&p=".($assPage->pageNow-1)."' style='height:16px;'>上一页</a>";
		}else{
			echo "<a class='pageButton button' href='ps_l.php?p=".($assPage->pageNow-1)."' style='height:16px;'>上一页</a>";
		}
		
	}
	echo "</td><td align='right'>";
	//这里显示一共多少页，然后有一个自动跳到多少页start
	echo "<font size='3'>{$assPage->pageNow}/{$assPage->pageCount}页　　</font>";
	echo "<input type='number' id='w_page' value='' style='width:30px;' />";
	echo "<a id='sub_s_page' href='#_ff'>跳到指定页</a>　";
	echo "<input type='hidden' class='page_count' value='".$assPage->pageCount."'>";//将总页数隐藏
	if(isset($_GET['n'])){
		echo "<input type='hidden' class='n' value='y'/>";
	}else{
		echo "<input type='hidden' class='n' value='n'/>";
	}
	if($assPage->pageNow < $assPage->pageCount) {
		if($_GET['n']){
			echo "<a class='pageButton button' href='ps_l.php?p=".($assPage->pageNow+1)."&n=y' style='height:16px;'>下一页</a>";
		}else{
			echo "<a class='pageButton button' href='ps_l.php?p=".($assPage->pageNow+1)."' style='height:16px;'>下一页</a>";
		}
	}else{
		echo "<font size='3' color='red'>已经是最后一页喽　</font>";
	}
	echo "</td></tr></table>";
	echo "</div>";
?>
</div>
<div id="fit_body_30_float">
<?php
	//查看是否有人登录， 和是否他已经在左侧在看自己的资料
	if(isset($_SESSION['USERID']) && !isset($_GET['n'])) {
		$sqlHelper = new SqlHelper();
		echo '<div class="main_col">';
		echo '<span class="main_title"><img src="Images/messages_48x48.png" width="25px" height="28px" />　我上传的资料</span>';
		echo '</div>';
		//查询上传过的资料
		$id = $_SESSION['USERID'];
		$sql_my_share = "Select * From t_share Where K_ShareUserId = $id Order By K_ShareTime Limit 0,5";
		$arr_my_share = $sqlHelper->execute_dql2($sql_my_share);
		//查询最近30天内下载量最多的资料
		$sql_hot_share = "Select * From t_share Where datediff(K_ShareTime,now())<30 Order By K_ShareDownTimes desc Limit 0,15";
		$arr_hot_share = $sqlHelper->execute_dql2($sql_hot_share);
		//如果存在该用户上传的资料 显示5条
		echo "<table>";
		if(count($arr_my_share)!=0) {
			for($i=0;$i<count($arr_my_share);$i++) {
				echo "<tr><td width='180px;'><a href='download.php?si=".$arr_my_share[$i]['K_ShareId']."' title='".$arr_my_share[$i]['K_ShareTitle']."'>".utf8Substr($arr_my_share[$i]['K_ShareTitle'], 0, 10)."</a></td><td align='right'><font size='3' >".date('Y-m-d', strtotime($arr_my_share[$i]['K_ShareTime']))."</font></td></tr>";
			}
		}
		//如果不存在该用户上传的资料
		else {
			echo "<tr><td><center><font size='3'>您暂时还没有上传的资料</font></center></td></tr>";
		}
		echo "</table>";
		echo "<br/><center><span class='c_v_span'><a class='button yellow' title='点击上传资料' id='shangchuanziliao' style='width:200px;' href='n_ps.php'>共享资料</a></span></center><br/>";
		echo '<div class="main_col">';
		echo '<span class="main_title"><img src="Images/network_48x48.png" width="25px" height="28px" />　资料下载排行榜</span>';
		echo '</div>';
		echo "<table>";
		if(count($arr_hot_share)!=0) {
			for($j=0;$j<count($arr_hot_share);$j++) {
				echo "<tr><td width='190px;'><a href='download.php?si=".$arr_hot_share[$j]['K_ShareId']."' title='".$arr_hot_share[$j]['K_ShareTitle']."'>".utf8Substr($arr_hot_share[$j]['K_ShareTitle'], 0, 10)."</a></td><td align='right'><font size='3' >下载量:".$arr_hot_share[$j]['K_ShareDownTimes']."</font></td></tr>";
			}
		}else {
			echo "<tr><td>暂时还没有资料!</td></tr>";
		}
		echo "</table>";
	}
	//没有人登录
	else {
		//查询最近30天内下载量最多的资料
		$sqlHelper = new SqlHelper();
		$sql_hot_share = "Select * From t_share Where datediff(K_ShareTime,now())<30 Order By K_ShareDownTimes desc Limit 0,15";
		$arr_hot_share = $sqlHelper->execute_dql2($sql_hot_share);
		echo '<div class="main_col">';
		echo '<span class="main_title"><img src="Images/network_48x48.png" width="25px" height="28px" />　资料下载排行榜</span>';
		echo '</div>';
		echo "<table>";
		if(count($arr_hot_share)!=0) {
			for($j=0;$j<count($arr_hot_share);$j++) {
				echo "<tr><td width='190px;'><a href='download.php?si=".$arr_hot_share[$j]['K_ShareId']."' title='".$arr_hot_share[$j]['K_ShareTitle']."'>".utf8Substr($arr_hot_share[$j]['K_ShareTitle'], 0, 10)."</a></td><td align='right'><font size='3' >下载量:".$arr_hot_share[$j]['K_ShareDownTimes']."</font></td></tr>";
			}
		}else {
			echo "<tr><td>暂时还没有资料!</td></tr>";
		}
		echo "</table>";
	}
?>
</div>
</div>
</body>