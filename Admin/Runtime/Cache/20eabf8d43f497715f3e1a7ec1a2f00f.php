<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh" lang="zh" dir="ltr">
<head profile="http://www.w3.org/2000/08/w3c-synd/#">
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="target-densitydpi=device-dpi,width=device-width,initial-scale=1,minimum-scale=0.1,maximum-scale=1" />
<meta name="开发团队" content="哈尔滨理工大学管理学院创新实验" />
<meta name="keywords" content="哈尔滨理工大学管理学院创新实验|魏玲|王金石|郭新朋|张健平|吴德森|徐文志">
<meta name="description" content="哈尔滨理工大学管理学院创新实验">
	<title>云环境下IT联盟信息平台后台管理系统</title>
<script type="text/javascript">
	var APP  = "__APP__";  //定义一个__app__的变量
	var ROOT = "__ROOT__";
	var LIBS = "__ROOT__/Libs";
	var PUBLIC = "__PUBLIC__";
</script>
<!-- 
<meta http-equiv="content-script-type" content="text/css">
 -->
<link href="__CSS__/main.css" rel="stylesheet" type="text/css"/>
<link href="__CSS__/admin.css" rel="stylesheet" type="text/css"/>
<link href="__PUBLIC__/Kindeditor/themes/default/default.css" rel="stylesheet" type="text/css"/><!-- 引入kindedit库 css文件-->
<link href="__PUBLIC__/Kindeditor/plugins/code/prettify.css" rel="stylesheet" type="text/css"/><!-- 引入kindedit库 css文件-->

<script src="__JS__/jq.js" type="text/javascript"></script>
<script type="text/javascript" src="__JS__/plugins/spinner/jquery.mousewheel.js"></script>
<script type="text/javascript" src="__JS__/jq-1.7.min.js"></script>
<script type="text/javascript" src="__JS__/jquery-ui.min.js"></script>
<script src="__JS__/admin.js" type="text/javascript"></script>



<script charset="utf-8" src="__PUBLIC__/Kindeditor/kindeditor.js"></script><!-- 引入kindedit库 js文件-->
<script charset="utf-8" src="__PUBLIC__/Kindeditor/lang/zh_CN.js"></script><!-- 引入kindedit库  js文件-->
<script charset="utf-8" src="__PUBLIC__/Kindeditor/plugins/code/prettify.js"></script><!-- 引入kindedit库 js文件 -->
<script charset="utf-8" src="__JS__/kindeditor.js"></script><!-- 引入Public/Js/kindedit配置文件 -->


<script type="text/javascript" src="__JS__/plugins/forms/uniform.js"></script>
<script type="text/javascript" src="__JS__/plugins/forms/jquery.cleditor.js"></script>
<script type="text/javascript" src="__JS__/plugins/forms/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="__JS__/plugins/forms/jquery.validationEngine.js"></script>
<script type="text/javascript" src="__JS__/plugins/forms/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="__JS__/plugins/forms/autogrowtextarea.js"></script>
<script type="text/javascript" src="__JS__/plugins/forms/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="__JS__/plugins/forms/jquery.dualListBox.js"></script>
<script type="text/javascript" src="__JS__/plugins/forms/jquery.inputlimiter.min.js"></script>
<script type="text/javascript" src="__JS__/plugins/forms/chosen.jquery.min.js"></script>

<script type="text/javascript" src="__JS__/plugins/wizard/jquery.form.js"></script>
<script type="text/javascript" src="__JS__/plugins/wizard/jquery.validate.min.js"></script>
<script type="text/javascript" src="__JS__/plugins/wizard/jquery.form.wizard.js"></script>

<script type="text/javascript" src="__JS__/plugins/uploader/plupload.js"></script>
<script type="text/javascript" src="__JS__/plugins/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="__JS__/plugins/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="__JS__/plugins/uploader/jquery.plupload.queue.js"></script>

<script type="text/javascript" src="__JS__/plugins/tables/datatable.js"></script>
<script type="text/javascript" src="__JS__/plugins/tables/tablesort.min.js"></script>
<script type="text/javascript" src="__JS__/plugins/tables/resizable.min.js"></script>

