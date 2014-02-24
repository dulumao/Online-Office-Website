<div class="sidebar-nav" id="sidebar-nav">
    <div id="nav-top"></div>
	<a  class="nav-header"  href="index.php?m=Admin&a=add_useful">
        <i class="icon-key"></i>
        申报管理
    </a>
    <a href="#nav_a" class="nav-header" data-toggle="collapse" id="nav_a_p"> <i class="icon-ok"></i>
        审批 <i class="icon-chevron-up"></i>
    </a>
    <ul id="nav_a" class="nav nav-list collapse">	
		
		 <li >
            <a href="index.php?m=Admin&a=app_project">
                申报项目
                <span class="label label-info">
                    <?php echo $_COOKIE['pro'];?></span>
            </a>
        </li>
        <li >
            <a href="index.php?m=Admin&a=app_company">
                示范企业
                <span class="label label-info">
                    <?php echo $_COOKIE['model'];?></span>
            </a>
        </li>
       
    </ul>
    <a href="#nav_b" class="nav-header" data-toggle="collapse" id="nav_b_p">
        <i class="icon-search"></i>
        项目查看
        <i class="icon-chevron-up"></i>
    </a>
    <ul id="nav_b" class="nav nav-list collapse">
        <li >
            <a href="index.php?m=Admin&a=project_guess">项目进度查看</a>
        </li>
        <li >
            <a href="index.php?m=Admin&a=project_search">项目查询统计</a>
        </li>
    </ul>

    <a  class="nav-header" href="index.php?m=Admin&a=company_search">
        <i class="icon-eye-open"></i>
        示范企业查询
    </a>

    <a  class="nav-header"  href="index.php?m=Admin&a=change_password">
        <i class="icon-key"></i>
        修改密码
    </a>
    <a href="#nav_c" class="nav-header" data-toggle="collapse" id="nav_c_p">
        <i class="icon-briefcase"></i>
        区县管理部门
        <i class="icon-chevron-up"></i>
    </a>
    <ul id="nav_c" class="nav nav-list collapse">
        <li>
            <a href="index.php?m=Admin&a=admin_list">账户列表</a>
        </li>
        <li >
            <a href="index.php?m=Admin&a=admin_new">新建账户</a>
        </li>
    </ul>
    <a  class="nav-header"  href="index.php?m=Admin&a=user">
        <i class="icon-group"></i>
        审批注册用户
        <span class="label label-info">
            <?php echo $_COOKIE['unit'];?></span>
    </a>
    <a href="index.php?m=Admin&a=message" class="nav-header" >
        <i class="icon-comment"></i>
        消息
        <span class="label label-info">
            <?php echo $_COOKIE['message'];?></span>
    </a>
    <a href="index.php?m=Admin&a=control" class="nav-header" >
        <i class="icon-dashboard"></i>
        功能开关
    </a>

    <a href="#nav_d" class="nav-header" data-toggle="collapse" id="nav_d_p">
        <i class="icon-edit"></i>
        内容管理
        <i class="icon-chevron-up"></i>
    </a>
    <ul id="nav_d" class="nav nav-list collapse">
        <li>
            <a href="index.php?m=Admin&a=add_news">添加公告</a>
        </li>
        <li>
            <a href="index.php?m=Admin&a=add_file">添加文件</a>
        </li>
        <li>
            <a href="index.php?m=Admin&a=reply">回复留言</a>
        </li>
        <li>
            <a href="index.php?m=Admin&a=del_news">删除信息</a>
        </li>
    </ul>
    <a href="index.php?m=Admin&a=help" class="nav-header" >
        <i class="icon-question-sign"></i>
        帮助
    </a>
	<a href="index.php?m=Admin&a=set_mail" class="nav-header" >
        <i class="icon-question-sign"></i>
        设置密码找回邮箱
    </a>
    <a href="#nav_e" class="nav-header" data-toggle="collapse" id="nav_e_p">
        <i class="icon-external-link"></i>
        数据库与日志
        <i class="icon-chevron-up"></i>
    </a>
    <ul id="nav_e" class="nav nav-list collapse">
        <li>
            <a href="index.php?m=Admin&a=log_export">日志查看导出</a>
        </li>
        <li>
            <a href="index.php?m=Admin&a=copy_sql">备份数据库</a>
        </li>
    </ul>
</div>