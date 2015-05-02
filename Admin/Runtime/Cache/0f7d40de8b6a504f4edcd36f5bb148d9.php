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
            <span>General balance:</span>
            <span class="balanceAmount">$10,900.36</span>
        </a>
        <a href="#" title="" class="amChanges">
            <strong class="sPositive">+0.6%</strong>
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
<!-- 发送站内信层 -->
<div id="send_outer_div">
<div class="infor_detail_2_div">
	<table style="margin:10px;" width="96%;">
		<tr><td align="center"><font size="20px" style="font-weight:bold;"><img src="__PUBLIC__/Images/icons/color/reply.png"/> 向<span class="send_user_name"></span>发送站内信</font></td><td align="right"><a onclick="close_send_mess_div()" href="#lose"/><img src="__IMG__/icons/close.png" width="25px" height="25px"/></a></td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2" align="center"><textarea cols="53" class="send_mess_con" rows="6"></textarea></td></tr>
		<tr><td colspan="2"><input type="hidden" class="send_mess_userid" value=""/></td></tr><!-- 将用户的ID放在这 -->
		<tr><td colspan="2" align="center" class="send_mess_noti_info"></td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2" align="center"><button onclick="send_button()">发送</button></td></tr>
	</table>
</div>
</div>
<!-- 显示处理结果层 -->
<div class="res_operator">
	<div class="res_word"></div>
