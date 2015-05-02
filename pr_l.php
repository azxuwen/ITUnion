<?php
/*创建者 : 徐文志 
 * 创建时间 : 2014 02 15 22:50 
 * 站点归属 ：IT联盟(哈尔滨理工大学创新实验)  
 * 招聘信息的列表展示
 */
require_once 'Include/SqlHelper.class.php';
include_once 'Include/config.inc.php';
require_once 'Include/AssPage.class.php';
require_once 'Include/ComFunction.php';
$sqlHelper = new SqlHelper();
//获取产品信息
$assPage = new AssPage();
//每页显示4个
$assPage->pageSize = 4;
//下面查看是否存在pageNow
if(isset($_GET['p'])){
	$assPage->pageNow = $_GET['p'];
}else{
	$assPage->pageNow = 1;
}
?>

<?php
include 'header.php';



$sqlHelper = new SqlHelper();
/*
 * 这里定义一个变量，来判断该程序到底走了那个 条件
 * 
 */
//如果存在GET['n'], 并且不存在 GET['m'] 那么证明是可能查看自己发布的招聘信息
if(isset($_GET['n']) && !isset($_GET['m'])  && $_SESSION['USERID']) {
	//不将这个作为筛选条件，比如我要查看我发布的招聘信息的话，可能是从个人中心过来的，那么这里就单独建立一个Sql语句来执行查询即可
	$sql_g_r_count = "Select count(K_RecruitId) from t_recruit where K_UserId = {$_SESSION['USERID']}";//构造Sql语句
	$start = ($assPage->pageNow-1)*$assPage->pageSize;//每一页的起始位置
	$end =$assPage->pageSize;
	//将本页的数据提取出来
	$sql_g_r_con = "Select * from t_recruit where K_UserId = {$_SESSION['USERID']} order by K_RecruitId desc  limit $start, $end";
	$sqlHelper->excute_dql_asspage($sql_g_r_count, $sql_g_r_con, $assPage);
	$var_way = "1";
	//在页面body中展示当前登录用法发布的招聘信息
}
//如果存在GET['n'] 和 GET['m']  那就证明是我要看我感兴趣的招聘信息
if(isset($_GET['n']) && isset($_GET['m'])  && $_SESSION['USERID']) {
	$sql_g_r_count = "Select count(t_recruit.K_RecruitId) from t_recruit,t_accept where t_recruit.K_RecruitVisible = 'Y' and  t_accept.K_UserId = {$_SESSION['USERID']} and t_accept.K_RecruitId = t_recruit.K_RecruitId";
	$start = ($assPage->pageNow-1)*$assPage->pageSize;//每一页的起始位置
	$end =$assPage->pageSize;
	$sql_g_r_con = "Select t_recruit.*,t_accept.* from t_recruit,t_accept where  t_recruit.K_RecruitVisible = 'Y' and  t_accept.K_UserId = {$_SESSION['USERID']} and t_accept.K_RecruitId = t_recruit.K_RecruitId order by t_recruit.K_RecruitId desc  limit $start, $end";
	$sqlHelper->excute_dql_asspage($sql_g_r_count, $sql_g_r_con, $assPage);
	$var_way = "2";
}
//查看某个人发布的招聘信息   url格式为  i=Google
if(isset($_GET['i'])){
	$uid = getUserId($_GET['i'], $sqlHelper);//这个GET['i'] 是这个企业的名称   然后通过函数 getUserId  来获取他的ID
	$sql_g_r_count = "Select count(K_RecruitId) from t_recruit where K_UserId = {$uid} and K_RecruitVisible = 'Y'"; 
	$start = ($assPage->pageNow-1)*$assPage->pageSize;//每一页的起始位置
	$end =$assPage->pageSize;
	$sql_g_r_con = "Select * from t_recruit  where K_UserId = {$uid} and K_RecruitVisible = 'Y' order by K_RecruitId desc  limit $start, $end";
	$sqlHelper->excute_dql_asspage($sql_g_r_count, $sql_g_r_con, $assPage);
	$var_way = "3";	
}
if(isset($_GET['t']) && isset($_GET['k'])){
	//如果同时存在行业 和 关键字  那就构造一个同时以 行业 和 关键字为条件执行查询
	$sql_g_r_count = "Select count(K_RecruitId)  from t_recruit where K_RecruitVisible = 'Y' and  K_RecruitTrade = '".$_GET['t']."' and (K_RecruitPosition like '".$_GET['k']."%' or  K_RecruitPosition like '%".$_GET['k']."' or K_RecruitPosition = '".$_GET['k']."') ";
	$start = ($assPage->pageNow-1)*$assPage->pageSize;//每一页的起始位置
	$end =$assPage->pageSize;
	$sql_g_r_con = "Select * from t_recruit where K_RecruitVisible = 'Y' and  K_RecruitTrade = '".$_GET['t']."' and (K_RecruitPosition like '".$_GET['k']."%' or  K_RecruitPosition like '%".$_GET['k']."' or K_RecruitPosition = '".$_GET['k']."') order by K_RecruitId desc limit {$start}, {$end}";
	$sqlHelper->excute_dql_asspage($sql_g_r_count, $sql_g_r_con, $assPage);
	$var_way = "4";
}else if(isset($_GET['t']) && !isset($_GET['k'])){
	//如果只存在行业 不存在关键字
	$sql_g_r_count = "Select count(K_RecruitId)  from t_recruit where K_RecruitVisible = 'Y' and K_RecruitTrade = '".$_GET['t']."'  ";
	$start = ($assPage->pageNow-1)*$assPage->pageSize;//每一页的起始位置
	$end =$assPage->pageSize;
	$sql_g_r_con = "Select * from t_recruit where K_RecruitVisible = 'Y' and  K_RecruitTrade = '".$_GET['t']."' order by K_RecruitId desc limit {$start}, {$end}";
	$sqlHelper->excute_dql_asspage($sql_g_r_count, $sql_g_r_con, $assPage);
	$var_way = "5";
}else if(!isset($_GET['t']) && isset($_GET['k'])){
	//如果只存在关键字 不存在行业
	$sql_g_r_count = "Select count(K_RecruitId)  from t_recruit where K_RecruitVisible = 'Y' and  K_RecruitVisible = 'Y' and   K_RecruitPosition like '".$_GET['k']."%' or  K_RecruitPosition like '%".$_GET['k']."' or K_RecruitPosition = '".$_GET['k']."' ";
	$start = ($assPage->pageNow-1)*$assPage->pageSize;//每一页的起始位置
	$end = $start+$assPage->pageSize;
	$sql_g_r_con = "Select * from t_recruit where K_RecruitVisible = 'Y' and   K_RecruitPosition like '".$_GET['k']."%' or  K_RecruitPosition like '%".$_GET['k']."' or K_RecruitPosition = '".$_GET['k']."' order by K_RecruitId desc limit {$start}, {$end}";
	$sqlHelper->excute_dql_asspage($sql_g_r_count, $sql_g_r_con, $assPage);
	$var_way = "6";
}else if($_SERVER['QUERY_STRING'] == '' || $_SERVER['QUERY_STRING'] == '?' || substr($_SERVER['QUERY_STRING'], 0, 1)  == 'p'){
	//从主页进来，无任何筛选条件
	$sql_g_r_count = "Select count(K_RecruitId)  from t_recruit where K_RecruitVisible = 'Y'  ";
	$start = ($assPage->pageNow-1)*$assPage->pageSize;//每一页的起始位置
	$end =$assPage->pageSize;
	$sql_g_r_con = "Select * from t_recruit where K_RecruitVisible = 'Y' order by K_RecruitId desc limit {$start}, {$end}";	
	$sqlHelper->excute_dql_asspage($sql_g_r_count, $sql_g_r_con, $assPage);
	$var_way = "7";
}
?>
<div id="fit_body_center_90">
<div id="fit_body_70_float">
<?php


