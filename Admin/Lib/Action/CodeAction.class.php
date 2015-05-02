<?php
class CodeAction extends CommonAction {
	//获取某类具体的类别 例如 专门获取新闻公告的类别 会把所有新闻公告的类别拿出来  并且返回值为一个二维数组
	public static  function getCodeCate($CategoryId){
		$c = M('Basecode');
		$where = 'CodeCategoryId = ' . $CategoryId;
		$arr_code = $c -> where($where) -> field (array('CodeId', 'CodeName')) -> order('CodeOrder')-> select();
		return $arr_code;
	}
	
	//通过某类的ID号，来获取具体的分类名称  参数为CodeId 返回值  OrderName
	public static function getCateName($code_id){
		$c = M('Basecode');
		$where = 'CodeId = '.$code_id;
		$arr_catename = $c -> field(array('CodeName'))-> where($where) -> select();
		return $arr_catename[0]['CodeName'];
	}
}
?>