<script type="text/javascript" src="__JS__/plugins/ui/jquery.tipsy.js"></script>
<script type="text/javascript" src="__JS__/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="__JS__/plugins/ui/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="__JS__/plugins/ui/jquery.progress.js"></script>
<script type="text/javascript" src="__JS__/plugins/ui/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="__JS__/plugins/ui/jquery.colorpicker.js"></script>
<script type="text/javascript" src="__JS__/plugins/ui/jquery.jgrowl.js"></script>
<script type="text/javascript" src="__JS__/plugins/ui/jquery.breadcrumbs.js"></script>
<script type="text/javascript" src="__JS__/plugins/ui/jquery.sourcerer.js"></script>

<script type="text/javascript" src="__JS__/plugins/calendar.min.js"></script>
<script type="text/javascript" src="__JS__/plugins/elfinder.min.js"></script>

<script type="text/javascript" src="__JS__/custom.js"></script>

</head>
<body>
<!-- 左侧菜单 -->
<div id="leftSide">
    <div class="logo"><a href="index.html"><img src="__IMG__/logo.png" alt="" /></a></div>
    <div class="sidebarSep mt0"></div>
    
    <div class="genBalance">
        <a href="#" title="" class="amount">
            <span>&nbsp;</span>
            <span class="balanceAmount">IT联盟</span>
        </a>
        <a href="#" title="" class="amChanges">
            <strong class="sPositive">&nbsp;</strong>
        </a>
    </div>

    <div class="sidebarSep"></div>
    
    <!-- Left navigation -->
    <ul id="menu" class="nav">
        <li class="dash"><a href="__APP__" title="" class="active"><span>后台主页</span></a></li>
        <li class="forms"><a href="__APP__/news/index" title="" class="exp"><span>联盟资讯</span><strong>2</strong></a>
            <ul class="sub">
            	<li><a href="__APP__/news/index" title="">管理资讯</a></li>
                <li><a href="__APP__/news/add" title="">添加资讯</a></li>
            </ul>
        </li>
        <li class="ui"><a href="tables.html" title="" class="exp"><span>用户管理</span><strong>3</strong></a>
        	<ul class="sub">
                <li><a href="__APP__/user/add" title="">添加新用户</a></li>
                <li><a href="__APP__/user/index" title="">管理用户</a></li>
                <li><a href="__APP__/user/statistics" title="">用户统计</a></li>
            </ul>
        </li>    
        <li class="widgets"><a href="#" title="" class="exp"><span>知识共享</span><strong>2</strong></a>
            <ul class="sub">
                <li class="last"><a href="__APP__/share/index" title="">管理知识共享</a></li>
            </ul>
        </li>
        <!-- 
        <li class="errors"><a href="#" title="" class="exp"><span>配置错误页面</span><strong>6</strong></a>
            <ul class="sub">
                <li><a href="admin.php/Other/403.html" title="">403 page</a></li>
                <li><a href="404.html" title="">404 page</a></li>
                <li><a href="405.html" title="">405 page</a></li>
                <li><a href="500.html" title="">500 page</a></li>
                <li><a href="503.html" title="">503 page</a></li>
                <li class="last"><a href="offline.html" title="">网站离线</a></li>
            </ul>
        </li>
         -->
         
         <li class="product"><a href="#" title="" class="exp"><span>产品管理</span><strong>2</strong></a>
         	<ul class="sub">
         		<li><a href="__APP__/product/index" title="">产品管理</a></li> 
                <li><a href="__APP__/product/add" title="">添加产品</a></li> 
            </ul>
         </li>
          <li class="recruit"><a href="#" title="" class="exp"><span>招聘管理</span><strong>2</strong></a>
         	<ul class="sub">
                <li><a href="__APP__/Recruit/index" title="">管理职位</a></li>
                <li><a href="__APP__/Recruit/statistics" title="">招聘统计</a></li>                 
            </ul>
         </li>
          <li class="recruit"><a href="#" title="" class="exp"><span>论坛管理</span><strong>2</strong></a>
         	<ul class="sub">
                <li><a href="__APP__/Recruit/index" title="">最新发帖</a></li>
                <li><a href="__APP__/Recruit/statistics" title="">论坛统计</a></li>                 
            </ul>
         </li>
          <li class="tables"><a href="tables.html" title="" class="exp"><span>项目管理</span><strong>3</strong></a>
            <ul class="sub">
                <li><a href="__APP__/Project/index" title="">项目列表</a></li>
                <li class="last"><a href="__APP__/Project/statistics" title="">项目统计</a></li>
            </ul>
        </li>
         <li class="cloud"><a href="#" title="" class="exp"><span>云计算</span><strong>3</strong></a>
         	<ul class="sub">
                <li><a href="404.html" title="">云环境</a></li> 
                <li><a href="404.html" title="">云数据库</a></li>
                <li><a href="404.html" title="">云服务</a></li>                
            </ul>
         </li>
        <li class="files"><a href="#" title="" class="exp"><span>权限管理</span><strong>2</strong></a>
            <ul class="sub">
                <li><a href="typography.html" title="">管理员权限</a></li>
                <li><a href="calendar.html" title="">用户权限</a></li>
            </ul>
        </li>
        <li class="typo"><a href="#" title="" class="exp"><span>其他页面</span><strong>3</strong></a>
            <ul class="sub">
                <li><a href="typography.html" title="">Typography</a></li>
                <li><a href="calendar.html" title="">日历</a></li>
                <li class="last"><a href="gallery.html" title="">画廊</a></li>
            </ul>
        </li>
    </ul>
