<?php
/*
 * 添加人  徐文志
 * 时间    2014年2月17日 15:02
 * 站点归属 ：IT联盟(哈尔滨理工大学创新实验)
 * 处理添加   修改 或 删除招聘信息的功能
 */
header("Content-Type:text/html; charset=utf8");
session_start(); 
require_once 'SqlHelper.class.php';
$sqlHelper = new SqlHelper();
/*
 * 既然要处理添加 修改 删除 3 项功能，那么首先就要进行区分
 * 首先 通过是否能通过GET 来获取 ri  如果有那么就是修改或者 删除  
 * 如果没有 ，那么就是添加
 */
if(!isset($_GET['ri'])){
	//如果url中不存在 ri ，那么就是添加招聘信息
	$r_title = $_POST['r_title'];//招聘标题
	$r_position = $_POST['r_position'];//职位
	$r_salary = $_POST['r_salary'];//薪资
	$r_degree = $_POST['r_degree'];//学历
	$r_trade = $_POST['r_trade2'];//行业
	//这里获取地点时要注意，因为分为一个二级联动和一个输入具体街道输入框，要将第二个下拉菜单的值 和 街道输入框通过&连接，然后传入数据库 
	$r_location = $_POST['r_city']."&".$_POST['r_l_3'];//地点
	$r_con = $_POST['content1'];//职位描述	
	//执行插入
	$sql_i_r_infor = "Insert into t_recruit(K_RecruitTrade,K_UserId,K_RecruitTitle, K_RecruitContent,K_RecruitPosition,K_RecruitLocation,K_RecruitSalary,K_RecruitDegree,K_RecruitVisible,K_RecruitTime,K_RecruitVisitTimes,K_RecruitOrder) ";
	$sql_i_r_infor .= " values('".$r_trade."', ".$_SESSION['USERID'].", '".$r_title."', '".$r_con."', '".$r_position."', '".$r_location."','".$r_salary."', '".$r_degree."', 'Y', now(), 0, 0)";
	$res_i_r_infor = $sqlHelper->execute_dql($sql_i_r_infor);
	if($res_i_r_infor){
		//添加成功,回到刚刚添加的这个招聘信息中去
		$ri = mysql_insert_id();
		header("Location:../pr_c.php?pi=".$ri."");
	}else{
		//添加失败
		echo '<script> alert("添加失败，请重试"); location.replace("../n_pr.php")</script>';
		exit();
	}
	
}else{
	//执行修改 或者 删除 ,那么这里要区分下到底是修改还是删除
	//我这里是通过u来判断，如果在url中  t=u那么就是修改
	if(isset($_GET['t'])){
		if($_GET['t'] == 'u'){
			//执行修改
			$ri = $_GET['ri'];//要修改的招聘ID
			$r_title = $_POST['r_title'];//招聘标题
			$r_position = $_POST['r_position'];//职位
			$r_salary = $_POST['r_salary'];//薪资
			$r_degree = $_POST['r_degree'];//学历
			$r_trade = $_POST['r_trade2'];//行业
			//这里获取地点时要注意，因为分为一个二级联动和一个输入具体街道输入框，要将第二个下拉菜单的值 和 街道输入框通过&连接，然后传入数据库
			$r_location = $_POST['r_city']."&".$_POST['r_l_3'];//地点
			$r_con = $_POST['content1'];//职位描述
			$sql_u_r_i = "Update t_recruit set K_RecruitTrade = '".$r_trade."',K_RecruitTitle='".$r_title."', K_RecruitContent='".$r_con."',K_RecruitPosition='".$r_position."',K_RecruitLocation='".$r_location."',K_RecruitSalary='".$r_salary."',K_RecruitDegree='".$r_degree."'";
			$sql_u_r_i .= " Where K_RecruitId = {$ri}";
			$res_u_r_i = $sqlHelper -> execute_dql($sql_u_r_i);
			if($res_u_r_i){
				//如果修改成功
				header("Location:../pr_c.php?pi=".$ri."&cor=u");
				exit;
			} else{
				//如果修改不成功
				header("Location:../pr_c.php?pi=".$ri."&err=u");
				exit();
			}
		}else{
			//执行删除
			if($_GET['t'] == 'd'){
				$ri = $_GET['ri'];//需要删除的招聘信息的ID
				//这里本应该在验证一下是否真的这条招聘信息属于现在登录的这个人的，不过这里就不验证了
				$sql_d_r = "delete from t_recruit where K_RecruitId = {$ri}";
				$res_d_r = $sqlHelper -> execute_dql($sql_d_r);
				if($res_d_r != null){
					echo '<script> alert("删除成功");</script>';
					header("Location:../pr_l.php?n=y&s=d");//这里实际上要回到招聘信息列表处，但是现在还没做招聘信息列表，所以暂时先
					exit();
				}else{
					echo '<script> alert("删除失败，请重试");</script>';
					header("Location:../pr_c.php?pi=".$ri."&err=d");
					exit();
				}
			}
		}
	}
}

?>