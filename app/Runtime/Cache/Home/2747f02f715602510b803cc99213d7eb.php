<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>后台管理</title>
<?php include("inc/cssjs.html") ?>
<script src="js/ajaxtabs.js"></script>
</head>

<body>
<?php include("inc/head.html") ?>
<div class="container-fluid">
	<div class="row-fluid">
    	<?php include("inc/nav.html") ?>
        <div class="span10 main">
            <ul class="nav nav-tabs" id="myTab">
              <li class="active"><a data-toggle="tab" href="#home">未回复留言</a></li>
              <li class=""><a data-toggle="tab" href="#profile">已回复留言</a></li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div id="home" class="tab-pane fade active in">
                <div class="clear"></div>              
              	<div class="meassage_box span12">
                	<div class="meassage_box_time pull-left span1">
                    	2012-12-12
                    </div>
                    <div class="meassage_box_content pull-left span10">
                    	<h4>我是留言标题，可以比较长，我试一下</h4>
                        <p>我是留言内容我是留言内容我是留言内容我是留言内容我是留言内容我是留言内容我是留言内容我是留言内容我是留言内容我是留言内容，内容，内容~~~~</p>
                    </div>
                    <div class="meassage_box_manu pull-right span1">
                    	<a href="#" action="file.php" class="btn btn-primary btn-small">回复</a>
                        <!--此处触发 对话框1 期内的form的action属性值可由a标签的action属性传入-->
                        <br><a href="#" class="btn btn-small">删除</a>
                    </div>
                </div>
                <div class="marginBoder"></div>
				<div class="clearfix"></div>
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
              <div id="profile" class="tab-pane fade">
			  	<table class="table table-hover">
                <thead>
                  <tr>
                    <th>发布时间</th>
                    <th>标题</th>
                    <th>内容</th>
                    <th>操作</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>2012-12-12</td>
                    <td>Raw denim you probably haven't heard of them jean shorts Austin.</td>
                    <td>
                    <a href="#content" onClick="mypets.loadiframepage('message_old.php')" role="button" data-toggle="modal">点击查看</a>
                    <!-- 此处触发 提示框2 期内的内容为ajax加载的iframe ，iframe的地址由a标签的onclick值确定-->
                    </td>
                    <td><a href="#">删除</a></td>
                  </tr>
                  <tr>
                    <td>2012-12-12</td>
                    <td>Raw denim you probably haven't heard of them jean shorts Austin.</td>
                    <td><a href="#content" onClick="mypets.loadiframepage('message_old.php')" role="button" data-toggle="modal">点击查看</a></td>
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
<!-- 对话框1 -->
<div class="myalert">
<div class="myalert_bg"></div>
<div class="myalert_box_parent">
<div class="myalert_box">
<form class="myalert_form" action="">
<fieldset>回复：</fieldset><br>
<textarea class="span4"></textarea>
<button class="btn btn-primary">确认</button>
<a href="#" class="btn mycancle">取消</a>
</form>
</div>
</div>
</div>
<!-- 对话框2 -->
<div id="content" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">留言内容及回复</h3>
</div>
<div class="modal-body">
    <div id="pettabs"></div><div id="petsdivcontainer"></div>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
</div>
</div>

</body>
<script>
$(function() {
	$(".bs-docs-sidenav").find("li:eq(2)").addClass("active");
});
$(".meassage_box_manu a:even").click(function(){
	$(".myalert").fadeIn();
	var action = $(".meassage_box_manu a:even").attr("action");
	$(".myalert_form").attr("action",action);
})
$(".mycancle").click(function(){
	$(".myalert").fadeOut();
})
$(".myalert_bg").click(function(){
	$(".myalert").fadeOut();
})

var mypets=new ddajaxtabs("pettabs", "petsdivcontainer")
mypets.setpersist(false)
mypets.init()
</script>
</html>