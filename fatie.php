<!--创建者 : 张健平 创建时间 : 2014 03 2 11:18 站点归属 ：IT联盟(哈尔滨理工大学创新实验)  上传新资料-->

<?php
include 'header.php';
require_once 'Include/ComFunction.php';
//首先检查是否已经登录
if(!isset($_SESSION['USERID'])){
	echo '<script> alert("请先登录"); location.replace("Login.php?l=fatie&")</script>';
	exit();
}
//发帖的标题 内容
$dis_title = "";
$dis_content = "";
$dis_cate = "";
?>
<div id="fit_body_center_90">
<div id="fit_body_70_float">
<form name="s_form" id="s_form" class='kindform' method="post" action="Include/sub_d.php" enctype='multipart/form-data'>
<table class="n_pr_form">
<tr><th colspan='4' align="left"><div style='font-size:25px;margin-top:5px;margin-bottom:5px;color:black;font-weight:bolder;'>发布帖子</div></th></tr>
<tr><td colspan='2'>&nbsp;</td></tr>
<tr><td>帖子标题</td><td><input type="text" name="d_title" id="s_title" placeholder="上传资料标题,限制30字。" value=""/></td></tr>
<tr><td>帖子类别</td><td>
<select name='d_cate' class='s_cate'>
<?php
$arr_dis_cate = getCategoryInfor(5, $sqlHelper);
if(count($arr_dis_cate)!=0){
	for($i = 0 ; $i < count($arr_dis_cate); $i++){
		if($dis_cate == $arr_dis_cate[$i]['CodeId']){
			echo "<option value='".$arr_dis_cate[$i]['CodeId']."' selected='selected'>".$arr_dis_cate[$i]['CodeName']."</option>";
		}else{
			echo "<option value='".$arr_dis_cate[$i]['CodeId']."'>".$arr_dis_cate[$i]['CodeName']."</option>";
		}
	}
}else{
		echo "<option value='88888'>暂无分类</option>";
}
?>
</select>
</td></tr>
<tr><td>帖子内容</td><td><textarea name="content1" id="content1" style="width:700px;height:300px;visibility:hidden;"></textarea><font style='margin-left:510px;font-size:15px;' color='gray'></font></td></tr>
<tr><td colspan='2' align='center'><input style='width:80px;height:30px;background:rgba(211,211,232,1.0)' type='submit' id='s_button' name='s_button' value='发布帖子' /></td></tr>
</table>
</form>
</div>
<div id="fit_body_30_float">

</div>
</div>
</body>