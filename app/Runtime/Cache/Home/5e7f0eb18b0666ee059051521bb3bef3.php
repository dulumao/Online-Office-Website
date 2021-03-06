<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <title>项目申报系统--示范企业申报</title>
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
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png"></head>
    <!--[if lt IE 7 ]>
<body class="ie ie6">
    <![endif]-->
    <!--[if IE 7 ]>
<body class="ie ie7 ">
    <![endif]-->
    <!--[if IE 8 ]>
<body class="ie ie8 ">
    <![endif]-->
    <!--[if IE 9 ]>
<body class="ie ie9 ">
    <![endif]-->
    <!--[if (gt IE 9)|!(IE)]>
    <!-->
<body class="">
    <!--<![endif]-->

    <?php include("public/include/navbar.php") ?>
    <?php include("public/include/left-nav.php") ?>
    <script>
function openNavList(){
  var currentClassName = document.getElementById("2").className;
  document.getElementById("2").className = currentClassName + "in";
}
window.onload = openNavList();
</script>

    <div class="content">

        <div class="header">
            <h1 class="page-title">示范企业申请</h1>
        </div>

        <ul class="breadcrumb">
            <li>
                示范企业申报
                <span class="divider">/</span>
            </li>
            <li class="active">示范企业申请</li>
        </ul>

        <div class="container-fluid">

            <div class="row-fluid"></div>

            <div class="row-fluid">
                <div class="block">
                    <a href="#page-stats" class="block-heading" data-toggle="collapse">示范企业申请</a>
                    <div id="page-stats" class="block-body collapse in">
                        <form action="index.php?m=Unit&a=company_progress" method="post" enctype="multipart/form-data">
                            <div class="well">
                                <h3>企业申请基本信息</h3>
                                <div class="myForm">

                                    <label>示范企业类别：</label>
                                    <select class="input-xlarge" name="level">
                                        <option value="国家级">国家级</option>
                                        <option value="省级">省级</option>
                                        <option value="区县级">区县级</option>
                                    </select>

                                    <label>单位法人代表：</label>
                                    <input type="text" value="<?php echo ($uinfo["unitlaw"]); ?>" class="input-xlarge" readonly="readonly">
                                    <!--此处示范不可更改信息-->
                                    <label>联系人：</label>
                                    <input type="text" value="<?php echo ($uinfo["unitlinker"]); ?>" class="input-xlarge" readonly="readonly">
                                    <label>总资产（元）：</label>
                                    <input type="text" value="<?php echo ($uinfo["unittotalmoney"]); ?>" class="input-xlarge" name="unittotalmoney" >
                                    <label>资金负债率（%）：</label>
                                    <input type="text" value="<?php echo ($uinfo["betmoneyrate"]); ?>" class="input-xlarge" name="betmoneyrate" >
                                    <label>单位地址：</label>
                                    <input type="text" value="<?php echo ($uinfo["unitaddr"]); echo ($uinfo["deatiladdr"]); ?>" class="input-xlarge" readonly="readonly"></div>
                                <div class="myForm">
                                    <label>注册登记类型：</label>
                                    <select class="input-xlarge">
                                        <option value="<?php echo ($uinfo["regkind"]); ?>"><?php echo ($uinfo["regkind"]); ?></option>

                                    </select>
                                    <label>单位联系电话：</label>
                                    <input type="text" value="<?php echo ($uinfo["unittel"]); ?>" class="input-xlarge" readonly="readonly">
                                    <label>上年销售收入（元）：</label>
                                    <input type="text" value="" class="input-xlarge" name="income">
                                    <label>银行信用等级：</label>
                                    <select class="input-xlarge">
                                        <option value="<?php echo ($uinfo["bankcredit"]); ?>"><?php echo ($uinfo["bankcredit"]); ?></option>
                                    </select>
                                    <label>单位邮编：</label>
                                    <input type="text" value="<?php echo ($uinfo["unitpostcode"]); ?>" class="input-xlarge" readonly="readonly"></div>
                                <div class="myForm">
                                    <label>注册资本（元）：</label>
                                    <input type="text" value="<?php echo ($uinfo["regmoney"]); ?>" class="input-xlarge" readonly="readonly">
                                    <label>联系人电话：</label>
                                    <input type="text" value="<?php echo ($uinfo["unitlinkermobile"]); ?>" class="input-xlarge" readonly="readonly">
                                    <label>上年利润（元）：</label>
                                    <input type="text" value="" class="input-xlarge" name="profit">
                                    <label>职工人数：</label>
                                    <input type="text" value="<?php echo ($uinfo["worker"]); ?>" class="input-xlarge" readonly="readonly">
                                    <label>上年税金（元）：</label>
                                    <input type="text" value="" class="input-xlarge" name="tax" ></div>
                            </div>
                            <div class="well">
                                <h3>企业自荐信息</h3>
                                <textarea style="width:97%" rows="10" name="self"></textarea>
                            </div>
                            <div class="well">
                                <h3>企业自荐文件</h3>

                                <div id="add_file">
                                    <script>
                    function addFile(){
                        var inputList = document.getElementById('add_file');
                        var divNode = inputList.getElementsByTagName('input');
                        var pageNum = divNode.length;
                        var currentMessage = document.getElementById('add_file').innerHTML;
                        document.getElementById('add_file').innerHTML="<input name=file"+"add"+pageNum+" type='file' />"+"<br />"+currentMessage;
                    }
                    </script>
                                    <a href="javascript:;" onclick="addFile()">再添加一个文件</a>
                                </div>
                                <br />
                                <br />
                                <!-- <input type="submit" class="btn" value="上传文件，进入下一步"/>
                                -->
                                <input class="btn btn-primary" name="submit1" value="提交申请" type="submit"/>
                                <input class="btn" name="submit2" value="存为草稿" type="submit"/>
                                <br>
                                <br></div>
                        </div>
                        <div class="clear"></div>

                    </form>
                </div>
            </div>
        </div>
        <?php include("public/include/footer.php") ?></div>
</div>

<script src="public/lib/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>

</body>
</html>