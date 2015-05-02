<!--创建者 : 徐文志 创建时间 : 2014 01 13    14:00 站点归属 ：IT联盟(哈尔滨理工大学创新实验)-->
<!DOCTYPE HTML>
<html>
<head>
<!-- 网页描述信息 start-->
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="target-densitydpi=device-dpi,width=device-width,initial-scale=1,minimum-scale=0.1,maximum-scale=1" />
<meta name="开发团队" content="哈尔滨理工大学管理学院创新实验" />
<meta name="keywords" content="哈尔滨理工大学管理学院创新实验|魏玲|王金石|郭新朋|张健平|吴德森|徐文志">
<meta name="description" content="哈尔滨理工大学管理学院创新实验">
<!-- 网页描述信息 end-->
<!---标题 start-->
<title>云环境下IT企业联盟信息平台</title>
<!--标题-->
<!--CSS   start-->
<link href="Css/main.css" rel="stylesheet" type="text/css"/>
<!--CSS   end-->
<!--Js  start-->
<script src="Js/jquery-2.0.2.js" type="text/javascript"></script>
<script src="Js/main.js" type="text/javascript"></script>
<script src="Js/seo.js" type="text/javascript"></script>
<!--Js  end-->
</head>
<body>
<?php
include 'header.php';
?>
<table  id="pid_change_table">
        <tr><td width="80%" align="center"><!--  切换图为70%宽 -->
        <!--   主页图片切换 start -->
    		 <div class="sub_box">
			<div id="p-select" class="sub_nav">
				<div class="sub_no" id="bd1lfsj">
					<ul>
						<li class="show">1</li><li class="">2</li><li class="">3</li><li class="">4</li><li class="">5</li><li class="">6</li><li class="">7</li>
					</ul>
				</div>
			</div>
			<div id="bd1lfimg">
				<div>
					<dl class="show"></dl>
							<dl class="">
						<dt><a href="#" title="" target="_blank"><img src="Images/wood.jpg" /></a></dt>
						<dd>
							<h2><a href="#" target="_blank">海尔公司</a></h2>
							<p><a href="#" target="_blank">海尔公司…</a></p>
						</dd>
					</dl>
										<dl class="">
						<dt><a href="#" title="" target="_blank"><img src="Images/sunset.jpg" /></a></dt>
						<dd>
							<h2><a href="#" target="_blank">海信公司</a></h2>
							<p><a href="#" target="_blank">海信公司…</a></p>
						</dd>
					</dl>
										<dl class="">
						<dt><a href="#" title="" target="_blank"><img src="Images/subway.jpg" /></a></dt>
						<dd>
							<h2><a href="#" target="_blank">百度</a></h2>
							<p><a href="#" target="_blank">众里寻他千百度…</a></p>
						</dd>
					</dl>
										<dl class="">
						<dt><a href="#" title="" target="_blank"><img src="Images/shop.jpg"></a></dt>
						<dd>
							<h2><a href="#" target="_blank">2011西安世园会攻略</a></h2>
							<p><a href="#" target="_blank">提供最全面西安世园会资讯、西安世园会参观指南、西安世园会旅游…</a></p>
						</dd>
					</dl>
										<dl class="">
						<dt><a href="#" title=""><img src="Images/index1.jpg" ></a></dt>
						<dd>
							<h2><a href="#">五月乐享懒人天堂塞班岛</a></h2>
							<p><a href="#" >塞班岛是北马里亚纳群岛的首府，由于近邻赤道，塞班岛一年四季如…</a></p>
						</dd>
					</dl>
                    			<dl class="">
						<dt><a href="#" title="" target="_blank"><img src="Images/index2.jpg"></a></dt>
						<dd>
							<h2><a href="#" target="_blank">潜入城市周边清幽之地</a></h2>
							<p><a href="#" target="_blank">北京、上海、广州、成都周边，总有些人少清幽的地方，等着你去探…</a></p>
						</dd>
					</dl>
                    			<dl class="">
						<dt><a href="#" title="" target="_blank"><img src="Images/index3.jpg"></a></dt>
						<dd>
							<h2><a href="#" target="_blank">2011西安世园会攻略</a></h2>
							<p><a href="#" target="_blank">提供最全面西安世园会资讯、西安世园会参观指南、西安世园会旅游…</a></p>
						</dd>
					</dl>
			</div>
			</div>
		</div>
        <script type="text/javascript">movec();</script>
         <!--   主页图片切换 end -->
        </td>
        </tr>
        </table>
        
        <br/>
		<hr width="90%" style="color:white;margin:0 auto;"/>
        
 <!--  搜索框  start-->
        <div id="seo_div">
        	　<input type="search" class="keyword" name="seo_key" placeholder="填写要搜索的内容"/>  <input type="button" class="button gray" id="seo_button" value="搜索"/>
