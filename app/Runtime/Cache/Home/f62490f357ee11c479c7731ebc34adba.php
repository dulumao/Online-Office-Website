<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <title><?php echo ($title); ?></title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="public/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="public/stylesheets/theme.css">
    <link rel="stylesheet" href="public/lib/font-awesome/css/font-awesome.css">
    <script src="public/lib/jquery-1.7.2.min.js" type="text/javascript"></script>    
	<!--date picker--> 
	<?php include("public/include/datepicker.php") ?> 
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
    
<?php include("public/include/navbar.php") ?>        
<?php include("public/include/left-nav.php") ?>    
<script>
function openNavList(){
  var currentClassName = document.getElementById("1").className;
  document.getElementById("1").className = currentClassName + "in";
}
window.onload = openNavList();
</script>
    
    <div class="content">
        
        <div class="header">
            <h1 class="page-title">新项目申报</h1>
        </div>
        
        <ul class="breadcrumb">
            <li>项目管理<span class="divider">/</span></li>
            <li class="active">新项目申报</li>
        </ul>

        <div class="container-fluid">

<div class="row-fluid">
  
    <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>操作提示：</strong>
        <a href="index.php">第一步：保存申请。</a>
        <span class="nbsp"></span>
        <a href="index.php?m=Unit&a=newproject_upload">第二步：上传附件。</a>
        <span class="nbsp"></span>
        <a href="index.php?m=Unit&a=newproject_submit">第三步：提交申请。</a>
    </div>
</div>