</div>


<!-- 最上方菜单 -->
<div id="rightSide">
    <!-- Top fixed navigation -->
    <div class="topNav">
        <div class="wrapper">
            <div class="welcome"><a href="#" title=""><img src="__IMG__/userPic.png" alt="" /></a><span><?php echo (session('ManagerName')); ?></span></div>
            <div class="userNav">
                <ul>
                    <li><a href="#" title=""><img src="__IMG__/icons/topnav/profile.png" alt="" /><span>我</span></a></li>
                    <li><a href="#" title=""><img src="__IMG__/icons/topnav/tasks.png" alt="" /><span>任务</span></a></li>
                    <li class="dd"><a title=""><img src="__IMG__/icons/topnav/messages.png" alt="" /><span>信息</span><span class="numberTop">8</span></a>
                        <ul class="userDropdown">
                            <li><a href="#" title="" class="sAdd">新信息</a></li>
                            <li><a href="#" title="" class="sInbox">inbox</a></li>
                            <li><a href="#" title="" class="sOutbox">outbox</a></li>
                            <li><a href="#" title="" class="sTrash">trash</a></li>
                        </ul>
                    </li>
                    <li><a href="#" title=""><img src="__IMG__/icons/topnav/settings.png" alt="" /><span>设置</span></a></li>
                    <li><a href="__APP__/Login/loginout" title=""><img src="__IMG__/icons/topnav/logout.png" alt="" /><span>退出</span></a></li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    
    
    <!-- 页面 标题   -->
    <div class="titleArea">
        <div class="wrapper">
            <div class="pageTitle">
                <h1>IT联盟信息平台后台管理系统</h1>
                <span></span>
            </div>
            <div class="middleNav">
                <ul>
                    <li class="mUser"><a title=""><span class="users"></span></a>
                        <ul class="mSub1">
                            <li><a href="#" title="增加新用户">增加新用户</a></li>
                        </ul>
                    </li>
                    <li class="mMessages"><a title=""><span class="messages"></span></a>
                        <ul class="mSub2">
                            <li><a href="#" title="增加新联盟资讯">增加新联盟资讯<span class="numberRight">0</span></a></li>
                        </ul>
                    </li>
                    <li class="mFiles"><a href="#" title="Or you can use a tooltip" class="tipN"><span class="files"></span></a></li>
                    <li class="mOrders"><a title=""><span class="orders"></span><span class="numberMiddle">8</span></a>
                        <ul class="mSub4">
                            <li><a href="#" title="">Pending uploads</a></li>
                            <li><a href="#" title="">Statistics</a></li>
                            <li><a href="#" title="">Trash</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    
    <div class="line"></div>
    
    <!-- Page statistics and control buttons area 
    
    <div class="statsRow">
        <div class="wrapper">
        	<div class="controlB">
            	<ul>
                	<li><a href="#" title="编辑新数据库"><img src="__IMG__/icons/control/32/database.png" alt="" /><span>新数据库</span></a></li>
                    <li><a href="#" title="增加新用户"><img src="__IMG__/icons/control/32/hire-me.png" alt="" /><span>增加新用户</span></a></li>
                    <li><a href="#" title="网站统计"><img src="__IMG__/icons/control/32/statistics.png" alt="" /><span>网站统计</span></a></li>
					<li><a href="#" title="产品推介"><img src="__IMG__/icons/control/32/statistics.png" alt="" /><span>产品推介</span></a></li>
					<li><a href="#" title="新闻公告"><img src="__IMG__/icons/control/32/statistics.png" alt="" /><span>新闻公告</span></a></li>
					<li><a href="#" title="网站统计"><img src="__IMG__/icons/control/32/statistics.png" alt="" /><span>网站统计</span></a></li>
					<li><a href="#" title="网站统计"><img src="__IMG__/icons/control/32/statistics.png" alt="" /><span>网站统计</span></a></li>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    
    <div class="line"></div>--> 
