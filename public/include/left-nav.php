    <div class="sidebar-nav" id="sidebar-nav">
    	<div id="nav-top"></div>
        <a href="#nav_a" id="nav_a_p" class="nav-header" data-toggle="collapse"><i class="icon-briefcase"></i>项目管理<i class="icon-chevron-up"></i></a>
        <ul id="nav_a" class="nav nav-list collapse">
            <li><a href="index.php?m=Unit&a=index">新项目申报</a></li>
            <li ><a href="index.php?m=Unit&a=project_list">查看项目</a></li>
            <li ><a href="index.php?m=Unit&a=project_temp">草稿箱</a></li>
               
        </ul>

        <a href="#nav_b" id="nav_b_p" class="nav-header" data-toggle="collapse"><i class="icon-thumbs-up"></i>示范企业申报<i class="icon-chevron-up"></i></a>
        <ul id="nav_b" class="nav nav-list collapse">
            <li ><a href="index.php?m=Unit&a=company">示范企业申请</a></li>
            <li ><a href="index.php?m=Unit&a=company_temp">草稿箱</a></li>
            <li ><a href="index.php?m=Unit&a=company_progress">申请进度</a></li>
        </ul>

      

        <a href="#nav_c" id="nav_c_p" class="nav-header" data-toggle="collapse"><i class="icon-group"></i>账户管理<i class="icon-chevron-up"></i></a>
        <ul id="nav_c" class="nav nav-list collapse">
            <li ><a href="index.php?m=Unit&a=change_password">密码修改</a></li>
            <li ><a href="index.php?m=Unit&a=account">账户信息</a></li>
        </ul>

        <a href="index.php?m=Unit&a=message" class="nav-header" ><i class="icon-comment"></i>消息<span class="label label-info"><?php echo $_COOKIE['msg']; ?></span></a>
        <a href="index.php?m=Unit&a=help" class="nav-header" ><i class="icon-question-sign"></i>帮助</a>
	
    </div>
	<style>
	#sidebar-nav {
		position:fixed;
	}
	/*#nav-top {
		padding-top:12px;
		text-align:center;
		height:30px;
		background: #4d5b76;
		background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #4d5b76), color-stop(1, #6c7a95));
		background: -ms-linear-gradient(bottom, #4d5b76, #6c7a95);
		background: -moz-linear-gradient(center bottom, #4d5b76 0%, #6c7a95 100%);
		background: -o-linear-gradient(bottom, #4d5b76, #6c7a95);
		font-size:16px;
		color:#FFF;
		font-weight:bolder;

	}*/
	</style>
