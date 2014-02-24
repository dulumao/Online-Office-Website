<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>陕西省西安市两化融合</title>
<?php include "inc/cssjs.html" ?>
</head>
<body>
<div class="container">
	<?php include "inc/title.html" ?>
    <div class="photo"><div class="photo2"></div></div>
    <div class="row">
    	<div class="box pull-left">
            <ol class="breadcrumb" style="float:left; width:620px">
                <li style="float:left"><a href="index.php">首页</a> <span class="divider">/</span></li>
                <li style="float:left"><a href="index.php?m=Index&a=news">通知公告</a> <span class="divider">/</span></li>
                <li style="float:left; background-color:transparent" class="active"><?php echo ($msg["title"]); ?></li>
            </ol>
            <div class="news_content">
            	<h4><?php echo ($msg["title"]); ?></h4>
                <span class="time"><?php echo ($msg["time"]); ?>发布</span>
                <div class="news_content_box">
<!--//////////////////////////////////////////////////////////////--> 
					<?php echo ($msg["content"]); ?>                             
<!--//////////////////////////////////////////////////////////////-->                
                </div>
            </div>  
            <div class="clear"></div>
            <div class="pagination text-center">
                <ul>
                    <li style="clear:none"><a href="index.php?m=Index&a=news_content&id=<?php echo ($msg["upid"]); ?>">上一条：<?php echo ($msg["uptitle"]); ?></a></li>
                    <li style="clear:none"><a href="index.php?m=Index&a=news_content&id=<?php echo ($msg["downid"]); ?>">下一条：<?php echo ($msg["downtitle"]); ?></a></li>
                </ul>
            </div>
        </div>
    	<div class="box pull-right" style="width:270px;">
            <ol class="breadcrumb">
                <li>项目申报系统</li>
            </ol>
                <div class="project">
                    <a href="index.php?m=Unit&a=sign_in">企业用户登录</a>
                    <a href="index.php?m=Country&a=sign_in">区县管理员登录</a>
                    <a href="index.php?m=ContentAdmin&a=sign_in">内容管理员登录</a>
                    <a href="index.php?m=Admin&a=sign_in">超级管理员登录</a>
                </div>
            
        </div>                
    </div>
</div>
<?php include "inc/footer.html" ?>
<script>
$(document).ready(function() {
	$(".title").find("ul li:eq(1)").addClass("active");	
	var i = $.cookie("photo");
	if(i == 1 ){
		$(".photo2").animate({height:"180px"});
		$.cookie("photo", "2", { expires: 7 });	
	}else {
		$(".photo2").height("180px");
		$.cookie("photo", "2", { expires: 7 });			
	}
});
</script>
</body>
</html>