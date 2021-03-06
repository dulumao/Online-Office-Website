<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html public "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <title>项目申报系统</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="public/country/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="public/country/stylesheets/theme.css">
    <link rel="stylesheet" href="public/country/lib/font-awesome/css/font-awesome.css">
    <script src="public/country/lib/jquery-1.7.2.min.js" type="text/javascript"></script>    
	<!--date picker--> 
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
  </head>
  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 
  <body class=""> 
  <!--<![endif]-->
    
<?php include("public/country/include/navbar.php") ?>  <?php include("public/country/include/left-nav.php") ?>    
<script>
function openNavList(){
  var currentClassName = document.getElementById("1").className;
  document.getElementById("1").className = currentClassName + "in";
}
window.onload = openNavList();
</script>
    
    <div class="content">
        
        <div class="header">
            <h1 class="page-title"><?php echo ($info["proname"]); ?></h1>
        </div>


        <div class="container-fluid">

<div class="row-fluid">
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>温馨提醒：</strong> 本页面仅可以查看项目内容，不可修改
    </div>
</div>

<div class="row-fluid">
    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">项目申请信息</a>
        <div id="page-stats" class="block-body collapse in">
        	<div class="well">
            	<h3>项目信息</h3>
            	<ul>
                	<li><span class="li_left span2">项目承担单位名称：</span><?php echo ($uinfo["unitname"]); ?></li>
                    <li><span class="li_left span2">项目建设起止年限：</span><?php echo ($info["start"]); ?>至<?php echo ($info["end"]); ?></li>
                	<li><span class="li_left span2">项目名称：</span><?php echo ($info["proname"]); ?></li>
                    <li><span class="li_left span2">项目类别：</span><?php echo ($info["prokind"]); ?></li>
                </ul>
            </div>
            <div class="well">
            	<h3>项目承担单位基本信息</h3>
                <div class="myForm">
                	<ul>
                    <li><span class="li_left span6">单位法人代表：</span><?php echo ($uinfo["unitlaw"]); ?></li>
                    <li><span class="li_left span6">联系人：</span><?php echo ($uinfo["unitlinker"]); ?></li>
                    <li><span class="li_left span6">总资产（万元）：</span><?php echo ($uinfo["unittotalmoney"]); ?></li>
                    <li><span class="li_left span6">资金负债率（%）：</span><?php echo ($uinfo["betmoneyrate"]); ?>%</li>
                    <li><span class="li_left span6">单位地址：</span><?php echo ($uinfo["unitaddr"]); ?>&nbsp;<?php echo ($uinfo["detailaddr"]); ?></li>
                    </ul>
                </div>
                <div class="myForm">
                	<ul>
                    <li><span class="li_left span7">注册登记类型：</span><?php echo ($uinfo["regkind"]); ?></li>
                    <li><span class="li_left span7">联系人电话：</span><?php echo ($uinfo["unitlinkermobile"]); ?></li>
                    <li><span class="li_left span7">上年销售收入（万元）：</span><?php echo ($info["income"]); ?></li>
                    <li><span class="li_left span7">银行信用等级：</span><?php echo ($uinfo["bankcredit"]); ?></li>
                    <li><span class="li_left span7">单位邮编：</span><?php echo ($uinfo["unitpostcode"]); ?></li>
                    </ul>
                </div>
                <div class="myForm">
                    <ul>
                    <li><span class="li_left span6">注册资本（万元）：</span><?php echo ($uinfo["regmoney"]); ?></li>
                    <li><span class="li_left span6">联系人手机：</span><?php echo ($uinfo["unitlinkermobile"]); ?></li>
                    <li><span class="li_left span6">上年利润（万元）：</span><?php echo ($info["profit"]); ?></li>
                    <li><span class="li_left span6">职工人数：</span><?php echo ($uinfo["worker"]); ?></li>
                    <li><span class="li_left span6">上年税金（万元）：</span><?php echo ($info["tax"]); ?></li>
                    </ul>
                </div>
            </div>
            <div class="well">
            	<h3>项目资金来源</h3>
                <div class="myForm">
                    <ul>
                    <li><span class="li_left span6">项目总投资（万元）：</span><?php echo ($info["totalmoney"]); ?></li>
                    <li><span class="li_left span6">自筹（万元）：</span><?php echo ($info["self"]); ?></li>
                    <li><span class="li_left span6">银行贷款（万元）：</span><?php echo ($info["bankloan"]); ?></li>
                    </ul>
                </div>
                <div class="myForm">
                    <ul>
                    <li><span class="li_left span7">申请专项资金（万元）：</span><?php echo ($info["get"]); ?></li>
                    <li><span class="li_left span7">是否落实：</span><?php echo ($info["gettoornot"]); ?></li>
                    <li><span class="li_left span7">是否落实：</span><?php echo ($info["bankloanornot"]); ?></li>
                    </ul>
                </div>
                <div class="myForm">
                    <ul>
                    <li><span class="li_left span6">申请专项方式：</span><?php echo ($info["claimkind"]); ?></li>
                    </ul>
                </div>
            </div>
			<div class="well">
				 <h3>项目完成后企业一年内预期经济效益</h3>
				 <div class="myForm">
				 	 <ul>
                    <li><span class="li_left span7">销售收入：</span><?php echo ($info["psale"]); ?></li>
                    <li><span class="li_left span7">利润：</span><?php echo ($info["pprofit"]); ?></li>
                    <li><span class="li_left span7">税金：</span><?php echo ($info["ptax"]); ?></li>
                    </ul>
                    
                                       
                </div>
				</div>
            <div class="well">
            	<h3>项目建设内容、特点及典型示范意义</h3>
                <p style="width:97%"><?php echo ($info["prosignificance"]); ?></p>
            </div>            
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="block">
        <a href="#page-stats2" class="block-heading" data-toggle="collapse">项目附件</a>
        <div id="page-stats2" class="block-body collapse in">
        	<div class="well">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>文件名</th>
                     
                      <th>上传时间</th>
                    </tr>
                  </thead>
                  <tbody>
				  	<?php if(is_array($finfo)): $i = 0; $__LIST__ = $finfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$finfo): $mod = ($i % 2 );++$i;?><tr>
                      <td><?php echo ($finfo["nid"]); ?></td>
                      <td><a href="index.php?m=Country&a=getfile&id=<?php echo ($finfo["id"]); ?>&nid=<?php echo ($finfo["nid"]); ?>"><?php echo ($finfo["name"]); ?></a></td>                      
                      <td><?php echo ($finfo["time"]); ?></td>
					   <td>
                          <a href="index.php?m=Country&a=removefile&id=<?php echo ($finfo["id"]); ?>&fid=<?php echo ($finfo["nid"]); ?>"><i class="icon-remove"></i></a>
                      </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>	
                  </tbody>
                 
                </table>                
            </div>
        </div>
    </div>
</div>










<div class="row-fluid">
    <div class="block">
        <a href="#page-stats4" class="block-heading" data-toggle="collapse">上传辖下企业项目申报资料</a>    
        <div id="page-stats4" class="block-body collapse in">
        	<div class="well">
          	 	<form action="index.php?m=Country&a=add_file" method="post" enctype="multipart/form-data">
            		<input name="id" type="hidden" value="<?php echo ($id); ?>" />
                    <div id="add_file">
                    <script>
					function addFile(){
 						var inputList = document.getElementById('add_file');
   						var divNode = inputList.getElementsByTagName('input');
    					var pageNum = divNode.length;
						var currentMessage = document.getElementById('add_file').innerHTML;
						document.getElementById('add_file').innerHTML="<input name=file"+pageNum+" type='file' />"+"<br />"+currentMessage;
					}
					</script>
                    <a href="javascript:;" onclick="addFile()">再添加一个文件</a>
                    </div>
                    <br /><br />
                    <button class="btn">上传文件</button>                    
            	</form>
            </div></div>
     </div>
</div>


<?php include("public/country/include/footer.php") ?>  </div></div>
    


    <script src="public/country/lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>