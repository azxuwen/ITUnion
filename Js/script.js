/*
 * 创建者 : 徐文志 
 * 创建时间 : 2014 01 27  14:08 
 * 站点归属 ：IT联盟(哈尔滨理工大学创新实验)
 * 页面功能 : 主要处理一些基本的JS事件 例如 用户登录 注册等等
*/
$(document).ready(function(){
	//当点击登录时的JS+Ajax处理  start
	$("#LoginSubmit").click(function(){
		var UserEmail = $("#UserName").val();//用户名
		var UserPass = $("#UserPass").val();//密码	
		if(UserEmail.length == 0){
			$(".logininfor").html('<font color="red" size="2">您似乎还没有输入账号呢</font>');
			return false;
		}
		 $.ajax({
			  url:"Include/Ajax/checkUserExists.php",
			  type:"POST",
			  data:"UserEmail="+UserEmail,
			  success:function(data){
				  if(data == "0"){
					 $(".logininfor").html('<font color="red" size="2">用户名邮箱格式似乎输入错了</font>');
					 return false;
				  }else{
					  if(UserPass.length >= 6 && UserPass.length <=15){
						 $(".form-2").submit();
						 return false;
					  }else{
						 if(UserPass.length  == 0){
							$(".logininfor").html('<font color="red" size="2">您似乎还没有输入密码呀</font>');
							return false;
						 }else{
							$(".logininfor").html('<font color="red" size="2">密码应该在6-15位之间噢</font>');
							return false;
						 }
					  }
				  }
			  }
		  });
	});
	//当点击登录时的JS+Ajax处理  end
	//输入注册信息时，核对注册信息的JS+Ajax事件 start
	$("#UserEmail").focus(function(){
		$(this).keydown(function(){
			$("#reginfor").html('<font color="gray" size="2">填写您常用的邮箱</font>');
		});
	}).blur(function(){
		var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (!filter.test($(this).val())){
			$("#reginfor").html('<font color="red" size="2">您填写的邮箱格式似乎有点问题</font>');
		}else{
			$("#reginfor").html('');
		}
	});
	$("#UserPass1").focus(function(){
		$(this).keydown(function(){
			$("#reginfor").html('<font color="gray" size="2">填写6-15位包含英文和数字的密码</font>');
		});
	}).blur(function(){
		var filter  = /^[a-z | A-Z | 0-9]\w{5,15}/;
		if (!filter.test($(this).val())){
			$("#reginfor").html('<font color="red" size="2">请填写6-15位只包含英文和数字的密码</font>');
		}else{
			$("#reginfor").html('');
		}
		if($(this).val().length > 15){
			$("#reginfor").html('<font color="red" size="2">密码过长</font>');
		}else{
			$("#reginfor").html('');
		}
	});
	
	$("#UserPass2").focus(function(){
		$(this).keydown(function(){
			$("#reginfor").html('<font color="gray" size="2">核实刚刚填写的密码</font>');
		});
	}).blur(function(){
		
	});
	$("#UserName").focus(function(){
		$("#reginfor").html('');
	}).blur(function(){
		var filter  = /([\u4E00-\u9FA5]+|[a-zA-Z]+)/;
		if (!filter.test(UserName)){
			var radio = $("input[name='UserType']:checked").val();
			if(radio == 'c'){
				$("#reginfor").html('<font color="red" size="2">请填写正确的企业名称</font>');
			}else if(radio == 'p'){
				$("#reginfor").html('<font color="red" size="2">请填写正确中文名字</font>');
			}
			return false;
		}
	});
	//输入注册信息时，核对注册信息的JS+Ajax事件 end
	//点击注册时的JS+Ajax处理  start
	$("#RegSubmit").click(function(){
		//验证邮箱格式是否正确start
		var UserEmail = $("#UserEmail").val();
		if(UserEmail.length == 0){
			$("#reginfor").html('<font color="red" size="2">您还未填写邮箱呢</font>');
			return false;
		}
		var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (!filter.test(UserEmail)){
			$("#reginfor").html('<font color="red" size="2">您填写的邮箱格式似乎有点问题</font>');
			return false;
		}
		var temp_data = 0;
		$.ajax({
			  url:"Include/Ajax/checkUserExists.php",
			  type:"POST",
			  data:"UserEmail="+UserEmail,
			  async:false,
			  success:function(data){
				  if(data == "1"){
					 temp_data = 1;
				  }
			  }
		  });
		if(temp_data == 1){
			$("#reginfor").html('<font color="red" size="2">该邮箱已经注册过了，请选择其他邮箱</font>');
			return false;
		}
		//验证邮箱格式是否正确end
		var UserPass1 = $("#UserPass1").val().trim();
		var UserPass2 = $("#UserPass2").val().trim();
		if(UserPass1.length < 6){
			$("#reginfor").html('<font color="red" size="2">密码长度过短，请输入6-15位密码</font>');
			return false;
		}
		if(UserPass1.length > 15){
			$("#reginfor").html('<font color="red" size="2">密码长度过长，请输入6-15位密码</font>');
			return false;
		}
		if(UserPass1 != UserPass2){
			$("#reginfor").html('<font color="red" size="2">两次密码不一致，重新填写一下吧</font>');
			return false;
		}
		var UserName = $("#UserName").val().trim();
		if(UserName.length == 0){
			var radio = $("input[name='UserType']:checked").val();
			if(radio == 'c'){
				$("#reginfor").html('<font color="red" size="2">您还未填写企业名称呢</font>');
			}else if(radio == 'p'){
				$("#reginfor").html('<font color="red" size="2">您还未填写您的中文姓名呢</font>');
			}
		}
		var filter  = /([\u4E00-\u9FA5]+|[a-zA-Z]+)/;
		if (!filter.test(UserName)){
			var radio = $("input[name='UserType']:checked").val();
			if(radio == 'c'){
				$("#reginfor").html('<font color="red" size="2">请填写正确的企业名称</font>');
			}else if(radio == 'p'){
				$("#reginfor").html('<font color="red" size="2">请填写正确中文名字</font>');
			}
			return false;
		}
		$("#regForm").submit();//提交表单
	});
	//点击注册时的JS+Ajax处理  end

	//找回密码start
	$("#lp_next1").click(function(){
		var lp_email = $("#lp_email").val();
		if(lp_email.length == 0){
			$(".lp_email_infor").html('<font color="black" size="2">您还未填写电子邮件地址</font>');
			return false;
		}
		var temp_var = 0;
		$.ajax({
			  url:"Include/Ajax/checkUserExists.php",
			  type:"POST",
			  data:"UserEmail="+lp_email,
			  async:false,
			  success:function(data){
				  if(data == "0"){
					  temp_var = 1;
				  }
			  }
		});
		if(temp_var == 1){
			$(".lp_email_infor").html('<font color="black" size="2">该邮箱并没有在这里注册，请您核实</font>');
			return false;
		}
		//下面通过ajax向用户发送一封邮件start
		var lp_hid_code = $("#lp_hid_code").val();
		var lp_vars = lp_email+"-"+lp_hid_code;
		$.ajax({
			  url:"Include/Ajax/lp_post_email.php",
			  type:"POST",
			  data:"lp_vars="+lp_vars,
			  success:function(data){
				  if(data == "0"){
					 $(".lp_email_infor").html('<font color="black" size="2">抱歉，系统错误，请您刷新页面从新找回密码</font>');
					 return false;
				  }
			  }
		});
		//下面通过ajax向用户发送一封邮件end
		$("#lp_field_1").slideUp(1000);//让这个表单消失
		$("#lp_field_2").slideDown(1000);//让下一个表单出现
	});
	$("#lp_next2").click(function(){
		//点击第二个下一步，用户输入邮件中的验证码，然后我们获取这个验证码然后和之前隐藏在页面中的验证码判断是否匹配
		var emailcode = $("#verifycode").val().trim();
		var hidcode = $("#lp_hid_code").val().trim();
		if(emailcode != hidcode){
			$(".lp_code_infor").html('<font color="red" size="2">您输入的验证码不正确</font>');
			return false;
		}else{
			$("#lp_field_2").slideUp(1000);//让这个表单消失
			$("#lp_field_3").slideDown(1000);//让下一个表单出现
		}
	});
	$("#lp_next3").click(function(){
		//点击第三个修改密码的按钮
		var lp_pass1 = $("#lp_pass1").val().trim();
		var lp_pass2 = $("#lp_pass2").val().trim();
		if(lp_pass1.length < 6){
			$("#lp_pass_infor").html('<font color="black" size="2">密码长度过短，请输入6-15位密码</font>');
			return false;
		}
		if(lp_pass1.length > 15){
			$("#lp_pass_infor").html('<font color="black" size="2">密码长度过长，请输入6-15位密码</font>');
			return false;
		}
		if(lp_pass1 != lp_pass2){
			$("#lp_pass_infor").html('<font color="black" size="2">两次密码不一致，重新填写一下吧</font>');
			return false;
		}
		var lp_email = $("#lp_email").val();//要修改密码的邮箱
		var lp_up_vars = lp_email+"-"+lp_pass1;
		$.ajax({
			  url:"Include/Ajax/lp_up_pass.php",
			  type:"POST",
			  data:"lp_up_vars="+lp_up_vars,
			  success:function(data){
				  if(data == "1"){
					 $("#lp_field_3").slideUp(1000);//让这个表单消失
					 $("#lp_ok").slideDown(1000);//让下一个表单出现
					 return false;
				  }
				  if(data == "0"){
						 $("#lp_field_3").slideUp(1000);//让这个表单消失
						 $("#lp_no").slideDown(1000);//让下一个表单出现
						 return false;
				  }
			  }
		});
	});
	//找回密码end
});







