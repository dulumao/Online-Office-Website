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
            <a href="index.php?m=Index&a=news" class="more btn btn-small btn-primary disabled">查看更多</a>
            <ul class="unstyled">
				<?php if(is_array($l1)): $i = 0; $__LIST__ = $l1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l1): $mod = ($i % 2 );++$i;?><li style="width:606px;"><a href="index.php?m=Index&a=news_content&id=<?php echo ($l1["id"]); ?>"><?php echo ($l1["title"]); ?></a><span><?php echo ($l1["time"]); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    	<div class="box pull-right" style="width:270px;">
        	<div class="box_title"><a href="#">文件下载</a></div>
            <a href="index.php?m=Index&a=file" class="more" style="font-size:12px; color:#999;">更多</a>            
            <ul class="unstyled">
				<?php if(is_array($l2)): $i = 0; $__LIST__ = $l2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l2): $mod = ($i % 2 );++$i;?><li style="width:225px;"><a href="index.php?m=Index&a=get_file&id=<?php echo ($l2["id"]); ?>"><?php echo ($l2["title"]); ?></a><span><?php echo ($l2["time"]); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>        
    </div>
    <div class="row">
    	<div class="box pull-left">
        	<div class="box_title"><a href="#">在线留言</a></div>
            <a href="index.php?m=Index&a=message" class="more btn btn-small btn-primary disabled">查看更多</a>
            <ul class="unstyled">
				<?php if(is_array($l3)): $i = 0; $__LIST__ = $l3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l3): $mod = ($i % 2 );++$i;?><li style="width:606px;"><a href="index.php?m=Index&a=message_content&id=<?php echo ($l3["id"]); ?>"><?php echo ($l3["title"]); ?></a><span><?php echo ($l3["time"]); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
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
	<!-- 保证主页Box高度一致 -->
	var box0 = $(".box:eq(0)").height();
	var box1 = $(".box:eq(1)").height();
	if(box0 >= box1){
		$(".box:eq(1)").animate({height:box0});
	}else if(box0 < box1){
		$(".box:eq(0)").animate({height:box1});
	}
	var box2 = $(".box:eq(2)").height();
	var box3 = $(".box:eq(3)").height();
	if(box2 >= box3){
		$(".box:eq(3)").animate({height:box2});
	}else if(box2 < box3){
		$(".box:eq(2)").animate({height:box3});
	}


	
	$(".title").find("ul li:eq(0)").addClass("active");
	var i = $.cookie("photo");
	if(i == 2 ){
		$(".photo2").height("180px");		
		$(".photo2").animate({height:"336px"});
		$.cookie("photo", "1", { expires: 7 });	
	}else {
		$(".photo2").height("336px")
		$.cookie("photo", "1", { expires: 7 });			
	}
});
</script>
</body>
</html>