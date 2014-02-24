<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
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
				<a href="index.html" title="西安交通大学勤工助学中心" id="web_logo">
					<img src="/public/upload/201207/1342516579.png" alt="西安交通大学勤工助学中心" title="西安交通大学勤工助学中心" style="margin:20px 0px 0px 0px;" />
				</a>
				<ul class="top-nav list-none">
					<li class="t">
                    	<a href="login.html" title="登录" target="_self"><?php echo ($user); ?></a>
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
                	<a href='index.html' title='网站首页' class='nav'>
                    	<span>网站首页</span>
                    </a>
                </li>
                <li class="line"></li><li id='nav_1' style='width:121px;'>
                	<a href='about.html' 0 title='勤工概况' class='hover-none nav'>
                    	<span>勤工概况</span>
                    </a>
                </li>
                <li class="line">
                </li>
                <li id='nav_2' style='width:121px;'>
                	<a href='news.html'  title='家教兼职' class='hover-none nav'>
                    	<span>家教兼职</span>
                    </a>
                </li>
                <li class="line">
                </li>
                <li id='nav_32' style='width:121px;'>
                	<a href='download.html'  title='资料下载' class='hover-none nav'>
                		<span>资料下载</span>
                	</a>
                </li>
                <li class="line">
                </li>
                <li id='nav_22' style='width:120px;'>
                	<a href='usercenter.html'  title='个人中心' class='hover-none nav'>
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
            <dl class="list-none navnow"><dt id='part2_4'><a href='javascript:;'  title='学生查询' class="zm" onclick="change1()"><span>学生查询</span></a></dt></dl>
            <dl class="list-none navnow"><dt id='part2_5'><a href='javascript:;'  title='单位管理' class="zm" onclick="change2()"><span>单位管理</span></a></dt></dl>
            <dl class="list-none navnow"><dt id='part2_6'><a href='javascript:;'  title='岗位管理' class="zm" onclick="change3()"><span>岗位管理</span></a></dt></dl>
            <dl class="list-none navnow"><dt id='part2_6'><a href='javascript:;'  title='申请处理' class="zm" onclick="change4()"><span>申请处理</span></a></dt></dl>
            <dl class="list-none navnow"><dt id='part2_6'><a href='javascript:;'  title='无岗学生' class="zm" onclick="change5()"><span>无岗学生</span></a></dt></dl>           
            <dl class="list-none navnow"><dt id='part2_6'><a href='admin_content.html'  title='内容管理' class="zm" target="_blank"><span>内容管理</span></a></dt></dl>                        
            <div class="clear"></div></div>







			<div class="active editor">
