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
	hs.graphicsDir = '/public/highslide/graphics/';
	hs.outlineType = 'rounded-white';
	hs.showCredits = false;
	hs.wrapperClassName = 'draggable-header';
</script>




	<script language="Javascript" src="/public/htmlbox/jquery-1.3.2.min.js" type="text/javascript"></script>
	<script language="Javascript" src="/public/htmlbox/htmlbox.colors.js" type="text/javascript"></script>
	<script language="Javascript" src="/public/htmlbox/htmlbox.styles.js" type="text/javascript"></script>
	<script language="Javascript" src="/public/htmlbox/htmlbox.syntax.js" type="text/javascript"></script>
	<script language="Javascript" src="/public/htmlbox/xhtml.js" type="text/javascript"></script>
	<script language="Javascript" src="/public/htmlbox/htmlbox.min.js" type="text/javascript"></script>
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
                    	<a href=__URL__/login title="登录" target="_self"><?php echo ($user); ?></a>
                        <span>|</span>
                    	<a href=__URL__/newuser title="注册" target="_self">注册</a>
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

			<h3 class='title myCorner' data-corner='top 5px'>内容管理</h3>
			<div class="active" id="sidebar" data-csnow="2" data-class3="0" data-jsok="2">
           
            <dl class="list-none navnow"><dt id='part2_4'><a href=__URL__/admin_content  title='通知公告' class="zm" onclick="change1()"><span>通知公告</span></a></dt></dl>
            <dl class="list-none navnow"><dt id='part2_5'><a href=__URL__/xinwenzhongxin  title='新闻中心' class="zm" onclick="change2()"><span>新闻中心</span></a></dt></dl>
            <dl class="list-none navnow"><dt id='part2_6'><a href=__URL__/jiajiaoxinde  title='家教心得' class="zm" onclick="change3()"><span>家教心得</span></a></dt></dl>
            <dl class="list-none navnow"><dt id='part2_7'><a href=__URL__/fabuwenzhang  title='发布文章' class="zm" onclick="change4()"><span>发布文章</span></a></dt></dl>
  <dl class="list-none navnow"><dt id='part2_8'><a href=__URL__/jiajiaojianzhixinxi  title='家教兼职信息' class="zm" onclick="change5()"><span>家教兼职信息</span></a></dt></dl>     
            <dl class="list-none navnow"><dt id='part2_9'><a href=__URL__/ziliaoshangchuan  title='资料上传' class="zm" onclick="change6()"><span>资料上传</span></a></dt></dl>
            <div class="clear"></div></div>
			<div class="active editor">
            中心简介、成果展示、家教须知<br />
			三部分内容请在“发布文章”中修改，新文章发布后会自动覆盖原有文章。
			<div class="clear"></div>
            </div>
    </div>
    
    
    <div class="sb_box" id="box1" style="display:none">
	    <h3 class="title">
			<span>通知公告</span>
		</h3>
		<div class="clear"></div>
        	<form style="margin:50px auto">
        	<table id="worklist" cellspacing="0" cellpadding="0">
              <tr class="worklist_root">
                <td>标题</td>
                <td>链接</td>
                <td>发布时间</td>
                <td>点击数</td>
                <td>操作</td>
              </tr>
              
              
              
              <tr>
                <td>我是新闻标题</td>
                <td>http://www.iAmTheLink.com</td>
                <td>2012-12-12</td>
                <td>100</td>
                <td><button>删除</button></td>
              </tr>
              <tr>
                <td>我是新闻标题</td>
                <td>http://www.iAmTheLink.com</td>
                <td>2012-12-12</td>
                <td>100</td>
                <td><button>删除</button></td>
              </tr>
              <tr>
                <td>我是新闻标题</td>
                <td>http://www.iAmTheLink.com</td>
                <td>2012-12-12</td>
                <td>100</td>
                <td><button>删除</button></td>
              </tr>              
            </table>
            </form>        
	</div>
    
    
    
    <div class="sb_box" id="box2" style="display:block">
	    <h3 class="title">
			<span>新闻中心</span>
		</h3>
		<div class="clear"></div>
        	<form style="margin:50px auto">
        	<table id="worklist" cellspacing="0" cellpadding="0">
                 <tr class="worklist_root">
                <td>标题</td>
                <td>前台查看</td>
                <td>发布时间</td>
                <td>点击数</td>
                <td>操作</td>
              </tr>
              
              
             <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($vo["title"]); ?></td>
                <td><a href=__URL__/readnews?id=<?php echo ($vo["id"]); ?>>__URL__/readnews?id=<?php echo ($vo["id"]); ?></a></td>
                <td><?php echo ($vo["date"]); ?></td>
                <td><?php echo ($vo["count"]); ?></td>
                <td><a href=__URL__/deletenews?id=<?php echo ($vo["id"]); ?>>删除</a></td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>              
            </table>
            </form>        
	</div>
    
    
    
    
    <div class="sb_box" id="box3" style="display:none">
	    <h3 class="title">
			<span>家教心得</span>
		</h3>
        	<form style="margin:50px auto">
        	<table id="worklist" cellspacing="0" cellpadding="0">
              <tr class="worklist_root">
                <td>标题</td>
                <td>链接</td>
                <td>发布时间</td>
                <td>点击数</td>
                <td>操作</td>
              </tr>
              
              
              
              <tr>
                <td>我是新闻标题</td>
                <td>http://www.iAmTheLink.com</td>
                <td>2012-12-12</td>
                <td>100</td>
                <td><button>删除</button></td>
              </tr>
              <tr>
                <td>我是新闻标题</td>
                <td>http://www.iAmTheLink.com</td>
                <td>2012-12-12</td>
                <td>100</td>
                <td><button>删除</button></td>
              </tr>
              <tr>
                <td>我是新闻标题</td>
                <td>http://www.iAmTheLink.com</td>
                <td>2012-12-12</td>
                <td>100</td>
                <td><button>删除</button></td>
              </tr>              
            </table>
            </form>        
	</div>







    <div class="sb_box" id="box4" style="display:none">
	    <h3 class="title">
			<span>发布文章</span>
		</h3>
		<div class="clear"></div>
        <form style="margin:20px 10px">
        	发布板块：<select><option>通知公告</option><option>新闻中心</option><option>家教心得</option><option>中心简介</option><option>成果展示</option><option>家教须知</option></select>
            标题：<input type="text" />
            <div class="clear"></div>
            <br />
            <div style="height:700px">
            <textarea id='ha'></textarea>
            <script language="Javascript" type="text/javascript">
            $("#ha").css("height","100%").css("width","100%").htmlbox({
                toolbars:[
                    [
                    // Cut, Copy, Paste
                    "separator","cut","copy","paste",
                    // Undo, Redo
                    "separator","undo","redo",
                    // Bold, Italic, Underline, Strikethrough, Sup, Sub
                    "separator","bold","italic","underline","strike","sup","sub",
                    // Left, Right, Center, Justify
                    "separator","justify","left","center","right",
                    // Ordered List, Unordered List, Indent, Outdent
                    "separator","ol","ul","indent","outdent",
                    // Hyperlink, Remove Hyperlink, Image
                    "separator","link","unlink","image"
                    
                    ],
                    [// Show code
                    "separator","code",
                    // Formats, Font size, Font family, Font color, Font, Background
                    "separator","formats","fontsize","fontfamily",
                    "separator","fontcolor","highlight",
                    ],
                    [
                    //Strip tags
                    "separator","removeformat","striptags","hr","paragraph",
                    // Styles, Source code syntax buttons
                    "separator","quote","styles","syntax"
                    ]
                ],
                skin:"blue"
            });
            </script>
            </div>
            <br />
            <button id="unitPassword_sub" style="margin-left:300px">发布</button>
        </form>
	</div>








    <div class="sb_box" id="box5" style="display:none">
	    <h3 class="title">
			<span>家教兼职信息</span>
		</h3>
        
        <form style="margin:20px 0 0 50px">
	        <h2>添加信息</h2>
        	<ul>
            	<li>年级：<input type="text" /></li>
            	<li>性别：<input type="text" /></li>
            	<li>住址：<input type="text" /></li>
            	<li>科目：<input type="text" /></li>
            	<li>需求：<input type="text" /></li>                
            </ul>
            <button id="unitPassword_sub" style="margin-bottom:0">添加</button>
        </form>
        	<form style="margin:30px auto">
        	<table id="worklist" cellspacing="0" cellpadding="0">
              <tr class="worklist_root">
                <td>编号</td>
                <td>年级</td>
                <td>性别</td>
                <td>住址</td>
                <td>科目</td>
                <td>需求</td>
                <td>操作</td>
              </tr>
              <tr>
              	<td>00001</td>
              	<td>高三</td>
              	<td>男</td>
              	<td>太乙i路</td>
              	<td>数学</td>
              	<td>不知道</td>
                <td><button>删除</button></td>
              </tr>
              <tr>
              	<td>00001</td>
              	<td>高三</td>
              	<td>男</td>
              	<td>太乙i路</td>
              	<td>数学</td>
              	<td>不知道</td>
                <td><button>删除</button></td>
              </tr>
              <tr>
              	<td>00001</td>
              	<td>高三</td>
              	<td>男</td>
              	<td>太乙i路</td>
              	<td>数学</td>
              	<td>不知道</td>
                <td><button>删除</button></td>
              </tr>
              <tr>
              	<td>00001</td>
              	<td>高三</td>
              	<td>男</td>
              	<td>太乙i路</td>
              	<td>数学</td>
              	<td>不知道</td>
                <td><button>删除</button></td>
              </tr>
              <tr>
              	<td>00001</td>
              	<td>高三</td>
              	<td>男</td>
              	<td>太乙i路</td>
              	<td>数学</td>
              	<td>不知道</td>
                <td><button>删除</button></td>
              </tr>
              <tr>
              	<td>00001</td>
              	<td>高三</td>
              	<td>男</td>
              	<td>太乙i路</td>
              	<td>数学</td>
              	<td>不知道</td>
                <td><button>删除</button></td>
              </tr>
              <tr>
              	<td>00001</td>
              	<td>高三</td>
              	<td>男</td>
              	<td>太乙i路</td>
              	<td>数学</td>
              	<td>不知道</td>
                <td><button>删除</button></td>
              </tr>
              <tr>
              	<td>00001</td>
              	<td>高三</td>
              	<td>男</td>
              	<td>太乙i路</td>
              	<td>数学</td>
              	<td>不知道</td>
                <td><button>删除</button></td>
              </tr>
              <tr>
              	<td>00001</td>
              	<td>高三</td>
              	<td>男</td>
              	<td>太乙i路</td>
              	<td>数学</td>
              	<td>不知道</td>
                <td><button>删除</button></td>
              </tr>
              <tr>
              	<td>00001</td>
              	<td>高三</td>
              	<td>男</td>
              	<td>太乙i路</td>
              	<td>数学</td>
              	<td>不知道</td>
                <td><button>删除</button></td>
              </tr>
            </table>
            </form>        
	</div>






    <div class="sb_box" id="box6" style="display:none">
	    <h3 class="title">
			<span>资料上传</span>
		</h3>
        <form style="margin:30px 0 30px 50px">
        	标题：<input type="text" /><br /><br />
            地址：<input name="" type="file" /><br /><br />
            <button id="unitPassword_sub" style="margin-left:50px">上传</button>
        </form>
	</div>






    <div class="sb_box" id="box7" style="display:none">
	    <h3 class="title">
			<span>中心简介</span>
		</h3>
	</div>







    <div class="sb_box" id="box8" style="display:none">
	    <h3 class="title">
			<span>成果展示</span>
		</h3>
	</div>






    <div class="sb_box" id="box9" style="display:none">
	    <h3 class="title">
			<span>家教须知</span>
		</h3>
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