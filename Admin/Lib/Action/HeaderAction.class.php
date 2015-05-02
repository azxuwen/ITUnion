<?php
//页面跳转类
class HeaderAction extends CommonAction {
	/*
	 * 跳转函数，
	 * 参数3 显示跳转到的 页面
	 * 参数 2  显示跳转时显示的文字
	 * 参数3 跳转时的 停留的时间
	 * 
	*/
	public function myHeader($header_page , $show_str, $show_time){
		$this->redirect($header_page, '', $show_time, "<body><div style='position:relative;width:500px;height:100px;left:450px;top:120px;border:10px solid rgba(100, 10, 0, 1.0);'><center><br/><img src='/ITUnion/Public/Images/tb.png'/><br/>".$show_str."</center></div></body>");
		exit;
	}
}
?>