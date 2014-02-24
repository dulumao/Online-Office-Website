   <?php include("config.php"); ?>
    <div class="navbar" id="navbar">
        <div class="navbar-inner">
                <ul class="nav pull-right">
                    
                    <li id="fat-menu" class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i>区县管理员(<?php echo $_COOKIE['country_name'];?>)
                            <i class="icon-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="index.php?m=Country&a=change_password">修改密码</a></li>
                            <li class="divider"></li>
                            <li><a tabindex="-1" href="index.php?m=Country&a=sign_out">注销登陆</a></li>
                        </ul>
                    </li>
                    
                </ul>
                <a class="brand" href="index.php">
                <span class="first"><?php echo $UNIT_NAME;?></span>
                <span class="second"><?php echo $PRO_NAME;?></span>
                <span class="first" style="font-size:14px">区县管委会</span>
                </a>
        </div>
    </div>
    <div style="height:42px; clear:both"></div>
<style>
#navbar {
	position:fixed;
	width:100%;
}
</style>