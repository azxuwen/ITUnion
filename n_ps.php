<!--创建者 : 徐文志 创建时间 : 2014 02 27 19:41 站点归属 ：IT联盟(哈尔滨理工大学创新实验)  上传新资料-->
<!--引入页头文件start-->
<?php
include 'header.php';
require_once 'Include/ComFunction.php';
//首先检查是否已经登录
if(!isset($_SESSION['USERID'])){
	header('Location:Login.php');
	exit;
}
//刚进入页面的处理end
//接下来要处理的是什么呢，因为想把这一个页面不仅当做添加 还要可以修改 这两种情况的判断就是判断有没有ID，有ID的情况下是修改，否则是添加start
if(isset($_GET['si'])){
	//如果存在ID的情况，那就是修改，要将数据库中原有的内容取出来
	$sql_get_s_i = "Select * from t_share where K_ShareId = {$_GET['si']}";
	$arr_get_s_i = $sqlHelper -> execute_dql2($sql_get_s_i);
	if(count($arr_get_s_i) != 0){
		$s_title = $arr_get_s_i[0]['K_ShareTitle'];//资料标题
		$s_content = $arr_get_s_i[0]['K_ShareContent'];//资料介绍
		$s_cate = $arr_get_s_i[0]['K_ShareCategory'];//资料类别
		//上传的资料无法编辑，只能删除
	}else{
		//如果在数据库中不存在以此为ID的招聘信息，那就not found
		header('Location:notfound.php');
	}
}else{
	//不存在ID，那就是添加，设置一些变量，让他们为空
	$s_title = "";//资料标题
	$s_content = "";//资料介绍
	$s_cate = "";
}
//接下来要处理的是什么呢，因为想把这一个页面不仅当做添加 还要可以修改 这两种情况的判断就是判断有没有ID，有ID的情况下是修改，否则是添加end
?>
<!--引入页头文件end-->
<div id="fit_body_center_90">
<div id="fit_body_70_float">
<?php
if(isset($_GET['r']) && $_GET['r'] == 'y'){
	echo "<div class='error_infor'>";
	echo "<table style='position:relative;top:-20px;' width='100%'>";
	echo "<tr><td valign='top' align='right'><a href='#close' id='clo_infor' title='关闭该信息'><img src='Images/cross_48x48.png' width='17px' height='17px'/></a></td></tr>";
	echo "<tr><td valign='bottom' align='center'>恭喜您，修改成功</td></tr>";
	echo "</table>";
	echo "</div>";
} 
if(isset($_GET['r']) && $_GET['r'] == 'n'){
	echo "<div class='error_infor'>";
	echo "<table style='position:relative;top:-20px;' width='100%'>";
	echo "<tr><td valign='top' align='right'><a href='#close' id='clo_infor' title='关闭该信息'><img src='Images/cross_48x48.png' width='17px' height='17px'/></a></td></tr>";
	echo "<tr><td valign='bottom' align='center'>很抱歉，修改失败，请重试</td></tr>";
	echo "</table>";
	echo "</div>";
}
?>
<form name="s_form" id="s_form" class='kindform' method="post" action="Include/sub_s.php<?php if(isset($_GET['si'])){ echo "?si=".$_GET['si']."&t=u"; }?>" enctype='multipart/form-data'>
<table class="n_pr_form">
<tr><th colspan='4' align="left"><div style='font-size:25px;margin-top:5px;margin-bottom:5px;color:black;font-weight:bolder;'><?php if(!isset($_GET['si'])){echo "发布新资料"; }else{ echo "修改资料";}?></div></th></tr>
<tr><td colspan='2'>&nbsp;</td></tr>
<tr><td>资料标题</td><td><input type="text" name="s_title" id="s_title" placeholder="上传资料标题,限制30字。" value="<?php echo $s_title;?>"/></td></tr>
<tr><td>资料类别</td><td>
<select name='s_cate' class='s_cate'>
<?php
$arr_share_cate = getCategoryInfor(5, $sqlHelper);
if(count($arr_share_cate)!=0){
	for($i = 0 ; $i < count($arr_share_cate); $i++){
		if($s_cate == $arr_share_cate[$i]['CodeId']){
			echo "<option value='".$arr_share_cate[$i]['CodeId']."' selected='selected'>".$arr_share_cate[$i]['CodeName']."</option>";
		}else{
			echo "<option value='".$arr_share_cate[$i]['CodeId']."'>".$arr_share_cate[$i]['CodeName']."</option>";
		}
	}
}else{
		echo "<option value='88888'>暂无分类</option>";
}
?>
</select>
</td></tr>
<?php
if(isset($_GET['si'])){
	echo "<tr><td colspan='2' align='center'><font style='font-size:15px;' color='red'>已经上传的文件暂不支持修改功能，如果您需要修改文件，可以选择重新上传</font></td></tr>";
} else{
	echo "<tr><td>选择资料</td><td><input type='file' name='s_file' id='s_file'  onchange='filesize(this)' value='' placeholder='选择文件'/><br/><font style='margin-left:300px;font-size:15px;' color='gray'>只支持.doc,.xsl,.ppt,.zip.rar,等类型文件,大小限制在10M</font></td></tr>";
	echo "<input type='hidden' class='j_file' value=''/>";//作为判断文件大小是否过大的标志
}
?>
<tr><td>资料简介</td><td><textarea name="content1" id="content1" style="width:700px;height:300px;visibility:hidden;"><?php echo $s_content;?></textarea><font style='margin-left:510px;font-size:15px;' color='gray'>资料简介，限制500字以内</font></td></tr>
<?php 
echo "<tr><td colspan='2' align='center'><span class='sub_s_infor'></span> </td></tr>";
if(!isset($_GET['si'])){
	echo "<input type='hidden' class='j_si' value='88888'/>";
	echo "<tr><td colspan='2' align='center'><input style='width:80px;height:30px;background:rgba(211,211,232,1.0)' type='button' id='s_button' name='s_button' value='提交内容' /></font></td></tr>";
}else{
	echo "<input type='hidden' class='j_si' value='".$_GET['si']."'/>";
	echo "<tr><td colspan='2' align='center'><input style='width:80px;height:30px;background:rgba(211,211,232,1.0)' type='button' id='s_button' name='s_button' value='修改' /></font></td></tr>";
}
?>
</table>
</form>
</div><!-- fit_body_70_float -->

<div id="fit_body_30_float">

</div>
</div><!-- fit_body_center_90 -->
<!--引入页尾文件start-->
<!--引入页尾文件end-->
</body>
</html>
