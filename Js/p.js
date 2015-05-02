$(function() {
	//项目合作右侧的切换图start
	var sliderElement = $('.slider-carousel');
	sliderElement.slidesjs({
		play: {
			auto: true,
			effect: 'fade'
		},
		navigation: {
			effect: "fade"
		},
		pagination: {
			effect: "fade"
		},
		effect: {
			slide: {
				speed: 400
			}
		}
	});
	var slidernav = sliderElement.find('.slidesjs-navigation');
	sliderElement.hover(function() {
		slidernav.stop().animate({
			opacity: 1
		})
	},function() {
		slidernav.stop().animate({
			opacity: 0
		});
	});
	//项目合作右侧的切换图end
	//点击加入开源项目按钮的JS事件start
	$("#j_p").click(function(){
		var pj_id = $(".pj_id").val();
		$.ajax({
			type:'post',
			url:'Include/Ajax/j_project.php',
			data:'pj_id='+pj_id,
			dataType:'text',
			success:function(data){
				if(data == 'al'){
					$(".j_pj_infor").html("<center><font color='red' size='2'>您已经在此开源项目中</font></center>");
					$(".p_al").html('您已经在此开源项目中了');
					$("#j_p").css('display', 'none');
				}else if(data == '1'){
					$(".j_pj_infor").html("<center><font color='red' size='2'>您成功加入到该开源项目中</font></center>");
					$(".p_al").html('您已经在此开源项目中了');
					$("#j_p").css('display', 'none');
				}else{
					$(".j_pj_infor").html("<center><font color='red' size='2'>系统错误，建议您刷新浏览器重新关注，谢谢</font></center>");
				}
			},
			beforeSend:function(XMLHttpRequest){   /*  加载之前的效果   */
				var load = "<center><img src='Images/loader_rec.gif' width='200px' height='10px'/></center>";
				$(load).appendTo(".j_pj_infor");
			},
			complete:function(XMLHttpRequest, textStatus){    /*   加载之后    */
				$("#j_pj_infor").html('');
			}
		});
	});
	//点击加入开源项目按钮的JS事件end
	//点击对招聘信息感兴趣的JS事件start
	//首先点击感兴趣按钮 然后隐藏表单出现start
	$("#j_pr").click(function(){
		$(".accecpt_insert").show();//隐藏表单出现
		$(this).css('display', 'none');//本身按钮消失
		$(".accecpt_insert").animate({marginTop:'-30px'}, 700);//让输入框向上移动一下
	});
	//首先点击感兴趣按钮 然后隐藏表单出现end
	//应聘宣言的keyup事件start
	$("#accept_content").focus(function(){
		$(this).keyup(function(){
			//计算这个textarea中输入了多少个字
			var length = $(this).val().length;
			if(length <= 500){
				$("#j_pr_on").show();
				$(".accept_insert_count_s").html('<font size="2">已经输入了'+length+'个字。</font>');
			}else{
				//如果超过了500个字，那么让提交链接失效
				$("#j_pr_on").hide();
				var temp = length - 500;
				$(".accept_insert_count_s").html('<font size="2">你输入了'+length+'个字，超过了'+temp+'，请适当删减</font>');
			}
		});
	});
	//应聘宣言的keyup事件end
	//点击下方出现的取消按钮事件 start
	$("#j_pr_off").click(function(){
		$(".accecpt_insert").animate({marginTop:'30px'}, 700);//让输入框向上移动一下
		$(".accecpt_insert").hide();
		$("#j_pr").show();//本身按钮消失
	});
	//点击下方出现的取消按钮事件 end
	$("#j_pr_on").click(function(){
		var pr_id = $(".pr_id").val();//招聘信息的ID
		var pr_con = $("#accept_content").val();//填写的应聘宣言内容
		var pr_all_con = pr_id +'&'+ pr_con;
		$.ajax({
			type:'post',
			url:'Include/Ajax/j_recruit.php',
			data:'pr_all_con='+pr_all_con,
			dataType:'text',
			success:function(data){
				if(data == 'al'){
					//已经关注了该职位
					$(".j_pr_infor").html('<font size="2" color="red">您已经关注了该职位，您可以查看下方的最新职位</font>');
				}else if(data == '1'){
					//关注成功
					//将页面上 已有多少人对该职位信息感兴趣的数量 +1
					var like_count = $(".like_count").html();
					like_count ++;
					$(".like_count").html(like_count);
					$(".accecpt_insert").css('position', 'relative');
					$(".accecpt_insert").css('top', 20);
					$(".accecpt_insert").html('<br/><center><img src="Images/like_48x48.png" width="30px" height="30px"/><font color="red" size="2">您已成功关注该职位信息</font></center>');
				}else{
					//关注失败
					$(".j_pr_infor").html('<font size="2" color="red">系统错误，建议您刷新浏览器重新关注，谢谢</font>');
				}
			},
			beforeSend:function(XMLHttpRequest){   /*  加载之前的效果   */
				var load = "<center><img src='Images/loader_rec.gif' width='200px' height='10px'/></center>";
				$(load).appendTo(".j_pj_infor");
			},
			complete:function(XMLHttpRequest, textStatus){    /*   加载之后    */
				$("#j_pj_infor").html('');
			}
		});
	});
	//点击对招聘信息感兴趣的JS事件end
	
	//点击修改该招聘信息的可见性
	$("#cha_visible").click(function(){
		var v_status = $(this).attr('href');
		var pr_id = $(".pr_id").val();
		if(v_status == '#v_on'){
			//改变成 仅自己可见
			var status = 'N';
			var c_r_v = status+'-'+pr_id;
			$.ajax({
				type:'post',
				url:'Include/Ajax/c_r_visible.php',
				data:'c_r_v='+c_r_v,
				dataType:'text',
				success:function(data){
					if(data == '1'){
						$(".c_v_span").html("<center><span class='c_v_span'><a class='button blue1' title='点击改变该招聘信息是否显示' id='cha_visible' style='width:220px;' href='#v_off'>公开可见</a></span></center>");
						$(".n_status").html('仅自己可见');
						window.location.reload();
					}else{
						alert('修改失败，建议刷新浏览器，重试');
					}
				}
			});
		}else{
			//改变成  公开可见
			var status = 'Y';
			var c_r_v = status+'-'+pr_id;
			$.ajax({
				type:'post',
				url:'Include/Ajax/c_r_visible.php',
				data:'c_r_v='+c_r_v,
				dataType:'text',
				success:function(data){
					if(data == '1'){
						$(".c_v_span").html("<center><span class='c_v_span'><a class='button blue1' title='点击改变该招聘信息是否显示' id='cha_visible' style='width:220px;' href='#v_on'>仅自己可见</a></span></center>");
						$(".n_status").html('公开可见');
						window.location.reload();
					}else{
						alert('修改失败，建议刷新浏览器，重试');
					}
				}
			});
		}
	});
	$("#clo_infor").click(function(){
		$(".error_infor").slideUp();
	});
	
	
	
	
	
	//当在产品推介列表中跳到多少页时
	$("#sub_w_page").click(function(){
		var pageCount = $(".page_count").val();//总页数
		var w_page = $("#w_page").val().trim();//跳到指定页
		if(w_page == ''){
			return false;
		}
		if((!(w_page <= pageCount )|| ! (w_page > 0)) ){
			alert('不存在该页数');
			return false;
		}
		var kind = $(".p_kind").val();
		if(kind != '88888'){
			window.location.href = 'pd_l.php?p='+w_page+'&pk='+kind;
		}else{
			window.location.href = 'pd_l.php?p='+w_page;
		}
		
	});
	$("#w_page").focus(function(){
		$(this).css('background', '#CDBE70');
		$(this).val('');
	});
	$("#w_page").blur(function(){
		$(this).css('background', 'white');
	});
	
	
	
	
	//当在项目合作列表中跳到多少页时
	$("#go_w_page").click(function(){
		var pageCount = $(".page_count").val();//总页数
		var w_page = $("#w_page").val().trim();//跳到指定页
		if(w_page == ''){
			return false;
		}
		if((!(w_page <= pageCount )|| ! (w_page > 0)) ){
			alert('不存在该页数');
			return false;
		}
		window.location.href = 'pp_l.php?p='+w_page;
	});
	$("#w_page").focus(function(){
		$(this).css('background', '#CDBE70');
		$(this).val('');
	});
	$("#w_page").blur(function(){
		$(this).css('background', 'white');
	});
	
	
	
	
	//当点击在招聘列表中跳到多少页时
	
	$("#sub_r_page").click(function(){
		var pageCount = $(".page_count").val();//总页数
		var w_page = $("#w_page").val().trim();//跳到指定页
		if(w_page == ''){
			return false;
		}
		if((!(w_page <= pageCount )|| ! (w_page > 0)) ){
			alert('不存在该页数');
			return false;
		}
		//下面判断是否存在行业 和 关键字
		if($(".keyword").val()  != '88888'){
			if($(".trade").val() != '88888'){
				window.location.href = 'pr_l.php?p='+w_page+'&k='+$(".keyword").val()+'&t='+$(".trade").val();//跳到指定页
			}else{
				window.location.href = 'pr_l.php?p='+w_page+'&k='+$(".keyword").val();
			}
		}else{
			if($(".trade").val() != '88888'){
				window.location.href = 'pr_l.php?p='+w_page+'&t='+$(".trade").val();//跳到指定页
			}else{
				window.location.href = 'pr_l.php?p='+w_page;
			}
		}
	});
	$("#w_page").focus(function(){
		$(this).css('background', '#CDBE70');
		$(this).val('');
	});
	$("#w_page").blur(function(){
		$(this).css('background', 'white');
	});
	
	
	//跳到指定资料页面
	$("#sub_s_page").click(function(){
		var pageCount = $(".page_count").val();//总页数
		var w_page = $("#w_page").val().trim();//跳到指定页
		if(w_page == ''){
			return false;
		}
		if((!(w_page <= pageCount )|| ! (w_page > 0)) ){
			alert('不存在该页数');
			return false;
		}
		if($(".n").val() == 'y'){
			window.location.href = 'ps_l.php?p='+w_page+'&n=y';
		}else{
			window.location.href = 'ps_l.php?p='+w_page;
		}
		
	});
	
	
	//跳到指定新闻页面
	$("#sub_n_page").click(function(){
		var pageCount = $(".page_count").val();//总页数
		var w_page = $("#w_page").val().trim();//跳到指定页
		if(w_page == ''){
			return false;
		}
		if((!(w_page <= pageCount )|| ! (w_page > 0)) ){
			alert('不存在该页数');
			return false;
		}
		var link = 'pn_l.php?p='+w_page;
		window.location.href = link;
		
	});
	
	
	
	
	
	
	//点击选中标记为已阅
	$("#do_accept_change").click(function(){
		var ri = $(".ri").val();//招聘信息ID
		//接下来通过ajax来将招聘ID为ri的表t_accept中的处理状态改成已处理
		$.ajax({
			type:'post',
			url:'Include/Ajax/c_accept_status.php',
			data:'ri='+ri,
			dataType:'text',
			success:function(data){
				if(data == '1'){
					$(".accept_status_infor").html('<font size="2" color="red">已成功更改为已阅</font>');
				}else{
					$(".accept_status_infor").html('<font size="2" color="red">更改失败，请重试，建议您刷新浏览器</font>');
				}
			},
			beforeSend:function(XMLHttpRequest){   /*  加载之前的效果   */
				var load = "<center><img src='Images/loader_acc.gif' width='40px' height='10px'/></center>";
				$(load).appendTo(".accept_status_infor");
			},
			complete:function(XMLHttpRequest, textStatus){    /*   加载之后    */
				$(".accept_status_infor").html('');
			}
		});
	});

});


