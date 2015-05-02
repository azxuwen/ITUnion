<?php
//产品类
class ProductAction extends CommonAction {
	/*
	 * 产品管理  显示
	*/
	public function index(){
		$p = M('Product');   //这里使用关联查询，在ProductModel.class.php中定义了模型
		import('ORG.Util.Page');// 导入分页类
		$count      = $p->count();// 查询满足要求的总记录数
		$page       = new Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $p->field(array('K_ProductId', 'K_ProductTitle','K_ProductManagerId', 'K_ProductTop', 'K_ProductPicAddress', 'K_ProductTime','K_ProductVisitTimes', 'K_ProductKind'))->order('K_ProductTime DESC')->limit($page->firstRow.','.$page->listRows)->select();
		//下面通过循环来获取发布新闻的管理员的姓名
		for($i = 0; $i < count($list); $i++){
			//$list[$i]['K_ProductPicAddress'] = explode(',', $list[$i]['K_ProductPicAddress'])[1];//因为产品中会有多个图片，这里只获得其中的第一个图片地址
			$list[$i]['K_ProductKind'] = CodeAction::getCateName($list[$i]['K_ProductKind']);//获取分类
			$list[$i]['K_ProductManagerId'] = ManagerAction::getManaName($list[$i]['K_ProductManagerId']);//获取添加管理员姓名
		}		
		$this->assign('PAGEPRODUCT',$list);// 赋值数据集
		$this->assign('PAGE',$show);// 赋值分页输出
		$this->display();
	}
	
	/*
	 * 显示修改产品的页面
	 */
	public function edit(){
		//如果链接有问题，执行跳转
		if(!isset($_GET['p_id'])){
			HeaderAction::myHeader('Product/index', '页面非法,正在跳转...', 2);
		}
		$p = M('Product');
		$condition = "K_ProductId = " . $_GET['p_id'];
		$arr_product_list = $p -> where($condition)->field(array('K_ProductTitle', 'K_ProductContent', 'K_ProductPicAddress', 'K_ProductKind', 'K_ProductAdvertisment', 'K_ProductUserId'))->select();
		$arr_product_cate = CodeAction::getCodeCate(4);//产品类别代码
		//将多个产品的配图  从字符串处理成数组  通过explode()转化的数组为一维数组  还需要转化成二维数组供模板使用
		$arr_product_pic = explode(',', $arr_product_list[0]['K_ProductPicAddress']);
		$arr_product_pic_end = array();
		for($i = 0; $i < count($arr_product_pic); $i++){
			$arr_product_pic_end[$i]['K_ProductPicAddress'] = $arr_product_pic[$i];
			$arr_product_pic_end[$i]['K_ProductImageOrder'] = $i+1;//这里为每个图片分配一个序号，这样在模板页面的时候，当鼠标移动到这个图片的时候，可以很快的定位到这个图片地址的位置
		}
		$this->assign("PROID",$_GET['p_id']);
		$this->assign("PROTITLE", $arr_product_list[0]['K_ProductTitle']);
		$this->assign("PROCON", $arr_product_list[0]['K_ProductContent']);
		$this->assign("PROCATE", $arr_product_list[0]['K_ProductKind']);
		$this->assign("PROCOMPANY", UserAction::getUserNameById($arr_product_list[0]['K_ProductUserId']));
		$this->assign("PROCOMPANYID", $arr_product_list[0]['K_ProductUserId']);
		$this->assign("CODECATE", $arr_product_cate);
		$this->assign("PROPIC", $arr_product_pic_end);
		$this->display();
	}
	
	/*
	 * 处理 Ajax
	 * 移除产品图片地址 控制器
	 * 处理机制，因为图片地址是通过 图片1地址 , 图片2地址 , 图片3地址
	 * 如果要删除图片2的地址，那么需要传递过来一个图片的序号  2
	 * 参数为前端通过 POST方式传递过来的一个字符串  rmv_pic_str 组成方式 为 {要删除的图片地址序号 & 产品ID} 
	*/
	public function remove_product_pic_address(){
		//如果不存在这个 POST过来的字符串，输出错误
		if(!isset($_POST['rmv_pic_str'])){
			echo "error";
			exit;
		}
		$rmv_pic_str = explode('-', $_POST['rmv_pic_str']);
		$pic_order = $rmv_pic_str[0]-1;//需要移除的图片序号,对它执行 -1 是方便在数组遍历时，好处理
		$product_id = $rmv_pic_str[1]; //需要处理的产品 ID
		//首先将这个产品的地址拿过来
		$p = M('Product');
		$condition = "K_ProductId = " . $product_id;
		$arr_product_pic = $p->where($condition)->field(array('K_ProductPicAddress'))->select();
		$arr_pics = explode(',', $arr_product_pic[0]['K_ProductPicAddress']);
		//这个产品的所有图片地址的数组就已经拿到了,下面只需要通过那个删除图片的ID号来删除掉该图片即可,通过过循环来构造移除图片后的图片拼接地址
		//新的图片拼接地址字符串 保存在变量  $new_pro_pic_str 中 
		$new_pro_pic_str = ""; 
		for($i = 0 ;$i < count($arr_pics); $i++){
			if($i != $pic_order){
				$new_pro_pic_str .= $arr_pics[$i].",";
			}else{
				continue;
			}
		}
		$new_pro_pic_str = substr($new_pro_pic_str, 0, strlen($new_pro_pic_str)-1);
		//下面执行修改数据库
		$data['K_ProductPicAddress'] = $new_pro_pic_str;
		$res = $p->where($condition)->save($data);//保存到数据库
		//然后需要执行 删除这个文件在服务器文件夹的文件
		unlink($arr_pics[$pic_order]);
		if($res != null){
			echo "ok";
			exit;
		}else{
			echo "no";
			exit;
		}
	}
	
