<!--创建者 : 张健平 创建时间 : 2014 02 28    17:04 站点归属 ：IT联盟(哈尔滨理工大学创新实验)  招聘信息内容显示-->
<?php
require_once 'Include/SqlHelper.class.php';
require_once 'Include/AssPage.class.php';
require_once 'Include/ComFunction.php';
$sqlHelper = new SqlHelper();

//招聘信息内容显示首先获取该招聘信息的id
if(isset($_GET['pi']) && $_GET['pi']!=""){
	$pi = $_GET['pi'];//信息id
	//查询该论坛一共多少帖子
	$sql_num_dis = "Select count(K_DiscuzId) From t_discuz";
	$arr_num_dis = $sqlHelper->execute_dql2($sql_num_dis);
	$discuz_num = $arr_num_dis[0][0];
	//下面从数据库中获取该信息中的内容start
	$sql_get_dis_c = "Select * from t_discuz where K_DiscuzId = $pi";
	$arr_get_dis_c = $sqlHelper -> execute_dql2($sql_get_dis_c);
	if(count($arr_get_dis_c) == 0){
		header('Location:notfound.php');
		exit;
	}
	//将浏览次数加一
	$sql_visittimes = "Update t_discuz set K_DiscuzVisitTimes = K_DiscuzVisitTimes+1 Where K_DiscuzId = $pi";
	$arr_visittimes = $sqlHelper->execute_dql($sql_visittimes);
	//获取帖子的信息
	$dis_title = $arr_get_dis_c[0]['K_DiscuzTitle'];//帖子标题
	$dis_content = $arr_get_dis_c[0]['K_DiscuzContent'];//帖子内容
	$dis_user = getUserName($arr_get_dis_c[0]['K_DiscuzUserId'],$sqlHelper);//帖子发布人
	//帖子发布头像
	$dis_head = getUserHead($arr_get_dis_c[0]['K_DiscuzUserId'],$sqlHelper);
	//帖子类别
	$sql_get_cate = "Select CodeName From t_basecode Where CodeId = ".$arr_get_dis_c[0]['K_DiscuzCategory'];
	$arr_get_cate = $sqlHelper->execute_dql2($sql_get_cate);
	$dis_cate = $arr_get_cate[0][0];
	//帖子发布时间
	$dis_time = $arr_get_dis_c[0]['K_DiscuzTime'];
	//帖子浏览次数
	$dis_visittimes = $arr_get_dis_c[0]['K_DiscuzVisitTimes'];
	
}else{
	header('Location:notfound.php');
	exit;
}
?>
<?php
include 'header.php';
?>
<a name="top"></a>
<div id="fit_body_center_90">
<div id="fit_body_70_float">
<div id="banner">
<table>
<tr><td width="150px" rowspan="2"><a href="pdis_l.php"><img src="Images/talk.jpg" width="100px" height="80px" /></a></td><td valign="top" class="title">IT联盟</td></tr>
<tr><td valign="top" class="time">帖子数:<?php echo $discuz_num;?></td></tr>
</table>
</div>
<hr style='border:0.1px solid gray' ></hr>
<?php
echo "<table id='discuz'>";
echo '<tr><td width="100px"><img src="'.$dis_head.'" width="70px" height="70px"/><br/>'.$dis_user.'</td><td class="discuz_title">'.$dis_title.'</td></tr>';
echo '<tr><td>&nbsp;</td><td class="discuz_content">'.$dis_content.'</td></tr>';
echo '<tr><td colspan="2" class="time" align="right">&nbsp;发表于&nbsp;'.$dis_time.'</td></tr>';
echo '<tr><td colspan="2" class="time" align="right"><span class="cate">['.$dis_cate.']</span></td></tr>';
echo '<tr><td colspan="2" height="20px">&nbsp;</td></tr>';
echo "</table><br/>";
echo "<hr style='color:white;'></hr>";

//查询该帖子的回复
$sqlHelper1 = new SqlHelper();
$sql_all_reply = "Select * From t_discuzreply Where K_ReplyDiscuzId = $pi Order By K_ReplyTime";
$arr_all_reply = $sqlHelper1->execute_dql2($sql_all_reply);
if(count($arr_all_reply)!=0) {
	for($i=0;$i<count($arr_all_reply);$i++) {
		//获取回复人
		$reply_user = getUserName($arr_all_reply[$i]['K_ReplyUserId'],$sqlHelper1);
		//获取回复人头像
		$reply_head = getUserHead($arr_all_reply[$i]['K_ReplyUserId'],$sqlHelper1);
		//获取回复内容
		$reply_content = $arr_all_reply[$i]['K_ReplyContent'];
		//获取回复时间
		$reply_time = $arr_all_reply[$i]['K_ReplyTime'];
		echo '<table id="reply" >';
		echo '<tr><td align="left" width="50px" style="color:gray">'.($i+1).'楼</td><td></td></tr>';
		echo '<tr><td colspan="2" class="time"><img src="'.$reply_head.'" width="50px" height="50px"/><br/>'.$reply_user.'</td></tr>';
		echo '<tr><td></td><td class="discuz_content">'.$reply_content.'</td></tr>';
		echo '<tr><td colspan="2" align="right" class="time">'.$reply_time.'</td></tr>';
		echo '</table>';
	}
}else {
	echo "<br/><br/><center><span class='cate'>该帖子还暂时没有人回复!</span></center><br/><br/>";
}
?>
<?php
	if(isset($_SESSION['USERID'])!="") {
?>
<br/>
<a name="reply">
<form action="Include/sub_d.php?pi=<?php echo $pi;?>" method="post" class='kindform' name="reply">
<textarea name="content1" id="content1" style="width:100%;height:200px;visibility:hidden;"></textarea><br/>
<p align="center"><input style='width:80px;height:30px;background:rgba(211,211,232,1.0)' type='submit' id='s_button' name='reply' value='回复' /></p><br/>
</form>
<?php
	}else {
		echo "<br/><br/><center><span class='cate'><a href='Login.php'>请先登录再评论！</a></span></center><br/><br/>";
	}
?>
</div>
<div id="fit_body_30_float">
<?php
	//查找热门帖子
	$sql_hot_discuz = "Select t_discuz.*,t_discuzreply.* From t_discuz,t_discuzreply Order By count(t_discuzreply.K_ReplyDiscuzId) desc,t_discuzreply.K_ReplyTime desc Limit 0,10";
	$arr_hot_discuz = $sqlHelper1->execute_dql2($sql_hot_discuz);
	if(isset($_SESSION['USERID'])) {
		//查找我发过的帖子
		$sql_my_discuz = "Select * From t_discuz Where K_DiscuzUserId =".$_SESSION['USERID'];
		$arr_my_discuz = $sqlHelper1->execute_dql2($sql_my_discuz);
		
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
<div id="rightBottom" style=" width:50px; height:150px; position:absolute;">
<a href="#reply"><img src="Images/reply.jpg" width="50px" height="50px"/></a><br/>
<a href="fatie.php"><img src="Images/fatie.jpg" width="50px" height="50px"/></a><br/>
<a href="#top"><img src="Images/top.jpg" width="50px" height="50px"/></a>
</div>
<?php
	}
?>
<script type="text/javascript">
window.onscroll= window.onresize = window.onload = function (){
var getDiv = document.getElementById('rightBottom');
var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
getDiv.style.left= document.documentElement.clientWidth - getDiv.offsetWidth-40+'px';
getDiv.style.top = document.documentElement.clientHeight-getDiv.offsetHeight +scrollTop-50 +'px';
}
</script>
</body>