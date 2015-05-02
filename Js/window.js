$(function() {
	//当点击删除招聘信息时，弹出一个小窗体询问是否真的删除
	$('#r_delete').confirmOn('click', function(e, confirmed) {
  		if(confirmed) { // Clicked yes
     	 var ri = $(".r_id").val();
     	 window.location.href = "Include/sub_r.php?ri="+ri+"&t=d";
 	 } else { // Clicked no
    	  $('#msg_button_1').fadeIn();
 	 }
	});
	$('#s_delete').confirmOn('click', function(e, confirmed) {
  		if(confirmed) { // Clicked yes
     	 var si = $(this).attr('href');
     	 window.location.href = "Include/sub_s.php?si="+si+"&t=d";
 	 } else { // Clicked no
    	  $('#msg_button_1').fadeIn();
 	 }
	});
	//删除项目合作内容
	$('#p_delete').confirmOn('click', function(e, confirmed) {
  		if(confirmed) { // Clicked yes
     	 var si = $(".p_id").val();
     	 window.location.href = "Include/sub_p.php?pi="+si+"";
 	 } else { // Clicked no
    	  $('#msg_button_1').fadeIn();
 	 }
	});
});