<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <title>项目申报系统</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="public/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="public/stylesheets/theme.css">
    <link rel="stylesheet" href="public/lib/font-awesome/css/font-awesome.css">
    <script src="public/lib/jquery-1.7.2.min.js" type="text/javascript"></script>    
	<!--date picker--> 
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
  </head>
  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 
  <body class=""> 
  <!--<![endif]-->
    
<?php include("public/include/navbar.php") ?>  <?php include("public/include/left-nav.php") ?>    
<script>
function openNavList(){
  var currentClassName = document.getElementById("1").className;
  document.getElementById("1").className = currentClassName + "in";
}
window.onload = openNavList();
</script>
    
    <div class="content">
        
        <div class="header">
            <h1 class="page-title">新项目申报</h1>
        </div>
        
        <ul class="breadcrumb">
            <li>项目管理<span class="divider">/</span></li>
            <li class="active">新项目申报</li>
        </ul>

        <div class="container-fluid">

<div class="row-fluid">
<!--
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>消息提醒：</strong> <a href="#">管理员向您发来了新消息，点击查看。</a>
    </div>
-->
    <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>操作提示：</strong>
        <a href="index.php">第一步：保存申请。</a>
        <span class="nbsp"></span>
        <a href="newproject_upload.php">第二步：上传附件。</a>
        <span class="nbsp"></span>
        <a href="newproject_submit.php">第三步：提交申请。</a>
    </div>
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>温馨提示：</strong> <a href="#">上传文件时请将多个文件打包后再上传</a>
    </div>
    
</div>

<div class="row-fluid">
    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">新项目申报（第二步：上传附件,最多允许上传八个文件。）</a>
        <div id="page-stats" class="block-body collapse in">
        	
			<div class="well">
            	<h3>上传文件</h3>
          	 	<form action="index.php?m=Unit&a=newproject_submit" method="post" enctype="multipart/form-data">
            		<input name="file1" type="file" />
					<input name="file2" type="file" />
					<input name="file3" type="file" />
					<input name="file4" type="file" />
					<input name="file5" type="file" />
					<input name="file6" type="file" />
					<input name="file7" type="file" />
					<input name="file8" type="file" />					
					<input name="id" value="<?php echo ($id); ?>" type="hidden"/>                    
                    <br /><br />
                    <input type="submit" class="btn btn-primary" value="文件选择完毕，点击上传"/>                    
            	</form>
            </div>
        </div>
    </div>
    
<!--以下为文件删除确认框--> 
    <div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">文件删除确认</h3>
        </div>
        <div class="modal-body">
            <p class="error-text"><i class="icon-warning-sign modal-icon"></i>您确实要删除本文件吗？删除后不可恢复。</p>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
            <button class="btn btn-danger" data-dismiss="modal">删除</button>
        </div>
    </div>
    
</div>
<?php include("public/include/footer.php") ?>  </div></div>
    


    <script src="public/lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>