/*添加项目开启时间和结束时间的时间插件配置start*/
$(document).ready(function(){
	$("#r_trade2").change(function(){
		var  trade =$(this).val();
		trade = trade.split('-');
		trade_code = trade[0];//行业代号
		trade_name = trade[1];//行业名称
		var hid_trade_code = $("#trade_code").val();
		//将行业代号通过 , 连接起来
		//将行业名称在页面中显示出来
		var span_trade_name = $(".trade").html();//页面中已经显示的行业名称的内容
		if(span_trade_name.length ==0){
			$("#trade_code").val(trade_code);//行业代号
			$(".trade").html('<span class="trade_tag">'+trade_name+'<span>');
		}else{
			//这里控制只能添加三项行业，如果过多在这里警告
			var arr_trade = span_trade_name.split(',');
			if(arr_trade.length >=5){
				alert('只可以选择5项行业');
			}else{
				$(".trade").html(span_trade_name+',<span class="trade_tag">'+trade_name+'<span>');
				hid_trade_code += ','+trade_code;
				$("#trade_code").val(hid_trade_code);
			}
		}
	});
	
});
/*添加项目开启时间和结束时间的时间插件配置start*/

//行业 二级联动 函数  start    注意只适用 添加项目合作的时候可用
function g_grade_s_2(){
	var trade1 = $("#r_trade1").val();//省份 Code
	$("#r_trade2").find("option").remove();//清空市县第二个下拉菜单的option
	//通过ajax获取二级菜单数据
	$.ajax({
		type:'post',
		url:'Include/Ajax/t_get2.php',
		data:'trade1='+trade1,
		dataType:'json',
		success:function(json){
			for(var one in json){
				var str='<option value='+json[one]['K_TradeId']+'-'+json[one]['K_TradeName']+'>'+json[one]['K_TradeName']+'</option>';
				$(str).appendTo("#r_trade2");
		    }
		},
		beforeSend:function(XMLHttpRequest){   /*  加载之前的效果   */
			//var load = "<center><img src='Images/loader_rec.gif' width='200px' height='10px'/></center>";
			//$(load).appendTo(".j_pj_infor");
		},
		complete:function(XMLHttpRequest, textStatus){    /*   加载之后    */
			//$("#j_pj_infor").html('');
		}
	});
}
//行业 二级联动 函数  end

