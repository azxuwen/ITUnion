<?php
/*关联模型 关联新闻公告的 类别*/
class NewsModel extends RelationModel{
	public $_link = array(
		 'Basecode'=> array(  
		   'mapping_type'=>BELONGS_TO,
           'class_name'=>'Basecode',
           'foreign_key'=>'K_NewsCategory',
           'mapping_name'=>'K_NewsCategory',
		),
	);
}

?>