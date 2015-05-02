$(document).ready(function(){
	KindEditor.ready(function(K) {
		var editor1 = K.create('textarea[name="content1"]', {
			cssPath : PUBLIC+'/Kindeditor/plugins/code/prettify.css',
			uploadJson : PUBLIC+'/Kindeditor/php/upload_json.php',
			fileManagerJson : PUBLIC+'/Kindeditor/php/file_manager_json.php',
			allowFileManager : true,
            items : [  'source', '|', 'undo', 'redo', '|', 'preview', 'code', 'cut','plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', '|', 'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage', 'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap',  'link', 'unlink'  ], 
			afterCreate : function() {
				var self = this;
				K.ctrl(document, 13, function() {
					self.sync();
					K('form[name=r_form]')[0].submit();
				});
				K.ctrl(self.edit.doc, 13, function() {
					self.sync();
					K('form[name=r_form]')[0].submit();
				});
			},
			afterBlur: function(){this.sync();}//非常重要的一个函数，如果想通过button提交，这句必须要存在
		});
		prettyPrint();
	});
});
