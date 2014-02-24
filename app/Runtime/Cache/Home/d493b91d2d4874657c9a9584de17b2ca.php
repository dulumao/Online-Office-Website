<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>个人中心</title>
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
                    	<a href=__URL__/user_login title="登录" target="_self"><?php echo ($user); ?></a>
                        <span>|</span>
                    	<a href=__URL__/newuser  title="注册" target="_self">注册</a>
                        <span>|</span>                        
                        <a href='#' onclick='addFavorite();' style='cursor:pointer;' title='收藏本站'  >收藏本站</a>
                        <span>|</span>
                        <a class=fontswitch id=StranLink href="javascript:StranBody()">繁体中文</a>
						<script src="public/public/js/ch.js" type="text/javascript"></script></li>
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
				document.getElementById("box4").style.display = "none";
				document.getElementById("box5").style.display = "none";																			
			}
            function change2() {
				document.getElementById("box1").style.display = "none";
				document.getElementById("box2").style.display = "block";
				document.getElementById("box3").style.display = "none";	
				document.getElementById("box4").style.display = "none";
				document.getElementById("box5").style.display = "none";								
			}
            function change3() {
				document.getElementById("box1").style.display = "none";
				document.getElementById("box2").style.display = "none";
				document.getElementById("box3").style.display = "block";	
				document.getElementById("box4").style.display = "none";
				document.getElementById("box5").style.display = "none";								
			}
            function change4() {
				document.getElementById("box1").style.display = "none";
				document.getElementById("box2").style.display = "none";
				document.getElementById("box3").style.display = "none";	
				document.getElementById("box4").style.display = "block";
				document.getElementById("box5").style.display = "none";								
			}
            function change5() {
				document.getElementById("box1").style.display = "none";
				document.getElementById("box2").style.display = "none";
				document.getElementById("box3").style.display = "none";	
				document.getElementById("box4").style.display = "none";
				document.getElementById("box5").style.display = "block";								
			}							
            </script>
            <dl class="list-none navnow"><dt id='part2_4'><a href='javascript:;'  title='单位信息' class="zm" onclick="change1()"><span>单位信息</span></a></dt></dl>
            <dl class="list-none navnow"><dt id='part2_5'><a href='javascript:;'  title='岗位申请' class="zm" onclick="change2()"><span>岗位申请</span></a></dt></dl>
            <dl class="list-none navnow"><dt id='part2_6'><a href='javascript:;'  title='员工管理' class="zm" onclick="change3()"><span>员工管理</span></a></dt></dl>
            <dl class="list-none navnow"><dt id='part2_6'><a href='javascript:;'  title='添加员工' class="zm" onclick="change4()"><span>添加员工</span></a></dt></dl>
             <dl class="list-none navnow"><dt id='part2_6'><a href='javascript:;'  title='工资申报' class="zm" onclick="change5()"><span>工资申报</span></a></dt></dl>         
            <div class="clear"></div></div>

			<div class="active editor">