//如果是从删除页面回来的，那就要有一个提示信息时删除成功
if(isset($_GET['s']) && $_GET['s'] == 'd'){
	echo "<div class='error_infor'>";
	echo "<table style='position:relative;top:-20px;' width='100%'>";
	echo "<tr><td valign='top' align='right'><a href='#close' id='clo_infor' title='关闭该信息'><img src='Images/cross_48x48.png' width='17px' height='17px'/></a></td></tr>";
	echo "<tr><td valign='bottom' align='center'>恭喜您，删除成功!</td></tr>";
	echo "</table>";
	echo "</div>";
}


/*
 *这里根据var_way的结果来构造分页链接 上一页 下一页
*/
if($var_way == '1'){
	$link_pre_query = "?p=".($assPage->pageNow-1)."&n=y";
	$link_first = "?p=1&n=y";
	$link_next = "?p=".($assPage->pageNow+1)."&n=y";
	$recruit_title = "我的招聘";
}else if($var_way == '2'){
	$link_pre_query = "?p=".($assPage->pageNow-1)."&n=y&m=l";
	$link_first = "?p=1&n=y&m=l";
	$link_next = "?p=".($assPage->pageNow+1)."&n=y&m=l";
	$recruit_title = "我感兴趣的";
}else if($var_way == '3'){
	$link_pre_query = "?p=".($assPage->pageNow-1)."&i=".$_GET['i'];
	$link_first = "?p=1&i=".$_GET['i'];
	$link_next = "?p=".($assPage->pageNow+1)."&i=".$_GET['i'];
	$recruit_title = $_GET[i]."的招聘";
}else if($var_way == '4'){
	$link_pre_query = "?p=".($assPage->pageNow-1)."&t=".$_GET['t']."&k=".$_GET['k'];
	$link_first = "?p=1&t=".$_GET['t']."&k=".$_GET['k'];
	$link_next = "?p=".($assPage->pageNow+1)."&t=".$_GET['t']."&k=".$_GET['k'];
	$recruit_title = "关键字 : {$_GET['k']} |  行业 : ".getGradeName($_GET['t'], $sqlHelper)."";
}else if($var_way == '5'){
	$link_pre_query = "?p=".($assPage->pageNow-1)."&t=".$_GET['t'];
	$link_first = "?p=1&t=".$_GET['t'];
	$link_next = "?p=".($assPage->pageNow+1)."&t=".$_GET['t'];
	$recruit_title = "行业 : ".getGradeName($_GET['t'], $sqlHelper)."";
}else if($var_way == '6'){
	$link_pre_query = "?p=".($assPage->pageNow-1)."&k=".$_GET['k'];
	$link_first = "?p=1&k=".$_GET['k'];
	$link_next = "?p=".($assPage->pageNow+1)."&k=".$_GET['k'];
	$recruit_title = "关键字 : ".$_GET['k']."";
}else if($var_way == '7'){
	$link_pre_query = "?p=".($assPage->pageNow-1)."";
	$link_first = "";
	$link_next = "?p=".($assPage->pageNow+1);
	$recruit_title = "招聘信息列表";
}

