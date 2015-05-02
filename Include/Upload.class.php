<?php
	/*
	作者：徐文志
	所在:哈尔滨理工大学
	文件上传类，早在2013年8月就已完成，使用起来一般般，
	但是现在希望能够改进一下，改进时间 2014年2月28日
	*/
	class Upload{
		var $ImgName;  //文件的名字 <input type='file' name=''/> 所指定的name也就是要赋值给ImgName
		var $ImgPath;	//要将上传的文件上传的位置 
		var $ImgMaxSize;	//上传的文件的最大尺寸
		var $ImgType;	//指定上传文件的类型，一般会是一个数组
		var $boolWH;   //一个识别变量，如果为1 执行对图片裁剪  如果为其他 不裁剪 由下面两个变量定义裁剪尺寸
		var $ImgWidth;	//裁剪图片的宽度
		var $ImgHeight;	//裁剪图片的高度
		var $ImgNameLength = '15';

		//检查文件的类型是否标准
		public function checkImg(){
			//如果文件的类型不支持
			if($this->ImgName['size'] > $this->ImgMaxSize){
				return 'size';//返回size
			}
			return true;
		}

		//新生成的文件的名称长度是随机的
		//默认是15个长度，如果需要增加长度或者减短长度，那么可以进行修改
		public function changeNameLength($length){
			$this->ImgNameLength = $length;
		}
		//完成上传
		//返回值 为 文件新路径地址
		public function finishUpload(){
			//这里先获取文件后缀名
			$typeNamePos = strpos($this->ImgName['name'],'.');
			$typeName = substr($this->ImgName['name'],$typeNamePos, strlen($this->ImgName['name']));
			$this->ImgName['name'] = $this->createRandName($this->ImgNameLength).$typeName;//为文件生成新名字
			if($this->ImgPath != ''){
				$filename = $this->ImgPath."/".$this->ImgName['name'];//图片路径
			}else{
				$filename = $this->ImgName['name'];
			}
			if(!move_uploaded_file($this->ImgName['tmp_name'],  $filename)){
				  return 'move';
				  exit;
			}
			//如果需要对图片进行裁剪，则对图片进行裁剪
			if($this->boolWH == '1'){
				$this->resize_image($filename, $filename, $this->ImgWidth, $this->ImgHeight);
			}
			return $filename;
		}
		//生成随机字符串
		public function createRandName($length){
			$randStr = '';
			$pattern='1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
			for($i=0 ; $i<$length; $i++){
				$randStr .= $pattern[rand(0, 51)];
			}
			return $randStr;
		}
		/******************************************************************/
		/**
		 * 执行图片裁剪
		 * @param string $img_src 图片原始文件夹的路径
		 * @param string $new_img_path 要将新图片移动到哪个文件夹
		 * @param int $new_width 新图片的尺寸
		 * @param int $new_height 新图片的高度
		 * @return bool  如果裁剪成功，返回true  如果不成功 返回false 
		 */
		public function resize_image($img_src, $new_img_path, $new_width, $new_height)
		{
			$img_info = @getimagesize($img_src);
			if (!$img_info || $new_width < 1 || $new_height < 1 || empty($new_img_path)) {
				return false;
			}
			if (strpos($img_info['mime'], 'jpeg') !== false) {
				$pic_obj = imagecreatefromjpeg($img_src);
			} else if (strpos($img_info['mime'], 'gif') !== false) {
				$pic_obj = imagecreatefromgif($img_src);
			} else if (strpos($img_info['mime'], 'png') !== false) {
				$pic_obj = imagecreatefrompng($img_src);
			} else {
				return false;
			}

			$pic_width = imagesx($pic_obj);
			$pic_height = imagesy($pic_obj);

			if (function_exists("imagecopyresampled")) {
				$new_img = imagecreatetruecolor($new_width,$new_height);
				imagecopyresampled($new_img, $pic_obj, 0, 0, 0, 0, $new_width, $new_height, $pic_width, $pic_height);
			} else {
				$new_img = imagecreate($new_width, $new_height);
				imagecopyresized($new_img, $pic_obj, 0, 0, 0, 0, $new_width, $new_height, $pic_width, $pic_height);
			}
			if (preg_match('~.([^.]+)$~', $new_img_path, $match)) {
				$new_type = strtolower($match[1]);
				switch ($new_type) {
					case 'jpg':
						imagejpeg($new_img, $new_img_path);
						break;
					case 'gif':
						imagegif($new_img, $new_img_path);
						break;
					case 'png':
						imagepng($new_img, $new_img_path);
						break;
					default:
						imagejpeg($new_img, $new_img_path);
				}
			} else {
				imagejpeg($new_img, $new_img_path);
			}
			imagedestroy($pic_obj);
			imagedestroy($new_img);
			return true;
		}
	}
?>