<div class="clear"></div></div>
    </div>
    
    
    <div class="sb_box" id="box1" style="display:block">
	    <h3 class="title">
			<span>单位信息</span>
		</h3>
		<div class="clear"></div>
		<div id="unitMessage">
        	<div class="unitMessage_title">单位名称：</div><div class="unitMessage_value"><?php echo ($c["name"]); ?></div><div class="clear"></div>
        	<div class="unitMessage_title">地址：</div><div class="unitMessage_value"><?php echo ($c["address"]); ?></div><div class="clear"></div>
        	<div class="unitMessage_title">主管人：</div><div class="unitMessage_value"><?php echo ($c["pm"]); ?></div><div class="clear"></div>
        	<div class="unitMessage_title">电话：</div><div class="unitMessage_value"><?php echo ($c["phone"]); ?></div><div class="clear"></div>
        	<div class="unitMessage_title">邮箱：</div><div class="unitMessage_value"><?php echo ($c["email"]); ?></div>            
        </div>
        <div class="clear"></div>
        <div id="unitPassword">
        	<h2>修改密码</h2>
            <form action=__URL__/usercenter method="post" >
                <div class="unitPassword_title">原密码：</div><input type="password" value="" name="o" /><div class="clear"></div>
                <div class="unitPassword_title">新密码：</div><input type="password" value="" name="p1" /><div class="clear"></div>
                <div class="unitPassword_title">确认密码：</div><input type="password" value="" name="p2" /><div class="clear"></div>
               
                <button id="unitPassword_sub" type="submit" >确认</button>
            </form>                      
        </div>
	</div>
    
    
    
    <div class="sb_box" id="box2" style="display:none">
	    <h3 class="title">
			<span>岗位申请</span>
		</h3>
		<div class="clear"></div>
		<div id="unitMessage">
        	<form style="width:400px;" method="post" action=__URL__/usercenter >
        	<div class="unitMessage_title">申请原因：</div><textarea name="yuanyin" cols="" rows="" class="unitMessage_value" style="width:200px"></textarea>
            <div class="unitMessage_title">申请人数：</div>
            <div class="clear"></div>
            <div class="unitMessage_title">长期岗：</div><input type="text" name="changqirenshu" style="width:50px" />人
            <div class="clear"></div>            
            <div class="unitMessage_title">临时岗：</div><input type="text" name="duanqirenshu" style="width:50px" />人
            											<span style="margin-left:20px"></span>临时岗时间：<input type="text" name="duanqishijian" style="width:50px" />月
            <div class="clear" style="margin-bottom:40px"></div>
            <button id="unitPassword_sub" type="submit">确认</button>
            </form>
        </div>
	</div>
    
    
    
    
    <div class="sb_box" id="box3" style="display:none">
	    <h3 class="title">
			<span>员工管理</span>
		</h3>
		<div class="clear"></div>
	    <h2>员工查询(学号或者名字作为关键词)：<form method="get" action=__URL__/xinxichaxun target="_blank"><input type="text" name="id"/></form></h2>
        <h2>长期岗：</h2>
        	<form>
        	<table id="worklist" cellspacing="0" cellpadding="0">
              <tr class="worklist_root">
                <td>姓名</td>
                <td>学号</td>
                <td>班级</td>
                <td>性别</td>
                <td>书院</td>
                
                <td>操作</td>
			 </tr>        
			      
               <?php if(is_array($list1)): $i = 0; $__LIST__ = $list1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td>
                  <?php echo ($vo["name"]); ?>                                  		
                </td>
                <td><?php echo ($vo["sid"]); ?></td>
                <td><?php echo ($vo["class"]); ?></td>
                <td><?php echo ($vo["sex"]); ?></td>
                <td><?php echo ($vo["shuyuan"]); ?></td>
                
                <td><a href=__URL__/delete_worker_from_unit_me?id=<?php echo ($vo["id"]); ?> >删除</a></td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>      
            </table>
            </form>

        <h2>临时岗：</h2>
        	<form style="margin-bottom:50px">
        	<table id="worklist" cellspacing="0" cellpadding="0">
              <tr class="worklist_root">
                <td>姓名</td>
                <td>学号</td>
                <td>班级</td>
                <td>性别</td>
                <td>书院</td>
                
                <td>操作</td>
              </tr>
              
            <?php if(is_array($list2)): $i = 0; $__LIST__ = $list2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td>
                  <?php echo ($vo["name"]); ?>                                  		
                </td>
                <td><?php echo ($vo["sid"]); ?></td>
                <td><?php echo ($vo["class"]); ?></td>
                <td><?php echo ($vo["class"]); ?></td>
                <td><?php echo ($vo["shuyuan"]); ?></td>
                
                <td><a href=__URL__/delete_worker_from_unit_me?id=<?php echo ($vo["id"]); ?> >删除</a></td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>   
			
            </table>
            </form>
	</div>







    <div class="sb_box" id="box4" style="display:none">
	    <h3 class="title">
			<span>添加员工</span>
		</h3>
		<div class="clear"></div>
        <div id="unitPassword">
        	<h2>添加员工</h2>
            <form action=__URL__/add_worker_to_this_part_me method="POST">
                    <div class="unitPassword_title">学号：</div><input type="text" value="" name="sid" /><div class="clear"></div>
                   
                    <div class="unitPassword_title">工作时限：</div><input type="text" name="changduan" /><div class="clear"></div>
                    <div class="clear"></div>
					<input type="hidden" name="part" value="<?php echo ($notice); ?>"/> 
                    <button id="unitPassword_sub">确认</button>
                </form>                        
        </div>
	</div>

	
	 <div class="sb_box" id="box5" style="display:none">
	    <h3 class="title">
			<span>工资申报</span>
		</h3>
		<div class="clear"></div>
        <div id="unitPassword">
        	<h2>工资申报</h2>
          
		        <a href=<?php echo ($url); ?>changqi=<?php echo ($changqi); ?>&duanqi=<?php echo ($duanqi); ?>&total=<?php echo ($total); ?>&date=<?php echo ($date); ?> ><button id="unitPassword_sub" >点击此处跳往工资申报页面</button></a>
                                     
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
<script src="/publictemplates/metv5/images/js/fun.inc.js" type="text/javascript"></script>

</body>
</html>