//添加公司start
$(document).ready(function() {
	$("#r_user").keyup(function() {
		var userName = $(this).val();
		$.ajax({
			type:'post',
			url:'Include/Ajax/unionSearch.php',
			data:'userName='+userName,
			dataType:'json',
			success: function(data) {
				document.getElementById("r_user1").length = 0;
					var str1='<option value="请选择下列企业">请选择下列企业</option>';
					$(str1).appendTo("#r_user1");
				for(var one in data) {
					var str = '<option value='+data[one]["K_UserId"]+'-'+data[one]["K_UserName"]+'>'+data[one]["K_UserName"]+'</option>';
					$(str).appendTo("#r_user1");
				}
			}
		});
	});
});
//添加公司 end
$(document).ready(function(){
	$("#r_user1").change(function(){
		var  user =$(this).val();
		user = user.split('-');
		user_code = user[0];//企业代号
		user_name = user[1];//企业名称
		var hid_user_code = $("#user_code").val();
		//将企业代号通过 , 连接起来
		//将企业名称在页面中显示出来
		var span_user_name = $("#user").html();//页面中已经显示的行业名称的内容
		if(span_user_name.length ==0){
			$("#user_code").val(user_code);//行业代号
			$("#user").html('<span class="trade_tag">'+user_name+'<span>');
		}else{
			//这里控制只能添加三项行业，如果过多在这里警告
			var arr_user = span_user_name.split(',');
			if(arr_user.length >=5){
				alert('最多只能选择5家其他公司');
			}else{
				$("#user").html(span_user_name+',<span class="trade_tag">'+user_name+'<span>');
				hid_user_code += ','+user_code;
				$("#user_code").val(hid_user_code);
			}
		}
		//alert($("#user_code").val());
	});
	
});










