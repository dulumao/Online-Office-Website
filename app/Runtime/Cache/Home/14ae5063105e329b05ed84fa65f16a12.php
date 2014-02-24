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
  var currentClassName = document.getElementById("1").className;
  document.getElementById("1").className = currentClassName + "in";
}
window.onload = openNavList();
</script>
    
    <div class="content">
        
        <div class="header">
            <h1 class="page-title">项目修改</h1>
        </div>
        
        <ul class="breadcrumb">
            <li>项目管理<span class="divider">/</span></li>
            <li>历史项目<span class="divider">/</span></li>
            <li class="active">项目修改</li>
        </ul>

        <div class="container-fluid">

<div class="row-fluid">
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>消息提醒：</strong> <a href="#">管理员向您发来了新消息，点击查看。</a>
    </div>
    <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>操作提示：</strong>
        <a href="index_old.php">第一步：保存申请。</a>
        <span class="nbsp"></span>
        <a href="oldproject_upload.php">第二步：上传附件。</a>
        <span class="nbsp"></span>
        <a href="oldproject_submit.php">第三步：提交申请。</a>
    </div>
</div>

<div class="row-fluid">
    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">项目修改（第一步：保存申请。）</a>
        <div id="page-stats" class="block-body collapse in">
        <form action="oldproject_upload.php">	
        	<div class="well">
            	<h3>项目信息</h3>
            	<div>
                	<label>项目承担单位名称:</label>
                    <p>AAAAAAAAAAAAAAAAA</p>
                    <label>项目建设起止年限：</label>
                    <input type="text" id="from" name="from"/>
 					<span>至</span>
                    <input type="text" id="to" name="to"/>
                	<label>项目名称:</label>
                    <input type="text" value="" class="input-xlarge">
                    <label>项目类别：</label>
                    <select class="input-xlarge">
                      <option value=""></option>
                      <option value="">不知道啊</option>                      
                	</select>                    
                </div>
            </div>
            <div class="well">
            	<h3>项目承担单位基本信息</h3>
                <div class="myForm">
                    <label>单位法人代表：</label>
                    <input type="text" value="" class="input-xlarge">
                    <label>联系人：</label>
                    <input type="text" value="" class="input-xlarge">
                    <label>总资产（元）：</label>
                    <input type="text" value="" class="input-xlarge">
                    <label>资金负债率（%）：</label>
                    <input type="text" value="" class="input-xlarge">
                    <label>单位地址：</label>
                    <input type="text" value="" class="input-xlarge">
                </div>
                <div class="myForm">
                    <label>注册登记类型：</label>
                    <select class="input-xlarge">
                      <option value=""></option>
                      <option value="">不知道啊</option>                      
                	</select>
                    <label>联系人电话：</label>
                    <input type="text" value="" class="input-xlarge">
                    <label>上年销售收入（元）：</label>
                    <input type="text" value="" class="input-xlarge">
                    <label>银行信用等级：</label>
                    <select class="input-xlarge">
                      <option value=""></option>
                      <option value="">骗子</option>                      
                      <option value="">骗子</option>                      
                      <option value="">骗子</option>                      
                	</select>
                    <label>单位邮编：</label>
                    <input type="text" value="" class="input-xlarge">                    
                </div>
                <div class="myForm">
                    <label>注册资本（元）：</label>
                    <input type="text" value="" class="input-xlarge">
                    <label>联系人手机：</label>
                    <input type="text" value="" class="input-xlarge">
                    <label>上年利润（元）：</label>
                    <input type="text" value="" class="input-xlarge">
                    <label>职工人数：</label>
                    <input type="text" value="" class="input-xlarge">
                    <label>上年税金（元）：</label>
                    <input type="text" value="" class="input-xlarge">                    
                </div>
            </div>
            <div class="well">
            	<h3>项目资金来源</h3>
                <div class="myForm">
                    <label>项目总投资（元）：</label>
                    <input type="text" value="" class="input-xlarge">
                    <label>自筹（元）：</label>
                    <input type="text" value="" class="input-xlarge">
                    <label>银行贷款（元）：</label>
                    <input type="text" value="" class="input-xlarge">
                </div>
                <div class="myForm">
                    <label>申请专项资金（元）：</label>
                    <input type="text" value="" class="input-xlarge">
                    <label>是否落实：</label>
                    <select class="input-xlarge">
                      <option value=""></option>
                      <option value="">不知道啊</option>                      
                	</select>
                    <label>是否落实：</label>
                    <select class="input-xlarge">
                      <option value=""></option>
                      <option value="">不知道啊</option>                      
                	</select>
                </div>
                <div class="myForm">
                    <label>申请专项方式：</label>
                    <select class="input-xlarge">
                      <option value=""></option>
                      <option value="">不知道啊</option>                      
                	</select>                
                </div>
            </div>
            <div class="well">
            	<h3>项目建设内容、特点及典型示范意义</h3>
                <textarea style="width:97%" rows="10"></textarea>
            </div>            

        	<div class="clear"></div>
            <div class="btn-toolbar">
                <button class="btn btn-primary"><i class="icon-save"></i>保存申请</button>
              <div class="btn-group">
              </div>
            </div>
		</form>
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