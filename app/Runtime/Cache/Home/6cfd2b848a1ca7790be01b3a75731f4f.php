<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <title>后台管理系统--上传示范企业推荐资料</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="public/country/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="public/country/stylesheets/theme.css">
    <link rel="stylesheet" href="public/country/lib/font-awesome/css/font-awesome.css">
    <script src="public/country/lib/jquery-1.7.2.min.js" type="text/javascript"></script>   <!--date picker--> 
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
    
<?php include("public/country/include/navbar.php") ?>    <?php include("public/country/include/left-nav.php") ?>    <div class="content">
        
        <div class="header">
            <h1 class="page-title">上传示范企业推荐资料</h1>
        </div>
        


        <div class="container-fluid">

<div class="row-fluid"><!--若本区域无内容，请勿显示-->
    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">示范企业申请状态</a>
        <div id="page-stats" class="block-body collapse in">
        	<div class="well">
                <table class="table">
                  <thead>
                    <tr>
                      <th>申请编号</th>
					  <th>申请类别</th>
                      <th>申请公司</th>
					  <th>申请信息</th>
                      <th>提交时间</th>
                      <th>申请进度</th>
                      <th>上传推荐资料</th>
					  <th>推荐</th>
                    </tr>
                  </thead>
                  <tbody>
				  	<?php if(is_array($li)): $i = 0; $__LIST__ = $li;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><tr>
                      <td><?php echo ($li["id"]); ?></td>
					  <td><?php echo ($li["level"]); ?></td>
                      <td><a href="index.php?m=Country&a=com&id=<?php echo ($li["claimid"]); ?>"><?php echo ($li["unitname"]); ?></a></td>
					  <th><a href="index.php?m=Country&a=company_content&id=<?php echo ($li["id"]); ?>">查看申请信息</a></th>					  
                      <td><?php echo ($li["time_send"]); ?></td>
                      <td><?php echo ($li["state"]); ?></td>
                      <td>
                          <a href="index.php?m=Country&a=upload_company_upload&id=<?php echo ($li["id"]); ?>" >上传推荐资料</a>
						   <td><a href="index.php?m=Country&a=reccomend&kind=model&id=<?php echo ($li["id"]); ?>"><?php echo ($li["recornot"]); ?></a></td> 
                      </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                  </tbody>
                </table> 
            </div>
        </div>
                         
    </div>  
</div>
<?php include("include/footer.php") ?>                    
            </div></div>  <script src="public/country/lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>