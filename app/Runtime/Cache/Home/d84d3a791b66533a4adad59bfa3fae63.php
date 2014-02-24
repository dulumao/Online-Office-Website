<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>个人中心</title>
<link rel="stylesheet" type="text/css" href="/public/templates/metv5/images/css/metinfo.css" />
<script src="/public/js/jQuery1.7.2.js" type="text/javascript"></script>
<!--[if IE]>
<script src="public/js/html5.js" type="text/javascript"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/public/templates/metv5/images/css/usercenter.css" />



<script type="text/javascript" src="/public/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="/public/highslide/highslide.css" />



<script type="text/javascript">
	hs.graphicsDir = 'highslide/graphics/';
	hs.outlineType = 'rounded-white';
	hs.showCredits = false;
	hs.wrapperClassName = 'draggable-header';
</script>

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
                    	<a href=__URL__/user_login  title="登录" target="_self"><?php echo ($user); ?></a>
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

			<h3 class='title myCorner' data-corner='top 5px'>个人中心</h3>
			<div class="active" id="sidebar" data-csnow="2" data-class3="0" data-jsok="2">
            <script type="text/javascript">
            function change1() {
				document.getElementById("box1").style.display = "block";
				document.getElementById("box2").style.display = "none";
				document.getElementById("box3").style.display = "none";	
			}
            function change2() {
				document.getElementById("box1").style.display = "none";
				document.getElementById("box2").style.display = "block";
				document.getElementById("box3").style.display = "none";	
			}
            function change3() {
				document.getElementById("box1").style.display = "none";
				document.getElementById("box2").style.display = "none";
				document.getElementById("box3").style.display = "block";	
			}
            </script>
            <dl class="list-none navnow"><dt id='part2_4'><a href='javascript:;'  title='个人资料' class="zm" onclick="change1()"><span>个人资料</span></a></dt></dl>
            <dl class="list-none navnow"><dt id='part2_5'><a href='javascript:;'  title='工作状况' class="zm" onclick="change2()"><span>工作状况</span></a></dt></dl>
            <dl class="list-none navnow"><dt id='part2_6'><a href='javascript:;'  title='工资查询' class="zm" onclick="change3()"><span>工资查询</span></a></dt></dl>
            <div class="clear"></div></div>

			<div class="active editor">
<div class="clear"></div></div>
    </div>
    
    
    <div class="sb_box" id="box1" style="display:block">
	    <h3 class="title">
			<span>个人资料</span>
		</h3>
		<div class="clear"></div>
		<div id="unitMessage">
        	<div class="unitMessage_title">注册邮箱：</div><div class="unitMessage_value"><?php echo ($u["email"]); ?></div><div class="clear"></div>
        	<div class="unitMessage_title">姓名：</div><div class="unitMessage_value"><?php echo ($u["name"]); ?></div><div class="clear"></div>
        	<div class="unitMessage_title">学号：</div><div class="unitMessage_value"><?php echo ($u["sid"]); ?></div><div class="clear"></div>
        	<div class="unitMessage_title">性别：</div><div class="unitMessage_value"><?php echo ($u["sex"]); ?></div><div class="clear"></div>
        	<div class="unitMessage_title">书院：</div><div class="unitMessage_value"><?php echo ($u["shuyuan"]); ?></div><div class="clear"></div>
        	<div class="unitMessage_title">班级：</div><div class="unitMessage_value"><?php echo ($u["class"]); ?></div><div class="clear"></div>       
        	<div class="unitMessage_title">手机：</div><div class="unitMessage_value"><?php echo ($u["mobile"]); ?></div><div class="clear"></div>
        	<div class="unitMessage_title">特长：</div><div class="unitMessage_value"><?php echo ($u["des"]); ?></div>            
        </div>
        <div class="clear"></div>
        <div id="unitPassword">
        	<h2>修改特长</h2>
            <form action=__URL__/usercenter_stu method="post">
            	<textarea style="margin:0 0 20px 66px" name="des"></textarea>
                <div class="clear"></div>
                <button id="unitPassword_sub" type="submit">确认</button>
            </form>
        </div>
        <div class="clear"></div>
        <div id="unitPassword">
        	<h2>修改密码</h2>
            <form action=__URL__/usercenter_stu method="post">
                <div class="unitPassword_title">原密码：</div><input type="password" value="" name="o" /><div class="clear"></div>
                <div class="unitPassword_title">新密码：</div><input type="password" value="" name="p1" /><div class="clear"></div>
                <div class="unitPassword_title">确认密码：</div><input type="password" value="" name="p2" /><div class="clear"></div>
                            
				
                <div class="clear"></div>
				
                <button id="unitPassword_sub" type="submit">确认</button>
            </form>                      
        </div>
	</div>
    
    
    
    <div class="sb_box" id="box2" style="display:none">
	    <h3 class="title">
			<span>工作状况</span>
		</h3>
		<div class="clear"></div>
        
        
        <div id="haveWork">
        	<table id="worklist" cellspacing="0" cellpadding="0">
              <tr class="worklist_root">
                <td>工作单位</td>                
                <td>工作内容</td>
              </tr>
              <tr>
                <td><?php echo ($f["name"]); ?></td>                
                <td><?php echo ($changduan); ?></td>
              </tr>              
            </table>
        </div>
        
     
	</div>
    
    
    
    
    <div class="sb_box" id="box3" style="display:none">
	    <h3 class="title">
			<span>工资查询</span>
		</h3>
		<div class="clear"></div>
        	<div style="margin:40px 2px">
        	<table id="worklist" cellspacing="0" cellpadding="0">
              <tr class="worklist_root">
                <td>本功能待开发</td>
                
              </tr>
			  <!--
              <tr>
                <td>20121212</td>
                <td>222</td>
              </tr>
              <tr>
                <td>20121212</td>
                <td>222</td>
              </tr>
              <tr>
                <td>20121212</td>
                <td>222</td>
              </tr>
              <tr>
                <td>20121212</td>
                <td>222</td>
              </tr>
			  -->
            </table>
            </div>
	</div>




    
    
    <div class="clear"></div>
</div>

<footer data-module="22" data-navdown="22" data-classnow="22">
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