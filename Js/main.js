$(document).ready(function(){
	// 导航下拉  start
	$("nav ul li").hover(function() {
		$(this).addClass("active");
		$(this).find("ul").show().animate({opacity: 1}, 400);
		},function() {
		$(this).find("ul").hide().animate({opacity: 0}, 200);
		$(this).removeClass("active");
	});
	
	// Requried: Addtional styling elements
	$('nav ul li ul li:first-child').prepend('<li class="arrow"></li>');
	$('nav ul li:first-child').addClass('first');
	$('nav ul li:last-child').addClass('last');
	$('nav ul li ul').parent().append('<span class="dropdown"></span>').addClass('drop');
	// 导航下拉  end
	

	//主页云计算  start
	//主页云计算栏中的，当鼠标放在图片上的效果  start
	$("#width_cloud_1 #width_cloud_2 .cloud_img img").mouseover(function(){
		$(this).animate({marginLeft:'80px'}, 300);
		$(this).animate({marginLeft:'-=40px'}, 300);
	});
	//主页云计算栏中的，当鼠标放在图片上的效果  end
	

	//主页云计算  end
	/*定义一个正好适应浏览器高度的样式，如果网页内容过短，这样可以撑满整个屏幕 start*/
	/*在CSS文件main.css中 同样有这样限制这个样式的代码*/
	var ScreenHeight = parseInt($(window).height());//浏览器当前高度
	$("#fit_for_body_height").css('height', ScreenHeight-100);
	/*定义一个正好适应浏览器高度的样式，如果网页内容过短，这样可以撑满整个屏幕 end*/
	


	
	//用户注册时，在选择企业注册 或者 个人用户是 的点击事件
	$(".form-2 input[type=radio]").click(function(){
		var id = $(this).attr('id');
		if(id == 'c'){
			$("#UserName").attr('placeholder', '最后请如实填写您的企业名称,我们会对此进行核实');
		}else if(id == 'p'){
			$("#UserName").attr('placeholder', '最后填写您的昵称,注册完成之后您可以进行更改');
		}
	});
	

});
/*主页图片切换 start*/
function $a(id,tag){var re=(id&&typeof id!="string")?id:document.getElementById(id);if(!tag){return re;}else{return re.getElementsByTagName(tag);}}

//焦点滚动图 点击移动
function movec()
{
	var o=$a("bd1lfimg","");
	var oli=$a("bd1lfimg","dl");
    var oliw=oli[0].offsetWidth; //每次移动的宽度	 
	var ow=o.offsetWidth-2;
	var dnow=0; //当前位置	
	var olf=oliw-(ow-oliw+10)/2;
		o["scrollLeft"]=olf+(dnow*oliw);
	var rqbd=$a("bd1lfsj","ul")[0];
	var extime;

	<!--for(var i=1;i<oli.length;i++){rqbd.innerHTML+="<li>"+i+"</li>";}-->
	var rq=$a("bd1lfsj","li");
	for(var i=0;i<rq.length;i++){reg(i);};
	oli[dnow].className=rq[dnow].className="show";
	var wwww=setInterval(uu,5000);

	function reg(i){rq[i].onclick=function(){oli[dnow].className=rq[dnow].className="";dnow=i;oli[dnow].className=rq[dnow].className="show";mv();}}
	function mv(){clearInterval(extime);clearInterval(wwww);extime=setInterval(bc,15);wwww=setInterval(uu,10000);}
	function bc()
	{
		var ns=((dnow*oliw+olf)-o["scrollLeft"]);
		var v=ns>0?Math.ceil(ns/10):Math.floor(ns/10);
		o["scrollLeft"]+=v;if(v==0){clearInterval(extime);oli[dnow].className=rq[dnow].className="show";v=null;}
	}
	function uu()
	{
		if(dnow<oli.length-2)
		{
			oli[dnow].className=rq[dnow].className="";
			dnow++;
			oli[dnow].className=rq[dnow].className="show";
		}
		else{oli[dnow].className=rq[dnow].className="";dnow=0;oli[dnow].className=rq[dnow].className="show";}
		mv();
	}
	o.onmouseover=function(){clearInterval(extime);clearInterval(wwww);}
	o.onmouseout=function(){extime=setInterval(bc,15);wwww=setInterval(uu,6000);}
}
/*主页图片切换 end*/



/*---main_content菜单切换js文件----START*/

