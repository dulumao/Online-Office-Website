<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <title>项目申报系统--企业用户登陆</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="public/lib/bootstrap/css/bootstrap.css">

    <link rel="stylesheet" type="text/css" href="public/stylesheets/theme.css">
    <link rel="stylesheet" href="public/lib/font-awesome/css/font-awesome.css">

    <script src="public/lib/jquery-1.7.2.min.js" type="text/javascript"></script>

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
</head>

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

    <div class="row-fluid">
        <div class="dialog">
            <div class="block">
                <p class="block-heading">企业用户登陆</p>
                <div class="block-body">
                    <form class="logIn" action="index.php?m=Unit&a=sign_in" method="post">
                        <label>用户名：</label>
                        <input type="text" class="span12" name="u" value="<?php echo ($u); ?>"  />
                        <label>密码</label>
                        <input type="password" class="span12" name="p" value="<?php echo ($p); ?>"/>
                        <label>验证码：</label>
                        <input type="text" class="span6" name="verify"/>

                        <button type="submit" class="keyImgButton"><img src="index.php?m=Unit&a=verify" class="keyImg" /></button>
                        <div class="clear"></div>

                        <input name="登陆" type="submit"  class="btn btn-primary pull-right" value="登录">
                        

                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
            <p class="pull-right" style="">
                <a href="index.php?m=Unit&a=sign_up" target="blank">用户注册</a>
            </p>
            <p>
                <a href="index.php?m=Unit&a=reset_password" target="blank">忘记密码？</a>
            </p>
        </div>
    </div>
    <script src="public/lib/bootstrap/js/bootstrap.js"></script>

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