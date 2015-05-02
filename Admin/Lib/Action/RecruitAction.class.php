<?php
//人才管理类 也就是 招聘类
class RecruitAction extends CommonAction {
	/*
	 * 人才管理首页
	 */
	public function index(){
		$r = D('Recruit');   //这里使用关联查询，在NewsModel.class.php中定义了模型
		import('ORG.Util.Page');// 导入分页类
		$count      = $r->count();// 查询满足要求的总记录数
		$page       = new Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $r->field(array('K_RecruitId', 'K_RecruitTrade','K_UserId', 'K_RecruitTitle', 'K_RecruitPosition', 'K_RecruitVisible','K_RecruitTime', 'K_RecruitOrder','K_RecruitVisitTimes'))->order('K_RecruitTime DESC')->limit($page->firstRow.','.$page->listRows)->select();
		//下面通过循环来将一些带有代码的字段(外键)值 修改成真实值
		for($i = 0; $i < count($list); $i++){
			$list[$i]['K_RecruitTrade'] = TradeAction::getTradeNameById($list[$i]['K_RecruitTrade']);
			$list[$i]['K_UserId'] = UserAction::getUserNameById($list[$i]['K_UserId']);
		}
		//dump($show);
		//dump($list);
		$this->assign('RECRUITLIST',$list);// 赋值数据集
		$this->assign('PAGE',$show);// 赋值分页输出
		$this->display();
	}
	
	/*
	 * Ajax通过 招聘ID获取详细信息
	 */
	public function get_recruit_infor(){
		$r = M('Recruit');
		$condition = "K_RecruitId =" .$_POST['recruit_id'];
		$arr = $r -> where($condition) -> field(array('K_RecruitSalary', 'K_RecruitContent', 'K_RecruitLocation', 'K_RecruitDegree' ))->select();
		//dump($arr);
		//处理一下招聘地址
		$temp_arr = explode('&', $arr[0]['K_RecruitLocation']);
		$str = "";
		for($i = 0; $i < count($temp_arr); $i ++){
			$str .= $temp_arr[$i];
		}
		
		$arr[0]['K_RecruitLocation'] = $str;
		$arr[0]['K_RecruitSalary'] = CodeAction::getCateName($arr[0]['K_RecruitSalary']);
		$arr[0]['K_RecruitDegree'] = CodeAction::getCateName($arr[0]['K_RecruitDegree']);
		echo json_encode($arr);
	}
	/*
	 * 前端删除 招聘信息时  的Ajax控制器
	 */
	public function remove_recruit(){
		if(!isset($_POST['recruit_id'])){
			echo "error";
			exit;
		}
		$r = M('Recruit');
		$condition = "K_RecruitId = ".$_POST['recruit_id'];
		$res_delete_recruit = $r->where($condition)->delete();
		if($res_delete_recruit!=null){
			echo "ok";
		}else{
			echo "no";
		}
	}
	
	/*
	 * Ajax 修改 招聘信息 的 置顶级别
	 * 会POST过来一个字符串  通过 "-"  相连 
	 * num1-num2  num1代表需要修改的招聘信息的 ID  num2为置顶数
	 */
	public function up_recruit_top(){
		if(!isset($_POST['up_recruit_top_str'])){
			echo "error";
			exit;
		}
		$arr = explode('-',$_POST['up_recruit_top_str']);
		$recruit_id = $arr[0];
		$top_value = $arr[1];
		$r = M('Recruit');
		$data['K_RecruitOrder'] = $top_value;
		$condition = "K_RecruitId = " . $recruit_id;
		$res_up_rec_top = $r->where($condition)->save($data);
		if($res_up_rec_top != null){
			echo "ok";
		}else{
			echo "no";
		}
	}
	
	
	/*
	 * 招聘统计  信息
	 */
	public function statistics(){
		$r = M('Recruit');
		//首先在  “最新数据” 中需要统计  今天  最近一周 和最近一个月的招聘信息的数量
		//首先获取  今天 发布的 招聘信息的数量
		$condition = "TO_DAYS(NOW()) - TO_DAYS(K_RecruitTime) <= 0";
		$today_count = $r->where($condition)->count();
		
		//获取最近一周的 招聘信息的数量
		$condition = "TO_DAYS(NOW()) - TO_DAYS(K_RecruitTime) <= 7";
		$week_count = $r->where($condition)->count();
		
		//获取最近一个月 招聘信息 的数量
		$condition = "TO_DAYS(NOW()) - TO_DAYS(K_RecruitTime) <= 31";
		$month_count = $r->where($condition)->count();
		
		//火热招聘 部分  点击量 高的  60天以内的
		$hot_recruit = $this->getHotRecruit(10);
		
		$this->assign('HOTRECRUIT', $hot_recruit);
		$this->assign('TODAYCOUNT', $today_count);
		$this->assign('WEEKCOUNT', $week_count);
		$this->assign('MONTHCOUNT', $month_count);
		$this->display();
	}
	
	
	/*
	 * 获取 点击量 最高的  前 {参数 1}条数据
	*/
	public static function getHotRecruit($limit){
		$r = M('Recruit');
		$condition = "TO_DAYS(NOW()) - TO_DAYS(K_RecruitTime) <= 60";
		$arr = $r->limit(0, $limit)->field(array('K_RecruitId', 'K_RecruitTitle'))->order('K_RecruitVisitTimes desc')->select();
		return $arr;
	}
	
}
?>