$(document).ready(function(){
	$("#r_button").click(function(){
		var r_title = $("#r_title").val().trim();//招聘标题
		var r_position = $("#r_position").val().trim();//招聘职位
		if(r_title.length == 0){
			$(".r_infor").html('<font color="red" size="2">您还未输入招聘标题</font>');
			return false;
		}else{
			$(".r_infor").html('');
		}
		if(r_title.length > 30){
			$(".r_infor").html('<font color="red" size="2">您输入的招聘标题过长，建议您控制在30字以内</font>');
			return false;
		}else{
			$(".r_infor").html('');
		}
		if(r_position.length == 0){
			$(".r_infor").html('<font color="red" size="2">您还未输入招聘职位</font>');
			return false;
		}else{
			$(".r_infor").html('');
		}
		if(r_position.length > 20){
			$(".r_infor").html('<font color="red" size="2">您输入的职位信息过长，建议您控制在20字以内</font>');
			return false;
		}else{
			$(".r_infor").html('');
		}
		//提交表单
		$("#r_form").submit();
	});
});