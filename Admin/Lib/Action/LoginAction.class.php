<?php
// 本类由系统自动生成，仅供测试用途
class LoginAction extends Action {
	//显示管理员登录表单
	public function index(){
        header("Content-type: text/html; charset=utf-8");
        $this->display();
    }
    //处理管理员登录
    public function login(){
    	header("Content-type: text/html; charset=utf-8");
    	if(!isset($_POST['login_code']) || !isset($_POST['login_pass'])){
    		$this->redirect('Login/index', '', 5, '<html>非法操作,页面正在跳转<br/>如没有跳转<a href="admin.php/Login/index">请点击这里</a></html>');
    		exit;
    	}
    	$login_code = $_POST['login_code'];//登录编号
    	$login_pass = $_POST['login_pass'];//登录密码
    	if(strlen($login_code) == 0 || strlen($login_pass) == 0){
    		$this->redirect('Login/index', '', 5, '<html>没有填写登录账号或密码,页面正在跳转<br/>如没有跳转<a href="admin.php/Login/index">请点击这里</a></html>');
    		exit;
    	}
    	//下面执行查询
    	$m = M('Manager');
    	$condition = "K_ManagerLoginCode = '".$login_code."'";
    	$arr_verify_login = $m -> field(array('K_ManagerLoginPass', 'K_ManagerName', 'K_ManagerId'))-> where($condition) ->select();
    	if($arr_verify_login[0]['K_ManagerLoginPass'] != $login_pass){
    		$this->redirect('Login/index', '', 5, '<html>用户名或密码错误,页面正在跳转<br/>如没有跳转<a href="admin.php/Login/index">请点击这里</a></html>');
    		exit;
    	}else{
    		session_start();
    		$_SESSION['ManagerId'] = $arr_verify_login[0]['K_ManagerId'];//管理员ID
    		$_SESSION['ManagerLoginCode'] = $login_code;//登录code
    		$_SESSION['ManagerName'] = $arr_verify_login[0]['K_ManagerName'];//管理员姓名
    		$this->redirect('Index/index', '', 0, '');
    	}
    }
    
    //处理管理员退出
    public function loginout(){
    	session_start();
    	$_SESSION['ManagerLoginCode'] = null;
    	$_SESSION['ManagerName'] = null;
    	$this->redirect('Login/index', '', 0, '');
    }
}
?>