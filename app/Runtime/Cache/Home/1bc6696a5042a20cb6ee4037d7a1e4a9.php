<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <title>可供申报的项目类型</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="public/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="public/stylesheets/theme.css">
    <link rel="stylesheet" href="public/lib/font-awesome/css/font-awesome.css">
    <script src="public/lib/jquery-1.7.2.min.js" type="text/javascript"></script>    
	<!--date picker--> 
	<?php include("public/include/datepicker.php") ?> 
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
    
<?php include("public/include/navbar.php") ?>        
<?php include("public/include/left-nav.php") ?>    
<script>
function openNavList(){
  var currentClassName = document.getElementById("1").className;
  document.getElementById("1").className = currentClassName + "in";
}
window.onload = openNavList();
</script>
    

  <div class="content">

    <div class="header">
      <h3 class="page-title">可供申报的项</h3>
    </div>


    <div class="container-fluid">

      <div class="row-fluid">
        <div class="block">         
          <div id="page-stats" class="block-body collapse in">
		  	<h3><?php echo ($notice); ?></h3>
            <table class="table">
              <thead>
                <tr>
                  <th>编号</th>
                  <th>名称</th>
                  <th>申报开始时间</th>
                  <th>申报结束时间</th>
                  <th>申报</th>
				
                 
                </tr>
              </thead>
              <tbody>
                <?php if(is_array($li)): $i = 0; $__LIST__ = $li;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($li["pid"]); ?></td>
                    <td><?php echo ($li["name"]); ?></td>
                    <td><?php echo ($li["start"]); ?></td>
                    <td><?php echo ($li["end"]); ?></td>
                    <td><a href='index.php?m=Unit&a=index&id=<?php echo ($li["id"]); ?>'>申报</a></td>
					
                    
                  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
				
               
              </tbody>
			  
            </table>
           
          </div>
           
		</div>			
		

        </div>
		
      </div>


<?php include("public/include/footer.php") ?>                    
            </div></div>
    


    <script src="public/lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>