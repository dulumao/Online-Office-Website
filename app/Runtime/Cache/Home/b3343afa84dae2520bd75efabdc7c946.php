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
     
    <div class="sb_box" id="box3" style="display:block">
	    <h3 class="title" align="center">
			<span >员工信息</span>
		</h3>
		<div class="clear"></div>
	    <h2 align="center"><?php echo ($c["name"]); ?></h2>       
        	
        	<table align="center" style="margin-left:160px;"  cellspacing="0" cellpadding="0">
              <tr >
                <td style="width:180px;">姓名</td>                
                <td style="width:180px;">班级</td>
                <td style="width:180px;">性别</td>
				<td style="width:180px;">学号</td>
				<td style="width:180px;">电子邮件</td>
				<td style="width:140px;">电话</td>
                <td style="width:180px;">书院</td>
				<td style="width:180px;">描述</td>                 
			 </tr>        
			      
              
              <tr>
                <td>
                  <?php echo ($c["name"]); ?>                                  		
                </td>
                
                <td><?php echo ($c["class"]); ?></td>
                <td><?php echo ($c["sex"]); ?></td>
				<td><?php echo ($c["sid"]); ?></td>
				<td><?php echo ($c["email"]); ?></td>
				<td><?php echo ($c["mobile"]); ?></td>
                <td><?php echo ($c["shuyuan"]); ?></td>               
                <td><?php echo ($c["des"]); ?></td>  
              </tr>
              
            </table>
            </form>

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