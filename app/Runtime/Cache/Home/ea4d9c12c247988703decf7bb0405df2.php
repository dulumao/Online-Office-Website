<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <title>项目申报系统--示范企业申请信息</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="public/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="public/stylesheets/theme.css">
    <link rel="stylesheet" href="public/lib/font-awesome/css/font-awesome.css">
    <script src="public/lib/jquery-1.7.2.min.js" type="text/javascript"></script>    
	<!--date picker--> 
	<?php include("public/include/datepicker.php") ?> <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
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
            <h1 class="page-title">示范企业申请信息</h1>
        </div>
        
        <ul class="breadcrumb">
            <li>示范企业申报<span class="divider">/</span></li>
            <li class="active">示范企业申请信息</li>
        </ul>

        <div class="container-fluid">

<div class="row-fluid">
</div>

<div class="row-fluid">
    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">示范企业申请信息</a>
        <div id="page-stats" class="block-body collapse in">
            <div class="well">
            	<h3>企业申请基本信息</h3>
                <div class="myForm">
                	<ul>
					 <li><span class="li_left span6">示范企业类别：</span><?php echo ($cinfo["level"]); ?></li>	
                    <li><span class="li_left span6">单位法人代表：</span><?php echo ($uinfo["unitlaw"]); ?></li>
                    <li><span class="li_left span6">联系人：</span><?php echo ($uinfo["unitlinker"]); ?></li>
                    <li><span class="li_left span6">总资产（元）：</span><?php echo ($uinfo["unittotalmoney"]); ?></li>
                    <li><span class="li_left span6">资金负债率（%）：</span><?php echo ($uinfo["betmoneyrate"]); ?></li>
                    <li><span class="li_left span6">单位地址：</span><?php echo ($uinfo["unitaddr"]); echo ($uinfo["detailaddr"]); ?></li>
                    </ul>
                </div>
                <div class="myForm">
                	<ul>
                    <li><span class="li_left span7">注册登记类型：</span><?php echo ($uinfo["regkind"]); ?></li>
                    <li><span class="li_left span7">单位电话：</span><?php echo ($uinfo["unittel"]); ?></li>
                    <li><span class="li_left span7">上年销售收入（元）：</span><?php echo ($cinfo["income"]); ?></li>
                    <li><span class="li_left span7">银行信用等级：</span><?php echo ($uinfo["bankcredit"]); ?></li>
                    <li><span class="li_left span7">单位邮编：</span><?php echo ($uinfo["unitpostcode"]); ?></li>
                    </ul>
                </div>
                <div class="myForm">
                    <ul>
                    <li><span class="li_left span6">注册资本（元）：</span><?php echo ($uinfo["regmoney"]); ?></li>
                    <li><span class="li_left span6">联系人手机：</span><?php echo ($uinfo["unitlinkermobile"]); ?></li>
                    <li><span class="li_left span6">上年利润（元）：</span><?php echo ($cinfo["profit"]); ?></li>
                    <li><span class="li_left span6">职工人数：</span><?php echo ($uinfo["worker"]); ?></li>
                    <li><span class="li_left span6">上年税金（元）：</span><?php echo ($cinfo["tax"]); ?></li>
                    </ul>
                </div>
            </div>
            <div class="well">
            	<h3>企业自荐信息</h3>
                <blockqute style="width:97%"><?php echo ($cinfo["self"]); ?></blockqute>
            </div>            

        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="block">
        <a href="#page-stats2" class="block-heading" data-toggle="collapse">申请附件</a>
        <div id="page-stats2" class="block-body collapse in">
        	<div class="well">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>文件名</th>
                     
                      <th>上传时间</th>
                    </tr>
                  </thead>
                  <tbody>
				  	<?php if(is_array($finfo)): $i = 0; $__LIST__ = $finfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$finfo): $mod = ($i % 2 );++$i;?><tr>
                      <td><?php echo ($finfo["fid"]); ?></td>
                      <td><a href="index.php?m=Unit&a=getfile_1&id=<?php echo ($finfo["id"]); ?>&fid=<?php echo ($finfo["fid"]); ?>"><?php echo ($finfo["name"]); ?></a></td>                      
                      <td><?php echo ($finfo["time"]); ?></td>
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