<div class="row-fluid">
    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">新项目申报（第一步：保存申请。）</a>
        <div id="page-stats" class="block-body collapse in">
        <form action="index.php?m=Unit&a=newproject_upload" method="post" class="new_project">			
        	<div class="well">
            	<h3>项目信息</h3>
            	<div>
                	<label>项目承担单位名称: <?php echo ($info["unitname"]); ?></label>
                   <input type="hidden" name="pro_kind" value="<?php echo ($pro_kind); ?>"/>
                    <label>项目建设起止年限：</label>
                    <input type="text" id="from" name="start" readonly="readonly" value="" datatype="*" />
 					<span>至</span>
                    <input type="text" id="to" name="end" readonly="readonly" value="" datatype="*" />
                	<label>项目名称:</label>
                    <input type="text" class="input-xlarge" name="proname" value="" datatype="*">
                    <label>项目类别：</label>
                    <select class="input-xlarge" name="prokind">
                      <option value="国家级项目">国家级项目</option>
                      <option value="省级项目">省级项目</option>
					  <option value="区县级项目">区县级项目</option>                      
                	</select>                    
                </div>
            </div>
            <div class="well">
            	<h3>项目承担单位基本信息</h3>
                <div class="myForm">
                    <label>单位法人代表：</label>
                    <input type="text" value="<?php echo ($info["unitlaw"]); ?>" class="input-xlarge" readonly="readonly"><!--此处示范不可更改信息-->
                    <label>联系人：</label>
                    <input type="text" value="<?php echo ($info["unitlinker"]); ?>" class="input-xlarge" name="linker" readonly="readonly">
                    <label>总资产（万元）：</label>
                    <input type="text" value="<?php echo ($info["unittotalmoney"]); ?>" class="input-xlarge" name="unittotalmoney" >
                    <label>资金负债率（%）：</label>
                    <input type="text" value="<?php echo ($info["betmoneyrate"]); ?>" class="input-xlarge" name="betmoneyrate" >
                    <label>单位地址：</label>
                    <input type="text" value="<?php echo ($info["unitaddr"]); ?>&nbsp;<?php echo ($info["detailaddr"]); ?>" class="input-xlarge" readonly="readonly">
                </div>
                <div class="myForm">
                    <label>注册登记类型：</label>
                    <select class="input-xlarge">
                      <option value="<?php echo ($info["regkind"]); ?>"><?php echo ($info["regkind"]); ?></option>                                      
                	</select>
                    <label>联系人电话：</label>
                    <input type="text" value="<?php echo ($info["unitlinkermobile"]); ?>" class="input-xlarge" name="linkertel" readonly="readonly">
                    <label>上年销售收入（万元）：</label>
                    <input type="text" value="" class="input-xlarge" name="income" datatype="n">
                    <label>银行信用等级：</label>
                    <select class="input-xlarge" name="bankcredit">
                      <option value="<?php echo ($info["bankcredit"]); ?>"><?php echo ($info["bankcredit"]); ?></option>
                                         
                	</select>
                    <label>单位邮编：</label>
                    <input type="text" value="<?php echo ($info["unitpostcode"]); ?>" class="input-xlarge" name="unitpostcode" readonly="readonly">                    
                </div>
                <div class="myForm">
                    <label>注册资本（万元）：</label>
                    <input type="text" value="<?php echo ($info["regmoney"]); ?>" class="input-xlarge" readonly="readonly">
                    <!--
					<label>联系人手机：</label>
                    <input type="text" value="" class="input-xlarge">
					-->
                    <label>上年利润（万元）：</label>
                    <input type="text" value="" class="input-xlarge" name="profit" datatype="n">
                    <label>职工人数：</label>
                    <input type="text" value="<?php echo ($info["worker"]); ?>" class="input-xlarge" readonly="readonly">
                    <label>上年税金（万元）：</label>
                    <input type="text" value="" class="input-xlarge" name="tax" datatype="n">                    
                </div>
            </div>
            <div class="well">
            	<h3>项目资金来源</h3>
				
                <div class="myForm">
                    <label>项目总投资（万元）：</label>
                    <input type="text"  class="input-xlarge" name="totalmoney" value="" datatype="n"/>
                    <label>自筹（万元）：</label>
                    <input type="text"  class="input-xlarge" name="self" value="" datatype="n"/>
                    <label>银行贷款（万元）：</label>
                    <input type="text"  class="input-xlarge" name="bankloan" value="" datatype="n"/>
                </div>
                <div class="myForm">
                    <label>申请专项资金（万元）：</label>
                    <input type="text" value="" class="input-xlarge" name="get" datatype="n"/>
                    <label>是否落实：</label>
                    <select class="input-xlarge"  name="gettoornot">
						<option value="是">是</option>
                      <option value="否">否</option>
                                           
                	</select>
                    <label>是否落实：</label>
                    <select class="input-xlarge" name="bankloanornot">
                        <option value="是">是</option>
                      <option value="否">否</option>                     
                	</select>
                </div>
                <div class="myForm">
                    <label>申请专项方式：</label>
					 <select class="input-xlarge" name="claimkind">
                        <option value="贷款贴息">贷款贴息</option>
                      <option value="以奖代补">以奖代补</option>                     
                	</select>
					         
                </div>
				<div class="well">
				 <h3>项目完成后企业一年内预期经济效益</h3>
				 <div class="myForm">
                    <label>销售收入：</label>
                    <input type="text" value="" class="input-xlarge" name="psale" datatype="n" />
                    <!--
					<label>联系人手机：</label>
                    <input type="text" value="" class="input-xlarge">
					-->
                    <label>利润（万元）：</label>
                    <input type="text" value="" class="input-xlarge" name="pprofit" datatype="n" />
                    <label>税金：</label>
                    <input type="text" value="" class="input-xlarge" name="ptax"  datatype="n" />
                                       
                </div>
				</div>
            </div>
            <div class="well">
            	<h3>项目建设内容、特点及典型示范意义</h3>
                <textarea style="width:97%" rows="10" name="prosignificance"  datatype="*"></textarea>
            </div>            

        	<div class="clear"></div>
            <div class="btn-toolbar">
                <input type="submit" class="btn btn-primary" value="保存申请"/><i class="icon-save"></i>
            </div>
			<div class="error11"></div>
		</form>
        </div>
    </div>
</div>
<?php include("public/include/footer.php") ?>                    
            </div></div>
    


    <script src="public/lib/bootstrap/js/bootstrap.js"></script>
	<script src="public/form.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
		
		$(".new_project").Validform();
    </script>
    
  </body>
</html>