/*点击资料下载-------START--------*/
$(document).ready(function() {
	$("#download").click(function(){
		$(".main_col_90 span").removeClass().addClass("main_title_unselect");
		$("#download").removeClass().addClass("main_title_select");
	});
	/*点击资料下载-------END--------*/
	
	/*点击实时交流--------START--------*/
	$("#discuz").click(function() {
		$(".main_col_90 span").removeClass().addClass("main_title_unselect");
		$("#discuz").removeClass().addClass("main_title_select");
		//这里处理标题栏右侧的more的链接start
		$("#right_more_id").remove();
		var str = "<span class='main_right_more' id='right_more_id'><a href='pdis_l.php' title='更多'><font size='4' style='font-weight:bolder;position:relative;top:-12px;' >・・・</font></a></span>";
		$(str).appendTo("#project_title_div");
		//这里处理标题栏右侧的more的链接end
		var ul1 = document.getElementById("main_content");
		while(ul1.firstChild) {
			ul1.removeChild(ul1.firstChild);
		}
		//显示实时交流
		$.ajax({
			url:"Include/Ajax/index_discuz.php",
			dataType:"json",
			success:function(json) {
				for(var one in json) {
					//alert(json[one]['K_DiscuzId']);
					var str = '<div class="project"><a href="pdis_c.php?pi='+json[one]['K_DiscuzId']+'"  title="'+json[one]['K_DiscuzTitle']+'"><table class="project_table" width="500px"><tr><td height="30px"><span class="title">'+json[one]['K_DiscuzTitle']+'</span></td></tr><tr><td height="110px" valign="top">'+json[one]['K_DiscuzContent'].substring(0,260)+'</td></tr><tr><td>发布人：'+json[one]['K_DiscuzUserId']+'&nbsp;&nbsp;&nbsp;'+json[one]['K_DiscuzTime']+'</td></tr></table></a></div>';
					$(str).appendTo("#main_content");
				}
			}
		});
	});
	/*点击实时交流--------END--------*/
	
	/*点击知识共享-------START---------*/
	$("#share").click(function() {
		$(".main_col_90 span").removeClass().addClass("main_title_unselect");
		$("#share").removeClass().addClass("main_title_select");
		//这里处理标题栏右侧的more的链接start
		$("#right_more_id").remove();
		var str = "<span class='main_right_more' id='right_more_id'><a href='ps_l.php' title='更多'><font size='4' style='font-weight:bolder;position:relative;top:-12px;' >・・・</font></a></span>";
		$(str).appendTo("#project_title_div");
		//这里处理标题栏右侧的more的链接end
		//先将表格中原来的信息清除
		var ul1 = document.getElementById("main_content");
		while(ul1.firstChild) {
			ul1.removeChild(ul1.firstChild);
		}
		//显示知识共享
		$.ajax({
			url:"Include/Ajax/index_share.php",
			dataType:"json",
			success:function(json) {
				for(var one in json){
					var str = '<div class="project"><a href="download.php?si='+json[one]['K_ShareId']+'" title="'+json[one]['K_ShareTitle']+'"><table><tr><td width="330px"><span class="title">'+json[one]['K_ShareTitle'].substr(0, 21)+'</span></td><td width="200px">'+json[one]['K_ShareTime']+'</td></tr></table></a></div>';
					$(str).appendTo("#main_content");
				}
			}
		});
	});
	/*点击知识共享------END---------*/
	
	/*点击项目合作-------START------*/
	$("#project").click(function() {
		$(".main_col_90 span").removeClass().addClass("main_title_unselect");
		$("#project").removeClass().addClass("main_title_select");
		//这里处理标题栏右侧的more的链接start
		$("#right_more_id").remove();
		var str = "<span class='main_right_more' id='right_more_id'><a href='pp_l.php' title='更多'><font size='4' style='font-weight:bolder;position:relative;top:-12px;' >・・・</font></a></span>";
		$(str).appendTo("#project_title_div");
		//这里处理标题栏右侧的more的链接end
		//先将表格中原来的信息清除
		var ul1 = document.getElementById("main_content");
		while(ul1.firstChild) {
			ul1.removeChild(ul1.firstChild);
		}
		//显示项目合作
		$.ajax({
			url:"Include/Ajax/index_project.php",
			dataType:"json",
			success:function(json) {
				for(var one in json){
				var str='<div class="project"><a href="p_c.php?pi='+json[one]['K_ProjectId']+'"  title="'+json[one]['K_ProjectName']+'"><table class="project_table" width="500px"><tr><td rowspan="3"><img src="'+json[one]['K_ProjectView']+'" width="200px" height="150px" /></td><td valign="top" height="10px"><span class="title">'+json[one]['K_ProjectName']+'</span></a></td></tr><tr><td valign="center">　　'+json[one]['K_ProjectContent'].substring(0,129)+"..."+'</td></tr><tr><td>项目开启时间:'+json[one]['K_ProjectStartTime'].substr(0, 10)+'</td></tr></table></a></div>';
					$(str).appendTo("#main_content");
				}
			}
		});
	});
	/*点击项目合作-------END------*/
	
	/*不点击的时候/显示项目合作----START-------*/
	$.ajax({
		url:"Include/Ajax/index_project.php",
		dataType:"json",
		success:function(json) {
			for(var one in json){
				var str='<div class="project"><a href="p_c.php?pi='+json[one]['K_ProjectId']+'" title="'+json[one]['K_ProjectName']+'"><table class="project_table" width="500px"><tr><td rowspan="3"><img src="'+json[one]['K_ProjectView']+'" width="200px" height="150px" /></td><td valign="top" height="10px"><span class="title">'+json[one]['K_ProjectName']+'</span></a></td></tr><tr><td valign="center">　　'+json[one]['K_ProjectContent'].substring(0,129)+"..."+'</td></tr><tr><td>项目开启时间:'+json[one]['K_ProjectStartTime'].substr(0, 10)+'</td></tr></table></a></div>';
				$(str).appendTo("#main_content");
			}
		}
	});
	


});
/*不点击的时候/显示项目合作----END-------*/
/*---main_content菜单切换js文件----END*/


