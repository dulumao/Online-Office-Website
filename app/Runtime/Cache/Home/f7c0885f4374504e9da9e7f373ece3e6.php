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
        	<div class="box_title"><a href="#">通知公告</a></div>
            <ul class="unstyled">
			<?php if(is_array($li)): $i = 0; $__LIST__ = $li;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><li style="width:600px;"><a href="index.php?m=Index&a=news_content&id=<?php echo ($li["id"]); ?>"><?php echo ($li["title"]); ?></a><span><?php echo ($li["time"]); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>	
            </ul>
            <div class="clear"></div>
            <div class="pagination pull-right">
                <ul>
                    <li style="clear:none"><a href="index.php?m=Index&a=news&pageid=<?php echo ($up); ?>">«</a></li>                                    
                    <li style="clear:none"><a href="index.php?m=Index&a=news&pageid=<?php echo ($cur); ?>">第<?php echo ($cur); ?>页,共<?php echo ($totalpages); ?>页</a></li>
                    <li style="clear:none"><a href="index.php?m=Index&a=news&pageid=<?php echo ($down); ?>">»</a></li>
                </ul>
            </div>
        </div>
    	<div class="box pull-right" style="width:270px;">
        	<div class="box_title"><a href="#">项目申报</a></div>
                <div class="project">
                    <a href="index.php?m=Unit&a=sign_in">企业用户登录</a>
                    <a href="index.php?m=Country&a=sign_in">区县管理员登录</a>
                    <a href="index.php?m=ContentAdmin&a=sign_in">内容管理员登录</a>
                    <a href="index.php?m=Admin&a=sign_in">超级管理员登录</a>
                </div>
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