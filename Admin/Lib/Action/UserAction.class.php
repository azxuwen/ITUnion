<?php
class UserAction extends CommonAction {
	/*
	 * 增加新用户
	 */
	public function add(){
		$this->display();
	}
	/*
	 * 查看具体用户信息，会有一些修改用户信息的内容
	 */
	public function index(){
		//获取新闻数据
		$n = M('User');   //这里使用关联查询，在NewsModel.class.php中定义了模型
		import('ORG.Util.Page');// 导入分页类
		$count      = $n->count();// 查询满足要求的总记录数
		$page       = new Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $n->field(array('K_UserId', 'K_UserName', 'K_UserEmail','K_UserType', 'K_UserHeadAdd','K_UserJoinTime', 'K_UserLandTimes', 'K_UserLandTime', 'K_Shield'))->order('K_UserJoinTime DESC')->limit($page->firstRow.','.$page->listRows)->select();
		//dump($list);
		$this->assign('USERLIST',$list);// 赋值数据集
		$this->assign('PAGE',$show);// 赋值分页输出
		$this->display();
	}
	/*
	 * 开启 用户 的屏蔽 也就是让他不能登录
	*/
	public function open_user_shield(){
		if(!isset($_POST['user_id'])){
			echo "error";
			exit;
		}
		$data['K_Shield'] = 'n';
		$condition = "K_UserId = ".$_POST['user_id'];	
		$u = M('User');
		$res_open_verify = $u -> where($condition)->save($data);
		if($res_open_verify != null){
			echo "ok";
			exit;
		}else{
			echo "no";
			exit;
		}
		
	}
	/*
	 * 关闭 用户 的屏蔽 也就是可以让他登录
	*/
	public function close_user_shield(){
	if(!isset($_POST['user_id'])){
			echo "error";
			exit;
		}
		$data['K_Shield'] = 'y';
		$condition = "K_UserId = ".$_POST['user_id'];	
		$u = M('User');
		$res_open_verify = $u -> where($condition)->save($data);
		if($res_open_verify != null){
			echo "ok";
			exit;
		}else{
			echo "no";
			exit;
		}
	}
	/*
	 * 当在用户列表中点击查看该用户时，拿到这个用户的一些具体信息
	*/
	public function get_user_infor(){
		$u = M('User');
		$condition = "K_UserId = ". $_POST['user_id'];
		$arr_user_infor = $u -> where($condition)->field(array('K_UserName', 'K_UserEmail', 'K_Verify', 'K_UserJoinTime', 'K_UserLandTime', 'K_UserType', 'K_UserIntegral', 'K_UserHeadAdd', 'K_UserPhone', 'K_UserBirthday', 'K_UserIntroduce'))->select();
		echo json_encode($arr_user_infor);
	}
	/*
	 * 修改用户积分
	 */
	public function update_user_integral(){
		$up_user_integral = explode('-', $_POST['up_user_integral']);
		$user_id = $up_user_integral[0];//用户ID
		$integral = $up_user_integral[1];//修改的积分
		$u = M('User');
		$data['K_UserIntegral'] = $integral;
		$condition = "K_UserId = ".$user_id;
		$res_up_integral = $u -> where($condition)->save($data);
		if($res_up_integral != null){
			echo "ok";
		}else{
			echo "no";
		}
	}
	
	/*
	 * 通过用户的 ID 获取用户的名称
	 */
	public static function getUserNameById($user_id){
		$u = M('User');
		$condition = "K_UserId =" . $user_id;
		$arr_username = $u->where($condition)->field(array('K_UserName'))->select();
		return $arr_username[0]['K_UserName'];
	}
	
	
	/*
	 * 前端获取全部的用户信息
	*/
	public function ajax_get_company_name(){
		$user_name = $_GET['username'];
		if(trim($user_name) == ""){
			//如果username为空 意味着取全部的公司
			$u = M('User');
			$condition = "K_UserType = 'c'";
			$arr_user_list = $u->where($condition)->field(array('K_UserId', 'K_UserName'))->select();
			echo json_encode($arr_user_list);//输入json格式
		}else{
			//不为空 意味通过like来获取信息
			$u = M('User');
			$condition['K_UserName'] = array('like', '%'.$user_name.'%');
			$condition['K_UserType'] = 'c';
			$arr_user_list = $u->where($condition)->field(array('K_UserId', 'K_UserName'))->select();
			echo json_encode($arr_user_list);
		}
	}
	
	
	
	
	/*
	 *  START === 这里完成用户统计 页面的 控制器代码  
	 */
	public function statistics(){
		//获取 企业用户 和 个人用户 的简单信息
		$arr_user_company = $this->getUserSimpleInfor('c');//企业用户信息
		$arr_user_person = $this->getUserSimpleInfor('p');//个人用户信息
		//获取企业用户和个人用户数量
		$user_company_count = $this->getUserCount('c');//企业用户数量
		$user_person_count = $this->getUserCount('p');//个人用户数量
		//获取未激活用户 和 已屏蔽用户
		$user_needverify_user = $this->getNeedVerifyUser('v');
		$user_alshield_user = $this->getNeedVerifyUser('s');
		$this->assign('USERCOMPANY', $arr_user_company);
		$this->assign('USERPERSON', $arr_user_person);
		$this->assign('USERCOMPANYCOUNT',$user_company_count);
		$this->assign('USERPERSONCOUNT',$user_person_count);
		$this->assign('USERNEEDVERIFY', $user_needverify_user);
		$this->assign('USERALSHIELD', $user_alshield_user);
		$this->display();
	}
	/*
	 * 根据参数来获取用户的简单信息  例如 取得企业用户 或者 个人用户
	 * 参数 为  固定的 例如   如果为 'c' 取得企业用户   为'p'取得个人用户
	 */
	public static function getUserSimpleInfor($type){
		$u = M('User');
		$condition = "K_UserType = '".$type."'";
		$user_company = $u->where($condition)->field(array('K_UserName', 'K_UserHeadAdd', 'K_UserId', 'K_UserIntroduce'))->order('K_UserJoinTime desc')->limit(0, 6)->select();
		return $user_company;
	}
	/*
	 * 根据参数来获取用户数量
	 * 参数 为  固定的 例如   如果为 'c' 取得企业用户   为'p'取得个人用户
	 */
	public static function getUserCount($type){
		$u = M('User');
		$condition = "K_UserType = '".$type."'";
		$user_count = $u->where($condition)->count();
		return $user_count;
	}
	/*
	 * 获取未激活用户  或者 已屏蔽用户 
	 * 参数  如果 为 s获取已屏蔽用户 如果为v获取未激活用户
	*/
	public function getNeedVerifyUser($type){
		if($type == 'v'){
			$condition = "K_Verify = 'n'";
		}else if($type == 's'){
			$condition = "K_Shield = 'n'";
		}
		$u = M('User');
		$users_list = $u->where($condition)->field(array('K_UserName', 'K_UserHeadAdd', 'K_UserId', 'K_UserIntroduce'))->order('K_UserJoinTime desc')->limit(0, 6)->select();
		return $users_list;
	}
	/*
	 *  END === 这里完成用户统计 页面的 控制器代码  
	 */
	
	/*
	 * 获取全部的  企业 或 个人  用户
	 * 根据参数  参数为类型
	 */
	public function getUserByType($type){
		$u = M('User');
		$condition = "K_UserType  =  '$type'";
		$arr_get_user = $u->where($condition)->field(array('K_UserId', 'K_UserName'))->select();
		return $arr_get_user;
	}
}
?>