</div>
<div class="wrapper">
<div class="title"><h6>用户统计</h6></div>
        <!-- Widgets -->
        <div class="widgets">
            <div class="oneTwo">  
            	<!-- 网站数量统计 -->
                <div class="widget">
                    <div class="title"><img src="__IMG__/icons/dark/stats.png" alt="" class="titleIcon" /><h6>数量统计</h6></div>
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                        <thead>
                            <tr>
                                <td width="80">数量</td>
                                <td>描述</td>
                                <td width="80">近期增加</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="center"><a href="#" title="" class="webStatsLink"><?php echo ($USERCOMPANYCOUNT); ?></a></td>
                                <td>企业用户</td>
                                <td><span class="statsPlus">0.32%</span></td>
                            </tr>
                            <tr>
                                <td align="center"><a href="#" title="" class="webStatsLink"><?php echo ($USERPERSONCOUNT); ?></a></td>
                                <td>个人用户</td>
                                <td><span class="statsMinus">82.3%</span></td>
                            </tr>
                        </tbody>
                    </table>   
                </div>
            
            
                <!-- 企业用户 -->
                <div class="widget">
                    <div class="title"><img src="__IMG__/icons/dark/users.png" alt="" class="titleIcon" /><h6>企业列表 </h6></div>
                    <ul class="partners">
                    <?php if(is_array($USERCOMPANY)): $i = 0; $__LIST__ = $USERCOMPANY;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$usercompany): $mod = ($i % 2 );++$i;?><li>
                            <a href="#" title="" class="floatL">
                            <!-- 显示头像 -->
	                            <?php if(($usercompany["K_UserHeadAdd"]) == ""): ?><img src="__ROOT__/Upload/Images/default_u.jpg" width="30px" height="30px"/>
		                        <?php else: ?>
		                        	<img src="__ROOT__/<?php echo ($usercompany["K_UserHeadAdd"]); ?>" width="30px" height="30px"/><?php endif; ?>
                            </a>
                            <div class="pInfo">
                                <a href="#" title=""><strong><?php echo ($usercompany["K_UserName"]); ?></strong></a>
                                <i>
                                <?php if(($usercompany["K_UserIntroduce"]) == ""): ?>暂无介绍
                                <?php else: ?>
                                	<?php echo (substr($usercompany["K_UserIntroduce"],0, 99)); endif; ?>
                                </i>	
                            </div>
                            <div class="pLinks">
                                <!-- <a href="#" title="Direct call" class="tipW"><img src="__IMG__/icons/pSkype.png" alt="" /></a> -->
                               <a href="#send" onclick="send_message(<?php echo ($usercompany["K_UserId"]); ?>,'<?php echo ($usercompany["K_UserName"]); ?>')"><img src="__IMG__/icons/pEmail.png" alt="" /></a>
                            </div>
                            <div class="clear"></div>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            
            
                <!-- 个人用户 -->
                <div class="widget">
                    <div class="title"><img src="__IMG__/icons/dark/users.png" alt="" class="titleIcon" /><h6>个人列表 </h6></div>
                    <ul class="partners">
                    <?php if(is_array($USERPERSON)): $i = 0; $__LIST__ = $USERPERSON;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$userperson): $mod = ($i % 2 );++$i;?><li>
                            <a href="#" title="" class="floatL">
                            <!-- 显示头像 -->
	                            <?php if(($userperson["K_UserHeadAdd"]) == ""): ?><img src="__ROOT__/Upload/Images/default_u.jpg" width="30px" height="30px"/>
		                        <?php else: ?>
		                        	<img src="__ROOT__/<?php echo ($userperson["K_UserHeadAdd"]); ?>" width="30px" height="30px"/><?php endif; ?>
                            </a>
                            <div class="pInfo">
                                <a href="#" title=""><strong><?php echo ($userperson["K_UserName"]); ?></strong></a>
                                <i>
                                <?php if(($userperson["K_UserIntroduce"]) == ""): ?>暂无介绍
                                <?php else: ?>
                                	<?php echo (substr($userperson["K_UserIntroduce"],0, 99)); endif; ?>
                                </i>	
                            </div>
                            <div class="pLinks">
                                <!-- <a href="#" title="Direct call" class="tipW"><img src="__IMG__/icons/pSkype.png" alt="" /></a> -->
                                <a href="#send" onclick="send_message(<?php echo ($userperson["K_UserId"]); ?>,'<?php echo ($userperson["K_UserName"]); ?>')"><img src="__IMG__/icons/pEmail.png" alt="" /></a>
                            </div>
                            <div class="clear"></div>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                
                
            </div>
        
        	<!-- 2 columns widgets -->
            <div class="oneTwo">
            <!-- 搜索框 -->
                <div class="searchWidget">
                    <form action="#">
                        <input type="text" name="search" placeholder="搜索用户..." />
                        <input type="submit" name="find" value="" />
                    </form>
                </div>
            <!--待激活用户 -->
            <div class="widget">
                    <div class="title"><img src="__IMG__/icons/dark/users.png" alt="" class="titleIcon" /><h6>待激活用户 </h6></div>
                    <ul class="partners">
                    <?php if(is_array($USERNEEDVERIFY)): $i = 0; $__LIST__ = $USERNEEDVERIFY;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$userneedverify): $mod = ($i % 2 );++$i;?><li>
                            <a href="#" title="" class="floatL">
                            <!-- 显示头像 -->
	                            <?php if(($userneedverify["K_UserHeadAdd"]) == ""): ?><img src="__ROOT__/Upload/Images/default_u.jpg" width="30px" height="30px"/>
		                        <?php else: ?>
		                        	<img src="__ROOT__/<?php echo ($userneedverify["K_UserHeadAdd"]); ?>" width="30px" height="30px"/><?php endif; ?>
                            </a>
                            <div class="pInfo">
                                <a href="#" title=""><strong><?php echo ($userneedverify["K_UserName"]); ?></strong></a>
                                <i>
                                <?php if(($userneedverify["K_UserIntroduce"]) == ""): ?>暂无介绍
                                <?php else: ?>
                                	<?php echo (substr($userneedverify["K_UserIntroduce"],0, 99)); endif; ?>
                                </i>	
                            </div>
                            <div class="pLinks">
                                <!-- <a href="#" title="Direct call" class="tipW"><img src="__IMG__/icons/pSkype.png" alt="" /></a> -->
                                <a href="#send" onclick="send_message(<?php echo ($userneedverify["K_UserId"]); ?>,'<?php echo ($userneedverify["K_UserName"]); ?>')"><img src="__IMG__/icons/pEmail.png" alt="" /></a>
                            </div>
                            <div class="clear"></div>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                <!-- 已限制登录的用户 -->
                <div class="widget">
                    <div class="title"><img src="__IMG__/icons/dark/users.png" alt="" class="titleIcon" /><h6>已屏蔽用户 </h6></div>
                    <ul class="partners">
                    <?php if(is_array($USERALSHIELD)): $i = 0; $__LIST__ = $USERALSHIELD;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$useralshield): $mod = ($i % 2 );++$i;?><li>
                            <a href="#" title="" class="floatL">
                            <!-- 显示头像 -->
	                            <?php if(($useralshield["K_UserHeadAdd"]) == ""): ?><img src="__ROOT__/Upload/Images/default_u.jpg" width="30px" height="30px"/>
		                        <?php else: ?>
		                        	<img src="__ROOT__/<?php echo ($useralshield["K_UserHeadAdd"]); ?>" width="30px" height="30px"/><?php endif; ?>
                            </a>
                            <div class="pInfo">
                                <a href="#" title=""><strong><?php echo ($useralshield["K_UserName"]); ?></strong></a>
                                <i>
                                <?php if(($useralshield["K_UserIntroduce"]) == ""): ?>暂无介绍
                                <?php else: ?>
                                	<?php echo (substr($useralshield["K_UserIntroduce"],0, 99)); endif; ?>
                                </i>	
                            </div>
                            <div class="pLinks">
                                <!-- <a href="#" title="Direct call" class="tipW"><img src="__IMG__/icons/pSkype.png" alt="" /></a> -->
                                <a href="#send" onclick="send_message(<?php echo ($useralshield["K_UserId"]); ?>,'<?php echo ($useralshield["K_UserName"]); ?>')"><img src="__IMG__/icons/pEmail.png" alt="" /></a>
                            </div>
                            <div class="clear"></div>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            
                

                
                <div class="clear"></div>

            </div>
            <div class="clear"></div>
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