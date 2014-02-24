<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <title>项目申报系统--历史项目查询</title>
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
            <h1 class="page-title">查看项目</h1>
        </div>
        
        <ul class="breadcrumb">
            <li>项目管理<span class="divider">/</span></li>
            <li class="active">所有项目</li>
        </ul>
        <div class="container-fluid">

<div class="row-fluid">
 
</div>

<?php if(is_array($big)): $i = 0; $__LIST__ = $big;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$big): $mod = ($i % 2 );++$i;?><div class="row-fluid">
    <div class="block">
	<h3><?php echo ($big["name"]); ?></h3>        
        <div id="page-stats21" class="block-body collapse in">
        	<div class="well">
			<style>
			.table11 th, .table11 td {
			font-size:13px;
			}
			</style>
                <table class="table">
                  <thead>
                    <tr>
                      <th>项目编号</th>
                      <th>项目名称</th>
                      <th>提交时间</th>
                      <th>项目状态</th>
					  <th>批复意见</th>
					  <th>是否支持</th>
					  <th>支持资金</th>
					  <th>进度汇报</th>
					  <th>删除</th>
                    </tr>
                  </thead>
                  <tbody>
				   <?php if(is_array($big['content'])): $i = 0; $__LIST__ = $big['content'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l): $mod = ($i % 2 );++$i;?><tr class="checkq">
                      <td><?php echo ($l["pid"]); ?></td>
                      <td><a href="index.php?m=Unit&a=project_content&id=<?php echo ($l["id"]); ?>"><?php echo ($l["proname"]); ?></a></td>
                      <td><?php echo ($l["time"]); ?></td>
                      <td><?php echo ($l["state"]); ?></td>
					  <td><?php echo ($l["pifu"]); ?></td>
					  <td><?php echo ($l["support"]); ?></td>
					  <td><?php echo ($l["support_money"]); ?>万</td>
					  <td class="<?php echo ($l["showornot"]); ?>">
					  
					  <a href="index.php?m=Unit&a=project_progress&id=<?php echo ($l["id"]); ?>" >修改进度</a>&nbsp;
					  <a href="index.php?m=Unit&a=shenqingyanshou&id=<?php echo ($l["id"]); ?>" >申请验收</a>
					  

					  </td>
					  <td><a href="index.php?m=Unit&a=dd_p&id=<?php echo ($l["id"]); ?>">删除</a></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                  </tbody>
                </table>            
            </div>
        </div>
	</div>  
</div><?php endforeach; endif; else: echo "" ;endif; ?>



<?php include("public/include/footer.php") ?>  </div></div>
    


    <script src="public/lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    <script>
$(document).ready(function(){

$(".tty").html("<span class='forb_a'>修改进度</span>&nbsp;&nbsp;<span class='forb_a'>申请验收</span>")

});
	</script>
<style>
.forb_a {
color:#999999;
cursor:pointer;
}
</style>
  </body>
</html>