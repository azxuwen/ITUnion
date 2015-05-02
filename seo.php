<!--创建者 : 徐文志 创建时间 : 2014 03 02    12:36 站点归属 ：IT联盟(哈尔滨理工大学创新实验)   页面功能:SEO搜索结果 -->
<?php
require_once 'Include/config.inc.php'; 
?>
<!--引入页头文件start-->
<?php
include 'header.php';
require_once 'Include/ComFunction.php';
require_once 'Include/SqlHelper.class.php';
if(!isset($_GET['k'])){
	header("Location:notfound.php");//如果不存在关键字跳转到notfound.php
	exit;
}else{
	if($_GET['k'] == ""){
		//如果关键字为空，那么直接就会显示无搜索结果，也不到数据库中搜索
	}else{
		//当关键字不为空时，这时候就需要到数据库中搜索
		/*这里的搜索的方式，我是这么想的，我想对每一个表都进行搜索，得到不同的数组，然后将数组组合到一起
		 */
		$sql_g_n_seo = "Select K_NewsId, K_NewsTitle, K_NewsContent from t_news where  locate('".$_GET['k']."', K_NewsTitle)<>0 or locate('".$_GET['k']."', K_NewsContent)<>0";
		$arr_g_n_seo =  $sqlHelper ->execute_dql2($sql_g_n_seo);//新闻搜索结果 二维数组
		$sql_g_p_seo = "Select K_ProductId, K_ProductTitle, K_ProductContent from t_product where  locate('".$_GET['k']."', K_ProductTitle)<>0 or locate('".$_GET['k']."', K_ProductContent)<>0";
		$arr_g_p_seo = $sqlHelper -> execute_dql2($sql_g_p_seo);//产品搜索结果  二维数组
		$sql_g_d_seo = "Select K_DiscuzId, K_DiscuzTitle, K_DiscuzContent from t_discuz where  locate('".$_GET['k']."', K_DiscuzTitle)<>0 or locate('".$_GET['k']."', K_DiscuzContent)<>0";
		$arr_g_d_seo = $sqlHelper -> execute_dql2($sql_g_d_seo);//论坛结果  二维数组
		$sql_g_s_seo = "Select K_ShareId, K_ShareTitle, K_ShareContent from t_share where  locate('".$_GET['k']."', K_ShareTitle)<>0 or locate('".$_GET['k']."', K_ShareContent)<>0";
		$arr_g_s_seo = $sqlHelper -> execute_dql2($sql_g_s_seo);//知识共享结果  二维数组
		$sql_g_r_seo = "Select K_RecruitId, K_RecruitTitle, K_RecruitContent from t_recruit where  locate('".$_GET['k']."', K_RecruitTitle)<>0 or locate('".$_GET['k']."', K_RecruitContent)<>0";
		$arr_g_r_seo = $sqlHelper -> execute_dql2($sql_g_r_seo);//招聘信息结果  二维数组
		$sql_g_i_seo = "Select K_UnionId, K_UnionName, K_UnionIntroduce from t_union where  locate('".$_GET['k']."', K_UnionName)<>0 or locate('".$_GET['k']."', K_UnionIntroduce)<>0";
		$arr_g_i_seo = $sqlHelper -> execute_dql2($sql_g_i_seo);//联盟结果  二维数组
		$sql_g_pp_seo = "Select K_ProjectId, K_ProjectName, K_ProjectContent from t_project where  locate('".$_GET['k']."', K_ProjectName)<>0 or locate('".$_GET['k']."', K_ProjectContent)<>0";
		$arr_g_pp_seo = $sqlHelper -> execute_dql2($sql_g_pp_seo);//项目信息结果  二维数组
		//下面组合这些数组
		$arr_all_seo = array_merge($arr_g_d_seo, $arr_g_i_seo, $arr_g_n_seo, $arr_g_p_seo, $arr_g_pp_seo, $arr_g_r_seo, $arr_g_s_seo);
		//随机打乱数组
		shuffle($arr_all_seo);
	}
}
?>
<div id="fit_body_center_90"><!-- 最外层的div  样式为 居中 宽度 90% 高度不限制 -->
<div id="fit_body_70_float"><!-- 最外第二层左侧div  样式为 宽度70% 高度不限制  向左浮动-->
<div id="seo_div">
        	　<input type="search" class="keyword" name="seo_key" value='<?php if(isset($_GET['k'])){echo $_GET['k']; }?>' placeholder="填写要搜索的内容"/>  <input type="button" class="button gray" id="seo_button" value="搜索"/>
