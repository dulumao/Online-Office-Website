<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新闻中心</title>
<link rel="stylesheet" type="text/css" href="/public/templates/metv5/images/css/metinfo.css" />
<script src="/public/public/js/jQuery1.7.2.js" type="text/javascript"></script>
<!--[if IE]>
<script src="public/js/html5.js" type="text/javascript"></script>
<![endif]-->
</head>
<body>
    <header>
		<div class="inner">
			<div class="top-logo">
				<a href=__URL__/index  title="西安交通大学勤工助学中心" id="web_logo">
					<img src="/public/upload/201207/1342516579.png" alt="西安交通大学勤工助学中心" title="西安交通大学勤工助学中心" style="margin:20px 0px 0px 0px;" />
				</a>
				<ul class="top-nav list-none">
					<li class="t">
                    	<a href=__URL__/user_login title="登录" target="_self"><?php echo ($user); ?></a>
                        <span>|</span>
                    	<a href=__URL__/newuser  title="注册" target="_self">注册</a>
                        <span>|</span>                        
                        <a href='#' onclick='addFavorite();' style='cursor:pointer;' title='收藏本站'  >收藏本站</a>
                        <span>|</span>
                        <a class=fontswitch id=StranLink href="javascript:StranBody()">繁体中文</a>
						<script src="/public/public/js/ch.js" type="text/javascript"></script></li>
				</ul>                
			</div>
			<nav>
            <ul class="list-none">
            	<li id="nav_10001" style='width:121px;'>
                	<a href=__URL__/index  title='网站首页' class='nav'>
                    	<span>网站首页</span>
                    </a>
                </li>
                <li class="line"></li><li id='nav_1' style='width:121px;'>
                	<a href=__URL__/about 0 title='勤工概况' class='hover-none nav'>
                    	<span>勤工概况</span>
                    </a>
                </li>
                <li class="line">
                </li>
                <li id='nav_2' style='width:121px;'>
                	<a href=__URL__/news   title='家教兼职' class='hover-none nav'>
                    	<span>家教兼职</span>
                    </a>
                </li>
                <li class="line">
                </li>
                <li id='nav_32' style='width:121px;'>
                	<a href=__URL__/downloadlist   title='资料下载' class='hover-none nav'>
                		<span>资料下载</span>
                	</a>
                </li>
                <li class="line">
                </li>
                <li id='nav_22' style='width:120px;'>
                	<a href=__URL__/usercenter_stu   title='个人中心' class='hover-none nav'>
                		<span>个人中心</span>
                	</a>
                </li>
                </ul></nav>
		</div>
	</header>


<div class="sidebar inner">
    <div class="sb_nav">

			<h3 class='title myCorner' data-corner='top 5px'>新闻资讯</h3>
			<div class="active" id="sidebar" data-csnow="5" data-class3="0" data-jsok="2"><dl class="list-none navnow"><dt id='part2_4'><a href=__URL__/tongzhi  title='通知公告' class="zm"><span>通知公告</span></a></dt></dl><dl class="list-none navnow"><dt id='part2_5'><a href=__URL__/xinwen  title='新闻中心' class="zm"><span>新闻中心</span></a></dt></dl><div class="clear"></div></div>
</div>


    <div class="sb_box">
	    <h3 class="title">
			<span>通知公告</span>
		</h3>
		<div class="clear"></div>

        <div class="active" id="shownews">
            <h1 class="title"><?php echo ($b["title"]); ?></h1>
            <div class="editor"></div>
			<div>
                  <p><?php echo ($b["content"]); ?></p>
              </div><div class="clear"></div></div>

			
        </div>
    </div>
    <div class="clear"></div>
</div>

<footer data-module="4" data-navdown="323" data-classnow="323">
	<div class="inner">
		<div class="foot-text">
			<p>西安交通大学勤工助学中心</p>
			<p>本站由极光工作室负责维护</p>
		</div>
	</div>
</footer>
<script src="/public/templates/metv5/images/js/fun.inc.js" type="text/javascript"></script>

</body>
</html>