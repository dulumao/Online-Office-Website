<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html public/admin "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <title>项目申报系统--示范企业申请进度</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="public/admin/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="public/admin/stylesheets/theme.css">
    <link rel="stylesheet" href="public/admin/lib/font-awesome/css/font-awesome.css">
    <script src="public/admin/lib/jquery-1.7.2.min.js" type="text/javascript"></script>    
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
    
<?php include("public/admin/include/navbar.php") ?>  <?php include("public/admin/include/left-nav.php") ?>    
<script>
function openNavList(){
  var currentClassName = document.getElementById("2").className;
  document.getElementById("2").className = currentClassName + "in";
}
window.onload = openNavList();
</script>
    
    <div class="content">
        
        <div class="header">
            <h1 class="page-title">示范企业申请</h1>
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
					   <th>申请企业</th>
					  <th>申请信息</th>					 
                      <th>提交时间</th>
                      <th>申请进度</th>
					  <th>批复意见</th>
					  
					  <th>是否被推荐</th>
					  <th style="width: 136px;"></th>
                    </tr>
                  </thead>
                  <tbody>
				  	<?php if(is_array($l1)): $i = 0; $__LIST__ = $l1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l1): $mod = ($i % 2 );++$i;?><tr>
                      <td><?php echo ($l1["pid"]); ?></td>
					   <td><a href="index.php?m=Admin&a=com&id=<?php echo ($l1["claimid"]); ?>"><?php echo ($l1["unit"]); ?></a></td>
					  <th><a href="index.php?m=Admin&a=company_content&id=<?php echo ($l1["id"]); ?>">查看申请信息</a></th>						 				  
                      <td><?php echo ($l1["time_send"]); ?></td>
                      <td><?php echo ($l1["state"]); ?></td>
					  <td><?php echo ($l1["back_reason"]); ?></td>
					  <td><?php echo ($l1["recornot"]); ?></td>
					  	 <td>
                          <a href="#myModal1<?php echo ($l1["id"]); ?>" role="button" data-toggle="modal">审批</a>
                          <a href="#myModal2<?php echo ($l1["id"]); ?>" role="button" data-toggle="modal">删除申请</a>
						<div class="modal small hide fade" id="myModal1<?php echo ($l1["id"]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo ($l1["id"]); ?>" aria-hidden="true">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h3 id="myModalLabel<?php echo ($l1["id"]); ?>">申请状态更改</h3>
							</div>
							<div class="modal-body">
								<p>填写状态</p>
								<input name="id"  id="value1<?php echo ($l1["id"]); ?>" />							
								
								<p>批复(请尽量精简，最好少于16个字)</p>
								<input id="value2<?php echo ($l1["id"]); ?>" name="pifu" value=""/>
								<input name="id" value="<?php echo ($l1["id"]); ?>" type="hidden" />
							</div>
							<div class="modal-footer">
								
								<a class="btn btn-primary" type="submit" onclick=mySubmit<?php echo ($l1["id"]); ?>()>确定并反馈</a>
								<a class="btn btn-primary" type="submit" onclick=mySubmit_feed<?php echo ($l1["id"]); ?>()>确&nbsp;&nbsp;定</a>
								<button class="btn" data-dismiss="modal" aria-hidden="true">取消<tton>
							</div>
                            <script>
							function mySubmit<?php echo ($l1["id"]); ?>(){
								var value1 = document.getElementById("value1<?php echo ($l1["id"]); ?>").value;
								var value2 = document.getElementById("value2<?php echo ($l1["id"]); ?>").value;
								window.location.href="http://127.0.0.1/index.php?m=Admin&a=rec&id=<?php echo ($l1["id"]); ?>&state="+value1+"&pifu="+value2;
							}
							</script>
							<script>
							function mySubmit_feed<?php echo ($l1["id"]); ?>(){
								var value1 = document.getElementById("value1<?php echo ($l1["id"]); ?>").value;
								var value2 = document.getElementById("value2<?php echo ($l1["id"]); ?>").value;
								window.location.href="http://127.0.0.1/index.php?m=Admin&a=rec_nosee&id=<?php echo ($l1["id"]); ?>&state="+value1+"&pifu="+value2;
							}
							</script>
						</div>
						<!--                  -->
						 <div class="modal small hide fade" id="myModal2<?php echo ($l1["id"]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h3 id="myModalLabel">申请删除确认</h3>
							</div>
							<div class="modal-body">
								<p class="error-text"><i class="icon-warning-sign modal-icon"></i>您确实要删除本申请吗？删除后不可恢复。</p>
							</div>
							<div class="modal-footer">
								<button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
								<a  href="index.php?m=Admin&a=dd&id=<?php echo ($l1["id"]); ?>&action=del"class="btn btn-danger">删除</a>
							</div>
						</div>    
	
                      </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                  </tbody>
                </table> 
            </div>
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