　　　　<span style="font-size:0.8em;">大家都在<font size="15px">搜</font></span>
        <?php
        	//这里存放一些最近经常搜索的东西或者说是标签
        	$arr_category_seo = getCategoryInfor(5, $sqlHelper, 5);
        	if(count($arr_category_seo) != 0){
        		for($i = 0; $i < count($arr_category_seo); $i ++ ){
        			echo "<a href='seo.php?k=".$arr_category_seo[$i]['CodeName']."'><span class='seo_tags'>".$arr_category_seo[$i]['CodeName']."<span></a>";
        		}
        	}
        ?>
        </div>
<!--  搜索框  end-->
		<hr width="90%" style="color:white;margin:0 auto;"/>
        <br/><br/>
        
<!--联盟公告 产品 等内容  start-->
<div id="width_100">
<div id="width_30">
<div class="main_col">
	<span class="main_title"><img src="Images/list_48x48.png" width="25px" height="28px" />　联盟资讯</span>
    <span class="main_more"><a href="pn_l.php"><font size='4' style='font-weight:bolder;'>・・・</font></a></span>
</div><!--main_col-->
<!--    下面这个表格显示新闻资讯start   -->
<table>
<?php
	//查询时间最靠前的联盟资讯15条
	$start = 0;
	$end = 15;
	$sql_get_news = sprintf("Select K_NewsId,K_NewsTitle,K_NewsTime From t_news Order By K_NewsTop desc,K_NewsTime desc Limit %d,%d", $start, $end);
	$arr_news = $sqlHelper -> execute_dql2($sql_get_news);
	if(count($arr_news) != 0){
		for($i = 0; $i < count($arr_news); $i ++){
			echo "<tr><td><img src='Images/tb1.jpg' /></td><td width='270px'><a href='pn_c.php?ni=".$arr_news[$i]['K_NewsId']."' title={$arr_news[$i]['K_NewsTitle']}>".utf8Substr($arr_news[$i]['K_NewsTitle'], 0, 17)."</a></td><td><a href='pn_c.php?ni=".$arr_news[$i]['K_NewsId']."' title={$arr_news[$i]['K_NewsTitle']}>".date("Y-m-d",strtotime($arr_news[$i]['K_NewsTime']))."</a></td></tr>";
		}
	}else{
		echo "<tr><td><small>暂无联盟资讯，您可以查看其他内容</small></td></tr>";
	}
?>
</table>
<!--    下面这个表格显示新闻资讯end   -->
</div><!--width_30-->

<div id="width_30">
<div class="main_col">
	<span class="main_title"><img src="Images/cart_48x48.png" width="25px" height="28px" />　产品推介</span>
    <span class="main_more"><a href="pd_l.php"><font size='4' style='font-weight:bolder;'>・・・</font></a></span>
</div><!--main_col-->
<!--    下面这个表格显示产品信息start   -->
<table>
<?php
	//这里实现放产品推介的信息
	$start = 0;
	$end = 14; 
	$sql_get_products = sprintf("Select K_ProductId,K_ProductTitle,K_ProductPicAddress,K_ProductTime from t_product where K_ProductAdvertisment ='N' order by K_ProductTop desc,K_ProductTime desc limit %d, %d", $start, $end);
	//echo $sql_get_products;
	$arr_products = $sqlHelper -> execute_dql2($sql_get_products);
	if(count($arr_products) != 0){
		echo "<tr>";
		//这里通过一个3次的循环来以图片的形式来在主页里显示产品
		for($k = 0; $k < 3 ; $k ++){
			/*因一个产品记录的图片地址可能会有多个，而且在数据库中是以 地址1,地址2，地址3  这样的形式保存的
			 * 我们这里只是想要其中的一张，所以这里将这个从数据库里拿出来的字符串转换成数组，然后拿到第一张图片
			 * 另外我们在填写数据的时候 保证每个产品 必须要至少要有一张描述其特性的图片
			 */
			$Product_img_path_array = explode(",", $arr_products[$k]['K_ProductPicAddress']);
			$Product_first_img_path = $Product_img_path_array[0];
			echo "<td width='20%' align='center'><a href='pd_c.php?pi=".$arr_products[$k]['K_ProductId']."' title={$arr_products[$k]['K_ProductTitle']}><img src={$Product_first_img_path} width='100px' height='60px'/><br/>".utf8Substr($arr_products[$k]['K_ProductTitle'], 0, 7)."</a></td></td>";			
		}
		echo "</tr>";
		echo "</table>";
		echo "<table>";
		//上面是以图片的形式来展示图片，下面通过文字的方式来展示产品
		for($k = 3; $k < count($arr_products); $k ++){
			echo "<tr><td><img src='Images/tb1.jpg' /></td><td width='270px'><a href='pd_c.php?pi=".$arr_products[$k]['K_ProductId']."' title={$arr_products[$k]['K_ProductTitle']}>".utf8Substr($arr_products[$k]['K_ProductTitle'], 0, 17)."</a></td><td><a href='newscon.php' title={$arr_products[$k]['K_ProductTitle']}>".date("Y-m-d",strtotime($arr_products[$k]['K_ProductTime']))."</a></td></tr>";
		}
	}else{
		echo "<tr><td><small>暂无产品信息</small></td></tr>";
	}
