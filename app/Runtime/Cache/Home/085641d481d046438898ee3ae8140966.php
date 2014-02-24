<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html public/admin "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <title>后台管理系统--审批注册用户</title>
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

  <?php include("public/admin/include/navbar.php") ?>
  <?php include("public/admin/include/left-nav.php") ?>

  <div class="content">

    <div class="header">
      <h1 class="page-title">审批注册用户</h1>
    </div>

    <div class="container-fluid">

      <div class="row-fluid">
        <div class="block">
          <a href="#page-stats" class="block-heading" data-toggle="collapse">新注册用户</a>
          <div id="page-stats" class="block-body collapse in">
            <table class="table">
              <thead>
                <tr>
                  <th>单位名称</th>
                  <th>法人代表</th>
                  <th>工商注册编号</th>
                  <th>联系人姓名</th>
                  <th>联系人手机</th>
                  <th>注册时间</th>
                  <th style="width: 100px;"></th>
                </tr>
              </thead>
              <tbody>
                <?php if(is_array($l1)): $i = 0; $__LIST__ = $l1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l1): $mod = ($i % 2 );++$i;?><tr>
                    <td>
                      <a href="index.php?m=Admin&a=com&id=<?php echo ($l1["id"]); ?>"><?php echo ($l1["unitname"]); ?></a>
                    </td>
                    <td><?php echo ($l1["unitlaw"]); ?></td>
                    <td><?php echo ($l1["unitcode"]); ?></td>
                    <td><?php echo ($l1["unitlinker"]); ?></td>
                    <td><?php echo ($l1["unitlinkermobile"]); ?></td>
                    <td><?php echo ($l1["time"]); ?></td>
                    <td>
                      <a href="index.php?m=Admin&a=Unit&action=del&id=<?php echo ($l1["id"]); ?>" role="button" data-toggle="modal">
                        <span class="icon-remove">删除</span>
                      </a>
                      <a href="index.php?m=Admin&a=Unit&action=pass&id=<?php echo ($l1["id"]); ?>">通过</a>
                    </td>
                  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="row-fluid">
        <div class="block">
          <a href="#page-stats" class="block-heading" data-toggle="collapse">已经通过审核的用户</a>
          <div id="page-stats" class="block-body collapse in">
            <table class="table">
              <thead>
                <tr>
                  <th>单位名称</th>
                  <th>法人代表</th>
                  <th>工商注册编号</th>
                  <th>联系人姓名</th>
                  <th>联系人手机</th>
                  <th>注册时间</th>
                  <th style="width: 100px;"></th>
                </tr>
              </thead>
              <tbody>
                <?php if(is_array($l2)): $i = 0; $__LIST__ = $l2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l2): $mod = ($i % 2 );++$i;?><tr>
                    <td>
                      <a href="index.php?m=Admin&a=com&id=<?php echo ($l2["id"]); ?>"><?php echo ($l2["unitname"]); ?></a>
                    </td>
                    <td><?php echo ($l2["unitlaw"]); ?></td>
                    <td><?php echo ($l2["unitcode"]); ?></td>
                    <td><?php echo ($l2["unitlinker"]); ?></td>
                    <td><?php echo ($l2["unitlinkermobile"]); ?></td>
                    <td><?php echo ($l2["time"]); ?></td>
                    <td>
                      <a href="index.php?m=Admin&a=Unit&action=del&id=<?php echo ($l2["id"]); ?>" role="button" data-toggle="modal">
                        <span class="icon-remove">删除</span>
                      </a>

                    </td>
                  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
              </tbody>
            </table>
            <a class="btn btn-primary" href="index.php?m=Admin&a=getexcel_user"> <i class="icon-save"></i>
              账户信息为导出EXCEL
            </a>
            <br>
            <br></div>

        </div>
      </div>
    </div>

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