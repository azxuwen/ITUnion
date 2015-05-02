/*  START  ==================           新闻模块处理                 ==========================================   */

/*
 * 鼠标的onmousemove事件，在标题的上边显示出编辑和删除两个链接 
 * 参数 为鼠标所在的 对象
*/
function news_show_div(obj){
	//当点击这个新闻的时候，会显示一个层 然后在加载之前显示loader图
	obj.cells[3].getElementsByTagName('span')[0].style.display = 'block';//将修改 删除 的链接显示
}
/*
 * 鼠标的onmouseleave事件
 */
function news_hidden_div(obj){
	obj.cells[3].getElementsByTagName('span')[0].style.display = 'none';//将修改 删除 的链接显示
}
/*
 * 当点击删除新闻时
 */
function news_remove(n_id){
	$("#yes_remove_news").attr("onclick", "true_remove_news("+n_id+")");//将这个需要删除的新闻的ID，通过onclick函数赋给 确定按钮
	$("#remove_outer_div").show();//显示提示框  是否确定删除
}
//当点击 “不是的”的时候，将弹窗关闭
function close_remove_div(){
	$("#remove_outer_div").fadeOut();
}
//当点击 “确定” 的时候，真正的要执行删除的事件
function true_remove_news(n_id){
	$("#remove_outer_div").fadeOut('fast');//隐藏确认框
	$(".res_operator").css('left', $(window).width()/2-150);//修改结果框的位置
	$(".res_operator").css('top', $(document).scrollTop());
	//下面就需要执行删除了
	$.ajax({
		type:'post',
		url:APP+'/News/control_del/',
		data:'n_id='+n_id,
		dataType:'text',
		success:function(data){
			data = data.trim();
			if(data == 'notid'){
				$(".res_operator .res_word").html("操作有误，建议刷新浏览器");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else if(data == 'ok'){
				$(".res_operator .res_word").html("删除成功!");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else{
				$(".res_operator .res_word").html("删除失败!");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
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
/*
 * 修改新闻公告的置顶级别
 */
function up_news_top(news_id, obj){
	//调整提示框的位置
	$(".res_operator").css('left', $(window).width()/2-150);//修改结果框的位置
	$(".res_operator").css('top', $(document).scrollTop());
	//获取到前面的 指定数
	var pre_input_obj = obj.previousSibling;//前面指定输入框的对象
	var top_value = pre_input_obj.value;//输入的置顶数
	//检查输入的是否是数字
	var newPar=/^(-|\+)?\d+(\.\d+)?$/   
	if(!newPar.test(top_value)){
		$(".res_operator .res_word").html("置顶数必须是数字");
		$(".res_operator").slideDown();
		setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
		return false;
	}
	//下面通过Ajax来修改置顶级别
	var up_news_top_str = news_id+"-" +top_value;
	$.ajax({
		type:'post',
		url:APP+'/News/up_news_top/',
		data:'up_news_top_str='+up_news_top_str,
		dataType:'text',
		success:function(data){
			data = data.trim();
			if(data == 'error'){
				$(".res_operator .res_word").html("操作有误，建议刷新浏览器");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else if(data == 'ok'){
				$(".res_operator .res_word").html("修改成功");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else{
				$(".res_operator .res_word").html("修改失败，请重试");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}
		},
		beforeSend:function(XMLHttpRequest){   /*  加载之前的效果   */
			//$(".load_recruit_infor").html("<img src='/ITUnion/Public/Images/loaders/loader12.gif' width='200px' height='12px'/>");
		},
		complete:function(XMLHttpRequest, textStatus){    /*   加载之后    */
			//$(".load_recruit_infor").html("");
		}
	});
}
/*
 * 当点击修改新闻公告的button按钮事件
*/
function news_edit_click(){
	if($("input[name='news_title']").val().length == 0){
		alert("未填写资讯标题");
		return false;
	}
	$("#admin_form").submit();
}
 /*
  * 批量删除新闻公告的点击事件
  */
function quantities_del(){
	$(".res_operator").css('left', $(window).width()/2-150);//修改结果框的位置
	$(".res_operator").css('top', $(document).scrollTop());
	//因为是批量删除，所以需要获得需要删除的新闻的 多个 ID
	var quantities_news_id = "";
	$("input[class='quantities_news_check']:checked").each(function () {
		if($(this).val() != ""){
			quantities_news_id += $(this).val()+"-";//多个新闻ID通过 “-”来连接
		}
    });
	//如果一个也没有选
	if(quantities_news_id.length == 0){
		$(".res_operator .res_word").html("还没有选中具体新闻");
		$(".res_operator").slideDown();
		setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
		return false;
	}
	quantities_news_id = quantities_news_id.substr(0, quantities_news_id.length-1);//将最后的 “-”去掉
	//下面通过Ajax来删除新闻
	$.ajax({
		type:'post',
		url:APP+'/News/control_quantities_del/',
		data:'quantities_news_id='+quantities_news_id,
		dataType:'text',
		success:function(data){
			data = data.trim();//去掉空格
			if(data == 'error'){
				//一项也没有删除
				$(".res_operator .res_word").html("删除失败!");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}
			if(data == 'ok'){
				//已经全部删除
				$(".res_operator .res_word").html("删除成功，建议刷新浏览器");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}
			if(data == 'no'){
				//没有全部删除，有一部分没有删除
				$(".res_operator .res_word").html("没有全部删除，请刷新页面重试");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
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
/*  END  ==================           新闻模块处理                 ==========================================   */
  
/*  START  ==================           用户模块处理                 ==========================================   */
  
/*
 * 当点击查看用户信息的时候，弹出一个层，来显示具体信息
*/
function look_user(user_id){
	$("#remove_outer_div").fadeIn();
	$.ajax({
		type:'post',
		url:APP+'/User/get_user_infor/',
		data:'user_id='+user_id,
		dataType:'json',
		success:function(data){
			$(".user_name").html(data[0]['K_UserName']);
			$(".user_email").html(data[0]['K_UserEmail']);
			$(".user_").html(data[0]['K_UserName']);
			$(".user_reg_time").html(data[0]['K_UserJoinTime'].substr(0, 10));
			$(".user_land_time").html(data[0]['K_UserLandTime'].substr(0, 10));
			if(data[0]['K_UserType'] == 'c'){
				$(".user_type").html("企业用户");
			}else{
				$(".user_type").html("个人用户");
			}
			$(".user_integral").html("<span class='class_integral_count'>"+data[0]['K_UserIntegral']+"</span>      <a href='#up_integral' onclick='update_user_integral("+user_id+")'>[修改积分]</a>  <input type='text' class='user_add_integral' style='display:none;'/><button style='display:none;' class='up_integeral_button' onclick='submit_up_user_integral("+user_id+")'>提交</button>");
			if(data[0]['K_UserBirthday'] == null){
				$(".user_birthday").html('未填写');
			}else{
				$(".user_birthday").html(data[0]['K_UserBirthday']);
			}
			if(data[0]['K_UserPhone'] == null){
				$(".user_phone").html('未填写');
			}else{
				$(".user_phone").html(data[0]['K_UserPhone']);
			}
			if(data[0]['K_UserIntroduce'] == null){
				$(".user_introduce").html('未填写');
			}else{
				$(".user_introduce").html(data[0]['K_UserIntroduce']);
			}
			if(data[0]['K_Verify'] == 'y'){
				$(".user_verify").html("<img src='/ITUnion/Public/Images/icons/notifications/accept.png' width='30px' height='30px'/>用户已激活");
			}else{
				$(".user_verify").html("<img src='/ITUnion/Public/Images/icons/notifications/information.png' width='30px' height='30px'/>用户未激活");
			}
		},
		beforeSend:function(XMLHttpRequest){   /*  加载之前的效果   */
			$(".load_user_infor").html("<img src='/ITUnion/Public/Images/loaders/loader12.gif' width='200px' height='12px'/>");
		},
		complete:function(XMLHttpRequest, textStatus){    /*   加载之后    */
			$(".load_user_infor").html("");
		}
	});
}
/*关闭查看用户信息的层*/
function close_user_div(){
	$("#remove_outer_div").fadeOut();
}
/*  点击修改用户积分  时 显示 输入框 和 按钮 */
function update_user_integral(user_id){
	//显示输入框
	$(".user_add_integral").show();
	$(".up_integeral_button").show();
	
}
function submit_up_user_integral(user_id){
	var user_add_integral = $(".user_add_integral").val();
	if(user_add_integral.length == ""){
		alert('未填写积分');
		return false;
	}
	var up_user_integral = user_id+"-"+user_add_integral;
	//很简单的通过ajax来修改用户积分
	$.ajax({
		type:'post',
		url:APP+'/User/update_user_integral/',
		data:'up_user_integral='+up_user_integral,
		dataType:'text',
		success:function(data){
			data = data.trim();
			if(data == 'ok'){
				//修改成功
				$(".user_add_integral").hide();
				$(".up_integeral_button").hide();
				$(".class_integral_count").html(user_add_integral);//将修改的积分修改
				$(".res_operator .res_word").html("修改积分成功!");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else if(data == 'no'){
				$(".res_operator .res_word").html("修改积分失败!");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}
		},
		beforeSend:function(XMLHttpRequest){   /*  加载之前的效果   */
			$(".load_user_infor").html("<img src='/ITUnion/Public/Images/loaders/loader12.gif' width='200px' height='12px'/>");
		},
		complete:function(XMLHttpRequest, textStatus){    /*   加载之后    */
			$(".load_user_infor").html("");
		}
	});
}
/* 
 * User/index 中 当点击屏蔽该用户时，也就是此时这个用户登录不了，将数据库中的K_Verify改为 n
 	如果是点击 结束屏蔽该用户 时，就是可以登录了
*/
function edit_user_shield(user_id, obj){
	//如果链接内容是 屏蔽该用户 那么就是执行这个ajax
	if(obj.innerHTML.trim() == "屏蔽该用户"){
		$.ajax({
			type:'post',
			url:APP+'/User/open_user_shield/',
			data:'user_id='+user_id,
			dataType:'text',
			success:function(data){
				data = data.trim();//去掉空格
				if(data == 'error'){
					//如果出现错误
					$(".res_operator").css('left', $(window).width()/2-150);//修改结果框的位置
					$(".res_operator").css('top', $(document).scrollTop());
					$(".res_operator .res_word").html("处理错误，请重试");
					$(".res_operator").slideDown();
					setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
					return false;
				}
				if(data == 'ok'){
					$(".res_operator").css('left', $(window).width()/2-150);//修改结果框的位置
					$(".res_operator").css('top', $(document).scrollTop());
					//如果成功屏蔽该用户
					$(".res_operator .res_word").html("成功屏蔽该用户");
					$(".res_operator").slideDown();
					setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
					//同时将 点击的链接的名称修改成功  结束屏蔽该用户
					obj.innerHTML = "结束屏蔽该用户";
					return false;
				}
				if(data == 'no'){
					//如果屏蔽失败
					$(".res_operator").css('left', $(window).width()/2-150);//修改结果框的位置
					$(".res_operator").css('top', $(document).scrollTop());
					$(".res_operator .res_word").html("操作失败");
					$(".res_operator").slideDown();
					setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
					return false;
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
	if(obj.innerHTML.trim() == "结束屏蔽该用户"){
		$.ajax({
			type:'post',
			url:APP+'/User/close_user_shield/',
			data:'user_id='+user_id,
			dataType:'text',
			success:function(data){
				data = data.trim();//去掉空格
				if(data == 'error'){
					//如果出现错误
					$(".res_operator").css('left', $(window).width()/2-150);//修改结果框的位置
					$(".res_operator").css('top', $(document).scrollTop());
					$(".res_operator .res_word").html("处理错误，请重试");
					$(".res_operator").slideDown();
					setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
					return false;
				}
				if(data == 'ok'){
					$(".res_operator").css('left', $(window).width()/2-150);//修改结果框的位置
					$(".res_operator").css('top', $(document).scrollTop());
					//如果成功屏蔽该用户
					$(".res_operator .res_word").html("成功结束屏蔽该用户");
					$(".res_operator").slideDown();
					setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
					//同时将 点击的链接的名称修改成功  结束屏蔽该用户
					obj.innerHTML = "屏蔽该用户";
					return false;
				}
				if(data == 'no'){
					//如果屏蔽失败
					$(".res_operator").css('left', $(window).width()/2-150);//修改结果框的位置
					$(".res_operator").css('top', $(document).scrollTop());
					$(".res_operator .res_word").html("操作失败");
					$(".res_operator").slideDown();
					setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
					return false;
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
}

/*
 * 在User/index中  向用户发送站内信
 * */
function send_message(user_id, user_name){
	$(".send_mess_userid").val(user_id);
	$(".send_user_name").html(user_name);
	$("#send_outer_div").fadeIn();
}
/*关闭 发送站内信 的函数*/
function close_send_mess_div(){
	$("#send_outer_div").fadeOut();
}
/*
 * 点击 向用户 发送 站内信 的 按钮 事件
 */
function send_button(){
	var user_id = $(".send_mess_userid").val();
	var send_mess_con = $(".send_mess_con").val();
	if(user_id == null){
		$(".send_mess_noti_info").html("<font color='red' size='15'>提交出错，请重试</font>");
		return false;
	}else{
		$(".send_mess_noti_info").html("");
	}
	if(send_mess_con.trim().length == 0){
		$(".send_mess_noti_info").html("<font color='red' size='15'>未填写发送信息</font>");
		return false;
	}else{
		$(".send_mess_noti_info").html("");
	}
	//这里执行提交 站内信
	var send_info_str = user_id+"^"+send_mess_con;
	$.ajax({
		type:'post',
		url:APP+'/Message/send_mess_to_user/',
		data:'send_info_str='+send_info_str,
		dataType:'text',
		success:function(data){
			data = data.trim();//去掉空格
			if(data == 'ok'){
				$("#send_outer_div").fadeOut();
				$(".res_operator").css('left', $(window).width()/2-150);//修改结果框的位置
				$(".res_operator").css('top', $(document).scrollTop());
				//如果成功屏蔽该用户
				$(".res_operator .res_word").html("发送成功");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else if(data == 'no'){
				$(".res_operator").css('left', $(window).width()/2-150);//修改结果框的位置
				$(".res_operator").css('top', $(document).scrollTop());
				//如果成功屏蔽该用户
				$(".res_operator .res_word").html("发送失败，请重试");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}
		}
	});
}
/*  END  ==================           用户模块处理                 ==========================================   */

/*  START  ==================           产品模块处理                 ==========================================   */
/*
 * 点击添加图片时，出现添加图片的层
 */
function start_add_product_pic(){
	$("#remove_outer_div1").fadeIn();
}
/*
 * 点击取消添加图片时的点击事件 去掉添加图片层
 */
function cancel_ad_pro_pic(){
	$("#remove_outer_div1").fadeOut();
}
/*
 * 真正的 点击 提交图片 时 的 点击事件
*/
function add_product_pic(){
	if($("#add_product_pic_input").val() ==""){
		alert('还未选择图片');
		return false;
	}
	$("#add_product_pic_form").submit();
}
/*
 * 当要在 Product/edit  中要移除具体产品的 图片时，将图片删除   Upload/Images/1.jpg,Upload/Images/2.jpg,.....   参数为 其中的图片地址的序号 例如 如果参数为2  就删除掉  Upload/Images/2.jpg ,以此类推
 * 参数1 为 需要删除图片的地址的序号 
 * 参数2 为 需要删除图片的产品ID
 * 参数3 为 删除图片的 JS对象
 */
function remove_pdt_pic_appe(pic_order, product_id, obj){
	if(pic_order < 0){
		alert('系统错误，请重试');
		return false;
	}
	var rmv_pic_str = pic_order+"-"+product_id;
	var pre_obj = obj.previousSibling;	//获取 这个 [移除] 链接的图片对象
	//下面通过ajax来执行移除图片的地址
	$.ajax({
		type:'post',
		url:APP+'/Product/remove_product_pic_address/',
		data:'rmv_pic_str='+rmv_pic_str,
		dataType:'text',
		success:function(data){
			data = data.trim();//去掉空格
			if(data == 'ok'){
				//obj.style.display = "none";
				pre_obj.remove();//删除 这个图片节点
				obj.remove();//删除这个 [移除] 的链接
				$(".res_operator").css('left', $(window).width()/2-150);//修改结果框的位置
				$(".res_operator").css('top', $(document).scrollTop());
				$(".res_operator .res_word").html("移除成功");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else if(data == 'no'){
				$(".res_operator").css('left', $(window).width()/2-150);//修改结果框的位置
				$(".res_operator").css('top', $(document).scrollTop());
				$(".res_operator .res_word").html("移除失败");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else{
				//操作 错误  error
				$(".res_operator").css('left', $(window).width()/2-150);//修改结果框的位置
				$(".res_operator").css('top', $(document).scrollTop());
				$(".res_operator .res_word").html("系统错误，请重试");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}
		}
	});
}
/*
 * 修改产品的置顶级别
 * 参数1  产品 ID
 * 参数2  修改链接的 JS对象
 */
function up_product_top(product_id, obj){
	//调整提示框的位置
	$(".res_operator").css('left', $(window).width()/2-150);//修改结果框的位置
	$(".res_operator").css('top', $(document).scrollTop());
	//获取到前面的 指定数
	var pre_input_obj = obj.previousSibling;//前面指定输入框的对象
	var top_value = pre_input_obj.value;//输入的置顶数
	//检查输入的是否是数字
	var newPar=/^(-|\+)?\d+(\.\d+)?$/   
	if(!newPar.test(top_value)){
		$(".res_operator .res_word").html("置顶数必须是数字");
		$(".res_operator").slideDown();
		setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
		return false;
	}
	//下面通过Ajax来修改置顶级别
	var up_product_top_str = product_id+"-" +top_value;
	$.ajax({
		type:'post',
		url:APP+'/Product/up_product_top/',
		data:'up_product_top_str='+up_product_top_str,
		dataType:'text',
		success:function(data){
			data = data.trim();
			if(data == 'error'){
				$(".res_operator .res_word").html("操作有误，建议刷新浏览器");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else if(data == 'ok'){
				$(".res_operator .res_word").html("修改成功");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else{
				$(".res_operator .res_word").html("修改失败，请重试");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}
		},
		beforeSend:function(XMLHttpRequest){   /*  加载之前的效果   */
			//$(".load_recruit_infor").html("<img src='/ITUnion/Public/Images/loaders/loader12.gif' width='200px' height='12px'/>");
		},
		complete:function(XMLHttpRequest, textStatus){    /*   加载之后    */
			//$(".load_recruit_infor").html("");
		}
	});
}
/*
 * 点击 修改 产品所属  公司  的链接时 出现 选择企业的下拉菜单  和 输入框
*/
function start_upd_product_com(obj){
	get_company_name("");
	document.getElementById('end_upd_a').style.display = "block";
	obj.style.display = 'none';
	$("#upd_pro_user").show();
}
function end_upd_product_com(obj){
	document.getElementById('start_upd_a').style.display = "block";
	obj.style.display = 'none';
	$("#upd_pro_user").hide();
}
/*
 * 当输入 输入框   输入事件 
*/
function input_select_company(obj){
	 get_company_name(document.getElementById('select_company').value);
}
/*
 * 获取 全部 或 部分的企业信息 主要通过参数 username来控制，如果无参数 意味着取全部，如果有参数，则意味这需要通过like查找到企业
*/
function get_company_name(username){
	$.ajax({
		type:'get',
		data:'username='+username,
		url:APP+'/User/ajax_get_company_name/',
		dataType:'json',
		success:function(json){
			$(".company_list_select").empty();
			$("<option value='88888'>选择具体企业</option>").appendTo(".company_list_select");
			var res_count = 0;
			for(var one in json){
				res_count++;
				var str='<option value='+json[one]['K_UserId']+'>'+json[one]['K_UserName']+'</option>';
				$(str).appendTo(".company_list_select");
		    }
			$("#input_select_res").html(res_count);
		}
	});
}
/*
 * 下拉菜单的 onchange事件 ，当触发这个事件时，将下拉菜单的选中 文字 添加到 只读框中 把value值 存放到id为HIDDEN_PRODUCT_COMPANY的隐藏域中
 */
function change_select_company(obj){
	if(obj.value != "88888"){
		document.getElementById('INPUT_PRODUCT_COMPANY').value = obj.options[obj.selectedIndex].text;
		document.getElementById('HIDDEN_PRODUCT_COMPANY').value = obj.value;
	}
}

/*
 * 当点击提交修改的时候，需要一些验证
 */
function product_edit_click(){
	//验证产品 title
	if(document.getElementById('product_title').value == ""){
		alert('产品标题不能为空');
		return false;
	}
	$("#product_edit_form").submit();
}

/*
* 当点击删除
*/
function product_remove(p_id){
	$("#yes_remove_product").attr("onclick", "true_remove_product("+p_id+")");//将这个需要删除的新闻的ID，通过onclick函数赋给 确定按钮
	$("#remove_outer_div").show();//显示提示框  是否确定删除
}
//当点击 “不是的”的时候，将弹窗关闭
function close_remove_div(){
	$("#remove_outer_div").fadeOut();
}
//当点击 “确定” 的时候，真正的要执行删除的事件
function true_remove_product(p_id){
	$("#remove_outer_div").fadeOut('fast');//隐藏确认框
	$(".res_operator").css('left', $(window).width()/2-150);//修改结果框的位置
	$(".res_operator").css('top', $(document).scrollTop());
	//下面就需要执行删除了
	$.ajax({
		type:'post',
		url:APP+'/Product/control_del/',
		data:'p_id='+p_id,
		dataType:'text',
		success:function(data){
			data = data.trim();
			if(data == 'error'){
				$(".res_operator .res_word").html("操作有误，建议刷新浏览器");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else if(data == 'ok'){
				$(".res_operator .res_word").html("删除成功!");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else{
				$(".res_operator .res_word").html("删除失败!");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
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
/*
 * 在添加 产品 页面 增加一个 图片 输入框
 */
function add_new_pic_input(){
	var new_file_input = '<div><input type="file" name="photo[]" id="pro_pic" /><a href="#ad_new_pic_input" style="position:relative;left:200px;" onclick="cancel_new_pic_input(this)">[取消]</a></div>';
	$(new_file_input).appendTo($(".product_pic_td"));//添加新 文件 表单
}
/*
 * 当点击取消这个添加这个 新图片输入框的时候  将前面的输入框删掉
 */
function cancel_new_pic_input(obj){
	//获取当前这个  [取消] 链接的上一个节点
	obj.parentNode.remove();//点击取消时  将新添加的 文件表单  外层div删除
}
 
/*
 * 当点击 提交产品 按钮 时 
 */
function product_add_click(){
	//表单验证
	if($("#product_title").val() == ""){
		alert('还未输入产品标题');
		return false;
	}
	if($("#HIDDEN_PRODUCT_COMPANY").val() ==""){
		alert('还未选择具体企业');
		return false;
	}
	if($("#pro_pic").val() == ""){
		alert('至少要上传一张产品配图');
		return false;
	}
	$("#product_add_form").submit();
}

/*  END  ==================           产品模块处理                ==========================================   */




/*  START  ==================           知识共享模块处理                ==========================================   */
/*
 * 当点击删除 知识共享时 的 函数
 */
function share_remove(share_id){
	//会显示出提示框 到底删不删除呢
	$("#yes_remove_product").attr("onclick", "true_remove_share("+share_id+")");//将这个需要删除的知识的ID，通过onclick函数赋给 确定按钮
	$("#remove_outer_div").fadeIn();	
}
/*
 * 真正执行删除 知识共享
 */
function true_remove_share(s_id){
	//通过ajax来删除知识
	$.ajax({
		type:'post',
		url:APP+'/Share/control_del/',
		data:'s_id='+s_id,
		dataType:'text',
		success:function(data){
			data = data.trim();
			if(data == 'error'){
				$(".res_operator .res_word").html("操作有误，建议刷新浏览器");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else if(data == 'ok'){
				//删除成功，将 提示 是否删除的 层 去掉
				$("#remove_outer_div").hide();
				$(".res_operator .res_word").html("删除成功!");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else{
				$(".res_operator .res_word").html("删除失败!");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
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

/*  END  ==================           知识共享模块处理                ==========================================   */

/*  START  ==================           人才管理(招聘应聘)模块处理                ==========================================   */
/*
 * Recruit/index 中 当点击 标题处  详细信息时  弹出个框
 */
function recruit_detail(recruit_id){
	$("#remove_outer_div1").fadeIn();
	$.ajax({
		type:'post',
		url:APP+'/Recruit/get_recruit_infor/',
		data:'recruit_id='+recruit_id,
		dataType:'json',
		success:function(data){
			$(".recruit_location").html(data[0]['K_RecruitLocation']);
			$(".recruit_salary").html(data[0]['K_RecruitSalary']);
			$(".recruit_degree").html(data[0]['K_RecruitDegree']);
			if(data[0]['K_RecruitContent'] != ""){
				$(".recruit_content").html(data[0]['K_RecruitContent']);
			}else{
				$(".recruit_content").html('未填写');
			}
			
		},
		beforeSend:function(XMLHttpRequest){   /*  加载之前的效果   */
			$(".load_recruit_infor").html("<img src='/ITUnion/Public/Images/loaders/loader12.gif' width='200px' height='12px'/>");
		},
		complete:function(XMLHttpRequest, textStatus){    /*   加载之后    */
			$(".load_recruit_infor").html("");
		}
	});
}
/*
 * 当显示出 招聘 详细信息的层的时候 点击 close 隐藏层
 */
function close_recruit_detail(){
	$("#remove_outer_div1").fadeOut();
}
/*
 * 点击 删除 招聘信息 时 会出现提示框 确定到底删不删除
 */
function recruit_remove(recruit_id){
	//会显示出提示框 到底删不删除呢
	$("#yes_remove_product").attr("onclick", "true_remove_recruit("+recruit_id+")");//将这个需要删除的知识的ID，通过onclick函数赋给 确定按钮
	$("#remove_outer_div").fadeIn();	
}
function true_remove_recruit(recruit_id){
	$("#remove_outer_div").fadeOut('fast');//隐藏确认框
	$(".res_operator").css('left', $(window).width()/2-150);//修改结果框的位置
	$(".res_operator").css('top', $(document).scrollTop());
	//执行删除
	$.ajax({
		type:'post',
		url:APP+'/Recruit/remove_recruit/',
		data:'recruit_id='+recruit_id,
		dataType:'text',
		success:function(data){
			if(data == 'error'){
				$(".res_operator .res_word").html("操作有误，建议刷新浏览器");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else if(data == 'ok'){
				$(".res_operator .res_word").html("删除成功");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else{
				$(".res_operator .res_word").html("删除失败，请重试");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}
		},
		beforeSend:function(XMLHttpRequest){   /*  加载之前的效果   */
			//$(".load_recruit_infor").html("<img src='/ITUnion/Public/Images/loaders/loader12.gif' width='200px' height='12px'/>");
		},
		complete:function(XMLHttpRequest, textStatus){    /*   加载之后    */
			//$(".load_recruit_infor").html("");
		}
	});
}
/*
 * 修改招聘信息的置顶信息
 * 参数1 为 需要修改的招聘信息的 ID 
 * 参数2  为 这个链接的 对象
 */
function up_recruit_top(recruit_id, obj){
	//调整提示框的位置
	$(".res_operator").css('left', $(window).width()/2-150);//修改结果框的位置
	$(".res_operator").css('top', $(document).scrollTop());
	//获取到前面的 指定数
	var pre_input_obj = obj.previousSibling;//前面指定输入框的对象
	var top_value = pre_input_obj.value;//输入的置顶数
	//检查输入的是否是数字
	var newPar=/^(-|\+)?\d+(\.\d+)?$/   
	if(!newPar.test(top_value)){
		$(".res_operator .res_word").html("置顶数必须是数字");
		$(".res_operator").slideDown();
		setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
		return false;
	}
	//下面通过Ajax来修改置顶级别
	var up_recruit_top_str = recruit_id+"-" +top_value;
	$.ajax({
		type:'post',
		url:APP+'/Recruit/up_recruit_top/',
		data:'up_recruit_top_str='+up_recruit_top_str,
		dataType:'text',
		success:function(data){
			if(data == 'error'){
				$(".res_operator .res_word").html("操作有误，建议刷新浏览器");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else if(data == 'ok'){
				$(".res_operator .res_word").html("修改成功");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else{
				$(".res_operator .res_word").html("修改失败，请重试");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}
		},
		beforeSend:function(XMLHttpRequest){   /*  加载之前的效果   */
			//$(".load_recruit_infor").html("<img src='/ITUnion/Public/Images/loaders/loader12.gif' width='200px' height='12px'/>");
		},
		complete:function(XMLHttpRequest, textStatus){    /*   加载之后    */
			//$(".load_recruit_infor").html("");
		}
	});
}
 
/*  END  ==================           人才管理(招聘应聘)模块处理                ==========================================   */
 
 /*  START ==================           合作项目管理模块处理                ==========================================   */
/*
 * 点击删除某个项目   会弹出提示框  是否真正的删除项目
 */
function project_remove(p_id){
	$("#yes_remove_product").attr("onclick", "true_remove_project("+p_id+")");//将这个需要删除的新闻的ID，通过onclick函数赋给 确定按钮
	$("#remove_outer_div").show();//显示提示框  是否确定删除
}
/*
 * 点击  确定  执行 真正的删除
 */
function true_remove_project(p_id){
	$("#remove_outer_div").fadeOut('fast');//隐藏确认框
	$(".res_operator").css('left', $(window).width()/2-150);//修改结果框的位置
	$(".res_operator").css('top', $(document).scrollTop());
	//下面就需要执行删除了
	$.ajax({
		type:'post',
		url:APP+'/Project/control_del/',
		data:'p_id='+p_id,
		dataType:'text',
		success:function(data){
			data = data.trim();
			if(data == 'notid'){
				$(".res_operator .res_word").html("操作有误，建议刷新浏览器");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else if(data == 'ok'){
				$(".res_operator .res_word").html("删除成功!");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
			}else{
				$(".res_operator .res_word").html("删除失败!");
				$(".res_operator").slideDown();
				setTimeout("$('.res_operator').slideUp()", 1500);//定时隐藏
				return false;
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

/*
 * 当点击 详细信息 时  弹出一个框 来显示 具体的项目 信息
 */
function project_detail(p_id){
	$("#remove_outer_div1").fadeIn();
	$.ajax({
		type:'post',
		url:APP+'/Project/getProjectInfo/',
		data:'p_id='+p_id,
		dataType:'json',
		success:function(data){
			$(".project_name").html(data[0]['K_ProjectName']);
			$(".project_union").html(data[0]['K_ProjectUnion']);
			if(data[0]['K_ProjectContent'] != ""){
				$(".project_content").html(data[0]['K_ProjectContent']);
			}else{
				$(".project_content").html('未填写');
			}
			
		},
		beforeSend:function(XMLHttpRequest){   /*  加载之前的效果   */
			$(".load_recruit_infor").html("<img src='/ITUnion/Public/Images/loaders/loader12.gif' width='200px' height='12px'/>");
		},
		complete:function(XMLHttpRequest, textStatus){    /*   加载之后    */
			$(".load_recruit_infor").html("");
		}
	});
}
 /*  END  ==================           合作项目管理模块处理                ==========================================   */