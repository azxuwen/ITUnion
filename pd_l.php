<!--创建者 : 张健平 创建时间 : 2014 02 24    20:57 站点归属 ：IT联盟(哈尔滨理工大学创新实验)  产品信息列表显示-->
<?php
require_once 'Include/SqlHelper.class.php';
require_once 'Include/AssPage.class.php';
require_once 'Include/ComFunction.php';
$sqlHelper = new SqlHelper();
//获取产品信息
$assPage = new AssPage();
//每页显示4个
$assPage->pageSize = 8;
//下面查看是否存在pageNow
	if(isset($_GET['p'])){
		$assPage->pageNow = $_GET['p'];
	}else{
		$assPage->pageNow = 1;
	}
	//产品类别的搜索
	if(isset($_GET['pk'])) {
		$ProductKind = $_GET['pk'];
	}else {
		$ProductKind = "";
	}
	//关键字的搜索
	if(isset($_GET['pt'])){
		$ProductTitleKey = $_GET['pt'];
	}else{
		$ProductTitleKey ="";
	}
	$sql_where = " where";
	if($ProductKind != ""){
		$sql_where .= " K_ProductKind = $ProductKind and ";
	}else{
		$sql_where.="";
	}
	if($ProductTitleKey !=""){
		$sql_where .= " locate('".$ProductTitleKey."', K_ProductKind)<>0";
	}else{
		$sql_where = substr($sql_where, 0, strlen($sql_where)-5); //如果存在 新闻分类条件   但不存在 搜索关键字条件  去掉 and  
	}
	if($sql_where == " where" || $ProductKind==""){//如果没有 搜索条件  
		$sql_where = "";
	}
	//查询出数据库中新闻公告的个数
	$sql_all_product_count = "Select count(K_ProductId) From t_product";
	$sql_all_product_count .=$sql_where;
	//建立查询 获取当前页面的数据
	$aa = ($assPage->pageNow-1)*$assPage->pageSize;//每一页的起始位置
	$bb = $aa+$assPage->pageSize;
	$sql_pagenow_product = "Select * From t_product ";
	$sql_pagenow_product.=$sql_where;
	$sql_pagenow_product.= " order by K_ProductTime desc,K_ProductTop desc Limit $aa, $bb ";//建立该查询
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
	if($assPage->pageCount==$assPage->pageNow) {
		$pageSize = count($assPage->pageArr);
	}else {
		$pageSize = $assPage->pageSize;
	}
	for($i=0;$i<$pageSize;$i++) {
		//获取产品类别
		$pd_kind = $assPage->pageArr[0]['K_ProductKind'];
		$sql_get_product_kind = "Select CodeName From t_basecode Where CodeId = $pd_kind";
		$arr_get_product_kind = $sqlHelper->execute_dql2($sql_get_product_kind);
		$pd_kind_name = $arr_get_product_kind[0]['CodeName'];
		//获取发布者
		$pd_user = getUserName($assPage->pageArr[$i]['K_ProductUserId'],$sqlHelper);
		//获取时间
		$pd_time = date('Y-m-d', strtotime($assPage->pageArr[$i]['K_ProductTime']));
		//获取图片
		$pd_address_array = explode(",",$assPage->pageArr[$i]['K_ProductPicAddress']);
		//布局
		echo "<table id='chanpinliebiao'>";
		echo "<tr><td colspan='2'><a href='pd_c.php?pi=".$assPage->pageArr[$i]['K_ProductId']."'><b>".$assPage->pageArr[$i]['K_ProductTitle']."</a></b></td></tr>";
		echo "<tr><td colspan='2' class='time'>".$pd_time." | 发布者：".$pd_user." | ".$pd_kind_name."</td></tr>";
		echo "<tr><td width='126' class='content'><img src=".$pd_address_array[0]." width='125' height='90'/></td><td valign='top'>".substr($assPage->pageArr[$i]['K_ProductContent'],0,800)."</td></tr>";
		echo "</table>";
		echo "<hr style='border:0.5px dashed gray' size=0.5></hr>";
	}
	//分页
	echo "<div class='fenye'>";
	echo "<table width='100%'><tr><td align='left'>";
	if($assPage->pageNow==1) {
		if(isset($_GET['pk'])){
			echo "<a class='pageButton button' href='pd_l.php?p=1&pk=".$_GET['pk']."'>首页</a>";
		}else{
			echo "<a class='pageButton button' href='pd_l.php?p=1'>首页</a>";
		}
	}else {
		if(isset($_GET['pk'])){
			echo "<a class='pageButton button' href='pd_l.php?p=".($assPage->pageNow-1)."&pk=".$_GET['pk']."'>上一页</a>";
		}else{
			echo "<a class='pageButton button' href='pd_l.php?p=".($assPage->pageNow-1)."'>上一页</a>";
		}
	}
	echo "</td><td align='right'>";
	//这里显示一共多少页，然后有一个自动跳到多少页start
	echo "<font size='3'>{$assPage->pageNow}/{$assPage->pageCount}页　　</font>";
	echo "<input type='number' id='w_page' value='' style='width:30px;' />";
	echo "<a id='sub_w_page' href='#_ff'>跳到指定页</a>　";
	echo "<input type='hidden' class='page_count' value='".$assPage->pageCount."'/>";//将页数隐藏于表单之中
	if(isset($_GET['pk'])){
	echo "<input type='hidden' class='p_kind' value='".$_GET['pk']."'/>";
	}else{
	echo "<input type='hidden' class='p_kind' value='88888' />";
	}
	//这里显示一共多少页，然后有一个自动跳到多少页end
	if($assPage->pageNow < $assPage->pageCount) {
		
		if(isset($_GET['pk'])){
			echo "<a class='pageButton button' href='pd_l.php?p=".($assPage->pageNow+1)."&pk=".$_GET['pk']."'>下一页</a>";
		}else{
			echo "<a class='pageButton button' href='pd_l.php?p=".($assPage->pageNow+1)."'>下一页</a>";
		}
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