<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html public/admin "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <title>后台管理系统--项目审批</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="public/admin/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="public/admin/stylesheets/theme.css">
    <link rel="stylesheet" href="public/admin/lib/font-awesome/css/font-awesome.css">
    <script src="public/admin/lib/jquery-1.7.2.min.js" type="text/javascript"></script>  <!--date picker--> 
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
    
<?php include("public/admin/include/navbar.php") ?>   <?php include("public/admin/include/left-nav.php") ?> 
<script>
function openNavList(){
  var currentClassName = document.getElementById("2").className;
  document.getElementById("2").className = currentClassName + "in";
}
window.onload = openNavList();
</script>
    
    <div class="content">
        
        <div class="header">
            <h1 class="page-title">项目验收审批</h1>
        </div>
        
      
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
        <a href="#page-stats" class="block-heading" data-toggle="collapse">等待验收的项目</a>
        <div id="page-stats" class="block-body collapse in">
        	<div class="well">
            <form>
                <table class="table">
                  <thead>
                    <tr>
                      <th>项目编号</th>
                      <th>项目名称</th>
					  <th>承建单位</th>
                      <th>提交时间</th>
                      <th>项目状态</th>
                      <th style="width: 136px;"></th>
                    </tr>
                  </thead>
                  <tbody>
				  	<?php if(is_array($li)): $i = 0; $__LIST__ = $li;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><tr>
                      <td><?php echo ($li["idd"]); ?></td>
                      <td><a href="index.php?m=Admin&a=app_project_content&id=<?php echo ($li["id"]); ?>"><?php echo ($li["proname"]); ?></a></td>
					   <td><a href="index.php?m=Admin&a=com&id=<?php echo ($li["uid"]); ?>"><?php echo ($li["unit"]); ?></a></td>
                      <td><?php echo ($li["time"]); ?></td>
                      <td>申请验收</td>
                      <td>
                          <a href="#myModal1<?php echo ($li["id"]); ?>" role="button" data-toggle="modal">更改状态</a>
                          <a href="#myModal2<?php echo ($li["id"]); ?>" role="button" data-toggle="modal">删除项目</a>
						<div class="modal small hide fade" id="myModal1<?php echo ($li["id"]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo ($li["id"]); ?>" aria-hidden="true">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h3 id="myModalLabel<?php echo ($li["id"]); ?>">项目状态更改</h3>
							</div>
						
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×<tton>
								<h3 id="myModalLabel<?php echo ($li["id"]); ?>">项目状态更改</h3>
							</div>
							<div class="modal-body">
								<p>选择状态</p>
								<select name="state" id="value1<?php echo ($li["id"]); ?>">
									<option value="验收失败">打回补充材料或者拒绝</option>	
									<option value="验收完成">通过验收</option>	
								<lect>
								<p >批复(请尽量精简，最好少于16个字)</p>
								<input id="value2<?php echo ($li["id"]); ?>" name="pifu" value=""/>
								<input name="id" value="<?php echo ($li["id"]); ?>" type="hidden" />
							</div>
							<div class="modal-footer">								
								<button class="btn" data-dismiss="modal" aria-hidden="true">取消<tton>
								<a class="btn btn-primary" type="submit" onclick=mySubmit<?php echo ($li["id"]); ?>()>确认</a>
							</div>
                            <script>
							function mySubmit<?php echo ($li["id"]); ?>(){
								var value1 = document.getElementById("value1<?php echo ($li["id"]); ?>").value;
								var value2 = document.getElementById("value2<?php echo ($li["id"]); ?>").value;
								window.location.href="http://127.0.0.1/index.php?m=Admin&a=yanshou&id=<?php echo ($li["id"]); ?>&state="+value1+"&pifu="+value2;
							}
							</script>

							

						</div>
						<!--                  -->
						 <div class="modal small hide fade" id="myModal2<?php echo ($li["id"]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h3 id="myModalLabel">项目删除确认</h3>
							</div>
							<div class="modal-body">
								<p class="error-text"><i class="icon-warning-sign modal-icon"></i>您确实要删除本项目吗？删除后不可恢复。</p>
							</div>
							<div class="modal-footer">
								<button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
								<a  href="index.php?m=Admin&a=app_change_state&id=<?php echo ($li["id"]); ?>&action=del"class="btn btn-danger">删除</a>
							</div>
						</div>    
	
                      </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                  </tbody>
                </table> 
            </form>
            </div>
        </div>
                              
    </div>  
</div>
 
   
   
<?php include("public/admin/include/footer.php") ?> </div></div> <script src="public/admin/lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>