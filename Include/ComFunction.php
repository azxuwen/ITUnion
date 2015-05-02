<?php
/*一个相当于substr的函数
 * 专门用于截取utf8字符串
 * 最后一个参数，截取长度，
 * 如果是英文 则按字母计
 * 如果是中文 则按汉字计
 * 引入人 : 徐文志
 * 时间:14年1月18日 17:00
 */
function utf8Substr($str, $from, $len){
	return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
			'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
			'$1',$str);
}//function utf8Substr() 结束


/*从t_basecode中截取分类
* 例如我要取得学历这一项中有哪些子类 我会取得专科 本科等等
* 并且还需要按照CodeOrder来排序获得
* 参数1 比如分类这项所代表的代码  
* 参数2 对象$sqlHelper
* 参数3 设定缺省，主要限制取得的个数，比如如果取得标签 但是标签在数据库中的量非常大，而我不想全部获得，如果全部获得的话 浪费资源到数据库中获取，所以设定一个这个参数
* 返回值 具有该项分类的 所有记录 组成的二维数组
* 引入人 : 徐文志
* 时间:14年1月18日 17:53
*/
function getCategoryInfor($CodeCategoryId, $sqlHelper, $count = 100){
	$sql_get_category = "Select * from t_basecode where CodeCategoryId = {$CodeCategoryId} order by CodeOrder desc limit 0, {$count}";
	$arr_get_category = $sqlHelper->execute_dql2($sql_get_category);
	return $arr_get_category;
}//function getCategoryInfor() 结束


/*生成随机字符串
 * 参数1 长度 用于指明生成的随机字符串的长度
* 引入人 : 徐文志
* 时间:14年2月3日 12:04
*/
function getRandomCode($length){
	$str = "";
	for($i = 0 ; $i < $length; $i ++){
		$str .= chr(rand(97, 122));
	}
	return $str;
}



/*通过用户ID来获取头像地址
 * 参数1 用户ID
 * 参数2 SqlHelper的对象 并且是引用参数
* 引入人 : 徐文志
* 时间:14年2月12日 11:45
*/
function getUserHead($UserId, &$sqlHelper){
	$sql_get_user_head = "Select K_UserHeadAdd from t_user where K_UserId = {$UserId}";
	$arr_get_user_head = $sqlHelper -> execute_dql2($sql_get_user_head);
	if($arr_get_user_head[0][0] != ""){
		return $arr_get_user_head[0][0];
	}
}


/*通过用户ID来获取用户积分
 * 参数1 用户ID
* 参数2 SqlHelper的对象 并且是引用参数
* 引入人 : 徐文志
* 时间:14年2月12日 12:59
*/
function getUserInteger($UserId, &$sqlHelper){
	$sql_get_user_integer = "Select K_UserIntegral from t_user where K_UserId = {$UserId}";
	$arr_get_user_integer= $sqlHelper -> execute_dql2($sql_get_user_integer);
	if($arr_get_user_integer[0][0] != ""){
		return $arr_get_user_integer[0][0];
	}
}






/*通过用户ID来获取用户姓名
 * 参数1 用户ID
* 参数2 SqlHelper的对象 并且是引用参数
* 引入人 : 徐文志
* 时间:14年2月12日 13:15
*/
function getUserName($UserId, &$sqlHelper){
	$sql_get_user_name = "Select K_UserName from t_user where K_UserId = {$UserId}";
	$arr_get_user_name = $sqlHelper -> execute_dql2($sql_get_user_name);
	//if($arr_get_user_name[0]['K_UserName'] != ""){
		return $arr_get_user_name[0][0];
//	}else{
		//return '未填写';
	//}
}



/*将字符串按照逗号分离开，返回一个数组
 * 参数1 要分离的字符串
 * 参数2 按照哪个字符来分
* 引入人 : 徐文志
* 时间:14年2月12日 18:15
*/
function explodeToArr($string, $explode){
	$arr = array();
	$arr = explode($explode, $string);
	return $arr;
}


/*通过行业id获取行业名称
 * 参数1 行业ID
 * 参数2 SqlHelper对象的引用
* 引入人 : 徐文志
* 时间:14年2月12日 18:20
*/
function getGradeName($gradeid, &$sqlHelper){
	$sql_get_tradename = "Select K_TradeName from t_trade where K_TradeId = {$gradeid}";
	$arr_get_tradename = $sqlHelper -> execute_dql2($sql_get_tradename);
	return $arr_get_tradename[0]['K_TradeName'];
}


