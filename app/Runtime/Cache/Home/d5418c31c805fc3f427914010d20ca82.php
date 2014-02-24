<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <title>项目申报系统--消息</title>
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
    
<script type="text/javascript" src="public/lib/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="public/lib/highslide/highslide.css" />
<script type="text/javascript">
	hs.graphicsDir = 'public/lib/highslide/graphics/';
	hs.outlineType = 'rounded-white';
	hs.showCredits = false;
	hs.wrapperClassName = 'draggable-header';
</script>
    
    
    
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
 

    
    <div class="content">
        
        <div class="header">
            <h1 class="page-title">消息</h1>
        </div>
        

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
        <a href="#page-stats" class="block-heading" data-toggle="collapse">与您相关的消息</a>
        <div id="page-stats" class="block-body collapse in">
        	<div class="well">
            <table class="table">
              <thead>
                <tr>
                  <th>编号</th>
                  <th>内容</th>
                  <th>发送人</th>
				  <th>接收人</th>
                  <th>时间</th>
                  <th width="50px">状态</th>
                  <th style="width: 80px;"></th>
                </tr>
              </thead>
              <tbody>
			    <?php if(is_array($msglist)): $i = 0; $__LIST__ = $msglist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vomsg): $mod = ($i % 2 );++$i;?><tr>
                  <td><?php echo ($vomsg["id"]); ?></td>
                  <td>
                  <a href="public/lib/highslide-4.1.13/examples/index.htm" onclick="return hs.htmlExpand(this, { headingText: '<?php echo ($vomsg["title"]); ?>' })">
                  <?php echo ($vomsg["title"]); ?>
                  </a>
                  <div class="highslide-maincontent"><?php echo ($vomsg["content"]); ?></div>
                  </td>
                  <td><?php echo ($vomsg["from"]); ?></td>
				  <td><?php echo ($vomsg["to"]); ?></td>
                  <td nowrap="nowrap"><?php echo ($vomsg["time"]); ?></td>
                  <th><?php echo ($vomsg["state"]); ?></th>
                  <td>
                     <td><a href="index.php?m=Unit&a=delmsg&id=<?php echo ($vomsg["id"]); ?>">删除</a></td>
					 <td><a href="index.php?m=Unit&a=readmsg&id=<?php echo ($vomsg["id"]); ?>">标记为已读</a></td>
                  </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>	
              </tbody>
            </table>
            </div>
        </div>
        <div class="pagination" style="margin-left:1em">			
        </div>                                   
    </div>
    
</div>
<div class="row-fluid">
    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">发送新消息</a>
        <div id="page-stats" class="block-body collapse in">
        	<div class="well">
				<form id="returnMessage" action="index.php?m=Unit&a=message" method="post">
                <label>接收方：</label>       
								
                	<input type="checkbox" name="rec[]" value="all|全部人|0">所有人&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="rec[]" value="root|超级管理员|1">超级管理员	&nbsp;&nbsp;&nbsp;			
					<?php if(is_array($unitlist)): $i = 0; $__LIST__ = $unitlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vounit): $mod = ($i % 2 );++$i;?><input  type="checkbox" name="rec[]" value="unit|<?php echo ($vounit["unitname"]); ?>|<?php echo ($vounit["id"]); ?>"><?php echo ($vounit["unitname"]); ?>&nbsp;&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>	   
					<?php if(is_array($countrylist)): $i = 0; $__LIST__ = $countrylist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vocountry): $mod = ($i % 2 );++$i;?><input type="checkbox" name="rec[]" value="country|<?php echo ($vocountry["user_name"]); ?>|<?php echo ($vocountry["id"]); ?>"><?php echo ($vocountry["user_name"]); ?>&nbsp;&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>	   
              
				
                <label>标题：</label>
                <input id="messageTitle" class="input-xlarge" name="title" />
                <label>正文：</label>
                <textarea style="width:98%" rows="10" name="content"></textarea>
				<input type="submit" class="btn-primary btn" value="发送" />                
                </form>
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