<?php
//知识共享类
class ShareAction extends CommonAction {
	//知识共享 管理主页 
	public function index(){
		$s = M('Share');
		import('ORG.Util.Page');// 导入分页类
		$count      = $s->count();// 查询满足要求的总记录数
		$page       = new Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $s->order('K_ShareTime desc')->limit($page->firstRow.','.$page->listRows)->select();
		//修改数组中的上传人ID->用户姓名   分类 ID -> 分类名称 
		for($i = 0 ; $i < count($list); $i ++){
			$list[$i]['K_ShareUserId'] = UserAction::getUserNameById($list[$i]['K_ShareUserId']);
			$list[$i]['K_ShareCategory'] = CodeAction::getCateName($list[$i]['K_ShareCategory']);
		}
		$this->assign('SHARELIST', $list);
		$this->assign('PAGE', $show);
		$this->display();
	}
	
	/*
	 * 执行下载文件
	 */
	public function down(){
		if(!isset($_GET['s_id'])){
			HeaderAction::myHeader('Share/index.html', 2, '非法操作');
			exit;
		}
		$s = M('Share');
		$condition = "K_ShareId =".$_GET['s_id'];
		$arr_get_add = $s->where($condition)->field(array('K_ShareTitle','K_ShareFileAddress'))->select();
		$file_dir_name = $arr_get_add[0]['K_ShareFileAddress'];
		$temp_str = $this->getFileTypeName($arr_get_add[0]['K_ShareFileAddress']);
		$file_name = $arr_get_add[0]['K_ShareTitle'].$temp_str;
		if(!file_exists($file_dir_name))   {   //检查文件是否存在
			 echo'<script> alert("不存在此文件!"); location.replace ("ziliaoxiazai.php") </script>'; exit();
		}else{ 
			$file = fopen($file_dir_name,"r"); 
			header("Content-type: application/octet-stream");
			header("Accept-Ranges: bytes");
			header("Accept-Length: ".filesize($file_dir_name));
			header("Content-Disposition: attachment; filename=" . $file_name);
			echo fread($file,filesize($file_dir_name));
			fclose($file);
			exit();
		}
	}
	/*
	 * 执行删除 知识共享 的控制器 
	 */
	public function control_del(){
		if(!isset($_POST['s_id'])){
			echo "error";
			exit;
		}
		//执行删除
		$s = M('Share');
		//首先删除掉文件
		$condition = "K_ShareId = " . $_POST['s_id'];
		$arr = $s->where($condition)->field(array('K_ShareFileAddress'))->select();
		unlink($arr[0]['K_ShareFileAddress']);
		$res = $s->where($condition)->delete();
		if($res != null){
			echo "ok";
			exit;
		}else{
			echo "no";
			exit;
		}
	}
	
	/*
	 * 获取文件后缀名  返回的后缀名 是带有   .  的 
	*/
	public function getFileTypeName($str){
		$arr = explode('.', $str);
		return '.'.$arr[count($arr)-1];
	}
}
?>