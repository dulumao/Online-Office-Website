<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <title>项目申报系统--企业用户注册</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="public/lib/bootstrap/css/bootstrap.css">
    
    <link rel="stylesheet" type="text/css" href="public/stylesheets/theme.css">
    <link rel="stylesheet" href="public/lib/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="public/stylesheets/sign-up.css">
    
    <script src="public/lib/jquery-1.7.2.min.js" type="text/javascript"></script>
    <script src="public/lib/sign-up.js" type="text/javascript"></script>
    

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

    

    
        <div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading">企业用户注册</p>
            <div class="block-body">
                <form id="formID" class="formular" method="post" action="index.php?m=Unit&a=sign_up">                       
                    <label>单位名称(用户名)</label>
                    <input value="" class="span12 validate[required] text-input" type="text" name="unitname" />
                    <label>密码</label>
            	    <input value="" class="span12 validate[required] text-input" type="password" name="password" id="password" />
                    <label>密码确认</label>
           		    <input value="" class="span12 validate[required,equals[password]] text-input" type="password" name="repassword" id="password" />             
                    <label>电子邮件</label>
                    <input value="" class="span12 validate[required,custom[email]] text-input" type="text" name="linkermail" id="email" />                    <label>单位地址</label>
                    <select style="float:left; width:120px;" name="unitaddr" class="span12 validate[required]">
                    	<option></option>
						 <?php if(is_array($addrlist)): $i = 0; $__LIST__ = $addrlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voaddr): $mod = ($i % 2 );++$i;?><option value="<?php echo ($voaddr["region_name"]); ?>"><?php echo ($voaddr["region_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>              
                    <input style="float:left; width:250px;" value="" class="span12 validate[required] text-input" type="text" name="detailaddr" />
                    <label>职工人数（人）</label>
                    <input value="" class="span12 validate[custom[onlyNumberSp]] validate[required] text-input" type="text" name="worker" />
                    <label>邮编</label>
                    <input value="" class="span12 validate[custom[onlyNumberSp]] validate[required] text-input" type="text" name="unitpostcode" />
					<label>企业办公电话</label>
                    <input value="" class="span12 validate[custom[fax]] validate[required]  text-input" type="text" name="unittel" />
                    <label>法人代表</label>
                    <input value="" class="span12 validate[required] text-input" type="text" name="unitlaw" />
                    <label>联系人姓名</label>
                    <input type="text" class="span12 validate[required] text-input" name="unitlinker">
                    <label>联系人手机</label>
					<input value="" class="span12 validate[custom[phone]] validate[required] text-input" type="text" name="unitlinkermobile" />                    
                    <label>注册登记类型</label>
                    <select  class="span12 validate[required]" name="regkind">
                    	<option></option>
                        <option value="私企">私企</option>
                        <option value="国企">国企</option>
                        <option value="外企">外企</option>
                        <option value="合资企业">合资企业</option>
                    </select>
                    <label>注册资本（万元）</label>
					<input value="" class="span12 validate[custom[number]] validate[required]  text-input" type="text" name="regmoney" />
                    <label>总资产（万元）</label>
					<input value="" class="span12 validate[custom[number]] validate[required]  text-input" type="text" name="unittotalmoney" />
                    <label>资金负债率（%）</label>
					<input value="" class="span12 validate[custom[number]] validate[required]  text-input" type="text" name="betmoneyrate" />
                    <label>银行信用等级</label>
                    <select  class="span12 validate[required]" name="bankcredit">
                    	<option></option>
						<option value="无">无</option>
                        <option value="A">A</option>
                        <option value="AA">AA</option>
                        <option value="AAA">AAA</option>
                        <option value="AAAA">AAAA</option>
                    </select>
                    <label>传真</label>
					<input value="" class="span12 validate[custom[fax]] validate[required]  text-input" type="text" name="fax" />
                    <label>工商注册编号</label>
					<input value="" class="span12 validate[required]  text-input" type="text" name="unitcode" />
                   <!--
				    <label>验证码：</label>
                    <input type="text" class="span6 validate[required]" name="verify">
                    <button class="keyImgButton"><img src="index.php?m=Unit&a=verify" class="keyImg" /></button>
					-->
                    
                    
                 
                    <p>注意：部分注册信息提交后不可更改。</p>
                    <input value="提交" type="submit" class="btn btn-primary pull-right"/>              
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
       
        <p><a href="index.php?m=Unit&a=sign_in">已有账户，直接登陆</a></p>        
    </div>
</div>


    


    <script src="public/lib/bootstrap/js/bootstrap.js"></script>

	<script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#formID").validationEngine('attach');          
		});
	</script>    

<style type="text/css">
.keyImgButton {
    border: none;
    margin-top: -7px;
    padding: 0;
    width: 50px;
    height: 22px;
}
</style>
  </body>
</html>