<?php
//后台配置文件
return array(
	//'配置项'=>'配置值'
	'SHOW_PAGE_TRACE' =>true, // 显示页面Trace信息
	'DB_DSN'=>'mysql://root:@localhost:3306/itunion',
	'DB_PREFIX'=>'t_',
	//'URL_MODEL'=>2,
	'TMPL_L_DELIM'=>'<{', //修改左定界符
	'TMPL_R_DELIM'=>'}>', //修改右定界符
	'TMPL_TEMPLATE_SUFFIX'=>'.html',//更改模板文件后缀名
	'URL_CASE_INSENSITIVE'=>true,//url不区分大小写
	 'TMPL_PARSE_STRING'=>array( //添加自己的模板变量规则
		'__CSS__'=>__ROOT__.'/Public/Css',
		 '__JS__'=>__ROOT__.'/Public/Js',
		'__IMG__'=>__ROOT__.'/Public/Images',
		'__LIBS__'=>__ROOT__.'/Libs',
		'__ITJS__'=>__ROOT__.'/Js',
	),
);
?>