<!--创建者 : 徐文志 创建时间 : 2014 01 17    20:30 站点归属 ：IT联盟(哈尔滨理工大学创新实验)   页面功能:用户注册 -->
<!--引入页头文件start-->
<?php
include 'header.php';

echo "<div id='center_width_70'>";

echo '<center><div><a href="index.php"><img src="images/404_icon.png"></a>';
        echo "<div>";
        echo "<h1>唉呀!</h1>";
        echo "<p>你正在寻找的页面无法找到。</p>";
		echo "<br /><br /><br />";
        echo '<a class="link" href="/" onclick="history.go(-1)"><span id="sec">5</span>秒后返回首页</a>';
echo "</div>";
echo "</center>";
echo "</div>";
echo "</div>";
?>
<?php
include 'footer.php';
?>
<script type="text/javascript">
	$(function () {            
	   setTimeout("lazyGo();", 1000);
	});
	function lazyGo() {
		var sec = $("#sec").text();
		$("#sec").text(--sec);
		if (sec > 0)
			setTimeout("lazyGo();", 1000);
		else
			window.location.href = "index.php";
	}
</script>
<!--引入页尾文件end-->
</body>
</html>
