<?php
class NewsAction extends CommonAction{
	//后台管理新闻公告主页
	public function index(){
		//获取新闻数据
		$n = D('News');   //这里使用关联查询，在NewsModel.class.php中定义了模型
		import('ORG.Util.Page');// 导入分页类
		$count      = $n->count();// 查询满足要求的总记录数
		$page       = new Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $n->relation(true)->field(array('K_NewsId', 'K_NewsTop','K_NewsTitle', 'K_NewsContent', 'K_NewsCategory', 'K_NewsTime','K_NewsVisitTimes', 'K_ManagerId'))->order('K_NewsTime DESC')->limit($page->firstRow.','.$page->listRows)->select();
		//下面通过循环来获取发布新闻的管理员的姓名
		for($i = 0; $i < count($list); $i++){
			$list[$i]['K_ManagerId'] = ManagerAction::getManaName($list[$i]['K_ManagerId']);
		}
		//dump($show);
		//dump($list);
		$this->assign('PAGENEWS',$list);// 赋值数据集
		$this->assign('PAGE',$show);// 赋值分页输出
		$this->display();
	}
	/*
	 * 编辑新闻页面
	*/
	public function edit(){
		if(!isset($_GET['n_id'])){
			$this->redirect('News/index', '', 3, '<html>非法操作</html>');
		}
		//这里到数据库中将id为$_GET['n_id']的新闻内容拿出来
		$n = M('News');
		$where = 'K_NewsId =' . $_GET['n_id'];
		$arr = $n -> where ($where) -> field(array('K_NewsTitle', 'K_NewsCategory', 'K_NewsContent')) -> select();
		$this->assign("NEWSID", $_GET['n_id']);
		$this->assign("NEWSTITLE", $arr[0]['K_NewsTitle']);
		$this->assign("NEWSCATE", $arr[0]['K_NewsCategory']);
		$this->assign("NEWSCON", $arr[0]['K_NewsContent']);
		//从BaseCode表中获取新闻类数据
		$arr_news_cate = CodeAction::getCodeCate(1);
		$this->assign("NEWSCATES", $arr_news_cate);	
		//dump($arr_news_cate);	
		$this->display();
	}
	/*
	 * 编辑新闻控制器
	*/
	public function control_edit(){
		$n = M('News');
		$condition = 'K_NewsId='.$_GET['n_id'];//新闻id
		$data['K_NewsTitle'] = $_POST['news_title'];//新闻标题
		$data['K_NewsContent']  = $_POST['content1'];//新闻内容
		$data['K_NewsCategory']  = $_POST['news_cate'];//新闻类别
		$res_update_news = $n -> where($condition)->save($data);//修改
		if($res_update_news != null){
			$this->success('修改成功');
		}else{
			$this->error('修改失败');
		}
	}
	/*
	 * 添加新闻页面
	 */
	public function add(){
		//从BaseCode表中获取新闻类数据
		$arr_news_cate = CodeAction::getCodeCate(1);
		$this->assign("NEWSCATES", $arr_news_cate);	
		$this->display();
	}
	/*
	 * 添加新闻 控制器
	 */
	public function control_add(){
		$n = M('News');
		$data['K_NewsTitle'] = $_POST['news_title'];//新闻标题
		$data['K_NewsContent']  = $_POST['content1'];//新闻内容
		$data['K_NewsCategory']  = $_POST['news_cate'];//新闻类别
		$data['K_ManagerId'] = $_SESSION['ManagerId'];//添加管理员ID
		$data['K_NewsTime'] = date("Y-m-d H:i:s", time());
		$data['K_NewsVisitTimes'] = 0;
		$data['K_NewsTop'] = 0;
		$res_update_news = $n -> add($data);//添加
		if($res_update_news != null){
			$this->success('添加成功');
		}else{
			$this->error('添加失败');
		}
	}
	
	/*
	 * 执行删除新闻资讯kongzhiqi
	 */
	public function control_del(){
		if(!isset($_POST['n_id'])){
			echo "notid";
			return;
		}
		//下面执行真正的删除
		$n = M('News');
		$where = 'K_NewsId ='.$_POST['n_id'];
		$res_news_del = $n->where($where)->delete();
		if($res_news_del!=null){
			echo "ok";
		}else{
			echo "no";
		}
	}
	
	/*
	 * 批量删除新闻
	*/
	public function control_quantities_del(){
		$quantities_news_id = $_POST['quantities_news_id'];
		$quantities_news_id = explode('-', $quantities_news_id);//转化为数组
		$quantities_news_count = count($quantities_news_id);
		$n = M('News');
		//通过循环构造SQL语句 类似于这样的条件  K_NewsId = 27 or K_NewsId = 26 or K_NewsId = 25 or K_NewsId = 24 or K_NewsId = 16 or K_NewsId = 15
		$condition = "";
		$do_length = 0;
		for($i = 0; $i < count($quantities_news_id); $i++){
			$condition = "K_NewsId = " . $quantities_news_id[$i];
			$res_news_del = $n -> where($condition) -> delete();
			if($res_news_del != null){
				$do_length ++;
			}
		}
		if($do_length == 0){
			echo "error";
			exit;
		}
		if($do_length == $quantities_news_count){
			echo "ok";
			exit;
		}else{
			echo "no";
			exit;
		}
	}
	
	/*
	 * 修改新闻公告的置顶级别
	 * 会POST过来 新闻  ID 和 置顶数  
	 */
	public function up_news_top(){
		if(!isset($_POST['up_news_top_str'])){
			echo "error";
			exit;
		}
		$temp_arr = explode('-', $_POST['up_news_top_str']); 
		$condition = "K_NewsId  = ".$temp_arr[0];
		$data['K_NewsTop'] = $temp_arr[1];
		$n = M('News');
		$res_up_top = $n->where($condition)->save($data);
		if($res_up_top!=null){
			echo "ok";
			exit; 
		}else{
			echo "no";
			exit;
		}
	}
}




?>









