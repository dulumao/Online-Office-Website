<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html public "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <title>项目申报系统--账户管理</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="public/country/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="public/country/stylesheets/theme.css">
    <link rel="stylesheet" href="public/country/lib/font-awesome/css/font-awesome.css">
    <script src="public/country/lib/jquery-1.7.2.min.js" type="text/javascript"></script>    
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
    
<?php include("public/country/include/navbar.php") ?>  <?php include("public/country/include/left-nav.php") ?>
<script>
function openNavList(){
	var currentClassName = document.getElementById("3").className;
	document.getElementById("3").className = currentClassName + "in";
}
window.onload = openNavList();
</script> 

    
    <div class="content">
        
        <div class="header">
            <h1 class="page-title">账户信息查看</h1>
        </div>
        
        <ul class="breadcrumb">
            <li>账户管理<span class="divider">/</span></li>
            <li class="active">账户信息</li>
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

<div class="row-fluid">
    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">账户信息查看</a>
        <div id="page-stats" class="block-body collapse in">
        	<div class="well">
                    <ul>
                    <li><span class="li_left span3">单位名称(用户名):</span><?php echo ($info["unitname"]); ?></li>
                    <li><span class="li_left span3">电子邮件:</span><?php echo ($info["linkermail"]); ?></li>
                    <li><span class="li_left span3">单位地址:</span><?php echo ($info["unitaddr"]); ?>&nbsp;<?php echo ($info["detailaddr"]); ?></li>
                    <li><span class="li_left span3">职工人数（人）:</span><?php echo ($info["worker"]); ?></li>
                    <li><span class="li_left span3">邮编:</span><?php echo ($info["unitpostcode"]); ?></li>
                    <li><span class="li_left span3">法人代表:</span><?php echo ($info["unitlaw"]); ?></li>
                    <li><span class="li_left span3">联系人姓名:</span><?php echo ($info["unitlinker"]); ?></li>
                    <li><span class="li_left span3">联系人手机:</span><?php echo ($info["unitlinkermobile"]); ?></li>
                    <li><span class="li_left span3">注册登记类型:</span><?php echo ($info["regkind"]); ?></li>
                    <li><span class="li_left span3">注册资本（万元）:</span><?php echo ($info["regmoney"]); ?></li>
                    <li><span class="li_left span3">总资产（万元）:</span><?php echo ($info["unittotalmoney"]); ?></li>
                    <li><span class="li_left span3">资金负债率（%）:</span><?php echo ($info["betmoneyrate"]); ?></li>
                    <li><span class="li_left span3">银行信用等级:</span><?php echo ($info["bankcredit"]); ?></li>
                    <li><span class="li_left span3">传真:</span><?php echo ($info["fax"]); ?></li>
                    <li><span class="li_left span3">工商注册编号:</span><?php echo ($info["unitcode"]); ?></li>
                    <li><span class="li_left span3">注册时间:</span><?php echo ($info["time"]); ?></li>
                    </ul>
            </div>
        </div>
    </div>
    
    
</div>
<?php include("public/country/include/footer.php") ?>  </div></div>
    


    <script src="public/country/lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>