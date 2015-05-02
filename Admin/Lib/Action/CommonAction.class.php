<?php
class CommonAction extends Action {
	public function _initialize(){
        //检查用户是否登录
        header("Content-type: text/html; charset=utf-8");
        session_start();
        if(!isset($_SESSION['ManagerLoginCode']) || !isset($_SESSION['ManagerName'])){
        	$this->redirect('Login/index', '', 0, '<html>管理员请先登录,页面正在跳转<br/>如没有跳转<a href="admin.php/Login/index">请点击这里</a></html>');
        }
    }
}
?>