$sqlHelper = new SqlHelper();
echo "<div class='recruit_title'>".$recruit_title."</div>";
if(count($assPage->pageArr) != 0){
	for($i=0;$i<count($assPage->pageArr);$i++) {
		//布局
		echo "<table id='chanpinliebiao'>";
		echo "<tr><td colspan='2'><a href='pr_c.php?pi=".$assPage->pageArr[$i]['K_RecruitId']."'><b>".$assPage->pageArr[$i]['K_RecruitTitle']."</a></b></td></tr>";
		echo "<tr><td colspan='2' class='time'>".getUserName($assPage->pageArr[$i]['K_UserId'], $sqlHelper)." | ".date('Y-m-d', strtotime($assPage->pageArr[$i]['K_RecruitTime']))." | ".$assPage->pageArr[$i]['K_RecruitVisitTimes']."次 | ".getGradeName($assPage->pageArr[$i]['K_RecruitTrade'], $sqlHelper)."";
		echo "</td></tr>";
		echo "<tr><td colspan='2' class='content'><font size='4' style='color:red;font-weight:bold;'>招聘职位:</font>".$assPage->pageArr[$i]['K_RecruitPosition']."</td></tr>";
		echo "<tr><td colspan='2' class='content'>".substr($assPage->pageArr[$i]['K_RecruitContent'],0,800)."</td></tr>";
		echo "</table>";
		echo "<hr style='border:0.5px dashed gray' size=0.5></hr>";
	}
	//分页
	echo "<div class='fenye'>";
	
	echo "<table width='100%'><tr><td align='left'>";
	if($assPage->pageNow==1) {		
			echo "<a class='pageButton button' href='pr_l.php".$link_first."' >首页</a>";
	}else{
		echo "<a class='pageButton button' href='pr_l.php".$link_pre_query."'>上一页</a>";
	}
	echo "</td><td align='right'>";
	//这里显示一共多少页，然后有一个自动跳到多少页start
	echo "<font size='3'>{$assPage->pageNow}/{$assPage->pageCount}页　　</font>";
	echo "<input type='number' id='w_page' value='' style='width:30px;' />";
	echo "<a id='sub_r_page' href='#_ff'>跳到指定页</a>　";
	echo "<input type='hidden' class='page_count' value='".$assPage->pageCount."'/>";//将总页数隐藏于表单之中
	//如果存在关键字 将关键字隐藏于表单中
	if(isset($_GET['k'])){
	echo "<input type='hidden' class='keyword' value='".$_GET['k']."'/>";
	}else{
	echo "<input type='hidden' class='keyword' value='88888' />";
	}
	//如果存在行业分类，将行业分类隐藏于表单中
	if(isset($_GET['t'])){
		echo "<input type='hidden' class='trade' value='".$_GET['t']."'/>";
	}else{
		echo "<input type='hidden' class='trade' value='88888' />";
	}
	//这里显示一共多少页，然后有一个自动跳到多少页end
	if($assPage->pageNow < $assPage->pageCount) {
			echo "<a class='pageButton button' href='pr_l.php".$link_next."'>下一页</a>";
	}else{
		echo "<font size='3' color='red'>已经是最后一页喽　</font>";
	}
	echo "</td></tr></table>";
	echo "</div>";
}else{
	echo "抱歉，没有结果。";
}
?>
</div>
<div id="fit_body_30_float">
</div>
</div>
</body>