/*判断当前登录的用户是否已经加入了开源项目
 * 参数1 当前登录用户的id
 * 参数2 当前浏览的项目的id
 * 参数3 SqlHelper的对象引用
 * 引入人 : 徐文志
 * 时间 : 14年2月12日
 */
function judgeProjectUserExists($userid, $pid, &$sqlHelper){
	$sql_judge = "Select count(K_ProjectId) from t_project where K_ProjectId = {$pid} and (K_ProjectUnion like '".$userid."' or K_ProjectUnion like '".$userid."%' or K_ProjectUnion like '%".$userid."')";
	$arr_judge = $sqlHelper -> execute_dql2($sql_judge);
	if($arr_judge[0][0] == 0){
		return 0;
	}else{
		return 1;
	}
}


/*通过用户ID来获取用户简介
 * 参数1 用户ID
* 参数2 SqlHelper的对象 并且是引用参数
* 引入人 : 徐文志
* 时间:14年2月14日 13:30
*/
function getUserIntro($UserId, &$sqlHelper){
	$sql_get_user_introduce= "Select K_UserIntroduce from t_user where K_UserId = {$UserId}";
	$arr_get_user_introduce = $sqlHelper -> execute_dql2($sql_get_user_introduce);
	if($arr_get_user_introduce[0][0] != ""){
		return $arr_get_user_introduce[0][0];
	}else{
		return "未填写";
	}
}




/*通过用户ID来判断用户是企业还是个人
 * 参数1 用户ID
* 参数2 SqlHelper的对象 并且是引用参数
* 引入人 : 徐文志
* 时间:14年2月14日 14:01
*/
function judgeUserType($UserId, &$sqlHelper){
	$sql_judge_user_type = "Select K_UserType from t_user where K_UserId = {$UserId}";
	$arr_judge_user_type = $sqlHelper -> execute_dql2($sql_judge_user_type);
	if(count($arr_judge_user_type) != 0){
		return $arr_judge_user_type[0]['K_UserType'];
	}else{
		return "";
	}
}


/*获取到行业二级下拉菜单的第一级
* 参数1 SqlHelper的对象 并且是引用参数
* 引入人 : 徐文志
* 时间:14年2月16日 15:07
*/
function getTrade($sqlHelper){
	$sql_get_t = "Select * from t_trade where length(K_TradeId) = 2";
	$arr_get_t = $sqlHelper -> execute_dql2($sql_get_t);
	return $arr_get_t;
}


/*
 * 根据企业名称或者个人名称获取ID
 * 参数1  名称或姓名
 * 参数2  SqlHelper对象，并且是引用参数
 * 引入人 徐文志
 * 时间   2014年2月26日 13:00
 */
function getUserId ($username , &$sqlHelper){
	$sql_get_uid = "Select K_UserId from t_user where K_UserName = '".$username."'";
	$arr_get_uid = $sqlHelper -> execute_dql2($sql_get_uid);
	return $arr_get_uid[0]['K_UserId'];
}



/*
 * 根据CodeId  来获取 处理状态
* 参数1  CodeId 
* 参数2  SqlHelper对象，并且是引用参数
* 引入人 徐文志
* 时间   2014年2月26日 21:00
*/
function getStatus($id , &$sqlHelper){
	$sql_get_status = "Select CodeName from t_basecode where CodeId = '".$id."'";
	$arr_get_status = $sqlHelper -> execute_dql2($sql_get_status);
	return $arr_get_status[0]['CodeName'];
}



/*通过用管理员ID来获取管理员真实姓名
 * 参数1 管理员ID
* 参数2 SqlHelper的对象 并且是引用参数
* 引入人 : 徐文志
* 时间:14年2月26日 22:11
*/
function getManagerName($MId, &$sqlHelper){
	$sql_get_user_name = "Select K_ManagerName from t_manager where K_ManagerId = {$MId}";
	$arr_get_user_name = $sqlHelper -> execute_dql2($sql_get_user_name);
	//if($arr_get_user_name[0]['K_UserName'] != ""){
	return $arr_get_user_name[0][0];
	//	}else{
	//return '未填写';
	//}
}



?>