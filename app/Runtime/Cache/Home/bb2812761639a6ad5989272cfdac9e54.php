<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <title>项目申报系统--项目查询</title>
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
            <h1 class="page-title">项目列表</h1>
        </div>
        
        <ul class="breadcrumb">
            <li>项目查询<span class="divider">/</span></li>
            <li class="active">项目列表</li>
        </ul>

        <div class="container-fluid">


<div class="row-fluid">
    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">项目汇总（元）</a>
        <div id="page-stats" class="block-body collapse in">
            <div class="stat-widget-container">
                <div class="stat-widget">
                    <div class="stat-button">
                        <p class="title">￥<?php echo ($total); ?></p>
                        <p class="detail">项目总投资</p>
                    </div>
                </div>

                <div class="stat-widget">
                    <div class="stat-button">
                        <p class="title">￥<?php echo ($get); ?></p>
                        <p class="detail">申请专向</p>
                    </div>
                </div>

                <div class="stat-widget">
                    <div class="stat-button">
                        <p class="title">￥<?php echo ($bankloan); ?></p>
                        <p class="detail">银行贷款</p>
                    </div>
                </div>

                <div class="stat-widget">
                    <div class="stat-button">
                        <p class="title">￥<?php echo ($self); ?></p>
                        <p class="detail">自筹金额</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">符合搜索条件的项目列表</a>
        <div id="page-stats" class="block-body collapse in">
        	<div class="well">
                <table class="table">
                  <thead>
                    <tr>
                      <th>项目编号</th>
                      <th style="width: 250px;">项目名称</th>
                      <th>项目承担单位</th>
                      <th>提交时间</th>                      
                      <th>项目状态</th>                      
                      <th>项目种类</th>
					  <th>项目总投资</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(is_array($li)): $i = 0; $__LIST__ = $li;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><tr>
                      <td><?php echo ($li["idd"]); ?></td>
                      <td><a href="index.php?m=Unit&a=project_content&id=<?php echo ($li["id"]); ?>"><?php echo ($li["proname"]); ?></a></td>
                      <td><a href="index.php?m=Unit&a=account&id=<?php echo ($li["claimid"]); ?>"><?php echo ($li["unit"]); ?></a></td>
                      <td><?php echo ($li["time"]); ?></td>                      
                      <td><?php echo ($li["state"]); ?></td>                      
                      <td><?php echo ($li["prokind"]); ?></td>
					  <td><?php echo ($li["totalmoney"]); ?></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                  </tbody>
                </table> 
            </div>       
           
            <div class="clear"></div>
            <div class="btn-toolbar">
                <a class="btn btn-primary" href="index.php?m=Unit&a=getexcel&id=<?php echo ($id); ?>"><i class="icon-save"></i> 导出EXCEL</a>
                <a class="btn" href="index.php?m=Unit&a=project_search">重新搜索</a>
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