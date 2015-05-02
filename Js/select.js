

//地点 二级联动  通过省份 获取市县  start
function g_locate_s_2(){
	var prov = $("#r_prov").val();//省份 Code
	$("#r_city").find("option").remove();//清空市县第二个下拉菜单的option
	//通过ajax获取二级菜单数据
	$.ajax({
		type:'post',
		url:'Include/Ajax/l_get2.php',
		data:'prov='+prov,
		dataType:'json',
		success:function(json){
			for(var one in json){
				var str='<option value='+json[one]['K_CityName']+'>'+json[one]['K_CityName']+'</option>';
				$(str).appendTo("#r_city");
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
//地点 二级联动  通过省份 获取市县  end


//行业 二级联动 函数  start
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
				var str='<option value='+json[one]['K_TradeId']+'>'+json[one]['K_TradeName']+'</option>';
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







