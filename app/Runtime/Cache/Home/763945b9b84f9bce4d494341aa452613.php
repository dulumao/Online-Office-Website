<?php if (!defined('THINK_PATH')) exit(); $htmlData = ''; if (!empty($_POST['content1'])) { if (get_magic_quotes_gpc()) { $htmlData = stripslashes($_POST['content1']); } else { $htmlData = $_POST['content1']; } } ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>后台管理</title>
<?php include("inc/cssjs.html") ?>
	<link rel="stylesheet" href="lib/kindeditor-4.1.7/themes/default/default.css" />
	<link rel="stylesheet" href="lib/kindeditor-4.1.7/plugins/code/prettify.css" />
	<script charset="utf-8" src="lib/kindeditor-4.1.7/kindeditor.js"></script>
	<script charset="utf-8" src="lib/kindeditor-4.1.7/lang/zh_CN.js"></script>
	<script charset="utf-8" src="lib/kindeditor-4.1.7/plugins/code/prettify.js"></script>
	<script>
		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="content1"]', {
				cssPath : 'lib/kindeditor-4.1.7/plugins/code/prettify.css',
				uploadJson : 'lib/kindeditor-4.1.7/php/upload_json.php',
				fileManagerJson : 'lib/kindeditor-4.1.7/php/file_manager_json.php',
				allowFileManager : true,
				afterCreate : function() {
					var self = this;
					K.ctrl(document, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
				}
			});
			prettyPrint();
		});
	</script>
</head>

<body>
<?php include("inc/head.html") ?>
<div class="container-fluid">
	<div class="row-fluid">
    	<?php include("inc/nav.html") ?>
        <div class="span10 main">
            <ul class="nav nav-tabs" id="myTab">
              <li class="active"><a data-toggle="tab" href="#home">添加新闻</a></li>
              <li class=""><a data-toggle="tab" href="#profile">查看已有新闻</a></li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div id="home" class="tab-pane fade active in">
				<?php echo $htmlData; ?>
                <form name="example" method="post" action="">
                                <fieldset>新闻标题</fieldset>
                                <input type="text">
                                <fieldset>新闻内容</fieldset>                    
                    <textarea name="content1" style="width:700px;height:200px;visibility:hidden;"><?php echo htmlspecialchars($htmlData); ?></textarea>
                    <br />
                    <input type="submit" class="btn btn-primary" name="button" value="提交内容" /> (提交快捷键: Ctrl + Enter)
                </form>
              </div>
              <div id="profile" class="tab-pane fade">
			  	<table class="table table-hover">
                    <thead>
                      <tr>
                        <th>上传时间</th>
                        <th>标题</th>
                        <th>链接</th>
                        <th>操作</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>2012-12-12</td>
                        <td>Raw denim you probably haven't heard of them jean shorts Austin.</td>
                        <td><a href="http://www.cctv.com.cn/xsa/xa/xa">http://www.cctv.com.cn/xsa/xa/xa</a></td>
                        <td><a href="#">修改</a><a>&nbsp;</a><a href="#">删除</a></td>
                      </tr>
                    </tbody>
            	</table>
				<div class="pagination">
                    <ul>
                      <li><a href="#">«</a></li>
                      <li><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">4</a></li>
                      <li><a href="#">5</a></li>
                      <li><a href="#">»</a></li>
                    </ul>
           	   </div>                              
              </div>
            </div>
        </div>
    </div>
</div>
<script>
	$(function() {
		$(".bs-docs-sidenav").find("li:eq(0)").addClass("active");
	});
</script>
</body>
</html>