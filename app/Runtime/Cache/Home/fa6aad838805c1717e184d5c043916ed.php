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
    

    
    
   
    
    <div class="sb_box" id="box3" style="display:block">
	    <h3 class="title">
			<span>岗位管理</span>
		</h3>
        <div id="unitPassword">
			<form action__URL__/gangweiguanli method="get">
        	单位：<div class="clear"></div><input type="text" name='part' value="<?php echo ($notice); ?>"/>			
			</form>
        </div>
		<div class="clear"></div>
        <h2>长期岗：</h2>
        	<form style="margin-bottom:50px">
        	<table id="worklist" cellspacing="0" cellpadding="0">
              <tr class="worklist_root">
                <td>姓名</td>
                <td>学号</td>
                <td>班级</td>
                <td>性别</td>
                <td>书院</td>
                <td>工作时限</td>
                <td>操作</td>
              </tr>
              
              
              <?php if(is_array($list1)): $i = 0; $__LIST__ = $list1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($vo["name"]); ?></td>
                <td><?php echo ($vo["sid"]); ?></td>
                <td><?php echo ($vo["class"]); ?></td>
                <td><?php echo ($vo["sex"]); ?></td>
                <td><?php echo ($vo["shuyuan"]); ?></td>
                <td>不限制</td>
                <td><a href=__URL__/delete_worker_from_unit?id=<?php echo ($vo["id"]); ?>&part=<?php echo ($notice); ?>>删除</a></td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>    
            
			  
            </table>
            </form>
		<div class="clear"></div>
        
        
        
        
        <h2>临时岗：</h2>
        	<form style="margin-bottom:50px">
        	<table id="worklist" cellspacing="0" cellpadding="0">
              <tr class="worklist_root">
                <td>姓名</td>
                <td>学号</td>
                <td>班级</td>
                <td>性别</td>
                <td>书院</td>
                <td>工作时限</td>
                <td>操作</td>
              </tr>
              
              
              
             
               <?php if(is_array($list2)): $i = 0; $__LIST__ = $list2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($voo["name"]); ?></td>
                <td><?php echo ($voo["sid"]); ?></td>
                <td><?php echo ($voo["class"]); ?></td>
                <td><?php echo ($voo["sex"]); ?></td>
                <td><?php echo ($voo["shuyuan"]); ?></td>
                <td><?php echo ($voo["changduan"]); ?></td>
                <td><a href=__URL__/delete_worker_from_unit?id=<?php echo ($voo["id"]); ?>&part=<?php echo ($notice); ?>>删除</a></td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>  
                         
              
              
           
            </table>
            </form>
            
            
            
        	
            <div id="unitPassword">
                <h2>添加员工</h2>
                <form action=__URL__/add_worker_to_this_part method="POST">
                    <div class="unitPassword_title">学号：</div><input type="text" value="" name="sid" /><div class="clear"></div>
                   
                    <div class="unitPassword_title">工作时限：</div><input type="text" name="changduan" /><div class="clear"></div>
                    <div class="clear"></div>
					<input type="hidden" name="part" value="<?php echo ($notice); ?>"/> 
                    <button id="unitPassword_sub">确认</button>
                </form>                      
            </div>
	</div>





            </table>
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