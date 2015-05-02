<!--创建者 : 徐文志 创建时间 : 2014 03 12    15:27 站点归属 ：IT联盟(哈尔滨理工大学创新实验)   页面功能:用户个人中心 区别在于企业和个人 -->
<?php
include_once 'header.php'; 
//上面配置一些页面的一些信息
require_once 'Include/SqlHelper.class.php';
include_once 'Include/ComFunction.php';
require_once 'Include/config.inc.php';
//检测是否登录
if(!isset($_SESSION['USERID'])){
	header('Location:Login.php');
	exit;
}
//下面获取这个人的相关信息
$sqlHelper = new SqlHelper();
$uid = $_SESSION['USERID'];//当前的ID就为SESSION中的ID
//获取该用户的所有信息
$sql_get_user_head = "Select  * from t_user where K_UserId = {$uid}";
$arr_get_user_head = $sqlHelper -> execute_dql2($sql_get_user_head);
print_r($arr_get_user_head);
$u_truename = $arr_get_user_head[0]['K_UserName'];//用户真实姓名
$u_head = $arr_get_user_head[0]['K_UserHeadAdd'];//头像路径
$u_type = $arr_get_user_head[0]['K_UserType'];//用户类型 企业=>'c' OR 个人=>'p'
$u_lastland = $arr_get_user_head[0]['K_UserLandTime'];//上次登录时间
$u_integer = $arr_get_user_head[0]['K_UserIntegral'];//积分
$u_landtimes = $arr_get_user_head[0]['K_UserLandTimes'];//登录次数
?>
<div id="fit_body_center_90">
<div id="fit_body_30_float">
<?php
//显示头像
echo "<div class='user_head'><img src='".$u_head."' /></div>";
//显示等级
echo "<div class='user_single_line'><span class='info_span'>我的积分 : {$u_integer}</span></div>";
//显示编辑头像链接
echo "<div class='user_single_line'><span class='info_span'><a href='mz.php?i='><font style='font-size:15px;' title='编辑我的头像'>编辑头像 </font></a></span></div>";
echo "<br/>";
echo "<hr width='100%' style='color:white;'/>";
//下面显示具体的菜单
echo "<div class='menu'><img src='Images/user.png' /><a href='mz.php?t=i' title='查看或修改我的资料'>我的资料</a></div>";//我的资料
//我的招聘
if($u_type == 'c'){
	echo "<div class='menu'><img src='Images/user.png' /><a href='mz.php?t=r' title='查看我发布的职位'>我的招聘</a></div>";
}else{
	echo "<div class='menu'><img src='Images/user.png'  /><a href='mz.php?t=r' title='查看我感兴趣的职位'>我的招聘</a></div>";
}
if($u_type =='c'){
	echo "<div class='menu'><img src='Images/user.png'  /><a href='mz.php?t=pp' title='查看我感兴趣的职位'>我的项目</a></div>";
}
if($u_type =='c'){
	echo "<div class='menu'><img src='Images/user.png'  /><a href='mz.php?t=pd' title='查看有关我的产品'>我的产品</a></div>";
}
echo "<div class='menu'><img src='Images/user.png'  /><a href='mz.php?t=d' title='查看我感兴趣的职位'>我的帖子</a></div>";
echo "<div class='menu'><img src='Images/user.png'  /><a href='mz.php?t=s' title='查看我感兴趣的职位'>我的共享</a></div>";
echo "<div class='menu'><img src='Images/user.png'  /><a href='mz.php?t=u' title='查看我感兴趣的职位'>我的联盟</a></div>";
?>
</div><!-- fit_body_30_float  end -->
<div id="fit_body_70_float">
<?php 
//通过链接中的 t 的值来区分显示什么内容

?>
</div>
</div>

</body>
</html>
