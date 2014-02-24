<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html public/admin "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <title>后台管理系统--网站功能开关</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="public/admin/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="public/admin/stylesheets/theme.css">
    <link rel="stylesheet" href="public/admin/lib/font-awesome/css/font-awesome.css">
    <script src="public/admin/lib/jquery-1.7.2.min.js" type="text/javascript"></script>  <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
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
    
    <div class="content">
        
        <div class="header">
            <h1 class="page-title">网站功能开关</h1>
        </div>
        

        <div class="container-fluid">

<div class="row-fluid">
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>企业用户权限：</strong> 企业用户注册：<?php echo ($p["ucsu"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;
									  企业用户登录：<?php echo ($p["ucsi"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;	
									  项目申报：<?php echo ($p["upc"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;
									  示范企业申报：<?php echo ($p["ucc"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;
									  示范企业查询：<?php echo ($p["ucs"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;
									  项目统计查询：<?php echo ($p["ups"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;						  
    </div>
	 <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
		<strong>区县管委会权限：</strong> 区县管委会登录：<?php echo ($p["asi"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;			 
									  项目申报增补材料：<?php echo ($p["aap"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;
									  示范企业申报增补材料：<?php echo ($p["aac"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;
									  示范企业查询：<?php echo ($p["acs"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;
									  项目统计查询：<?php echo ($p["aps"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;
       					  
    </div>
	
    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">网站功能开关</a>
        <div id="page-stats" class="block-body collapse in">
        
        	<div class="well">
            	<div>
                    <label>企业用户注册：</label>
					<form action="index.php?m=Admin&a=control" method="post">		
                    <select class="input-xlarge" name="unit_c_signup">
                      <option value="1">开</option>
                      <option value="0">关</option>                      
                	</select>
					<label>企业用户登录：</label>					
                    <select class="input-xlarge" name="unit_c_signin">
                      <option value="1">开</option>
                      <option value="0">关</option>                      
                	</select>
                    <label>企业项目申报：</label>
                    <select class="input-xlarge" name="unit_p_claim">
                      <option value="1">开</option>
                      <option value="0">关</option> 
                    </select>                     
                    <label>示范企业申报：</label>
                    <select class="input-xlarge" name="unit_c_claim">
                      <option value="1">开</option>
                      <option value="0">关</option>                      
                	</select>  
					<label>项目汇总查询：</label>
                    <select class="input-xlarge" name="unit_p_search">
                      <option value="1">开</option>
                      <option value="0">关</option> 
                    </select>                     
                    <label>示范企业查询：</label>
                    <select class="input-xlarge" name="unit_c_search">
                      <option value="1">开</option>
                      <option value="0">关</option>                      
                	</select>    
					                       
                </div>				
            </div>
			<div class="well">
            	<div>
                    <label>区县管理账户登录：</label>
						
                    <select class="input-xlarge" name="admin_signin">
                      <option value="1">开</option>
                      <option value="0">关</option>                      
                	</select>
					<label>为项目申报增加材料：</label>					
                    <select class="input-xlarge" name="admin_add_p">
                      <option value="1">开</option>
                      <option value="0">关</option>                      
                	</select>
                    <label>企业项目申报：</label>
                    <select class="input-xlarge" name="admin_add_c">
                      <option value="1">开</option>
                      <option value="0">关</option> 
                    </select>  
					<label>项目汇总查询：</label>
                    <select class="input-xlarge" name="admin_p_search">
                      <option value="1">开</option>
                      <option value="0">关</option> 
                    </select>                     
                    <label>示范企业查询：</label>
                    <select class="input-xlarge" name="admin_c_search">
                      <option value="1">开</option>
                      <option value="0">关</option>                      
                	</select>             
					<input name="action" value="modify" type="hidden"/>     
                            
                </div>				
            </div>
            <div class="btn-toolbar">
                <button class="btn btn-primary">确定</button>
              <div class="btn-group">
              </div>
            </div>
		</form>
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