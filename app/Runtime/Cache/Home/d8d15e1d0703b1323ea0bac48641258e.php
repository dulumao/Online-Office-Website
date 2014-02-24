<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>西安市两化融合项目 后台管理</title>
<?php include("inc/cssjs.html") ?>
<style>
body {
	background-color:#333;
}
.log {
	margin-left:auto;
	margin-right:auto;
	width:650px;
	background-color:#FFF;
	margin-top:10%;
	-webkit-border-radius: 6px;
	-moz-border-radius: 6px;
	border-radius: 6px;		
}
.log form {
	border:30px solid #e9eaee;
	padding:40px;
	-webkit-border-radius: 6px;
	-moz-border-radius: 6px;
	border-radius: 6px;		
}
</style>
</head>

<body>
<div class="log">
<form class="form-horizontal" action="index.php?m=Index&a=login_admin">
  <div class="control-group">
    <label for="inputEmail" class="control-label">账户</label>
    <div class="controls">
      <input type="text" placeholder="账户" id="" name="u">
    </div>
  </div>
  <div class="control-group">
    <label for="inputPassword" class="control-label">密码</label>
    <div class="controls">
      <input type="password" placeholder="密码" id="" name="p">
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      
      <button class="btn" type="submit">登陆</button>
    </div>
  </div>
</form>
</div>
</body>
<script>
	$(function() {
		$(".bs-docs-sidenav").find("li:eq(1)").addClass("active");
	});
</script>
</html>