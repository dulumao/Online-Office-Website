<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <title>项目申报系统--草稿箱</title>
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
  var currentClassName = document.getElementById("2").className;
  document.getElementById("2").className = currentClassName + "in";
}
window.onload = openNavList();
</script>
    
    <div class="content">
        
        <div class="header">
            <h1 class="page-title">草稿箱</h1>
        </div>
        
        <ul class="breadcrumb">
            <li>示范企业申报<span class="divider">/</span></li>
            <li class="active">草稿箱</li>
        </ul>

        <div class="container-fluid">

<div class="row-fluid">
<!--
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>消息提醒：</strong> <a href="#">管理员向您发来了新消息，点击查看。</a>
    </div>
-->    
</div>

<div class="row-fluid"><!--若本区域无内容，请勿显示-->
    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">草稿箱</a>
        <div id="page-stats" class="block-body collapse in">
        	<div class="well">
                <table class="table">
                  <thead>
                    <tr>
                      <th>申请编号</th>
                      <th>上次修改时间</th>
                      <th style="width: 66px;"></th>
                      <th style="width: 26px;"></th>
                    </tr>
                  </thead>
                  <tbody>
				  	<?php if(is_array($li)): $i = 0; $__LIST__ = $li;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><tr>
                      <td><?php echo ($li["id"]); ?></td>
                      <td><?php echo ($li["time_send"]); ?></td>
					  <td><a href="index.php?m=Unit&a=company_old&id=<?php echo ($li["id"]); ?>">继续编辑</a></td>
                      <td>
                          <a href="index.php?m=Unit&a=company_old&id=<?php echo ($li["id"]); ?>"><i class="icon-pencil"></i></a>
                          <a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a>  
						  <!--以下为文件删除确认框--> 
							<div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h3 id="myModalLabel">项目删除确认</h3>
								</div>
								<div class="modal-body">
									<p class="error-text"><i class="icon-warning-sign modal-icon"></i>您确实要删除本项目吗？删除后不可恢复。</p>
								</div>
								<div class="modal-footer">
									<button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
									<a class="btn btn-danger"  href="index.php?m=Unit&a=rr&id=<?php echo ($li["id"]); ?>">删除</a>
								</div>
							</div>                       
                      </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                  </tbody>
                </table> 
            </div>
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