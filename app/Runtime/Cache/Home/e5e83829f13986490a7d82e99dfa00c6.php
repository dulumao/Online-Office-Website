<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html public/admin "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <title>项目申报系统--示范企业查询</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="public/admin/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="public/admin/stylesheets/theme.css">
    <link rel="stylesheet" href="public/admin/lib/font-awesome/css/font-awesome.css">
    <script src="public/admin/lib/jquery-1.7.2.min.js" type="text/javascript"></script>    
	<!--date picker--> 
	<?php include("public/admin/include/datepicker.php") ?> <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
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
    
<?php include("public/admin/include/navbar.php") ?>  <?php include("public/admin/include/left-nav.php") ?>    
    
    <div class="content">
        
        <div class="header">
            <h1 class="page-title">示范企业查询</h1>
        </div>

        <div class="container-fluid">

<div class="row-fluid">
    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">示范企业查询</a>
        <div id="page-stats" class="block-body collapse in">
        <form action="index.php?m=Admin&a=company_search_list" method="post">	
        	<div class="well">
                <label>年度</label>
                <select name="year"> 
					<option value="无">无</option>                    
                    <option value="2012">2012</option>
					<option value="2013">2013</option>
					<option value="2014">2014</option>
					<option value="2015">2015</option>
					<option value="2016">2016</option> 				                
                </select>  
				 <label>示范企业类别：</label>
						<select class="input" name="level">
						<option value="无">无</option>
						  <option value="国家级">国家级</option>
						  <option value="省级">省级</option>
						  <option value="区县级">区县级</option>                      
						</select>     
						              
                <label>地域</label>
                <select name="place"> 
					<option value="无">无</option>    
					<?php if(is_array($city)): $i = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$city): $mod = ($i % 2 );++$i;?><option value="<?php echo ($city["region_name"]); ?>"><?php echo ($city["region_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>	                
                </select> 
				
				<label>当前状态</label>
                <select name="state"> 
					<option value="无">无</option>                    
                    <option value="草稿">草稿</option>
					<option value="提交待审核">提交待审核</option>
					<option value="通过">审核通过</option>
					<option value="打回">打回补充材料或者未通过</option>									                
                </select>   
				      
						
                                           
            </div>
        	<div class="clear"></div>
            <div class="btn-toolbar">
                <button class="btn btn-primary">查询</button>
              <div class="btn-group">
              </div>
            </div>
		</form>
        </div>
    </div>
</div>
<?php include("public/admin/include/footer.php") ?>  </div></div>
    


    <script src="public/admin/lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>