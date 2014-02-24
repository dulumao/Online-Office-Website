<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html public "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <title>项目申报系统</title>
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
  var currentClassName = document.getElementById("1").className;
  document.getElementById("1").className = currentClassName + "in";
}
window.onload = openNavList();
</script>
    
    <div class="content">
        
        <div class="header">
            <h1 class="page-title"><?php echo ($info["proname"]); ?></h1>
        </div>


        <div class="container-fluid">

<div class="row-fluid">
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>温馨提醒：</strong> 点击上传示范企业申请的支撑材料
    </div>
</div>



<div class="row-fluid">
    <div class="block">
        <a href="#page-stats4" class="block-heading" data-toggle="collapse">上传辖下企业项目申报资料</a>    
        <div id="page-stats4" class="block-body collapse in">
        	<div class="well">
          	 	<form action="index.php?m=Country&a=add_file_1" method="post" enctype="multipart/form-data">
            		<input name="id" type="hidden" value="<?php echo ($id); ?>" />
                    <div id="add_file">
                    <script>
					function addFile(){
 						var inputList = document.getElementById('add_file');
   						var divNode = inputList.getElementsByTagName('input');
    					var pageNum = divNode.length;
						var currentMessage = document.getElementById('add_file').innerHTML;
						document.getElementById('add_file').innerHTML="<input name=file"+pageNum+" type='file' />"+"<br />"+currentMessage;
					}
					</script>
                    <a href="javascript:;" onclick="addFile()">再添加一个文件</a>
                    </div>
                    <br /><br />
                    <button class="btn">上传文件</button>                    
            	</form>
            </div></div>
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