	/*
	 * 编辑 产品的 控制器 
	 * 表单所在 Product/edit
	 * 
	 */
	public function control_edit(){
		if(!isset($_GET['p_id'])){
			HeaderAction::myHeader('Product/index', '页面非法,正在跳转...', 2);
		}
		//下面执行修改
		$p = M('Product');
		$data['K_ProductTitle'] = $_POST['product_title'];
		$data['K_ProductContent'] = $_POST['content1'];
		$data['K_ProductKind'] = $_POST['product_cate'];
		$data['K_ProductUserId'] = $_POST['product_company_id'];
		$condition = "K_ProductId = ".$_GET['p_id'];
		$res_up_product = $p->where($condition)->save($data);
		if($res_up_product != null){
			$this->success('修改成功');
		}else{
			$this->error('修改失败');
		}
	}
	
	/*
	 * 编辑产品处，能够实现添加图片的 控制器
	 */
	public function add_pic(){
		//执行上传图片
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath =  './Upload/Images/';// 设置附件上传目录
		if(!$upload->upload()) {// 上传错误提示错误信息
			$this->error($upload->getErrorMsg());
		}else{// 上传成功 获取上传文件信息
			$info =  $upload->getUploadFileInfo();
		}
		// 保存表单数据 包括附件数据
		if(!isset($_GET['p_id'])){
			$this->error('操作失败，请重试');
			exit;
		}
		$p = M("Product"); 
		$condition = "K_ProductId = " . $_GET['p_id'];
		$arr_list = $p->where($condition)->field(array('K_ProductPicAddress'))->select();
		$arr_list[0]['K_ProductPicAddress'] .= ',Upload/Images/'.$info[0]['savename'];
		$data['K_ProductPicAddress'] = $arr_list[0]['K_ProductPicAddress'];
		$res_add_pic = $p->where($condition)->save($data);
		if($res_add_pic != null){
			$this->success('图片添加成功');
		}else{
			$this->error('图片添加失败');
		}
	}
	/*
	 * 执行删除产品   控制器
	 */
	public function control_del(){
		if(!isset($_POST['p_id'])){
			echo "error";
			exit;
		}
		//执行删除
		$p = M('Product');
		$condition = "K_ProductId = " .$_POST['p_id'];
		$res_del_product = $p -> where($condition) -> delete();
		if($res_del_product != null){
			echo "ok";
		}else{
			echo "no";
		}
	}
	
	/*
	 * 执行添加产品 的 页面
	 */
	public function add(){
		$p = M('Product');
		$arr_product_cate = CodeAction::getCodeCate(4);//产品类别代码
		$arr_user_company = UserAction::getUserByType('c');//获取全部企业用户
		$this->assign("PROCATE", $arr_product_cate);
		$this->assign("COMPANY", $arr_user_company);
		$this->display();
	}
	/*
	 * 添加产品 控制器
	 */
	public function control_add(){
		
		//执行上传图片
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath =  './Upload/Images/';// 设置附件上传目录
		if(!$upload->upload()) {// 上传错误提示错误信息
			$this->error($upload->getErrorMsg());
		}else{// 上传成功 获取上传文件信息
			$info =  $upload->getUploadFileInfo();
		}
		//循环构造 上传的图片的地址
		$product_pic_address = "";
		for($i = 0; $i < count($info); $i++){
			$product_pic_address .= "Upload/Images/".$info[$i]['savename'].",";
		}
		$product_pic_address = substr($product_pic_address, 0, strlen($product_pic_address)-1);
		
		$p = M('Product');
		$data['K_ProductTitle'] = $_POST['product_title'];
		$data['K_ProductContent'] = $_POST['content1'];
		$data['K_ProductKind'] = $_POST['product_cate'];
		$data['K_ProductUserId'] =$_POST['product_company_id'];
		$data['K_ProductManagerId'] = $_SESSION['ManagerId'];
		$data['K_ProductTime'] = date('Y-m-d H:i:s', time());
		$data['K_ProductVisitTimes'] = 1;
		$data['K_ProductAdvertisment'] = 'N';
		$data['K_ProductPicAddress'] = $product_pic_address;
		$res_add_product = $p->add($data);
		if($res_add_product != null){
			$this->success('添加成功');
		}else{
			$this->error('添加失败，请重试');
		}
	}
	
	/*
	 * 修改产品的 置顶级别
	 * 会POST过来 置顶的信息 产品ID-置顶数
	 */
	public function up_product_top(){
		if(!isset($_POST['up_product_top_str'])){
			echo "error";
			exit; 
		}
		$temp_arr = explode('-', $_POST['up_product_top_str']);
		$data['K_ProductTop'] = $temp_arr[1];
		$condition = "K_ProductId = ".$temp_arr[0];
		$p = M('Product');
		$res_up_top = $p->where($condition)->save($data);
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