　　　　<span style="font-size:0.8em;"><font size="15px">搜</font></span>
</div><!-- seo_div -->
<?php
//添加搜索结果start
if(count($arr_all_seo) != 0){
	for($i = 0 ; $i < count($arr_all_seo); $i ++){
		$keys = array_keys($arr_all_seo[$i]);//每一行中的数组的所有键值，是个数组，需要识别出第二个键值的值
		$second_key = $keys[1];
		echo "<table id='seo'>";
		switch($second_key){
			case 'K_ProductId':
				echo "<tr><td colspan='2'><a href='pd_c.php?pi=".$arr_all_seo[$i]['K_ProductId']."' target='_blank' title='".$arr_all_seo[$i]['K_ProductTitle']."'><b>".$arr_all_seo[$i]['K_ProductTitle']."</b></a></td></tr>";
				if(preg_match ( '/<img /i' , utf8Substr($arr_all_seo[$i]['K_ProductContent'],0, 50)  )){
					echo "<tr><td colspan='2' class='content'>".$arr_all_seo[$i]['K_ProductTitle']."</td></tr>";
				}else{
					echo "<tr><td colspan='2' class='content'>".utf8Substr($arr_all_seo[$i]['K_ProductContent'],0, 50)."</td></tr>";
				}
				echo "<tr><td colspan='2' align='left'><font color='green' size='2'>pd_c.php?pi=".$arr_all_seo[$i]['K_ProductId']."</font></td></tr>";
				break;
			case 'K_UnionId':
				echo "<tr><td colspan='2'><a href='my.php?pi=".$arr_all_seo[$i]['K_UnionId']."' target='_blank'  title='".$arr_all_seo[$i]['K_UnionName']."'><b>".$arr_all_seo[$i]['K_UnionName']."</b></a></td></tr>";
				if(preg_match ( '/<img /i' , utf8Substr($arr_all_seo[$i]['K_UnionIntroduce'],0, 50)  )){
					echo "<tr><td colspan='2' class='content'>".$arr_all_seo[$i]['K_UnionName']."</td></tr>";
				}else{
					echo "<tr><td colspan='2' class='content'>".utf8Substr($arr_all_seo[$i]['K_UnionIntroduce'],0, 50)."</td></tr>";
				}
				echo "<tr><td colspan='2' align='left'><font color='green' size='2'>my.php?pi=".$arr_all_seo[$i]['K_UnionId']."</font></td></tr>";
				break;
			case 'K_DiscuzId':
				echo "<tr><td colspan='2'><a href='pdi_c.php?di=".$arr_all_seo[$i]['K_DiscuzId']."' target='_blank'  title='".$arr_all_seo[$i]['K_DiscuzTitle']."'><b>".$arr_all_seo[$i]['K_DiscuzTitle']."</b></a></td></tr>";
				if(preg_match ( '/<img /i' , utf8Substr($arr_all_seo[$i]['K_DiscuzContent'],0, 50)  )){
					echo "<tr><td colspan='2' class='content'>".$arr_all_seo[$i]['K_DiscuzTitle']."</td></tr>";
				}else{
					echo "<tr><td colspan='2' class='content'>".utf8Substr($arr_all_seo[$i]['K_DiscuzContent'],0, 50)."</td></tr>";
				}
				echo "<tr><td colspan='2' align='left'><font color='green' size='2'>pdi_c.php?di=".$arr_all_seo[$i]['K_DiscuzId']."</font></td></tr>";
				break;
			case 'K_ShareId':
				echo "<tr><td colspan='2'><a href='download.php?si=".$arr_all_seo[$i]['K_ShareId']."' target='_blank'  title='".$arr_all_seo[$i]['K_ShareTitle']."'><b>".$arr_all_seo[$i]['K_ShareTitle']."</b></a></td></tr>";
				
				if(preg_match ( '/<img /i' , utf8Substr($arr_all_seo[$i]['K_ShareContent'],0, 50)  )){
					echo "<tr><td colspan='2' class='content'>".$arr_all_seo[$i]['K_ShareTitle']."</td></tr>";
				}else{
					echo "<tr><td colspan='2' class='content'>".utf8Substr($arr_all_seo[$i]['K_ShareContent'],0, 50)."</td></tr>";
				}
				echo "<tr><td colspan='2' align='left'><font color='green' size='2'>download.php?si=".$arr_all_seo[$i]['K_ShareId']."</font></td></tr>";
				break;
			case 'K_ProjectId':
				echo "<tr><td colspan='2'><a href='p_c.php?pi=".$arr_all_seo[$i]['K_ProjectId']."' target='_blank'  title='".$arr_all_seo[$i]['K_ProjectName']."'><b>".$arr_all_seo[$i]['K_ProjectName']."</b></a></td></tr>";
				if(preg_match ( '/<img /i' , utf8Substr($arr_all_seo[$i]['K_ProjectContent'],0, 50)  )){
					echo "<tr><td colspan='2' class='content'>".$arr_all_seo[$i]['K_ProjectName']."</td></tr>";
				}else{
					echo "<tr><td colspan='2' class='content'>".utf8Substr($arr_all_seo[$i]['K_ProjectContent'],0, 50)."</td></tr>";
				}
				echo "<tr><td colspan='2' align='left'><font color='green' size='2'>p_c.php?pi=".$arr_all_seo[$i]['K_ProjectId']."</font></td></tr>";
				break;
			case 'K_RecruitId':
				echo "<tr><td colspan='2'><a href='pr_c.php?pi=".$arr_all_seo[$i]['K_RecruitId']."' target='_blank'  title='".$arr_all_seo[$i]['K_RecruitTitle']."'><b>".$arr_all_seo[$i]['K_RecruitTitle']."</b></a></td></tr>";
				if(preg_match ( '/<img/i' , utf8Substr($arr_all_seo[$i]['K_RecruitContent'],0, 100)  )){
					echo "<tr><td colspan='2' class='content'>".$arr_all_seo[$i]['K_RecruitTitle']."</td></tr>";
				
				}else{
					echo "<tr><td colspan='2' class='content'>".utf8Substr($arr_all_seo[$i]['K_RecruitContent'],0, 50)."</td></tr>";
				}
				echo "<tr><td colspan='2' align='left'><font color='green' size='2'>pr_c.php?pi=".$arr_all_seo[$i]['K_RecruitId']."</font></td></tr>";
				break;
			case 'K_NewsId':
				echo "<tr><td colspan='2'><a href='pn_c.php?ni=".$arr_all_seo[$i]['K_NewsId']."' target='_blank' title='".$arr_all_seo[$i]['K_NewsTitle']."'><b>".$arr_all_seo[$i]['K_NewsTitle']."</b></a></td></tr>";
				if(preg_match ( '/<img /i' , utf8Substr($arr_all_seo[$i]['K_NewsContent'],0, 50)  )){
					echo "<tr><td colspan='2' class='content'>".$arr_all_seo[$i]['K_NewsTitle']."</td></tr>";
				}else{
					echo "<tr><td colspan='2' align='left'><font color='green' size='2'>pn_c.php?ni=".$arr_all_seo[$i]['K_NewsId']."</font></td></tr>";
				}
				break;
		}
		echo "</table>";
		echo "<hr style='border:0.5px dashed gray' size=0.5 />";
	}
}else{
	echo "无搜索结果";
}
//添加搜索结果end
?>
</div>
<div id="fit_body_30_float">
</div>
</div>
</body>
</html>