<div class="clear"></div></div>
    </div>
    
    
    <div class="sb_box" id="box1" style="display:block">
	    <h3 class="title">
			<span>学生查询</span>
		</h3>
		<div class="clear"></div>
        <div id="unitPassword">
            <form>
                <div class="unitPassword_title">姓名：</div><input type="text" value="" name="" /><div class="clear"></div>
                <div class="unitPassword_title">学号：</div><input type="text" value="" name="" /><div class="clear"></div>
                <button id="unitPassword_sub">查询</button>
            </form>                     
        </div>
        <div class="clear"></div>
        <div id="studentinfo">
        	<h2>张小明</h2>
              <ul>
                  <li>注册邮箱：someone@stu.xjtu.edu.cn</li>
                  <li>姓名：李小明</li>
                  <li>学号：2222222222</li>
                  <li>性别：男</li>
                  <li>书院：彭康书院</li>
                  <li>班级:某某11</li>
                  <li>手机：11111111111</li>
                  <li>特长：你猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜v猜</li>
              </ul>            
        </div>
	</div>
    
    
    
    <div class="sb_box" id="box2" style="display:none">
	    <h3 class="title">
			<span>单位管理</span>
		</h3>
		<div class="clear"></div>
		<div id="unitMessage">
        	<form>
        	<table id="worklist" cellspacing="0" cellpadding="0" style="margin-left:10px">
              <tr class="worklist_root">
                <td>单位名称</td>
                <td>负责人</td>
                <td>电话</td>
                <td>地址</td>
                <td>邮箱</td>
                <td>岗位上限</td>
                <td>员工人数</td>
                <td>编辑</td>
              </tr>
              
              
              
              <tr>
                <td>勤工办</td>
                <td>王晓明</td>
                <td>11111111111</td>
                <td>子安交通大学</td>
                <td>ppliuppliu@163.com</td>
                <td>30</td>
                <td>27</td>
                <td>
                <a href="temple.htm" onclick="return hs.htmlExpand(this, { headingText: '勤工办' })">修改</a>
                    <div class="highslide-maincontent">
                    	<form>
                    	<ul class="unit">
                            <li><span class="unitMessageChange">单位名称：</span><input type="text" value="勤工办" /></li>
                            <li><span class="unitMessageChange">负责人：</span><input type="text" value="李小明" /></li>
                            <li><span class="unitMessageChange">电话：</span><input type="text" value="11111111111" /></li>
                            <li><span class="unitMessageChange">地址：</span><input type="text" value="西安交通大学" /></li>
                            <li><span class="unitMessageChange">邮箱：</span><input type="text" value="ppliuppliu@163.com" /></li>
                            <li><span class="unitMessageChange">岗位上限:</span><input type="text" value="30" /></li>
                            <li><span class="unitMessageChange">员工人数：</span><input type="text" value="28" /></li>
                            <li><button>确认修改</button></li>
                        </ul>
                        </form>
                    </div>                 		
				</td>
              </tr>
              
              
              
              <tr>
                <td>勤工办</td>
                <td>王晓明</td>
                <td>11111111111</td>
                <td>子安交通大学</td>
                <td>ppliuppliu@163.com</td>
                <td>30</td>
                <td>27</td>
                <td>
                <a href="temple.htm" onclick="return hs.htmlExpand(this, { headingText: '勤工办' })">修改</a>
                    <div class="highslide-maincontent">
                    	<form>
                    	<ul class="unit">
                            <li><span class="unitMessageChange">单位名称：</span><input type="text" value="勤工办" /></li>
                            <li><span class="unitMessageChange">负责人：</span><input type="text" value="李小明" /></li>
                            <li><span class="unitMessageChange">电话：</span><input type="text" value="11111111111" /></li>
                            <li><span class="unitMessageChange">地址：</span><input type="text" value="西安交通大学" /></li>
                            <li><span class="unitMessageChange">邮箱：</span><input type="text" value="ppliuppliu@163.com" /></li>
                            <li><span class="unitMessageChange">岗位上限:</span><input type="text" value="30" /></li>
                            <li><span class="unitMessageChange">员工人数：</span><input type="text" value="28" /></li>
                            <li><button>确认修改</button></li>
                        </ul>
                        </form>
                    </div>                 		
				</td>
              </tr>
            </table>
            </form>
        </div>
	</div>
    
    
    
    
    <div class="sb_box" id="box3" style="display:none">
	    <h3 class="title">
			<span>岗位管理</span>
		</h3>
        <div id="unitPassword">
        	选择单位：<select><option value="勤工助学办公室">勤工助学办公室</option></select>
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
                <td>工作性质</td>
                <td>操作</td>
              </tr>
              
              
              
              <tr>
                <td>
                    <a href="temple.htm" onclick="return hs.htmlExpand(this, { headingText: '李小明' })">李小明</a>
                    <div class="highslide-maincontent">
                    	<ul>
                            <li>注册邮箱：someone@stu.xjtu.edu.cn</li>
                            <li>姓名：李小明</li>
                            <li>学号：2222222222</li>
                            <li>性别：男</li>
                            <li>书院：彭康书院</li>
                            <li>班级:某某11</li>
                            <li>手机：11111111111</li>
                            <li>特长：你猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜v猜</li>
                        </ul>
                    </div>                 		
                </td>
                <td>2222222222</td>
                <td>某某11</td>
                <td>男</td>
                <td>彭康书院</td>
                <td>不清楚</td>
                <td><button>删除</button></td>
              </tr>
              
              
              
              <tr>
                <td>
                    <a href="temple.htm" onclick="return hs.htmlExpand(this, { headingText: '李小明' })">李小明</a>
                    <div class="highslide-maincontent">
                    	<ul>
                            <li>注册邮箱：someone@stu.xjtu.edu.cn</li>
                            <li>姓名：李小明</li>
                            <li>学号：2222222222</li>
                            <li>性别：男</li>
                            <li>书院：彭康书院</li>
                            <li>班级:某某11</li>
                            <li>手机：11111111111</li>
                            <li>特长：你猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜v猜</li>
                        </ul>
                    </div>                 		
                </td>
                <td>2222222222</td>
                <td>某某11</td>
                <td>男</td>
                <td>彭康书院</td>
                <td>不清楚</td>
                <td><button>删除</button></td>
              </tr>
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
                <td>工作性质</td>
                <td>操作</td>
              </tr>
              
              
              
              <tr>
                <td>
                    <a href="temple.htm" onclick="return hs.htmlExpand(this, { headingText: '李小明' })">李小明</a>
                    <div class="highslide-maincontent">
                    	<ul>
                            <li>注册邮箱：someone@stu.xjtu.edu.cn</li>
                            <li>姓名：李小明</li>
                            <li>学号：2222222222</li>
                            <li>性别：男</li>
                            <li>书院：彭康书院</li>
                            <li>班级:某某11</li>
                            <li>手机：11111111111</li>
                            <li>特长：你猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜v猜</li>
                        </ul>
                    </div>                 		
                </td>
                <td>2222222222</td>
                <td>某某11</td>
                <td>男</td>
                <td>彭康书院</td>
                <td>不清楚</td>
                <td><button>删除</button></td>
              </tr>
              
              
              
              <tr>
                <td>
                    <a href="temple.htm" onclick="return hs.htmlExpand(this, { headingText: '李小明' })">李小明</a>
                    <div class="highslide-maincontent">
                    	<ul>
                            <li>注册邮箱：someone@stu.xjtu.edu.cn</li>
                            <li>姓名：李小明</li>
                            <li>学号：2222222222</li>
                            <li>性别：男</li>
                            <li>书院：彭康书院</li>
                            <li>班级:某某11</li>
                            <li>手机：11111111111</li>
                            <li>特长：你猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜v猜</li>
                        </ul>
                    </div>                 		
                </td>
                <td>2222222222</td>
                <td>某某11</td>
                <td>男</td>
                <td>彭康书院</td>
                <td>不清楚</td>
                <td><button>删除</button></td>
              </tr>
            </table>
            </form>
            
            
            
        	
            <div id="unitPassword">
                <h2>添加员工</h2>
                <form>
                    <div class="unitPassword_title">学号：</div><input type="text" value="" name="" /><div class="clear"></div>
                    <div class="unitPassword_title">工作性质：</div><select><option value="劳务">劳务</option><option value="助管">助管</option></select><div class="clear"></div>
                    <div class="unitPassword_title">工作时限：</div><select><option value="长期">长期</option><option value="临时">临时</option></select>
                    <div class="clear"></div>
                    <button id="unitPassword_sub">确认</button>
                </form>                      
            </div>
	</div>







    <div class="sb_box" id="box4" style="display:none">
	    <h3 class="title">
			<span>申请处理</span>
		</h3>
		<div class="clear"></div>
        	<form style="margin:50px auto">
        	<table id="worklist" cellspacing="0" cellpadding="0">
              <tr class="worklist_root">
                <td>单位名称</td>
                <td>申请原因</td>
                <td>长期岗申请人数</td>
                <td>临时岗申请人数</td>
                <td>临时岗工作时间（月）</td>
                <td>申请状态</td>
                <td>操作</td>
              </tr>
              
              
              
              <tr>
                <td>勤工助学办公室</td>
                <td>
                    <a href="temple.htm" onclick="return hs.htmlExpand(this, { headingText: '申请原因' })">最近工作量增大</a>
                    <div class="highslide-maincontent">
                    	<p>最近工作量增大最近工作量增大最近工作量增大最近工作量增大最近工作量增大最近工作量增大最近工作量增大最近工作量增大最近工作量增大最近工作量增大</p>
                    </div>                
                </td>
                <td>11</td>
                <td>4</td>
                <td>3</td>
                <td>已处理</td>
                <td><button>删除</button></td>
              </tr>
              
              
              
              <tr>
                <td>勤工助学办公室</td>
                <td>
                    <a href="temple.htm" onclick="return hs.htmlExpand(this, { headingText: '申请原因' })">最近工作量增大</a>
                    <div class="highslide-maincontent">
                    	<p>最近工作量增大最近工作量增大最近工作量增大最近工作量增大最近工作量增大最近工作量增大最近工作量增大最近工作量增大最近工作量增大最近工作量增大</p>
                    </div>                
                </td>
                <td>11</td>
                <td>4</td>
                <td>3</td>
                <td>未处理</td>
                <td><button>处理</button></td>
              </tr>
            </table>
            </form>
	</div>








    <div class="sb_box" id="box5" style="display:none">
	    <h3 class="title">
			<span>无岗学生</span>
		</h3>
		<div class="clear"></div>
        	<form style="margin:50px auto">
        	<table id="worklist" cellspacing="0" cellpadding="0">
              <tr class="worklist_root">
                <td>姓名</td>
                <td>学号</td>
                <td>班级</td>
                <td>性别</td>
                <td>书院</td>
              </tr>
              
              
              
              <tr>
                <td>
                    <a href="temple.htm" onclick="return hs.htmlExpand(this, { headingText: '李小明' })">李小明</a>
                    <div class="highslide-maincontent">
                    	<ul>
                            <li>注册邮箱：someone@stu.xjtu.edu.cn</li>
                            <li>姓名：李小明</li>
                            <li>学号：2222222222</li>
                            <li>性别：男</li>
                            <li>书院：彭康书院</li>
                            <li>班级:某某11</li>
                            <li>手机：11111111111</li>
                            <li>特长：你猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜v猜</li>
                        </ul>
                    </div>                 		
                </td>
                <td>2222222222</td>
                <td>某某11</td>
                <td>男</td>
                <td>彭康书院</td>
              </tr>
              
              
              
              <tr>
                <td>
                    <a href="temple.htm" onclick="return hs.htmlExpand(this, { headingText: '李小明' })">李小明</a>
                    <div class="highslide-maincontent">
                    	<ul>
                            <li>注册邮箱：someone@stu.xjtu.edu.cn</li>
                            <li>姓名：李小明</li>
                            <li>学号：2222222222</li>
                            <li>性别：男</li>
                            <li>书院：彭康书院</li>
                            <li>班级:某某11</li>
                            <li>手机：11111111111</li>
                            <li>特长：你猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜猜v猜</li>
                        </ul>
                    </div>                 		
                </td>
                <td>2222222222</td>
                <td>某某11</td>
                <td>男</td>
                <td>彭康书院</td>
              </tr>
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