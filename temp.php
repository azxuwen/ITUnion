<?php
require_once 'Include/Page.class.php';
$page = new Page();
$page->html = 5;//html版本号
$page->title = '云环境IT联盟信息平台';//网页标题
$page->keywords = "哈尔滨理工大学管理学院创新实验|魏玲|王金石|郭新朋|张健平|吴德森|徐文志";//网页关键字
$page->charset = 'utf-8';//编码方式
$page->description = "哈尔滨理工大学管理学院创新实验";//网页描述
//引入CSS文件
$page->stylePath[] = "<link href='Css/main.css' type='text/css' rel='stylesheet'>";
//引入JS文件
$page->javascriptPath[] = "<script src='Js/jquery-2.0.2.js' type='text/javascript'></script>";
$page->javascriptPath[] = "<script src='Js/main.js' type='text/javascript'></script>";
$page->headerPath = 'header.php';//网页页头
$page->footPath = 'footer.php';//网页页脚
//网页body中的内容
$page->contents = <<<CON
<table align="center" id="pid_change_table" cellpadding="10px" >
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
							<h2><a href="#" target="_blank">2011城市主题公园亲子游</a></h2>
							<p><a href="#" target="_blank">又是春游踏青的季节，各大主题乐园都为大朋友、小朋友们准备了丰…</a></p>
						</dd>
					</dl>
										<dl class="">
						<dt><a href="#" title="" target="_blank"><img src="Images/sunset.jpg" /></a></dt>
						<dd>
							<h2><a href="#" target="_blank">潜入城市周边清幽之地</a></h2>
							<p><a href="#" target="_blank">北京、上海、广州、成都周边，总有些人少清幽的地方，等着你去探…</a></p>
						</dd>
					</dl>
										<dl class="">
						<dt><a href="#" title="" target="_blank"><img src="Images/subway.jpg" /></a></dt>
						<dd>
							<h2><a href="#" target="_blank">盘点中国最美雪山</a></h2>
							<p><a href="#" target="_blank">盘点中国最美雪山，从云南的梅里到西藏的珠穆朗玛，带你领略中国…</a></p>
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
						<dt><a href="#" title=""><img src="Images/shop.jpg" ></a></dt>
						<dd>
							<h2><a href="#">五月乐享懒人天堂塞班岛</a></h2>
							<p><a href="#" >塞班岛是北马里亚纳群岛的首府，由于近邻赤道，塞班岛一年四季如…</a></p>
						</dd>
					</dl>
                    			<dl class="">
						<dt><a href="#" title="" target="_blank"><img src="Images/shop.jpg"></a></dt>
						<dd>
							<h2><a href="#" target="_blank">潜入城市周边清幽之地</a></h2>
							<p><a href="#" target="_blank">北京、上海、广州、成都周边，总有些人少清幽的地方，等着你去探…</a></p>
						</dd>
					</dl>
                    			<dl class="">
						<dt><a href="#" title="" target="_blank"><img src="Images/shop.jpg"></a></dt>
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
        
        <br/><br/>
		<center><hr width="90%" style="color:white;"/></center>
        
 <!--  搜索框  start-->
        <div id="seo_div">
        	　<input type="text" class="keyword" name="seo_key" placeholder="填写要搜索的内容"/>  <input type="button" class="button gray" id="seo_button" value="搜索"/>
            这里放一些最近比较火的标签
        </div>
<!--  搜索框  end-->
		<center><hr width="90%" style="color:white;"/></center>
        <br/><br/>
        
<!--联盟公告 产品 等内容  start-->
<div id="width_100">
<div id="width_30">
<div class="main_col">
	<span class="main_title"><img src="Images/list_48x48.png" width="25px" height="28px" />　联盟资讯</span>
    <span class="main_more"><a href="#">>>more</a></span>
</div><!--main_col-->
<!--    下面这个表格显示新闻资讯start   -->
<table>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题</a></td><td><a href="#">2014-01-14</a></td></tr>
</table>
<!--    下面这个表格显示新闻资讯end   -->
</div><!--width_30-->

<div id="width_30">
<div class="main_col">
	<span class="main_title"><img src="Images/cart_48x48.png" width="25px" height="28px" />　产品推介</span>
    <span class="main_more"><a href="#">>>more</a></span>
</div><!--main_col-->
<!--    下面这个表格显示产品信息start   -->
<table>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
</table>
<!--    下面这个表格显示产品信息start   -->
</div><!--width_30-->

<div id="width_30">
<div class="main_col">
	<span class="main_title"><img src="Images/peoples_48x48.png" width="25px" height="28px" />　招聘信息</span>
    <span class="main_more"><a href="#">>>more</a></span>
</div><!--main_col-->
<!--    下面这个表格显示招聘信息start   -->
<table align="center">
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
</table>
<!--    下面这个表格显示招聘信息end  -->
</div><!--width_30-->
</div><!--width_100-->
<!--联盟公告 产品 等内容  start-->
<br/><br/>


<!--下面主要是联盟中的项目合作方面 比如说 合作  交流   资料下载 等等   start   -->
<div id="width_100">
<div id="width_90">
<div  class="main_col_90">
	<span class="main_title_select"><img src="Images/messages_48x48.png" width="20" height="20"/><a href="#"> 项目合作</a></span>
    <span class="main_title_unselect"><img src="Images/sound_48x48.png" width="20" height="20"/><a href="#"> 知识共享</a></span>
    <span class="main_title_unselect"><img src="Images/call_48x48.png" width="20" height="20"/><a href="#"> 实时交流</a></span>
    <span class="main_title_unselect"><img src="Images/download_48x48.png" width="20" height="20"/><a href="#"> 资料下载</a></span>
</div><!--main_col-->
<!--    下面这个表格显示上面几个导航中的项目的内容  start   -->
<table id="main_content">
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
<tr><td><img src="Images/tb1.jpg" /></td><td><a href="#">新闻标题新闻标题新闻标题新闻标题标题</a></td><td><a href="#">2014-01-14</a></td></tr>
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
CON;
$page->Display();
?>