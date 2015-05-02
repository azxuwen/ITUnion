<?php
//项目合作类
class ProjectAction extends CommonAction{
	/*显示开源项目
	 * 到数据库中获取开源项目
	 * 分页显示
	*/
	public function index(){
		$p = M('Project');
		import('ORG.Util.Page');// 导入分页类
		$count      = $p->count();// 查询满足要求的总记录数
		$page       = new Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $p->field(array('K_ProjectId', 'K_ProjectName','K_ProjectUserId', 'K_ProjectUnion', 'K_ProjectStartTime', 'K_ProjectEndTime','K_ProjectTrade', 'K_ProjectView', 'K_ProjectOpen'))->order('K_ProjectStartTime DESC')->limit($page->firstRow.','.$page->listRows)->select();
		//下面通过循环来获取发布新闻的管理员的姓名
		for($i = 0; $i < count($list); $i++){
			$list[$i]['K_ProjectUserId'] = UserAction::getUserNameById($list[$i]['K_ProjectUserId']);//企业ID  -> 企业名称
			$list[$i]['K_ProjectTrade'] = TradeAction::getTradeNameById(substr($list[$i]['K_ProjectTrade'], 0, 4));//行业ID  -> 行业名称  只取第一个行业
			//通过循环来将加入项目的 企业 拿出来
			$temp_arr = array();
			$temp_str = "";
			$temp_arr = explode(',', $list[$i]['K_ProjectUnion']);
			for($j = 0; $j < 3; $j ++){
				$temp_str .= UserAction::getUserNameById($temp_arr[$j]).",";
			}
			$list[$i]['K_ProjectUnion'] = substr($temp_str, 0, strlen($temp_str)-1);
			//下面对项目视图的路径进行调整 ，因为多个项目视图路径是通过 “，”来连接的  这里需要只拿到其中的第一个路径
			$temp_arr = explode(",", $list[$i]['K_ProjectView']);
			$list[$i]['K_ProjectView'] = $temp_arr[0];
		}
		//dump($list);
		$this->assign('PAGEPROJECT',$list);// 赋值数据集
		$this->assign('PAGE',$show);// 赋值分页输出
		$this->display();
	}
	
	
	/*
	 * 执行删除 项目合作
	 * 会POST过来项目合作  的 数据库ID
	 */
	public function control_del(){
		if(!isset($_POST['p_id'])){
			echo "error";
			exit;	
		}
		$p = M('Project');
		$condition = "K_ProjectId = ".$_POST['p_id'];
		//真正执行删除
		/*
		 * 首先需要将项目合作中的 项目 视图 查询出来  并且删除掉  数据库中字段为 K_ProjectView
		 */
		$arr = $p->where($condition)->field(array('K_ProjectView'))->select();
		$arr = explode(',', $arr[0]['K_ProjectView']);
		for($i = 0; $i < count($arr); $i++){
			//循环来删除掉 服务器文件夹中的图片文件
			unlink($arr[$i]);
		}
		$res_del_project = $p->where($condition)->delete();
		if($res_del_project !=null){
			echo "ok";
			exit;
		}else{
			echo "no";
			exit;
		}
	}
	
	/*
	 * 点击查看详细信息时  弹出一个层   层中的内容  由这里控制返回
	 */
	public function getProjectInfo(){
		if(!isset($_POST['p_id'])){
			echo "error";
			exit;
		}
		$p = M('Project');
		$condition = "K_ProjectId = ".$_POST['p_id'];
		$arr = $p->where($condition)->field(array('K_ProjectName', 'K_ProjectContent','K_ProjectUnion'))->select();
		//将合作的企业ID  转换成名称查询出来
		$temp_arr = explode(',', $arr[0]['K_ProjectUnion']);
		$temp_str = "";
		for($i = 0; $i < count($temp_arr); $i ++){
			$temp_str .= UserAction::getUserNameById($temp_arr[$i])." , ";
		}
		$arr[0]['K_ProjectUnion'] = $temp_str;
		echo json_encode($arr);
	}
}
?>