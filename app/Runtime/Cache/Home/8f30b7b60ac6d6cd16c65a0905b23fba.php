<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>勤工助学网站后台管理</title>
<link rel="stylesheet" type="text/css" href="/public/templates/metv5/images/css/metinfo.css" />
<script src="/public/public/js/jQuery1.7.2.js" type="text/javascript"></script>
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
                    	<a href=__URL__/admin_exit title="注册" target="_self">退出</a>
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

			<h3 class='title myCorner' data-corner='top 5px'>后台管理</h3>
			<div class="active" id="sidebar" data-csnow="2" data-class3="0" data-jsok="2">
         
         <dl class="list-none navnow"><dt id='part2_4'><a href=__URL__/admin_main  title='学生查询' class="zm" onclick="change0()"><span>学生查询</span></a></dt></dl>
          <dl class="list-none navnow"><dt id='part2_5'><a href=__URL__/danweiguanli  title='单位管理' class="zm" onclick="change0()"><span>单位管理</span></a></dt></dl>
          <dl class="list-none navnow"><dt id='part2_6'><a href=__URL__/gangweiguanli  title='岗位管理' class="zm" onclick="change0()"><span>岗位管理</span></a></dt></dl>
          <dl class="list-none navnow"><dt id='part2_6'><a href=__URL__/shenqingchuli  title='申请处理' class="zm" onclick="change0()"><span>申请处理</span></a></dt></dl>
           <dl class="list-none navnow"><dt id='part2_6'><a href=__URL__/wugangxuesheng title='无岗学生' class="zm" onclick="change0()"><span>无岗学生</span></a></dt></dl>          
          <dl class="list-none navnow"><dt id='part2_6'><a href=__URL__/admin_content  title='内容管理' class="zm" target="_blank"><span>内容管理</span></a></dt></dl>                        
            <div class="clear"></div></div>







			<div class="active editor">
<div class="clear"></div></div>
    </div>
    
    
    
    
    <div class="sb_box" id="box1" style="display:block">
	    <h3 class="title">
			<span>单位管理</span>
		</h3>
		<div class="clear"></div>
		<div id="unitMessage">
		
        	<table id="worklist" cellspacing="0" cellpadding="0" style="margin-left:10px">
			
              <tr class="worklist_root">
                <td>单位名称</td>
                <td>负责人</td>
                <td>电话</td>
                <td>地址</td>
                <td>邮箱</td>
                <td>岗位上限</td>
                <td>员工人数</td>
                <td>修改</td>
              </tr>
              
           <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><form action=__URL__/danweiguanli method="get">
            <tr class="worklist_root">
                <td><input style="width:80px; height:inherit" name="name" value="<?php echo ($vo["name"]); ?>" /></td>
                <td><input style="width:50px; height:inherit" name="pm" value="<?php echo ($vo["pm"]); ?>" /></td>
                <td><input style="width:80px; height:inherit" name="phone" value="<?php echo ($vo["phone"]); ?>" /></td>
                <td><input style="width:100px; height:inherit" name="address" value="<?php echo ($vo["address"]); ?>" /></td>
                <td><input style="width:100px; height:inherit" name="email" value="<?php echo ($vo["email"]); ?>" /></td>
                <td><input style="width:30px; height:inherit" name="shangxian" value="<?php echo ($vo["shangxian"]); ?>" /></td>
                <td><input style="width:30px; height:inherit" name="renshu" value="<?php echo ($vo["renshu"]); ?>" /></td>
				<input type="hidden" value="<?php echo ($vo["id"]); ?>" name="id"/>
				<td>
                <input type="submit" value="确认修改" name="submit" />                         		
				</td>
              </tr>
			 </form><?php endforeach; endif; else: echo "" ;endif; ?>    
              
              <form action=__URL__/danweiguanli method="get">
			  <tr class="worklist_root">
                <td><input style="width:80px; height:inherit" name="name" value="" /></td>
                <td><input style="width:50px; height:inherit" name="pm" value="" /></td>
                <td><input style="width:80px; height:inherit" name="phone" value="" /></td>
                <td><input style="width:100px; height:inherit" name="address" value="" /></td>
                <td><input style="width:100px; height:inherit" name="email" value="" /></td>
                <td><input style="width:30px; height:inherit" name="shangxian" value="" /></td>
                <td><input style="width:30px; height:inherit" name="renshu" value="" /></td>
				<input type="hidden" value="" name="id"/>
				<td>
                <input type="submit" value="确认增加" name="submit" />                         		
				</td>
              </tr>
			  <tr class="worklist_root" height="70px">
			  	<td>输入单位描述</td>
				<td colspan="7"><textarea style="height:70px; width:550px"  name="des" >输入单位描述</textarea></td>
			  </tr>
			  </form>
           
            </table>
           
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