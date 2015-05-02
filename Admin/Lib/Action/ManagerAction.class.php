<?php
class ManagerAction extends CommonAction{
	public function index(){
		
	}
	//获取管理员真实姓名
	public static function getManaName($MangerId){
		$m = M('Manager');
		$where = "K_ManagerId = ".$MangerId;
		$arr_manager_name = $m ->field(array('K_ManagerName')) ->where($where)-> select();
		return $arr_manager_name[0]['K_ManagerName'];
	}
}
?>