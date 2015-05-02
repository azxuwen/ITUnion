$(document).ready(function(){
	$("#seo_button").click(function(){
		var keyword = $(".keyword").val().trim();
		if(keyword != ""){
			window.location.href = "seo.php?k="+keyword;
		}
	});
});