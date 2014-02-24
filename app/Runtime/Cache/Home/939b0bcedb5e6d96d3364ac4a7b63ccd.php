<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html public/admin "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <title>回复在线留言</title>
  <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="stylesheet" type="text/css" href="public/admin/lib/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="public/admin/stylesheets/theme.css">
  <link rel="stylesheet" href="public/admin/lib/font-awesome/css/font-awesome.css">
  <script src="public/admin/lib/jquery-1.7.2.min.js" type="text/javascript"></script>
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

  <style>
  form {
    margin: 0;
  }
  textarea {
    display: block;
  }
</style>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

  <?php include("public/admin/include/navbar.php") ?>
  <?php include("public/admin/include/left-nav.php") ?>

  <div class="content">

    <div class="header">
      <h1 class="page-title">回复在线留言</h1>
    </div>

    <div class="container-fluid">
      <?php if(is_array($li)): $i = 0; $__LIST__ = $li;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><div class="row-fluid">
          <div class="well">
            <form action="index.php?m=Admin&a=reply" method="post" enctype="multipart/form-data">
              <p>留言标题:<?php echo ($li["title"]); ?></p>
              <p>留言内容:<?php echo ($li["content"]); ?></p>

              <label>回复标题:</label>
              <input name="title" />
              <label>回复内容:</label>
              <textarea name="content" class="span7"></textarea>
              <input name='id' value="<?php echo ($li["id"]); ?>" type="hidden"/>
              <div class="clear"></div>
              <input class="btn" type="submit" value="编辑完成发布"/>
            </br>
          </br>

        </form>
      </div>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>
  <?php include("public/admin/include/footer.php") ?></div>
</div>
<script src="public/admin/lib/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>

</body>
</html>