<!-- 主界面 -->
<div class="wrapper">
        <!-- Note -->
        <div class="nNote nInformation hideit">
            <p><strong>INFORMATION: </strong>Top buttons area has 3 versions - 2 kinds of buttons and statistics. All of them could be viewed on <a href="ui_elements.html" title="">Interface elements page</a></p>
        </div>
        
        <!-- Chart -->
        <div class="widget chartWrapper">
            <div class="title"><img src="__IMG__/icons/dark/stats.png" alt="" class="titleIcon" /><h6>Chart</h6></div>
            <div class="body"><div class="chart"></div></div>
        </div>
        
        <!-- Widgets -->
        <div class="widgets">
            <div class="oneTwo">
            
                <!-- Partners list widget -->
                <div class="widget">
                    <div class="title"><img src="__IMG__/icons/dark/users.png" alt="" class="titleIcon" /><h6>用户列表</h6></div>
                    <ul class="partners">
                        <li>
                            <a href="#" title="" class="floatL"><img src="__IMG__/face5.png" alt="" /></a>
                            <div class="pInfo">
                                <a href="#" title=""><strong>Dave Armstrong</strong></a>
                                <i>Creative director at Google Inc. Zurich</i>	
                            </div>
                            <div class="pLinks">
                                <a href="#" title="Direct call" class="tipW"><img src="__IMG__/icons/pSkype.png" alt="" /></a>
                                <a href="#" title="Send an email" class="tipW"><img src="__IMG__/icons/pEmail.png" alt="" /></a>
                            </div>
                            <div class="clear"></div>
                        </li>
                    </ul>
                </div>
            
                <!-- Website stats widget -->
                <div class="widget">
                    <div class="title"><img src="__IMG__/icons/dark/stats.png" alt="" class="titleIcon" /><h6>Website statistics</h6></div>
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                        <thead>
                            <tr>
                                <td width="80">Amount</td>
                                <td>Description</td>
                                <td width="80">Changes</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="center"><a href="#" title="" class="webStatsLink">980</a></td>
                                <td>returned visitors</td>
                                <td><span class="statsPlus">0.32%</span></td>
                            </tr>
                            <tr>
                                <td align="center"><a href="#" title="" class="webStatsLink">1545</a></td>
                                <td>new registrations</td>
                                <td><span class="statsMinus">82.3%</span></td>
                            </tr>
                        </tbody>
                    </table>   
                </div>
            
                <!-- Latest update widget -->
                <div class="widget">
                    <div class="title"><img src="__IMG__/icons/dark/refresh4.png" alt="" class="titleIcon" /><h6>Latest updates</h6></div>
                    
                    <div class="updates">
                    	<div class="newUpdate">
                            <div class="uDone">
                                <a href="#" title=""><strong>A new server is on the board!</strong></a>
                                <span>We've just set up a new server. Our gurus ...</span>
                            </div>
                            <div class="uDate"><span class="uDay">08</span>feb</div>
                            <div class="clear"></div>
                        </div>
                        
                    	<div class="newUpdate">
                            <span class="uAlert">
                                <a href="#" title=""><strong>[ URGENT ] ex.ua was closed by government</strong></a>
                                <span>But already everything was solved. It will ...</span>
                            </span>
                            <span class="uDate"><span class="uDay">08</span>feb</span>
                            <div class="clear"></div>
                        </div>
                        
                    	<div class="newUpdate">
                            <span class="uNotice">
                                <a href="#" title=""><strong>Meat a new team member - Don Corleone</strong></a>
                                <span>Very dyplomatic and flexible sales manager</span>
                            </span>
                            <span class="uDate"><span class="uDay">06</span>feb</span>
                            <div class="clear"></div>
                        </div>
                        
                    </div>
                </div>
            </div>
        
        	<!-- 2 columns widgets -->
            <div class="oneTwo">
            
                <!-- Search -->
                <div class="searchWidget">
                    <form action="#">
                        <input type="text" name="search" placeholder="Enter search text..." />
                        <input type="submit" name="find" value="" />
                    </form>
                </div>
            
                <!-- Purchase info widget -->
                <div class="widget">
                    <div class="title">
                    	<img src="__IMG__/icons/dark/money.png" alt="" class="titleIcon" />
                        <h6>Purchase info</h6>
                        <div class="topIcons">
                            <a href="#" class="tipS" title="Download statement"><img src="__IMG__/icons/downloadTop.png" alt="" /></a>
                            <a href="#" class="tipS" title="Print invoice"><img src="__IMG__/icons/printTop.png" alt="" /></a>
                            <a href="#" class="tipS" title="编辑"><img src="__IMG__/icons/editTop.png" alt="" /></a>
                        </div>
                    </div>
                    <div class="newOrder">
                        <div class="userRow">
                            <a href="#" title=""><img src="__IMG__/pic.png" alt="" class="floatL" /></a>
                            <ul class="leftList">
                                <li><a href="#" title=""><strong>Julia Maria Shine</strong></a></li>
                                <li>Order status:</li>
                            </ul>
                            <ul class="rightList">
                                <li><a href="#" title=""> <strong>#2112</strong></a></li>
                                <li class="orderIcons"><span class="oUnfinished"></span><span class="oShipped tipN" title="Shipped on Feb 2nd, 2012"></span><span class="oPaid tipN" title="Paid on Feb 1st, 2012"></span></li>
                            </ul>
                            <div class="clear"></div>
                        </div>
                    
                        <div class="cLine"></div>
                        
                        <div class="orderRow">
                            <ul class="leftList">
                                <li>Date and time:</li>
                                <li>Subtotal amount:</li>
                                <li>Taxes</li>
                            </ul>
                            <ul class="rightList">
                                <li><strong>Jan 31, 2012</strong> |  12:51</li>
                                <li><strong class="green">$5,514.36</strong></li>
                                <li><strong class="orange">- $1,158.54</strong></li>
                            </ul>
                            <div class="clear"></div>
                        </div>
                        
                        <div class="cLine"></div>
                        <div class="totalAmount"><h6 class="floatL blue">Total:</h6><h6 class="floatR blue">$12,157.99</h6><div class="clear"></div></div>
                    </div>
                </div>                
        
                <!-- New users widget -->
                <div class="widget">
                    <div class="title"><img src="__IMG__/icons/dark/add.png" alt="" class="titleIcon" /><h6>New users</h6></div>
                    
                    <div class="wUserInfo">
                        <a href="#" title="" class="wUserPic"><img src="__IMG__/face4.png" alt="" /></a>
                        <ul class="leftList">
                            <li><a href="#" title=""><strong>Steve Downey</strong></a></li>
                            <li><a href="#" title="">steve@downey.com</a></li>
                        </ul>
                        <ul class="rightList">
                            <li><a href="#" class="green"><strong>$2,483.02</strong></a></li>
                            <li><a href="#" class="red">0 purchases</a></li>
                        </ul>
                        <div class="clear"></div>
                    </div>
                </div>
                
            	<!-- My tasks table widget -->
                <div class="widget">
                    <div class="title"><img src="__IMG__/icons/dark/timer.png" alt="" class="titleIcon" /><h6>My tasks</h6><div class="num"><a href="#" class="blueNum">+245</a></div></div>
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable taskWidget">
                        <thead>
                            <tr>
                                <td>Description</td>
                                <td width="100">Status</td>
                                <td width="60">Acts</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="taskPr"><a href="#" title="">Finish design</a></td>
                                <td><span class="green f11">in progress</span></td>
                                <td class="actBtns"><a href="#" title="Update" class="tipS"><img src="__IMG__/icons/edit.png" alt="" /></a><a href="#" title="Remove" class="tipS"><img src="__IMG__/icons/remove.png" alt="" /></a></td>
                            </tr>
                            <tr>
                                <td class="taskP"><a href="#" title="">Connect jQuery stuff</a></td>
                                <td><span class="lGrey f11">pending</span></td>
                                <td class="actBtns"><a href="#" title="Update" class="tipS"><img src="__IMG__/icons/edit.png" alt="" /></a><a href="#" title="Remove" class="tipS"><img src="__IMG__/icons/remove.png" alt="" /></a></td>
                            </tr>
                            <tr>
                                <td class="taskD"><a href="#" title="">Start beta testing</a></td>
                                <td><span class="red f11">done</span></td>
                                <td class="actBtns"><a href="#" title="Update" class="tipS"><img src="__IMG__/icons/edit.png" alt="" /></a><a href="#" title="Remove" class="tipS"><img src="__IMG__/icons/remove.png" alt="" /></a></td>
                            </tr>
                        </tbody>
                    </table> 
                </div>
                <div class="clear"></div>

            </div>
            <div class="clear"></div>
        </div>
    	
        <!-- Events calendar -->
        <div class="widget">
            <div class="title"><img src="__IMG__/icons/dark/monthCalendar.png" alt="" class="titleIcon" /><h6>Events</h6></div>
            <div class="calendar"></div>
        </div>
    
        <!-- Media table -->
        <div class="widget">
            <div class="title"><span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span><h6>Media table</h6></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
                <thead>
                    <tr>
                        <td><img src="__IMG__/icons/tableArrows.png" alt="" /></td>
                        <td>Image</td>
                        <td class="sortCol"><div>Description<span></span></div></td>
                        <td class="sortCol"><div>Date<span></span></div></td>
                        <td>File info</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <div class="itemActions">
                                <label>Apply action:</label>
                                <select>
                                    <option value="">Select action...</option>
                                    <option value="Edit">Edit</option>
                                    <option value="Delete">Delete</option>
                                    <option value="Move">Move somewhere</option>
                                </select>
                            </div>
                            <div class="tPagination">
                                <ul>
                                    <li class="prev"><a href="#" title=""></a></li>
                                    <li><a href="#" title="">1</a></li>
                                    <li><a href="#" title="">2</a></li>
                                    <li><a href="#" title="">3</a></li>
                                    <li><a href="#" title="">4</a></li>
                                    <li><a href="#" title="">5</a></li>
                                    <li><a href="#" title="">6</a></li>
                                    <li>...</li>
                                    <li><a href="#" title="">20</a></li>
                                    <li class="next"><a href="#" title=""></a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    
    	<!-- Dynamic table -->
        <div class="widget">
            <div class="title"><img src="__IMG__/icons/dark/full2.png" alt="" class="titleIcon" /><h6>Dynamic table</h6></div>                          
            <table cellpadding="0" cellspacing="0" border="0" class="display dTable">
            <thead>
            <tr>
            <th>Rendering engine</th>
            <th>Browser</th>
            <th>Platform(s)</th>
            <th>Engine version</th>
            </tr>
            </thead>
            <tbody>
            <tr class="gradeX">
            <td>Trident</td>
            <td>Internet
            Explorer 4.0</td>
            <td>Win 95+</td>
            <td class="center">4</td>
            </tr>
            </tbody>
            </table>  
        </div>
    
    </div>
    <!-- Footer line -->
</div>
<div class="clear"></div>
<div id="footer">
	<div class="wrapper">copyright &copy; 徐文志 吴德森 张健平 郭新朋 王金石</div>
</div>
</body>
</html>