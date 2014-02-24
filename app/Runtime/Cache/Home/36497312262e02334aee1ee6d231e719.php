<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <title>项目申报系统--项目进度</title>
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
            <h1 class="page-title">项目进度</h1>
        </div>
        
        <ul class="breadcrumb">
            <li>项目管理<span class="divider">/</span></li>
            <li class="active">项目进度</li>
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
        <a href="#page-stats" class="block-heading" data-toggle="collapse">项目进度申报及报告提交</a>
        <div id="page-stats" class="block-body collapse in">
        	<div class="well">
                <table class="table">
                  <thead>
                    <tr>
                      <th>项目编号</th>
                      <th>项目名称</th>
                      <th>通过审核时间</th>
                      <th>项目进度</th>
                      <th style="width: 180px;"></th>
                    </tr>
                  </thead>
                  <tbody>
				  
				  <?php if(is_array($l2)): $i = 0; $__LIST__ = $l2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l2): $mod = ($i % 2 );++$i;?><tr>
                      <td><?php echo ($l2["id"]); ?></td>
                      <td><a href="index.php?m=Unit&a=project_content&id=<?php echo ($l2["id"]); ?>"><?php echo ($l2["proname"]); ?></a></td>
                      <td><?php echo ($l2["time_pass"]); ?></td>
                      <td><a href="#myModal<?php echo ($l2["id"]); ?>" role="button" data-toggle="modal"><p class="icon-pencil"><?php echo ($l2["ptime"]); ?>&nbsp;<?php echo ($l2["p"]); ?></p></a></td>
					      <div class="modal small hide fade" id="myModal<?php echo ($l2["id"]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<form action="index.php?m=Unit&a=change_progress" method="post">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h3 id="myModalLabel">项目进度修改</h3>
							</div>
							<div class="modal-body">
								<p>项目最新进度(请尽量精简，最好少于16个字)</p>
								
								<select  name="progress">
									<option value="超前于计划">超前于计划</option>
									<option value="按计划进行">按计划进行</option>
									<option value="落后于计划">落后于计划</option>
								</select>
								<input name="id" value="<?php echo ($l2["id"]); ?>" type="hidden" />
								
							</div>
							<div class="modal-footer">								
								<button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
								<input type="submit"  value="确定"/>
							</div>
							</form>
						</div>
                      <td>
                          <a href="index.php?m=Unit&a=project_report&id=<?php echo ($l2["id"]); ?>">提交项目报告</a>						  
                          <a href="index.php?m=Unit&a=project_report_1&id=<?php echo ($l2["id"]); ?>">申请验收</a>
                      </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>	
                  </tbody>
                </table> 
            </div>
        </div></div>  
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