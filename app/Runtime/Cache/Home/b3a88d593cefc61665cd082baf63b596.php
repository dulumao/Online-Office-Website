<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($title); ?></title>



	  <style type="text/css">
		  

          .focusField{
              border:solid 2px #73A6FF;
              background:#EFF5FF;
              color:#000;
			  height:30px;
			  margin:10px;
			  width:143px;		  
          }
          .idleField{
              background:#EEE;
              color: #6F6F6F;
              border: solid 2px #DFDFDF;
			  height:30px;
			  margin:10px;
			  width:143px;
			  			  
          }
		  #login {
			  width:400px;
			  margin-left:auto;
			  margin-right:auto;
			  margin-top:30px;
			  margin-bottom:50px;
		  }
		  #login img {
			  margin-left:51px;
		  }
		  #login button {
			  background-image:url(public/templates/metv5/images/dt-5.gif);
			  height:32px;
			  border:none;
			  cursor:pointer;
			  color:#FFF;
			  padding:5px 10px;
			  margin-left:30px;
			  margin-top:20px;
		  }
		  .loginName {
			  width:47px;
			  float:left;
			  clear:both;
			  padding-top:13px;
		  }
		  .loginValue {
			  float:left;
		  }
      </style>




<link rel="stylesheet" type="text/css" href="templates/metv5/images/css/metinfo.css" />
<script src="js/jQuery1.7.2.js" type="text/javascript"></script>
<!--[if IE]>
<script src="public/js/html5.js" type="text/javascript"></script>
<![endif]-->


	<script type="text/javascript">
		$(document).ready(function() {
			$('input[type="text"]').addClass("idleField");
       		$('input[type="text"]').focus(function() {
       			$(this).removeClass("idleField").addClass("focusField");
    		    if (this.value == this.defaultValue){ 
    		    	this.value = '';
				}
				if(this.value != this.defaultValue){
	    			this.select();
	    		}
    		});
    		$('input[type="text"]').blur(function() {
    			$(this).removeClass("focusField").addClass("idleField");
    		    if ($.trim(this.value) == ''){
			    	this.value = (this.defaultValue ? this.defaultValue : '');
				}
    		});
		});			
	</script>




</head>
<body>
    <header>
		<div class="inner">
			<div class="top-logo">
				<a href=index.php?m=Index&a=index  title="西安交通大学勤工助学中心" id="web_logo">
					<img src="upload/201207/1342516579.png" alt="西安交通大学勤工助学中心" title="西安交通大学勤工助学中心" style="margin:20px 0px 0px 0px;" />
				</a>
				<ul class="top-nav list-none">
					<li class="t">
                    	<a href=index.php?m=Index&a=login title="登录" target="_self">登录</a>
                        <span>|</span>
                    	<a href=index.php?m=Index&a=newuser title="注册" target="_self">注册</a>
                        <span>|</span>                        
                        <a href='#' onclick='addFavorite();' style='cursor:pointer;' title='收藏本站'  >收藏本站</a>
                        <span>|</span>
                        <a class=fontswitch id=StranLink href="javascript:StranBody()">繁体中文</a>
						<script src="public/js/ch.js" type="text/javascript"></script></li>
				</ul>                
			</div>
			<nav>
            <ul class="list-none">
            	<li id="nav_10001" style='width:121px;'>
                	<a href=index.php?m=Index&a=index title='网站首页' class='nav'>
                    	<span>网站首页</span>
                    </a>
                </li>
                <li class="line"></li><li id='nav_1' style='width:121px;'>
                	<a href=index.php?m=Index&a=about 0 title='勤工概况' class='hover-none nav'>
                    	<span>勤工概况</span>
                    </a>
                </li>
                <li class="line">
                </li>
                <li id='nav_2' style='width:121px;'>
                	<a href=index.php?m=Index&a=news  title='家教兼职' class='hover-none nav'>
                    	<span>家教兼职</span>
                    </a>
                </li>
                <li class="line">
                </li>
                <li id='nav_32' style='width:121px;'>
                	<a href=index.php?m=Index&a=download  title='资料下载' class='hover-none nav'>
                		<span>资料下载</span>
                	</a>
                </li>
                <li class="line">
                </li>
                <li id='nav_22' style='width:120px;'>
                	<a href=index.php?m=Index&a=usercenter_stu   title='个人中心' class='hover-none nav'>
                		<span>个人中心</span>
                	</a>
                </li>
                </ul></nav>
		</div>
	</header>



<div class="sidebar inner">

    <div class="sb_box" style="width:980px">
	    <h3 class="title">
			<span>后台登陆</span>
		</h3>
		<div class="clear"></div>

	<form id="login" method="post" action=index.php?m=Index&a=admin > 
		<div class="loginName">账户:</div><div class="loginValue"><input name="u" value="" type="text"/></div><div class="clear"></div>
        <div class="loginName">密码:</div><div class="loginValue"><input name="p" value="" type="text"/></div><div class="clear"></div>       
      
		<button value="登陆" style="margin-left:96px; background-color:#00CCCC">登陆</button>
	</form>

        
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
<script src="templates/metv5/images/js/fun.inc.js" type="text/javascript"></script>

</body>
</html>