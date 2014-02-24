<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>后台管理</title>
<?php include("inc/cssjs.html") ?>
</head>

<body>
<?php include("inc/head.html") ?>
<div class="container-fluid">
	<div class="row-fluid">
    	<?php include("inc/nav.html") ?>
        <div class="span10 main">
            <ul class="nav nav-tabs" id="myTab">
              <li class="active"><a data-toggle="tab" href="#home">上传文件</a></li>
              <li class=""><a data-toggle="tab" href="#profile">查看已上传文件</a></li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div id="home" class="tab-pane fade active in">
                <form>
                	<fieldset>文件名</fieldset>
                    <input type="text">
                	<fieldset>选择文件</fieldset>                    
                    <input type="file">
                    <br>
                    <button class="btn btn-primary">上传</button>
                </form>
              </div>
              <div id="profile" class="tab-pane fade">
			  	<table class="table table-hover">
                    <thead>
                      <tr>
                        <th>上传时间</th>
                        <th>文件名</th>
                        <th>链接</th>
                        <th>操作</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>2012-12-12</td>
                        <td>Raw denim you probably haven't heard of them jean shorts Austin.</td>
                        <td><a href="http://www.cctv.com.cn/xsa/xa/xa">http://www.cctv.com.cn/xsa/xa/xa</a></td>
                        <td><a href="#">删除</a></td>
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
</body>
<script>
	$(function() {
		$(".bs-docs-sidenav").find("li:eq(1)").addClass("active");
	});
</script>
</html>