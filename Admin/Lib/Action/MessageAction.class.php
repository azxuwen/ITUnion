<?php
//站内信
class MessageAction extends CommonAction {
	//向用户发送站内信
	public function send_mess_to_user(){
		$send_info_str = explode('^',$_POST['send_info_str']);
		$user_id = $send_info_str[0];//用户ID
		$send_mess_con = $send_info_str[1];//发送内容
		$m = M('Message');
		$m->K_MessageContent = $send_mess_con;
		$m->K_MessageTime = date('Y-m-d H:i:s', time());
		$m->K_UserId = $user_id;
		$res_send_mess = $m->add();
		if($res_send_mess != null){
			echo "ok";
		}else{
			echo "no";
		}
	}
}
?>