?>
</table>
<!--    下面这个表格显示产品信息start   -->
</div><!--width_30-->

<div id="width_30">
<div class="main_col">
	<span class="main_title"><img src="Images/peoples_48x48.png" width="25px" height="28px" />　招聘信息</span>
    <span class="main_more"><a href="pr_l.php"><font size='4' style='font-weight:bolder;'>・・・</font></a></span>
</div><!--main_col-->
<!--    下面这个表格显示招聘信息start   -->
<table>
<?php 
//查询时间最靠前的招聘信息15条
	$start = 0;
	$end = 15;
	$sql_get_recruits = sprintf("Select K_RecruitId,K_RecruitTitle,K_RecruitTime From t_recruit Order By K_RecruitTime Limit %d,%d", $start, $end);
	$arr_recruits = $sqlHelper -> execute_dql2($sql_get_recruits);
	if(count($arr_recruits) != 0){
		for ($j = 0 ; $j < count($arr_recruits); $j++){
			echo "<tr><td><img src='Images/tb1.jpg' /></td><td width='270px'><a href='pr_c.php?pi=".$arr_recruits[$j]['K_RecruitId']."' title={$arr_recruits[$j]['K_RecruitTitle']}>".utf8Substr($arr_recruits[$j]['K_RecruitTitle'], 0, 17)."</a></td><td><a href='newscon.php' title={$arr_recruits[$j]['K_RecruitTitle']}>".date("Y-m-d",strtotime($arr_recruits[$j]['K_RecruitTime']))."</a></td></tr>";
		}
	}else{
		echo "<tr><td><small>暂无招聘信息</small></td></tr>";
	}
?>
</table>
<!--    下面这个表格显示招聘信息end  -->
</div><!--width_30-->
</div><!--width_100-->
<!--联盟公告 产品 等内容  start-->
<br/><br/>


<!--下面主要是联盟中的项目合作方面 比如说 合作  交流   资料下载 等等   start   -->
<div id="width_100">
<div id="width_90">
<div  class="main_col_90" id='project_title_div'>
<span class="main_title_select" id="project"><img src="Images/messages_48x48.png" width="20" height="20"/><a href="#main_col_90"> 项目合作</a></span>
    <span class="main_title_unselect" id="share"><img src="Images/download_48x48.png" width="20" height="20"/><a href="#main_col_90"> 知识共享</a></span>
    <span class="main_title_unselect" id="discuz"><img src="Images/call_48x48.png" width="20" height="20"/><a href="#main_col_90"> 实时交流</a></span>
	<span class="main_right_more" id='right_more_id'><a href="pp_l.php" title='更多'><font size='4' style='font-weight:bolder;position:relative;top:-12px;'>・・・</font></a></span>
</div><!--main_col-->
<!--    下面这个表格显示上面几个导航中的项目的内容  start   -->
<table id="main_content">

</table>
<!--    下面这个表格显示上面几个导航中的项目的内容  end   -->
</div><!--width_90-->
</div><!--width_100-->
<!--下面主要是联盟中的项目合作方面 比如说 合作  交流   资料下载 等等   end-->

<!--  云计算部分 start  -->
<br/><br/>
<div id="width_cloud_1">
<div id="width_cloud_2">
<div  class="main_col_90">
<span class="main_title"><img src="Images/cloud_48x48.png" width="25px" height="28px" />　云计算</span>
</div>
<div class="cloud_img">
<a href="#" title="云开发环境"><img src="Images/computer.jpg" /></a>
</div>
<div class="cloud_img">
<a href="#" title="云数据库"><img src="Images/database.jpg" /></a>
</div>
<div class="cloud_img">
<a href="#" title="云服务"><img src="Images/service.jpg" /></a>
</div>
</div>
</div>
<!--  云计算部分 end  -->

<!--    展示联盟中的企业显示企业图片  start  -->
<br/><br/>
<div id="width_union_1">
<div id="width_union_2">
<div  class="main_col_90">
<span class="main_title"><img src="Images/globe_48x48.png" width="25px" height="28px" />　联盟风采</span>
</div>
<marquee>
<img src="Images/facebook.jpg" width="240px" height="140px"  title="facebook"/>
<img src="Images/apple.jpg" width="240px" height="140px" title="apple"/>
</marquee>
</div>
</div>
<!-- 展示联盟中的企业显示企业图片 end-->
<br/><br/>
<?php
	include 'footer.php';
?>
</body>
</html>
