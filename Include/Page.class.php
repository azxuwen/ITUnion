<?php
	class Page{
		//页面中的属性
		var $html = "";//HTML版本
		var $charset  = "";//编码方式
		var $keywords = '';//关键字
		var $description = "";//网页描述
		var $title = '';//网页标题
		var $stylePath = "";//CSS文件路径
		var $javascriptPath = '';//javascript路径
		var $headerPath = '';//页眉路径
		var $footPath = '';//页脚路径
		var $contents;
		public function __set($name, $value){
			$this->$name = $value;
		}
		//展示页面 ]
		public function Display(){
			//HTML版本控制
			if($this->html == 5){
				echo "<!DOCTYPE HTML>";
			}else{
				echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
			}
			echo "\n<html>\n<head>\n";
			//网页编码方式
			$this->DisplayCharset();
			//网页标题
			$this->DisplayTitle();
			//网页关键字
			$this->DisplayKeywords();
			//网页描述
			$this->DisplayDescription();
			//网页CSS文件
			$this->DisplayStyles();
			//网页javascript文件
			$this->DisplayJavascript();
			echo "</head>\n<body>\n";
			$this->DisplayHeader();
			echo $this->contents;
			$this->DisplayFooter();
			echo "</body>\n</html>";
		}
		//标题函数
		public function DisplayTitle(){
			echo "<title>".$this->title."</title>\n";
		}
		//关键字函数
		public function DisplayKeywords(){
			echo "<meta name=\"Keywords\" content=\"".$this->keywords."\" />\n";
		}
		//编码方式
		public function DisplayCharset(){
			echo "<meta http-equiv='content-type' content='text/html;charset= ".$this->charset."' />\n";
		}
		//网页描述
		public function DisplayDescription(){
			echo "<meta name='description' content={$this->description}>\n";
		}
		//样式表函数
		public function DisplayStyles(){
			if(count($this->stylePath) > 0){
				for($i = 0; $i < count($this->stylePath); $i++){
					echo $this->stylePath[$i]."\n";
				}
			}else{
				echo $this->stylePath;
			}
		}
		//javascript函数
		public function DisplayJavascript(){
			if(count($this->javascriptPath) > 0){
				for($i = 0; $i < count($this->javascriptPath); $i++){
					echo $this->javascriptPath[$i]."\n";
				}
			}else{
				echo $this->javascriptPath;
			}
		}
		//标题栏函数
		function DisplayHeader(){
			//添加标题
			if($this->headerPath){
				include($this->headerPath);
			}
		}
		
		function DisplayFooter(){
			//添加页脚
			if($this->footPath){
				include($this->footPath);
			}
		}
	}
?>