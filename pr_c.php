<!--创建者 : 张健平 创建时间 : 2014 02 13    11:07 站点归属 ：IT联盟(哈尔滨理工大学创新实验)  招聘信息内容显示-->
<?php
require_once 'Include/SqlHelper.class.php';
require_once 'Include/ComFunction.php';
require_once 'Include/config.inc.php';
$sqlHelper = new SqlHelper();
//招聘信息内容显示首先获取该招聘信息的id
if(isset($_GET['pi']) && $_GET['pi']!=""){
	$pi = $_GET['pi'];//信息id
	//下面从数据库中获取该信息中的内容start
	$sql_get_pr_c = "Select * from t_recruit where K_RecruitId = $pi";
	$arr_get_pr_c = $sqlHelper -> execute_dql2($sql_get_pr_c);
	if(count($arr_get_pr_c) == 0){
		header('Location:notfound.php');
		exit;
	}
	//将浏览量+1
	$sql_add_view_times = "Update t_recruit set K_RecruitVisitTimes = K_RecruitVisitTimes+1 where K_RecruitId = $pi";
	$sqlHelper->execute_dql($sql_add_view_times);
	$pr_title = $arr_get_pr_c[0]['K_RecruitTitle'];//信息名称
	$pr_content = $arr_get_pr_c[0]['K_RecruitContent'];//信息内容
	$pr_user = $arr_get_pr_c[0]['K_UserId'];
	//获取发布者
	$pr_user = getUserName($pr_user, $sqlHelper);
	$pr_time = date('Y-m-d', strtotime($arr_get_pr_c[0]['K_RecruitTime']));
	$pr_trades = $arr_get_pr_c[0]['K_RecruitTrade'];//信息涉及到的行业代码 现在是个字符串，如果是多个是通过 逗号 隔开的
	$pr_arr_trades = explodeToArr($pr_trades, ',');//存有涉及到行业代码的数组
	//行业类别获取
	$sql_trades = "Select K_TradeName From t_trade Where K_TradeId = $pr_trades";
	$arr_trades = $sqlHelper->execute_dql2($sql_trades);
	$pr_trades = $arr_trades[0]['K_TradeName'];
	$pr_salary = $arr_get_pr_c[0]['K_RecruitSalary'];//信息的薪资，从basecode中获取
	//查询薪资
	$sql_salary = "Select CodeName From t_basecode Where CodeId = $pr_salary";
	$arr_salary = $sqlHelper->execute_dql2($sql_salary);
	$pr_salary = $arr_salary[0]['CodeName'];
	$pr_degree = $arr_get_pr_c[0]['K_RecruitDegree'];//要求的学历，从basecode中获取
	//学历获取
	$sql_degree = "Select CodeName From t_basecode Where CodeId = $pr_degree";
	$arr_degree = $sqlHelper->execute_dql2($sql_degree);
	$pr_degree = $arr_degree[0]['CodeName'];
	$pr_visittime = $arr_get_pr_c[0]['K_RecruitVisitTimes'];//信息的浏览次数
	$pr_position = $arr_get_pr_c[0]['K_RecruitPosition'];//招聘的岗位
	$pr_location = $arr_get_pr_c[0]['K_RecruitLocation'];//工作地点
	$pr_location = str_replace('&', '<br/>', $pr_location);
	$pr_viewtimes = $arr_get_pr_c[0]['K_RecruitVisitTimes'];//浏览量
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
	
	if(isset($_GET['err']) && $_GET['err'] == 'd'){
		echo "<div class='error_infor'>";
		echo "<table style='position:relative;top:-20px;' width='100%'>";
		echo "<tr><td valign='top' align='right'><a href='#close' id='clo_infor' title='关闭该信息'><img src='Images/cross_48x48.png' width='17px' height='17px'/></a></td></tr>";
		echo "<tr><td valign='bottom' align='center'>很抱歉，删除失败，请重试!</td></tr>";
		echo "</table>";
		echo "</div>";
	}
	if(isset($_GET['err']) && $_GET['err'] == 'u'){
		echo "<div class='error_infor'>";
		echo "<table style='position:relative;top:-20px;' width='100%'>";
		echo "<tr><td valign='top' align='right'><a href='#close' id='clo_infor' title='关闭该信息'><img src='Images/cross_48x48.png' width='17px' height='17px'/></a></td></tr>";
		echo "<tr><td valign='bottom' align='center'>很抱歉，修改失败，请重试!</td></tr>";
		echo "</table>";
		echo "</div>";
	}
	if(isset($_GET['cor']) && $_GET['cor'] == 'u'){
		echo "<div class='error_infor'>";
		echo "<table style='position:relative;top:-20px;' width='100%'>";
		echo "<tr><td valign='top' align='right'><a href='#close' id='clo_infor' title='关闭该信息'><img src='Images/cross_48x48.png' width='17px' height='17px'/></a></td></tr>";
		echo "<tr><td valign='bottom' align='center'>恭喜您，修改成功!</td></tr>";
		echo "</table>";
		echo "</div>";
	}
	echo "<div class='center_title'>{$pr_title}</div>";//项目名称
	echo "<div class='time_vtimes'>{$pr_user} | {$pr_time} | {$pr_viewtimes}次";
	//这里如果本人登录的话，那就显示 编辑这个链接
	if(isset($_SESSION['USERID']) && $_SESSION['USERID'] == $arr_get_pr_c[0]['K_UserId']){
		echo " | <a href='n_pr.php?ri=".$pi."&t=u'><img src='Images/note_edit.png' width='20px' height='20px' /><font color='black' size='2.5'>编辑</font></a>";
		//当点击删除时候，会弹出一个窗体询问是否真的彻底删除
		//这里将现在这个招聘信息的 ID隐藏在表单中
		echo "<input type='hidden' class='r_id' value=".$pi.">";
		echo " | <a href='' id='r_delete'><img src='Images/note_delete.png' width='20px' height='20px' /><font color='black' size='2.5'>删除</font></a>";
	}
	echo "</div>";//项目负责人 添加人 和添加时间
	//职位信息start	
	echo "<table id='zhiweixinxi'>";
	echo "<th colspan='3'><span style='font-size:23px;color:black;font-weight:bolder;'>职位信息</span></th>";
	echo "<tr><td style='font-size:18px;background:rgba(211,211,232,0.50);' width='80px'>招聘职位</td><td width='150px'>".$pr_position."</td><td style='font-size:18px;background:rgba(211,211,232,0.50);' width='80px'>工作地点</td><td width='150px'>".$pr_location."</td><td style='font-size:18px;background:rgba(211,211,232,0.50);' width='80px'>要求学历</td><td width='150px'>".$pr_degree."</td></tr>";
	echo "<tr><td style='font-size:18px;background:rgba(211,211,232,0.50);' width='80px'>发布时间</td><td width='150px'>".$pr_time."</td><td style='font-size:18px;background:rgba(211,211,232,0.50);' width='80px'>薪资情况</td><td width='150px'>".$pr_salary."</td><td style='font-size:18px;background:rgba(211,211,232,0.50);' width='80px'>行业类别</td><td width='150px'>".$pr_trades."</td></tr>";
	echo "</table><br/>";
	//职位信息end	
	//职位描述start
	echo "<table id='zhaopinneirong'>";
	echo "<th colspan='3' align='left'><span style='font-size:23px;color:black;font-weight:bolder;'>职位描述</span></th>";
	echo "<tr><td><hr width='100%' style='color:white;'/></td></tr>";
	echo "<tr><td>$pr_content<td></tr>";
	echo "</table><br/>";
	//职位描述end
	
	echo "<br/><br/><br/><hr width='100%'  style='color:white;'/><br/><br/>";
	
	//下面展示发布招聘信息的企业的简介start
	$user_introduce = getUserIntro($arr_get_pr_c[0]['K_UserId'], $sqlHelper);
	echo "<table id='zhiweixinxi'>";
	echo "<th colspan='3'><span style='font-size:23px;color:black;font-weight:bolder;'>{$pr_user}简介</span></th>";
	if(getUserHead($arr_get_pr_c[0]['K_UserId'], $sqlHelper) != ""){
		echo "<tr><td align='center'><a href='mz.php?i=".$arr_get_pr_c[0]['K_UserId']."' title='点击进入".getUserName($arr_get_pr_c[0]['K_UserId'], $sqlHelper)."主页'><img src='".getUserHead($arr_get_pr_c[0]['K_UserId'], $sqlHelper)."' width='250px' height='120px'/></a></td></tr>";
	}
	echo "<tr><td>{$user_introduce}</td></tr>";
	echo "</table>";
	//下面展示发布招聘信息的企业的简介end
	echo "</div>";
?>
</div>
<div id="fit_body_30_float"><!-- 最外第二层右侧div  样式为 宽度30% 高度不限制  向左浮动-->
<div class="main_col">
	<span class="main_title"><img src="Images/messages_48x48.png" width="25px" height="28px" />　招聘互动</span>
</div><!--main_col-->
<?php
//这里显示关于该条招聘信息的信息，例如有多少人感兴趣，然后点击感兴趣之类的start
//首先判断用户有没有登录
if(isset($_SESSION['USERID'])){
	//当有用户登录时,这里还要区分，是发布该条招聘信息的人登录的，还是其他人登录
	if($_SESSION['USERID'] == $arr_get_pr_c[0]['K_UserId']){
		//发布该条信息的人登录
		//招聘互动start
		//查询有多少人对这条信息感兴趣
		$sql_accept = "Select K_RecruitId From t_accept Where K_RecruitId = $pi";
		$arr_accept = mysql_query($sql_accept);
		$pr_accept = mysql_num_rows($arr_accept);
		echo "<br/><center><font style='color:black;font-size:15px;'>已经有<span class='like_count'><a href='r_ac.php?ri=".$pi."&c=".$pr_accept."' title='查看感兴趣的人'> {$pr_accept} </a></span>人对该职位感兴趣</font></center>";
		echo "<br/>";
		//这里列出三个感兴趣的人
		if($pr_accept > 0){
			$sql_get_like_u = "Select K_UserId from t_accept where K_RecruitId = {$pi} limit 0, 4";
			$arr_get_like_u = $sqlHelper -> execute_dql2($sql_get_like_u);
			for($i = 0; $i < count($arr_get_like_u); $i ++){
				if(getUserHead($arr_get_like_u[$i]['K_UserId'], $sqlHelper) != ""){
					echo "<a href='mz.php?id=".$arr_get_like_u[$i]['K_UserId']."' title='".getUserName($arr_get_like_u[$i]['K_UserId'], $sqlHelper)."'><img style='margin:5px;' width='50px' height='50px' src='".getUserHead($arr_get_like_u[$i]['K_UserId'], $sqlHelper)."'/></a>";
				}else{
					echo "<a href='mz.php?id=".$arr_get_like_u[$i]['K_UserId']."' title='".getUserName($arr_get_like_u[$i]['K_UserId'], $sqlHelper)."'><img style='margin:5px;' width='50px' height='50px' src='Upload/Images/default_u.jpg'/></a>";
				}
			}
			echo "<div style='width:50px;height:100px;display:inline;position:relative;left:20px;top:-25px;'><a href='r_ac.php?ri=".$pi."&c=".$pr_accept."' title='处理此信息'><font size='4' color='black' style='font-weight:bolder;'>・・・</font></a></div>";
		}
		//这里显示控制该条招聘信息是否可见
		echo "<br/>";
		echo $arr_get_pr_c[0]['K_RecruitVisible']=='Y'?'<font size="2" class="n_status">　公开可见</font>':'<font size="2" class="n_status">　仅自己可见</font>'."";
		echo "<br/><br/>";
		echo "<input type='hidden' class='pr_id' value='".$pi."'/>";//隐藏招聘信息 ID 
		if($arr_get_pr_c[0]['K_RecruitVisible'] == 'Y'){
			echo "<center><span class='c_v_span'><a class='button blue1' title='点击改变该招聘信息是否显示' id='cha_visible' style='width:220px;' href='#v_on'>仅自己可见</a></span></center>";
		}else{
			echo "<center><span class='c_v_span'><a class='button blue1' title='点击改变该招聘信息是否显示' id='cha_visible' style='width:220px;' href='#v_off'>公开可见</a></span></center>";
		}
		//招聘互动end	
		
		//该公司的其他招聘start
		//这里显示该公司的其他招聘信息
		echo "<br/>";
		echo "<div class='main_col'>";
		echo "<span class='main_title'><img src='Images/messages_48x48.png' width='25px' height='28px' />　我的其他招聘</span>";
		echo "<a href='pr_l.php?n=y' style='margin-left:120px;'><font size='4' style='font-weight:bolder;'>・・・</font></a>";
		echo "</div>";
		$sql_get_company_other_recruit = "Select K_RecruitId, K_RecruitTitle from t_recruit where K_RecruitId != {$pi} and K_UserId = {$arr_get_pr_c[0]['K_UserId']} and K_RecruitVisible = 'Y' order by K_RecruitId desc limit 0, 10;";
		$arr_get_company_other_recruit = $sqlHelper->execute_dql2($sql_get_company_other_recruit);
		if(count($arr_get_company_other_recruit)!= 0){
			for($i = 0; $i < count($arr_get_company_other_recruit); $i++){
				echo "<div id='project'><a href='pr_c.php?pi=".$arr_get_company_other_recruit[$i]['K_RecruitId']."' title='".$arr_get_company_other_recruit[$i]['K_RecruitTitle']."'>".utf8Substr($arr_get_company_other_recruit[$i]['K_RecruitTitle'], 0, 21)."</a></div>";
			}
		}else{
			echo "<div id='project'><font size='2'>您暂无其他招聘</font></div>";
		}
		echo "<br/><br/>";
		if(judgeUserType($_SESSION['USERID'], $sqlHelper) == 'c'){
			echo "<center><a class='button blue1' style='width:220px;' href='n_pr.php'>发布新职位</a></center>";//发布新职位
		}
		//该公司的其他招聘end
		//最新的招聘信息start
		//展示最近的10个招聘信息
		$sql_get_recent_recruit = "Select K_RecruitId, K_RecruitTitle from t_recruit where K_RecruitId != {$pi} and K_RecruitVisible = 'Y' order by K_RecruitId desc limit 0, 10";
		$arr_get_recent_recruit = $sqlHelper -> execute_dql2($sql_get_recent_recruit);
		if(count($arr_get_recent_recruit) != 0){
			echo "<br/><div class='main_col'>";
			echo "<span class='main_title'><img src='Images/clock_48x48.png' width='25px' height='28px' />　最新招聘</span>";
			echo "<a href='pr_l.php' style='margin-left:150px;'><font size='4' style='font-weight:bolder;'>・・・</font></a>";
			echo "</div>";
			for($i = 0 ; $i < count($arr_get_recent_recruit); $i++){
				echo "<div id='project'><a href='pr_c.php?pi=".$arr_get_recent_recruit[$i]['K_RecruitId']."' title='".$arr_get_recent_recruit[$i]['K_RecruitTitle']."'>".utf8Substr($arr_get_recent_recruit[$i]['K_RecruitTitle'], 0, 21)."</a></div>";
			}
		}
		//最新的招聘信息end
	}else{
		//不是发布该条信息的人登录
		//查询有多少人对这条信息感兴趣
		$sql_accept = "Select K_RecruitId From t_accept Where K_RecruitId = $pi";
		$arr_accept = mysql_query($sql_accept);
		$pr_accept = mysql_num_rows($arr_accept);
		echo "<center><font style='color:black;font-size:15px;'>已经有<span class='like_count'> {$pr_accept} </span>人对该职位感兴趣</font></center>";
		echo "<br/>";
		//这里判断到底这个用户关没关注这条招聘信息，如果关注了，就不显示 点击感兴趣这些东西了start
		//首先需要判断这个用户之前有没有对该招聘信息感兴趣，如果已经感兴趣了，就提示一下
		$sql_judge_j_r = "Select count(K_AcceptId) from t_accept where K_RecruitId = {$pi} and K_UserId = {$_SESSION['USERID']}";
		$arr_judge_j_r = $sqlHelper -> execute_dql2($sql_judge_j_r);
		if($arr_judge_j_r[0][0] == 0){
		//这里判断到底这个用户关没关注这条招聘信息，如果关注了，就不显示 点击感兴趣这些东西了end
		echo "<center><a class='button blue1' id='j_pr' style='width:220px;' href='#j_recruit'>点击感兴趣</a></center>";//现在加入，这里做成JS+Ajax实现
		echo "<div class='accecpt_insert' style='display:none;'>";
		echo "<br/><center><textarea style='width:240px;height:100px;overflow:hidden;' placeholder='填写您相对HR说的话,限制500字。' id='accept_content'/></textarea></center>";
		echo "<span class='accept_insert_count_s'><font size='2'>已经输入了<span class='accept_insert_count'>0</span>个字。</font></span>";
		echo "<center><span class='j_pr_infor'></span></center>";
		echo "<center><a class='button blue1' id='j_pr_on' href='#j_recruit'>提交</a><a class='button blue1' id='j_pr_off' href='#j_r_off'>取消</a></center>";
		echo "</div>";
		echo "<input type='hidden' class='pr_id' value='".$pi."'/>";//隐藏招聘信息 ID ，便于在对招聘信息感兴趣时获取
		}else{
			//这里还要判断，如果发布招聘的这个人已经处理完了，那么这里要显示，发布者已经处理了你的应聘请求，请注意交流
			//如果没有处理，则要显示，请等候处理
			$sql_get_a_s = "Select K_AcceptStatus from t_accept where K_RecruitId = {$_GET['pi']} and K_UserId = {$_SESSION['USERID']}";
			$arr_get_a_s = $sqlHelper -> execute_dql2($sql_get_a_s);
			if(count($arr_get_a_s) != 0){
				if($arr_get_a_s[0]['K_AcceptStatus'] == '53'){
					echo "<center><img src='Images/like_48x48.png' width='30px' height='30px'/><font size='2' color='red'>您已经关注了该职位，请等候处理</font></center>";
				}else{
					echo "<center><font size='2' color='red'>职位发布者已经处理了您的应聘请求，请注意交流</font></center>";
				}
			}
			
		}
		echo "<br/>";
		echo "<div class='main_col'>";
		echo "<span class='main_title'><img src='Images/messages_48x48.png' width='25px' height='28px' />　".utf8Substr($pr_user, 0,10)."的其他招聘</span>";
		echo "</div>";
		//这里显示该公司的其他招聘信息
		$sql_get_company_other_recruit = "Select K_RecruitId, K_RecruitTitle from t_recruit where K_RecruitId != {$pi} and K_UserId = {$arr_get_pr_c[0]['K_UserId']} and K_RecruitVisible = 'Y' order by K_RecruitId desc limit 0, 10;";
		$arr_get_company_other_recruit = $sqlHelper->execute_dql2($sql_get_company_other_recruit);
		if(count($arr_get_company_other_recruit)!= 0){
			for($i = 0; $i < count($arr_get_company_other_recruit); $i++){
				echo "<div id='project'><a href='pr_c.php?pi=".$arr_get_company_other_recruit[$i]['K_RecruitId']."' title='".$arr_get_company_other_recruit[$i]['K_RecruitTitle']."'>".utf8Substr($arr_get_company_other_recruit[$i]['K_RecruitTitle'], 0, 21)."</a></div>";
			}
		}else{
			echo "<div id='project'><font size='2'>暂无该公司的其他招聘</font></div>";
		}
		
		echo "<br/><br/>";
		//展示最近的10个招聘信息
		$sql_get_recent_recruit = "Select K_RecruitId, K_RecruitTitle from t_recruit where K_RecruitId != {$pi} and K_RecruitVisible = 'Y' order by K_RecruitId desc limit 0, 10";
		$arr_get_recent_recruit = $sqlHelper -> execute_dql2($sql_get_recent_recruit);
		if(count($arr_get_recent_recruit) != 0){
			echo "<br/><br/><div class='main_col'>";
			echo "<span class='main_title'><img src='Images/clock_48x48.png' width='25px' height='28px' />　最新招聘</span>";
			echo "</div>";
			for($i = 0 ; $i < count($arr_get_recent_recruit); $i++){
				echo "<div id='project'><a href='pr_c.php?pi=".$arr_get_recent_recruit[$i]['K_RecruitId']."' title='".$arr_get_recent_recruit[$i]['K_RecruitTitle']."'>".utf8Substr($arr_get_recent_recruit[$i]['K_RecruitTitle'], 0, 21)."</a></div>";
			}
		}
		//这里显示我的其他招聘，并且还要带有 ，发布新招聘信息的链接start
		echo "<br/><br/>";
		if(judgeUserType($_SESSION['USERID'], $sqlHelper) == 'c'){
			//只有是企业用户的时候才展示我的其他招聘
			$sql_get_my_other_recruit = "Select K_RecruitId, K_RecruitTitle from t_recruit where K_RecruitId != {$pi} and K_RecruitVisible = 'Y' and K_UserId = $_SESSION[USERID] order by K_RecruitId desc limit 0, 10";
			$arr_get_my_other_recruit = $sqlHelper -> execute_dql2($sql_get_my_other_recruit);
			if(count($arr_get_my_other_recruit) != 0){
				echo "<br/><br/><div class='main_col'>";
				echo "<span class='main_title'><img src='Images/tag-2_48x48.png' width='25px' height='28px' />　我的其他招聘</span>";
				echo "</div>";
				for($i = 0 ; $i < count($arr_get_my_other_recruit); $i++){
					echo "<div id='project'><a href='pr_c.php?pi=".$arr_get_my_other_recruit[$i]['K_RecruitId']."' title='".$arr_get_my_other_recruit[$i]['K_RecruitTitle']."'>".utf8Substr($arr_get_my_other_recruit[$i]['K_RecruitTitle'], 0, 21)."</a></div>";
				}
			}else{
				echo "<br/><br/><div class='main_col'>";
				echo "<span class='main_title'><img src='Images/tag-2_48x48.png' width='25px' height='28px' />　我的其他招聘</span>";
				echo "</div>";
				echo "<div id='project'><font size='2'>您暂无其他招聘</font></div>";
			}
			if(judgeUserType($_SESSION['USERID'], $sqlHelper) == 'c'){
				echo "<center><a class='button blue1' style='width:220px;' href='n_pr.php'>发布新职位</a></center>";//发布新职位
			}
		}
		//这里显示我的其他招聘，并且还要带有 ，发布新招聘信息的链接end
	}
}else{
	//当没有用户登录时，显示有多少人感兴趣，和登录对它感兴趣start
	//查询有多少人对这条信息感兴趣
	$sql_accept = "Select K_RecruitId From t_accept Where K_RecruitId = $pi";
	$arr_accept = mysql_query($sql_accept);
	$pr_accept = mysql_num_rows($arr_accept);
	echo "<br/><center>已经有 {$pr_accept} 人对该职位感兴趣</center>";
	echo "<br/><center><font size='2'>如果您对该职位感兴趣的话，点击上方的登录感兴趣吧!</font></center>";

//这里显示关于该条招聘信息的信息，例如有多少人感兴趣，然后点击感兴趣之类的end 
?>


<br/><br/>
<div class="main_col">
	<span class="main_title"><img src="Images/messages_48x48.png" width="25px" height="28px" />　该公司的其他招聘</span>
</div><!--main_col-->
<?php
	//这里显示该公司的其他招聘信息
	$sql_get_company_other_recruit = "Select K_RecruitId, K_RecruitTitle from t_recruit where K_RecruitId != {$pi} and K_UserId = {$arr_get_pr_c[0]['K_UserId']} and K_RecruitVisible = 'Y' order by K_RecruitId desc limit 0, 10;";
	$arr_get_company_other_recruit = $sqlHelper->execute_dql2($sql_get_company_other_recruit);
	if(count($arr_get_company_other_recruit)!= 0){
		for($i = 0; $i < count($arr_get_company_other_recruit); $i++){
			echo "<div id='project'><a href='pr_c.php?pi=".$arr_get_company_other_recruit[$i]['K_RecruitId']."' title='".$arr_get_company_other_recruit[$i]['K_RecruitTitle']."'>".utf8Substr($arr_get_company_other_recruit[$i]['K_RecruitTitle'], 0, 21)."</a></div>";
		}
	}else{
		echo "<div id='project'><font size='2'>暂无该公司的其他招聘</font></div>";
	}
?>
<br/><br/>
<?php
	//展示最近的10个招聘信息
	$sql_get_recent_recruit = "Select K_RecruitId, K_RecruitTitle from t_recruit where K_RecruitId != {$pi} and K_RecruitVisible = 'Y' order by K_RecruitId desc limit 0, 10";
	$arr_get_recent_recruit = $sqlHelper -> execute_dql2($sql_get_recent_recruit);
	if(count($arr_get_recent_recruit) != 0){
		echo "<br/><br/><div class='main_col'>";
		echo "<span class='main_title'><img src='Images/clock_48x48.png' width='25px' height='28px' />　最新招聘</span>";
		echo "</div>";
		for($i = 0 ; $i < count($arr_get_recent_recruit); $i++){
			echo "<div id='project'><a href='pr_c.php?pi=".$arr_get_recent_recruit[$i]['K_RecruitId']."' title='".$arr_get_recent_recruit[$i]['K_RecruitTitle']."'>".utf8Substr($arr_get_recent_recruit[$i]['K_RecruitTitle'], 0, 21)."</a></div>";
		}
	}
}//else 当没有用户登录时，显示有多少人感兴趣，和登录对它感兴趣end
?>
</div><!-- fit_body_30_float -->
</div><!-- fit_body_center_90 -->
</body>
</html>