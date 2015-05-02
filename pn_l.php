<!--创建者 : 吴德森 创建时间 : 2014 02 26    20:57 站点归属 ：IT联盟(哈尔滨理工大学创新实验)  联盟资讯列表显示-->
<?php
require_once 'Include/SqlHelper.class.php';
require_once 'Include/AssPage.class.php';
require_once 'Include/ComFunction.php';
require_once 'Include/config.inc.php';
$sqlHelper = new SqlHelper();
//获取新闻信息
$assPage = new AssPage();
//每页显示4个
$assPage->pageSize = 5;
//下面查看是否存在pageNow
	if(isset($_GET['p'])){
		$assPage->pageNow = $_GET['p'];
	}else{
		$assPage->pageNow = 1;
	}

	//查询出数据库中新闻公告的个数
	$sql_all_product_count = "Select count(K_NewsId) From t_news";
	//建立查询 获取当前页面的数据
	$aa = ($assPage->pageNow-1)*$assPage->pageSize;//每一页的起始位置
	$bb = $assPage->pageSize;
	$sql_pagenow_product = "Select * From t_news   order by K_NewsTop desc,K_NewsTime desc  Limit $aa, $bb ";
	//执行改查询
	$sqlHelper->excute_dql_asspage($sql_all_product_count, $sql_pagenow_product, $assPage);
	//如果丝毫没有查到数据，有可能是页码的问题，所以跳到notfound.php
	if(count($assPage->pageArr) == 0){
		header("Location:notfound.php");
		exit;
	}
	//查询后 该页面的信息已经被保存到$assPage->pageArr中
?>

<?php
include 'header.php';
?>
<div id="fit_body_center_90">
<div id="fit_body_70_float">
<?php
$sqlHelper = new SqlHelper();
	for($i=0;$i<count($assPage->pageArr);$i++) {
		//获取产品类别
		$pd_kind = $assPage->pageArr[0]['K_NewsCategory'];
		$sql_get_product_kind = "Select CodeName From t_basecode Where CodeId = $pd_kind";
		$arr_get_product_kind = $sqlHelper->execute_dql2($sql_get_product_kind);
		$pd_kind_name = $arr_get_product_kind[0]['CodeName'];
		//获取新闻发布者
		$pd_manager = getManagerName($assPage->pageArr[$i]['K_ManagerId'],$sqlHelper);
		//获取时间
		$pd_time = date('Y-m-d', strtotime($assPage->pageArr[$i]['K_NewsTime']));
		//布局
		echo "<table id='chanpinliebiao'>";
		echo "<tr><td colspan='2'><a href='pn_c.php?ni=".$assPage->pageArr[$i]['K_NewsId']."'><b>".$assPage->pageArr[$i]['K_NewsTitle']."</a></b></td></tr>";
		echo "<tr><td colspan='2' class='time'>".$pd_kind_name." |".$pd_time." | ".$pd_manager."</td></tr>";
		echo "<tr><td colspan='2' valign='top' class='content'>".utf8Substr($assPage->pageArr[$i]['K_NewsContent'],0,300)."</td></tr>";
		echo "</table>";
		echo "<hr style='border:0.5px dashed gray' size=0.5></hr>";
	}
	//分页
	echo "<div class='fenye'>";
	echo "<table width='100%'><tr><td align='left'>";
	if($assPage->pageNow==1) {
		echo "<a class='pageButton button' href='pn_l.php?p=1'>首页</a>";
	}else {
			echo "<a class='pageButton button' href='pn_l.php?p=".($assPage->pageNow-1)."'>上一页</a>";
	}
	echo "</td><td align='right'>";
	//这里显示一共多少页，然后有一个自动跳到多少页start
	echo "<font size='3'>{$assPage->pageNow}/{$assPage->pageCount}页　　</font>";
	echo "<input type='number' id='w_page' value='' style='width:30px;' />";
	echo "<a id='sub_n_page' href='#pn_l'>跳到指定页</a>　";
	echo "<input type='hidden' class='page_count' value='".$assPage->pageCount."'/>";//将页数隐藏于表单之中
	//这里显示一共多少页，然后有一个自动跳到多少页end
	if($assPage->pageNow < $assPage->pageCount) {
		echo "<a class='pageButton button' href='pn_l.php?p=".($assPage->pageNow+1)."'>下一页</a>";
	}else{
		echo "<font size='3' color='red'>已经是最后一页喽　</font>";
	}
	echo "</td></tr></table>";
	echo "</div>";
?>
</div>
<div id="fit_body_30_float">
</div>
</div>
</body>