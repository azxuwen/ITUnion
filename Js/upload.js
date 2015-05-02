$(document).ready(function(){
	$("#s_button").click(function(){
		var s_title =  $("#s_title").val().trim();
		var s_content = $("#content1").val().trim();
		if(s_title.length == 0){
			$(".sub_s_infor").html('<font color="red">资料标题不能为空</font>');
			return false;
		}else{
			$(".sub_s_infor").html('');
		}
		if(s_title.length > 30 ){
			$(".sub_s_infor").html('<font color="red">资料标题限制在30字以内</font>');
			return false;
		}else{
			$(".sub_s_infor").html('');
		}
		//这里判断class=j_si的值是否为88888 如果为的话，那么证明是在修改，而不是提交
		if($(".j_si").val() == '88888'){
			//如果不为88888，意味着是在发布资料，那么就要检查一下这个文件是否标准
			 var val= $("#s_file").val(); 
			 var k = val.substr(val.indexOf("."));//文件后缀名
			 if(k == ''){
				 $(".sub_s_infor").html('<font color="red">您还未选择文件。</font>');
					return false;
			 }else{
				 $(".sub_s_infor").html('');
			 }
			var file_limit = [".doc", ".xls", ".ppt", ".zip", ".rar", ".docx", "pptx", ".xlsx"];
			var l = file_limit.length;
			while(l--){
				if(file_limit[l] === k){
					break;
				}
			}
			if(l < 0){
				$(".sub_s_infor").html('<font color="red">不支持您上传的文件类型。</font>');
				return false;
			}
		}
		if($(".j_file").html() == '0'){
			$(".sub_s_infor").html('<font color="red">文件已经大于10M，请您从新选择。</font>');
			return false;
		}else{
			$(".sub_s_infor").html('');
		}
		if(s_content.length > 500){
			$(".sub_s_infor").html('<font color="red">资料简介限制在500字以内</font>');
			return false;
		}else{
			$(".sub_s_infor").html('');
		}
		$("#s_form").submit();//提交表单
	});
	
	$("#clo_infor").click(function(){
		$(".error_infor").slideUp();
	});
});

function filesize(ele) {
    // 返回 KB，保留小数点后两位
   if((ele.files[0].size / 1024).toFixed(2) > 10240){
	   alert('文件过大，请从新选择资料');
	   $(".j_file").html('0');
	   return false;
   }else{
	   $(".j_file").html('1');
   }
}