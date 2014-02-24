<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户注册</title>
<link rel="stylesheet" type="text/css" href="/public/templates/metv5/images/css/newuser.css" />
<link rel="stylesheet" type="text/css" href="/public/templates/metv5/images/css/metinfo.css" />
<script src="/public/public/js/jQuery1.7.2.js" type="text/javascript"></script>
<!--[if IE]>
<script src="public/js/html5.js" type="text/javascript"></script>
<![endif]-->
<script src="/public/templates/metv5/images/js/newuser.js" type="text/javascript"></script>
	<script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#formID").validationEngine('attach');
		});
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
                    	<a href=__URL__/user_login  title="登录" target="_self">登录</a>
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

    <div class="sb_box" style="width:980px">
	    <h3 class="title">
			<span>用户注册</span>
		</h3>
		<div class="clear"></div>

	<form id="formID" class="formular" method="post" action=__URL__/newuser >
		<fieldset>
			<legend>
				请使用西安交通大学邮箱，例如：<br />someone@stu.xjtu.edu.xn<br />someone@mail.xjtu.edu.cn
			</legend>
			<label>
				<span>邮箱地址 : </span>
				<input value="" class="validate[required,custom[email]] text-input" type="text" name="u" id="email" />
			</label>
		</fieldset> 
        <fieldset>
        	<legend>
            	请输入密码，本密码与邮箱密码无关
            </legend>
            <label>
            	<span>密码：</span>
                <input value="" class="validate[required] text-input" type="password" name="p1" id="password" />
            </label>
        </fieldset>
        <fieldset>
        	<legend>
            	请再次输入密码
            </legend>
            <label>
            	<span>确认密码：</span>
                <input value="" class="validate[required,equals[password]] text-input" type="password" name="p2" id="password" />
            </label>
        </fieldset>
		<fieldset>
			<legend>
				请输入您的真实姓名
			</legend>
			<label>
				<span>姓名 : </span>
				<input value="" class="validate[required] text-input" type="text" name="name" id="realName" />
			</label>
		</fieldset>
		<fieldset>
			<legend>
				学号
			</legend>
			<label>
				<span>学号: </span>
				<input value="" class="validate[required,minSize[6]] text-input" type="text" name="sid" id="number" />
			</label>
		</fieldset>
		<fieldset>
            <legend>
                性别
            </legend>
            <label>
            	<span>请选择您的性别：</span>
                <select name="sex" id="sex" class="validate[required]">
                    <option value=""></option>
                    <option value="男">男</option>
                    <option value="女">女</option>
                </select>
            </label>
		</fieldset>              
		<fieldset>
            <legend>
                书院
            </legend>
            <label>
            	<span>请选择您的书院：</span>
                <select name="shuyuan" id="college" class="validate[required]">
                    <option value=""></option>
                    <option value="彭康书院">彭康书院</option>
                    <option value="宗濂书院">宗濂书院</option>
                    <option value="启德书院">启德书院</option>
                    <option value="南洋书院">南洋书院</option>
                    <option value="励志书院">励志书院</option>
                    <option value="仲英书院">仲英书院</option>
                    <option value="文治书院">文治书院</option>
                    <option value="崇实书院">崇实书院</option>                            
                </select>
            </label>
		</fieldset> 
		<fieldset>
			<legend>
				班级，例如：经济17
			</legend>
			<label>
				<span>班级 : </span>
				<input value="" class="validate[required] text-input" type="text" name="class" id="class" />
			</label>
		</fieldset>                     
		<fieldset>
			<legend>
				手机
			</legend>
			<label>
				<span>手机 : </span>
				<input value="" class="validate[custom[phone]] validate[required] text-input" type="text" name="mobile" id="telephone" />
			</label>
		</fieldset>
		<fieldset>
			<legend>
				特长
			</legend>
			<label>
				<span>特长 : </span>
				<textarea value="" class="validate[required] text-input" type="text" name="des" id="interest"></textarea>
			</label>
		</fieldset>    
		<!--                 
		<fieldset>
			<legend>
				验证码
			</legend>
			<label>
				<span>验证码 : </span>
				<input value="" class="validate[required] text-input" type="text" name="key" id="key" />
`				<a href="javascript:;"><img src="public/getcode.do.jpg" />看不清楚</a><br />                
			</label>
		</fieldset> 
		-->
        <button value="" type="submit">确认</button>               
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
<script src="/public/templates/metv5/images/js/fun.inc.js" type="text/javascript"></script>

</body>
</html>