<?php

class AdminAction extends Action {
   public function add_useful()
   {
   		if($_POST['start']!="" && $_POST['end']!="" && $_POST['name']!="")
		{
			$a=M('provide');
			$a->create();$a->state="开启";
			$a->add();
		}
		//读出可以申报的项目
		$a=M('provide');$b=$a->select();
		for($i=0;$i<count($b);$i++)
		{
			$b[$i]['pid']=$i+1;
		}
		$this->assign('li',$b);
   		$this->display();
   }	
   public function set_mail()
   {
   	//设置密码找回邮箱
		if($_POST['u']!="" && $_POST['p']!="")
		{
			$a=M('mail');$a->create();$a->save();
		}
		$a=M('mail');$b=$a->select();$this->assign('l1',$b);
		$this->display();
   }
   public function reverse()
   {
   		$a=M('provide');
		$data['id']=$_GET['id'];
		$b=$a->where('id='.$_GET['id'])->select();
		$data['state']=$b[0]['state']=="开启"?"关闭":"开启";
		$a->save($data);
		redirect("index.php?m=Admin&a=add_useful",0,"");
   }
   public function delete()
   {
   		$a=M('provide');$a->where('id='.$_GET['id'])->delete();
		redirect("index.php?m=Admin&a=add_useful",0,"");
   }
   public function sign_in()
	{
		//在这个里面，需要做好把几个数字读出来的准备
		$a=M('model');$b=$a->select();
		$model=0;
		foreach($b as $c)
		{
			if($c['state']=="提交待审核")
			{
				$model=$model+1;
			}
		}
		setcookie('model',$model,time()+8*3600); //记录示范企业申请数目
		//
		$a=M('pro');$b=$a->select();
		$pro=0;$yanshou=0;
		foreach($b as $c)
		{
			if($c['state']=="提交待审核")
			{
				$pro=$pro+1;
			}
			if($c['state']=="申请验收")
			{
				$yanshou=$yanshou+1;
			}
		}
		setcookie('pro',$pro,time()+8*3600); //记录示范企业申请数
		//
		$a=M('message');$b=$a->select();
		$message=0;
		foreach($b as $c)
		{
			if($c['state']=="已送达" && $c['to']=="超级管理员")
			{
				$message=$message+1;
			}
		}
		setcookie('message',$message,time()+8*3600); //记录示范企业申请数
		//注册用户的审批
		$a=M('unit');$b=$a->select();
		$unit=0;
		foreach($b as $c)
		{
			if($c['state']=="待审")
			{
				$unit=$unit+1;
			}
		}
		setcookie('unit',$unit,time()+8*3600); //记录示范企业申请数
		//新的申请验收
		setcookie('yanshou',$yanshou,time()+8*3600); //记录示范企业申请数
		
		///
		
		if(isset($_POST['u']) && isset($_POST['p']) && empty($_POST['verify'])) //验证码空的提交,视为刷新页面的验证码
		{
			$this->u=$_POST['u'];$this->p=$_POST['p'];
			$this->display();
			return;
		}
		
		if(isset($_POST['u']) && isset($_POST['p']) && isset($_POST['verify']))
		{		
			if($_SESSION['verify'] != md5($_POST['verify']))
			{
				$this->error_1('验证码错误');
			}
			
			$a=M('root');$b=$a->select();
			$flag=0;$id=0;
			foreach($b as $c)
			{
				if($c['username']==$_POST['u'] && $c['password']==$_POST['p'])
				{
					$flag=1;					
					$id=$c['id'];
					break;
				}
			}
			if($flag)
			{
				setcookie("sys_role_admin","admin",time()+8*3600);
				setcookie("root_id",$id,time()+8*3600);	
				$this->log("登录成功");			
				redirect("index.php?m=Admin&a=index",0,"");
			}
			else
			{
				$this->log("登录失败");
				$this->error_1('用户名或者密码错误');				
			}
		}
		$this->display();
	}
	
	
	public function verify()
	{
		import("ORG.Util.Image");
		Image::buildImageVerify();
	}
	public function check_log()
	{
		return isset($_COOKIE['sys_role_admin'])?1:0;
	}
   public function index()
   {
   		
		if($this->check_log()==1)
		{
			redirect("index.php?m=Admin&a=app_project",0,"");
			return;
		}
		else
		{
			redirect("index.php?m=Admin&a=sign_in",0,"");
			return;
		}
   }

   public function sign_out()
   {
   		setcookie("sys_role_admin","",0);
		$this->log("安全退出系统");
		redirect("index.php?m=Admin&a=sign_in",0,"");
   }
   public function change_password()
   {
   		$this->check_id();
   		$this->style="block";
		$this->notify="请输入正确的原始密码和新密码";
		if(isset($_POST['o'])&& isset($_POST['n1']) && isset($_POST['n2']) )
		{
			$a=M('root');$b=$a->where('id='.$_COOKIE['root_id'])->select();
			if($_POST['n1']!=$_POST['n2'] )
			{
				$this->notify="两次密码不一致";
				$this->display();
				return;
			}
			if($_POST['n1']=="" || $_POST['n2']=="")
			{
				$this->notify="新密码不允许为空";
				$this->display();
				return;
			}
			if($_POST['o']==$b[0]['password'] )
			{
				$data['id']=$_COOKIE['root_id'];
				$data['password']=$_POST['n1'];
				$a=M('root');
				$a->save($data);
				$this->notify="密码更改成功，下次登录使用新密码";
				$this->log("更改了密码");
			}
			else
			{
				$this->notify="原始密码错误，请重新输入";
			}
		}			
   		$this->display();
   }
   public function app_project()
   {
   		//先查看是否有数据传
   		$this->check_id();
   		$a=M('pro');$b=$a->select();
		$li=$b;
		for($i=0;$i<count($li);$i=$i+1)
		{
			$a=M('unit');$b=$a->where('id='.$li[$i]['claimid'])->select();
			$li[$i]['unit']=$b[0]['unitname'];
			$li[$i]['uid']=$b[0]['id'];
			$li[$i]['idd']=$i+1;
			$li[$i]['recornot']=$li[$i]['reccomend']=="1"?"是":"否";
			//在增加是否支持的选择
			$li[$i]['s1']="selected='selected'";
			$li[$i]['s2']="selected='selected'";
			if($li[$i]['support']=="是")
			{
				$li[$i]['s2']="";
			}
			else
			{
				$li[$i]['s1']="";
			}
			
		}
		
		//对项目进行分项列出,这尼玛真是恶心。。
		
		$a=M('provide');$provide=$a->select();
		for($i=0;$i<count($provide);$i++)
		{
			$m=1;
			for($j=0;$j<count($li);$j++)
			{
				if($provide[$i]['id']==$li[$j]['pro_kind'])
				{
					$li[$j]['idd']=$m;$m++;
					$provide[$i]['content'][]=$li[$j];
				}
			}
			
		}
		$b=$provide;
		$provide=array();
		foreach($b as $c)
		{
			if(empty($c['content']))continue;
			$provide[]=$c;
		}
		
		
		$this->assign('li',$provide);
		//dump($provide);die();
		$this->log("查看了待审核的项目");
   		$this->display();
   }
   public function com()
   {
   		$this->check_id();
   		//从数据库中读出本单位的信息
		$a=M('unit');$b=$a->where('id='.$_GET['id'])->select();
		$this->assign("info",$b[0]);
		$this->log("查看了一个企业信息");
		$this->display();
   }
   public function app_change_state()
   {
   		$this->check_id();
   		if(isset($_GET['id']))
		{
			if(isset($_GET['action']) && $_GET['action']=="del")
			{
				//删除项目
				$a=M('pro');$a->where('id='.$_GET['id'])->delete();
				$this->log("删除了一个项目信息");
			}			
		}
		
		if(isset($_POST['id']))
		{
			if(isset($_POST['pifu']) && isset($_POST['state']))
			{
				//dump($_POST);die();
				//修改状态
				$data['id']=$_GET['id'];
				$data['state']=$_POST['state'];
				$data['pifu']=$_POST['pifu'];
				$data['time_pass']=date('Y-m-d');
				$a=M('pro');$a->save($data);
				$this->log("审批了项目");
			}
		}
   		redirect("index.php?m=Admin&a=app_project",0,"");
   }
  
  
   public function app_project_content()
   {
   		$this->check_id();
   		//查看项目的信息，只读出并且显示即可
		if(!isset($_GET['id']) || !is_numeric($_GET['id']))
		{
			$this->error_1("非法调用本函数,不要乱来，谢谢！");
			return;
		}
		//读出信息并且显示
		$a=M('pro');$b=$a->where('id='.$_GET['id'])->select();
		$this->assign('info',$b[0]);
		$unitid=$b[0]['claimid'];
		//构造出文件表的信息
		$finfo=array();
		$n=$b[0]['total_file'];
		for($i=1;$i<=9;$i=$i+1)
		{
			if($b[0]['file'.$i]!="")
			{
				$ff=$b[0]['file'.$i];//文件信息字符串
				$gg=explode('|',$ff);
				$finfo[]=array("id"=>$_GET['id'],"nid"=>$i,"name"=>$gg[0],"time"=>$gg[2]);
			}	
		}
		$this->assign('finfo',$finfo);
		//读出公司的信息
		$a=M('unit');$b=$a->where('id='.$unitid)->select();
		$this->assign('uinfo',$b[0]);
		//读出项目进度报告列表
		$a=M('pro');$b=$a->where('id='.$_GET['id'])->select();
		$total=$b[0]['report_total'];//获得现有的文件数目
		$total=$total==""?0:$total;//字符串向数字的转换
		//然后，从report1_9中找到不是空的进行显示输出
		$li=array();
		$i=1;
		for($i=1;$i<=9;$i=$i+1)
		{
			if($b[0]['report'.$i]!="")//说明存有文件信息
			{
				$c=explode('|',$b[0]['report'.$i]);
				$li[]=array('id'=>$_GET['id'],'fid'=>$i,'name'=>$c[0],"fname"=>$c[1],"time"=>$c[2]);
			}
		}
		$this->log("查看了项目具体信息");
		$this->assign('li',$li);	
   		$this->display();
   }
   public function getfile()
	{
		$this->check_id();
		//下载指定的文件
		// $_GET['id'] &_GET['nid']
		if( !isset($_GET['id']) || !isset($_GET['nid'])/* ||　!is_numeric($_GET['id']) || !is_numeric($_GET['nid'])*/ )
		{
			$this->error_1('参数错误');
			return;
		}
		$a=M('pro');$b=$a->where('id='.$_GET['id'])->select();
		$c=$b[0]['file'.$_GET['nid']]; //拼凑出的文件字符串
		$i=explode('|',$c);
		//处理下载过程
		header("Content-type:text/html;charset=utf-8"); 
		// $file_name="cookie.jpg"; 
		$file_name=$i[1]; 
		//dump($i);die();
		//用以解决中文不能显示出来的问题 
		//$file_name=iconv("utf-8","gb2312",$file_name); 
		$file_sub_path=$_SERVER['DOCUMENT_ROOT']."/upload/"; 
		$file_path=$file_sub_path.$file_name; 
		//首先要判断给定的文件存在与否 
		if(!file_exists($file_path)){ 
		$this->error_1("没有该文件文件"); 
		return ; 
		} 
		$fp=fopen($file_path,"r"); 
		$file_size=filesize($file_path); 
		//下载文件需要用到的头 
		Header("Content-type: application/octet-stream"); 
		Header("Accept-Ranges: bytes"); 
		Header("Accept-Length:".$file_size); 
		Header("Content-Disposition: attachment; filename=".$file_name); 
		$buffer=1024; 
		$file_count=0; 
		//向浏览器返回数据 
		while(!feof($fp) && $file_count<$file_size){ 
		$file_con=fread($fp,$buffer); 
		$file_count+=$buffer; 
		echo $file_con; 
		} 
		$this->log("下载了文件an".$file_name);
		fclose($fp); 
	}
	public function unit()
	{
		$this->check_id();
		if(isset($_GET['action']) && $_GET['action']=="del")
		{
			$a=M('unit');$a->where('id='.$_GET['id'])->delete();
		}
		if(isset($_GET['action']) && $_GET['action']=="pass")
		{
			$data['id']=$_GET['id'];$data['state']="通过审核";
			$a=M('unit');$a->save($data);
		}
		redirect("index.php?m=Admin&a=user",0,"");
	}
   public function user()
   {
   		$this->check_id();
   		//主要是拼出两个数组
		$a=M('unit');//
		$b=$a->select();
		$l1=array();$l2=array();
		foreach($b as $c)
		{
			if($c['state']=="待审")
			{
				$l1[]=$c;
			}
			else
			{
				$l2[]=$c;
			}
		}
		$this->assign('l1',$l1);
		$this->assign('l2',$l2);
		$this->log("查看了企业用户列表");
   		$this->display();
   }
   public function message()
	{
		$this->check_id();
		//如果存在消息的发送行为
		if( !empty($_POST['rec']) && isset($_POST['title']) && isset($_POST['content']))
		{
			//拆分出接收人，然后连续的写入到数据表中
			$rec=$_POST['rec'];
			
			foreach($rec as $to)
			{
				$data['fromid']=$_COOKIE['root_id'];
				$data['fromkind']="root";
				$data['from']="超级管理员";
				$data['ipfrom']=$_SERVER['REMOTE_ADDR'];
				$data['time']= date('Y-m-d H:i:s',time());
				$data['state']="已送达";
				$data['title']=$_POST['title'];
				$data['content']=$_POST['content'];
				//拆分数据to
				$info=explode('|',$to);
				$data['tokind']=$info[0];
				$data['to']=$info[1];
				$data['toid']=$info[2];
				if($data['tokind']=="all")
				{
					//发给所有人
					$a=M('message');
					$a->add($data);
					break;
				}
				else
				{
					$a=M('message');
					$a->add($data);
				}
			}
			$this->log("发送了一条消息");
			include('js.php');
			alert("消息发送成功");				
		}		
		$a=M('message');$b=$a->order('id desc')->select();
		$msglist=array();
		foreach($b as $c)
		{
			if( $c['tokind']=="root" && $c['state']=="已送达" )
			{
				$msglist[]=$c;
			}
		}		
		$this->assign("msglist",$msglist);
		$this->log("查看了消息列表");
		$a=M('unit');$b=$a->select();$this->assign('unitlist',$b);
		$a=M('manage');$b=$a->select();$this->assign('countrylist',$b);		
		$this->display();
	}
	public function delmsg()
	{
		$this->check_id();
		if(isset($_GET['id']) && is_numeric($_GET['id']))
		{
			$d=M('message');
			$d->where('id='.$_GET['id'])->delete();
			$this->log("删除了一条信息");
		}
		redirect("index.php?m=Admin&a=message",0,"");		
	}
	public function readmsg()
	{
		if(isset($_GET['id']) && is_numeric($_GET['id']))
		{
			$d=M('message');
			$a=$d->where('id='.$_GET['id'])->select();
			$data=$a[0];
			if( $data['tokind']=="root" )
			{
				$data['state']="已读";
				$d->save($data);
				$this->log("标志信息为已读");
			}
		}
		redirect("index.php?m=Admin&a=message",0,"");	
	}
	public function admin_new()
	{
		$this->check_id();
		if(isset($_POST['action']) && $_POST['action']=="add")
		{
			//添加用户
			$a=M('manage');
			$a->create();
			$a->state="启用";
			$a->time=date('Y-m-d');
			$a->add();
			//提示成功
			$this->log("添加了新的区县管理员账户");
			include('js.php');
			alert('新的区县管理员账户添加成功');
			//然后跳到list页面
			redirect("index.php?m=Admin&a=admin_list",0,"");	
		}
		//首先把所有的地名联系起来
		$a=M('city');$b=$a->select();
		$this->assign('city',$b);
		//然后再显示
		$this->display();
	}
	public function admin_list()
	{
		$this->check_id();
		if(isset($_POST['id']))
		{
			$a=M('manage');	
			$data=$a->create();
			$a->save($data);
			$this->log("更改了一个区县管理员账户信息");
			include('js.php');
			alert('区县管理员账户信息更改成功');
		}
		$a=M('manage');$b=$a->select();
		for($i=0;$i<count($b);$i++)
		{
			$b[$i]['pid']=$i+1;
		}
		$this->assign('li',$b);
		$this->display();
	}
	public function delm()
	{
		$this->check_id();
		$this->log("删除了一个区县管理员账户信息");
		$a=M('manage');
		$a->where('id='.$_GET['id'])->delete();
		
		redirect("index.php?m=Admin&a=admin_list",0,"");	
	}
	public function admin_change()
	{
	
		$this->check_id();
		if(!isset($_GET['id']))
		{	
			redirect("index.php?m=Admin&a=admin_list",0,"");	
			return;
		}
		$a=M('manage');$b=$a->where('id='.$_GET['id'])->select();
		$this->assign('li',$b[0]);
		$city=$b[0]['region'];
		//
		$a=M('city');$b=$a->select();
		$b[count($b)]['region_name']=$city;
		//然后对数组b进行反转
		$b=array_reverse($b);
		//
		$this->assign('c',$b);
		$this->display();
	}
	public function project_search()
	{
		$this->check_id();
		$a=M('unit');$b=$a->select();
		$this->assign('ui',$b);
		//地域信息的显示
		$a=M('city');$b=$a->select();
		$this->assign('ci',$b);
		//
		//状态选择
		$a=M('pro');$b=$a->select();
		$s=array();
		foreach($b as $c)
		{
			$s[]=$c['state'];
		}
		//剔除相同的值
		array_unique($s);
		$this->assign('s',$s);
		
		$this->display();
	}
	public function project_search_list()
	{
		$this->check_id();
		//来到这个地方就不再做数据校验了
		/*
			一共有这么几个条件
			$_POST['unit']  限制公司
			$_POST['place'] 限制地域
			$_POST['state'] 限制状态
			$_POST['prokind'] 限制项目类别
			$_POST['start'] 限制起始年份
			$_POST['end'] 限制项目结束年份
			$_POST['totalmoney'] 项目总投资			
		*/
		//下面，对项目进行排查
		$a=M('pro');
		$b=$a->select();//选中所有的
		$i1=array();
		//根据公司筛选第一遍
		if($_POST['unit']=="无")
		{
			$i1=$b;
		}
		else
		{
			foreach($b as $c)
			{
				if($c['claimid']==$_POST['unit'])
				{
					$i1[]=$c;//选中
				}
			}
		}
		//根据限制地域选择第二遍
		$i2=array();
		if($_POST['place']=="无")
		{
			$i2=$i1;
		}
		else
		{
			foreach($i1 as $c)
			{
				if($c['unitaddr']==$_POST['place'])
				{
					$i2[]=$c;
				}
			}
		}
		//根据状态筛选第三遍
		$i3=array();
		if($_POST['state']=="无")
		{
			$i3=$i2;
		}
		else
		{
			foreach($i2 as $c)
			{
				if($c['state']==$_POST['state'])
				{
					$i3[]=$c;
				}
			}
		}
		//根据类别筛选第四遍
		$i4=array();
		if($_POST['prokind']=="无")
		{
			$i4=$i3;
		}
		else
		{
			foreach($i3 as $c)
			{
				if($c['state']==$_POST['state'])
				{
					$i4[]=$c;
				}
			}
		}
		//根据起始年份筛选一遍
		$i5=array();
		if($_POST['start']="无")
		{
			$i5=$i4;
		}
		else
		{
			foreach($i4 as $c)
			{
				$st=explode('-',$c['start']);
				if(in_array($_POST['start'],$st))
				{
					$i5[]=$c;
				}
			}
		}
		//根据结束年份筛选一遍
		$i6=array();
		if($_POST['end']="无")
		{
			$i6=$i5;
		}
		else
		{
			foreach($i5 as $c)
			{
				$st=explode('-',$c['end']);
				if(in_array($_POST['end'],$st))
				{
					$i6[]=$c;
				}
			}
		}
		//项目总投资筛选一遍
		$i7=array();
		if($_POST['totalmoney']=="无")
		{
			$i7=$i6;
		}
		else
		{
			//首先把投资这一块的 货币符号去掉
			//可能出现的 , 分隔符
			$i=explode('-',$_POST['totalmoney']);
			$des_total_low=str_replace(array(','),'',$i[0]);
			$des_total_high=str_replace(array(','),'',$i[1]);
			foreach($i6 as $c)
			{
				if($c['totalmoney']>=$des_total_low && $c['totalmoney']<=$des_total_high)
				{
					$i7[]=$c;
				}
			}			
		}
		//从claimid中得到对应的承建单位
		$i=0;
		$total_all=0;
		$total_self=0;
		$total_bankloan=0;
		
		for($i=0;$i<count($i7);$i=$i+1)
		{
			$a=M('unit');
			$b=$a->where('id='.$i7[$i]['claimid'])->select();
			$i7[$i]['unit']=$b[0]['unitname'];
			$i7[$i]['idd']=$i+1;
			//累加相关的数值
			$total_all=$total_all+str_replace(array(','),'',$i7[$i]['totalmoney']);
			$total_self=$total_self+str_replace(array(','),'',$i7[$i]['self']);
			$total_get=$total_get+str_replace(array(','),'',$i7[$i]['get']);
			$total_bankloan=$total_bankloan+str_replace(array(','),'',$i7[$i]['bankloan']);
		}
		//筛选完毕，进行赋值
		$this->assign('li',$i7);
		//对条件进行赋值
		//$this->unit=$_POST['unit'];
		//$this->place=$_POST['place'];
		//$this->state=$_POST['state'];
		//$this->prokind=$_POST['prokind'];
		//$this->start=$_POST['start'];
		//$this->end=$_POST['end'];
		//$this->totalmoney=$_POST['totalmoney'];
		
		//进行一些必要的统计,到处成excel文件
		//进行一些必要的统计,到处成excel文件
		require_once 'PHPExcel-1.7.7/Classes/PHPExcel.php';
		$fn1=time().".xlsx";
		$fn="excel/".$fn1;
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		//设置宽和高度
		$objActSheet = $objPHPExcel->getActiveSheet();  
		$objActSheet->setTitle('项目统计查询汇总结果'); 
		$objActSheet->getColumnDimension('A')->setWidth(10); 
		$objActSheet->getColumnDimension('B')->setWidth(30);  
		$objActSheet->getColumnDimension('C')->setWidth(30);  
		$objActSheet->getColumnDimension('D')->setWidth(30);  
		$objActSheet->getColumnDimension('E')->setWidth(30);  
		$objActSheet->getColumnDimension('F')->setWidth(30);  
		$objActSheet->getColumnDimension('G')->setWidth(30);  
		$objActSheet->getColumnDimension('H')->setWidth(30);  
		$objActSheet->getColumnDimension('I')->setWidth(30);  
		$objActSheet->getColumnDimension('J')->setWidth(30);  
		$objActSheet->getColumnDimension('K')->setWidth(30);  
		$objActSheet->getColumnDimension('L')->setWidth(30);  
		$objActSheet->getColumnDimension('M')->setWidth(30);  
		$objActSheet->getColumnDimension('N')->setWidth(30);  
		$objActSheet->getColumnDimension('O')->setWidth(30);  
		$objActSheet->getColumnDimension('P')->setWidth(30);  
		$objActSheet->getColumnDimension('Q')->setWidth(30); 
		$objActSheet->getColumnDimension('R')->setWidth(30); 
		$objActSheet->getColumnDimension('S')->setWidth(30); 
		$objActSheet->getColumnDimension('T')->setWidth(30); 
		$objActSheet->getColumnDimension('U')->setWidth(30); 
		$objActSheet->getColumnDimension('V')->setWidth(30);  
		 
		//设置表头
		$objPHPExcel->getActiveSheet()->setCellValue('A1', "项目编号");
		$objPHPExcel->getActiveSheet()->setCellValue('B1', "企业名称");
		$objPHPExcel->getActiveSheet()->setCellValue('C1', "项目名称");
		$objPHPExcel->getActiveSheet()->setCellValue('D1', "项目简介");
		$objPHPExcel->getActiveSheet()->setCellValue('E1', "项目起止年限");
		$objPHPExcel->getActiveSheet()->setCellValue('F1', "所属区县");
		$objPHPExcel->getActiveSheet()->setCellValue('G1', "总资产");
		$objPHPExcel->getActiveSheet()->setCellValue('H1', "项目总投资");
		$objPHPExcel->getActiveSheet()->setCellValue('I1', "贷款");
		$objPHPExcel->getActiveSheet()->setCellValue('G1', "自筹");
		$objPHPExcel->getActiveSheet()->setCellValue('K1', "预期销售收入");
		$objPHPExcel->getActiveSheet()->setCellValue('L1', "预期利润");
		$objPHPExcel->getActiveSheet()->setCellValue('M1', "预期税金");
		$objPHPExcel->getActiveSheet()->setCellValue('N1', "上年销售收入");
		$objPHPExcel->getActiveSheet()->setCellValue('O1', "上年利润");
		$objPHPExcel->getActiveSheet()->setCellValue('P1', "上年税金");
		$objPHPExcel->getActiveSheet()->setCellValue('Q1', "补助");
		$objPHPExcel->getActiveSheet()->setCellValue('R1', "贴息");
		$objPHPExcel->getActiveSheet()->setCellValue('S1', "补助支持");
		$objPHPExcel->getActiveSheet()->setCellValue('T1', "贴息支持");
		$objPHPExcel->getActiveSheet()->setCellValue('U1', "联系人姓名");
		$objPHPExcel->getActiveSheet()->setCellValue('V1', "联系人电话");
		//$objPHPExcel->getActiveSheet()->setCellValue('Q1', "最新进度报告时间");
		
		$i=2;//
		foreach($i7 as $c)
		{
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $c['idd']); //编号
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $c['unit']); //企业名称
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $c['proname']); //项目名称
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $c['prosignificance']); //项目简介
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $c['start']."至".$c['end']);//起止年限
			$a=M('unit');$b=$a->where('id='.$c['claimid'])->select();
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $b[0]['unitaddr']);//所属区县
			
			$name=$b[0]['unitlinker'];
			$tel=$b[0]['unitlinkermobile'];
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $b[0]['unittotalmoney']);//总资产
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $c['totalmoney']); //项目总投资
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $c['bankloan']);//贷款
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $c['self']);//自筹
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$i, $c['psale']);//预期销售收入
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$i, $c['pprofit']);//预期利润
			$objPHPExcel->getActiveSheet()->setCellValue('M'.$i, $c['ptax']);//预期税金
			$objPHPExcel->getActiveSheet()->setCellValue('N'.$i, $c['sale']);//上年销售收入
			$objPHPExcel->getActiveSheet()->setCellValue('O'.$i, $c['profit']);//上年利润
			$objPHPExcel->getActiveSheet()->setCellValue('P'.$i, $c['tax']);//上年税金
			$z=0;$zz=0;
			if($c['claimkind']=="贷款贴息")
			{
				$zz=$c['get'];
			}
			else
			{
				$z=$c['get'];
			}			
			$objPHPExcel->getActiveSheet()->setCellValue('Q'.$i, $z);//补助
			$objPHPExcel->getActiveSheet()->setCellValue('R'.$i, $zz);//贴息
			
			$z=0;$zz=0;
			if($c['claimkind']=="贷款贴息")
			{
				$zz=$c['support_money']."万";
			}
			else
			{
				$z=$c['support_money']."万";
			}	
			$objPHPExcel->getActiveSheet()->setCellValue('S'.$i, $z);//补助支持
			$objPHPExcel->getActiveSheet()->setCellValue('T'.$i, $zz);//贴息支持
			$objPHPExcel->getActiveSheet()->setCellValue('U'.$i, $name);//联系人姓名
			$objPHPExcel->getActiveSheet()->setCellValue('V'.$i, $tel);//联系人电话			
			
			
			
			$i=$i+1;
		}
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save($fn);
		//文件写入成功
		//现在将文件信息存入到数据表中
		$a=M('excel');
		$data['fn']=$fn1;
		$a->add($data);
		//立刻查找该文件
		$b=$a->order('id desc')->select();		
		$this->id=$b[0]['id'];//存储excel文件的数据表
		//显示输出	
		$this->total=$total_all;
		$this->bankloan=$total_bankloan;
		$this->self=$total_self;
		$this->get=$total_get;
		$this->log("进行了一次项目的统计查查询");
		$this->display();
	}
	public function getexcel() //下载生成的文件
	{
		$this->check_id();
		if( !isset($_GET['id']))
		{
			$this->error_1('参数错误');
			return;
		}
		$a=M('excel');$b=$a->where('id='.$_GET['id'])->select();		
		//处理下载过程
		header("Content-type:text/html;charset=utf-8"); 
		// $file_name="cookie.jpg"; 
		$file_name=$b[0]['fn'];; 
		//dump($i);die();
		//用以解决中文不能显示出来的问题 
		//$file_name=iconv("utf-8","gb2312",$file_name); 
		$file_sub_path=$_SERVER['DOCUMENT_ROOT']."/excel/"; 
		$file_path=$file_sub_path.$file_name; 
		//首先要判断给定的文件存在与否 
		if(!file_exists($file_path)){ 
		$this->error_1("没有该文件文件"); 
		return ; 
		} 
		$fp=fopen($file_path,"r"); 
		$file_size=filesize($file_path); 
		//下载文件需要用到的头 
		Header("Content-type: application/octet-stream"); 
		Header("Accept-Ranges: bytes"); 
		Header("Accept-Length:".$file_size); 
		Header("Content-Disposition: attachment; filename=".$file_name); 
		$buffer=1024; 
		$file_count=0; 
		//向浏览器返回数据 
		while(!feof($fp) && $file_count<$file_size){ 
		$file_con=fread($fp,$buffer); 
		$file_count+=$buffer; 
		echo $file_con; 
		} 
		$this->log("下载了文件".$file_name);
		fclose($fp); 	
	}	
 	public function getexcel_admin()
	{
		$this->check_id();
		$a=M('manage');$i7=$a->select();
		require_once 'PHPExcel-1.7.7/Classes/PHPExcel.php';
		$fn1=time().".xlsx";
		$fn="excel/".$fn1;
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		//设置宽和高度
		$objActSheet = $objPHPExcel->getActiveSheet();  
		$objActSheet->setTitle('区县管委会帐号'); 
		$objActSheet->getColumnDimension('A')->setWidth(10); 
		$objActSheet->getColumnDimension('B')->setWidth(30);  
		$objActSheet->getColumnDimension('C')->setWidth(30);  
		$objActSheet->getColumnDimension('D')->setWidth(30);  
		$objActSheet->getColumnDimension('E')->setWidth(30);  
	 
		 
		//设置表头
		$objPHPExcel->getActiveSheet()->setCellValue('A1', "用户编号");
		$objPHPExcel->getActiveSheet()->setCellValue('B1', "用户名");
		$objPHPExcel->getActiveSheet()->setCellValue('C1', "用户密码");
		$objPHPExcel->getActiveSheet()->setCellValue('D1', "用户管辖范围");
		$objPHPExcel->getActiveSheet()->setCellValue('E1', "帐号启用时间");		
		//$objPHPExcel->getActiveSheet()->setCellValue('Q1', "最新进度报告时间");
		
		$i=2;//
		foreach($i7 as $c)
		{
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $c['id']);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $c['user_name']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $c['password']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $c['region']);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $c['time']);		
			//$objPHPExcel->getActiveSheet()->setCellValue('Q'.$i, $c['last']);		
			
			$i=$i+1;
		}
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save($fn);
		//文件写入成功
		$this->log("查看并下载了区县管理员账户列表");
		//现在将文件信息存入到数据表中
		$this->get_file_($fn1);
		
	}
	public function get_file_($fn)
	{
		$this->check_id();
		//处理下载过程
		header("Content-type:text/html;charset=utf-8"); 
		// $file_name="cookie.jpg"; 
		$file_name=$fn; 
		//dump($i);die();
		//用以解决中文不能显示出来的问题 
		//$file_name=iconv("utf-8","gb2312",$file_name); 
		$file_sub_path=$_SERVER['DOCUMENT_ROOT']."/excel/"; 
		$file_path=$file_sub_path.$file_name; 
		//首先要判断给定的文件存在与否 
		if(!file_exists($file_path)){ 
		$this->error_1("没有该文件文件"); 
		return ; 
		} 
		$fp=fopen($file_path,"r"); 
		$file_size=filesize($file_path); 
		//下载文件需要用到的头 
		Header("Content-type: application/octet-stream"); 
		Header("Accept-Ranges: bytes"); 
		Header("Accept-Length:".$file_size); 
		Header("Content-Disposition: attachment; filename=".$file_name); 
		$buffer=1024; 
		$file_count=0; 
		//向浏览器返回数据 
		while(!feof($fp) && $file_count<$file_size){ 
		$file_con=fread($fp,$buffer); 
		$file_count+=$buffer; 
		echo $file_con; 
		} 
		$this->log("下载了文件".$file_name);
		fclose($fp); 	
	}
	
	public function getexcel_user()
	{
		$this->check_id();
		$a=M('unit');$i7=$a->select();
		require_once 'PHPExcel-1.7.7/Classes/PHPExcel.php';
		$fn1=time().".xlsx";
		$fn="excel/".$fn1;
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		//设置宽和高度
		$objActSheet = $objPHPExcel->getActiveSheet();  
		$objActSheet->setTitle('企业用户列表'); 
		$objActSheet->getColumnDimension('A')->setWidth(10); 
		$objActSheet->getColumnDimension('B')->setWidth(30);  
		$objActSheet->getColumnDimension('C')->setWidth(30);  
		$objActSheet->getColumnDimension('D')->setWidth(30);  
		$objActSheet->getColumnDimension('E')->setWidth(30); 
		$objActSheet->getColumnDimension('E')->setWidth(30);  
		$objActSheet->getColumnDimension('E')->setWidth(30);  
		$objActSheet->getColumnDimension('E')->setWidth(30);  
		$objActSheet->getColumnDimension('E')->setWidth(30);  
		$objActSheet->getColumnDimension('E')->setWidth(30);  
		$objActSheet->getColumnDimension('E')->setWidth(30);  
		$objActSheet->getColumnDimension('E')->setWidth(30);  
		$objActSheet->getColumnDimension('E')->setWidth(30);  
		$objActSheet->getColumnDimension('E')->setWidth(30);  
		$objActSheet->getColumnDimension('E')->setWidth(30);  
		$objActSheet->getColumnDimension('E')->setWidth(30);  
		$objActSheet->getColumnDimension('E')->setWidth(30);  
		$objActSheet->getColumnDimension('E')->setWidth(30);  
		$objActSheet->getColumnDimension('E')->setWidth(30);  
		$objActSheet->getColumnDimension('E')->setWidth(30);  
		 
	 
		 
		//设置表头
		$objPHPExcel->getActiveSheet()->setCellValue('A1', "企业编号");
		$objPHPExcel->getActiveSheet()->setCellValue('B1', "企业名");
		$objPHPExcel->getActiveSheet()->setCellValue('C1', "登录密码");
		$objPHPExcel->getActiveSheet()->setCellValue('D1', "企业联系人");
		$objPHPExcel->getActiveSheet()->setCellValue('E1', "联系人电话");
		$objPHPExcel->getActiveSheet()->setCellValue('F1', "企业办公电话");
		$objPHPExcel->getActiveSheet()->setCellValue('G1', "注册类型");
		$objPHPExcel->getActiveSheet()->setCellValue('H1', "注册资金");
		$objPHPExcel->getActiveSheet()->setCellValue('I1', "企业地址");
		$objPHPExcel->getActiveSheet()->setCellValue('J1', "邮编");
		$objPHPExcel->getActiveSheet()->setCellValue('K1', "总资产");
		$objPHPExcel->getActiveSheet()->setCellValue('L1', "资产负债率");
		$objPHPExcel->getActiveSheet()->setCellValue('M1', "银行信贷等级");
		$objPHPExcel->getActiveSheet()->setCellValue('N1', "职工人数");
		$objPHPExcel->getActiveSheet()->setCellValue('O1', "传真");
		$objPHPExcel->getActiveSheet()->setCellValue('P1', "企业工商注册编号");
		$objPHPExcel->getActiveSheet()->setCellValue('Q1', "联系人邮箱");
		$objPHPExcel->getActiveSheet()->setCellValue('R1', "注册时间");
		$objPHPExcel->getActiveSheet()->setCellValue('S1', "当前状态");			
	
		
		$i=2;//
		foreach($i7 as $c)
		{
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $c['id']);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $c['unitname']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $c['password']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $c['unitlinker']);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $c['unitlinkermobile']);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $c['unittel']);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $c['regkind']);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $c['regmoney']);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $c['unitaddr'].$c['detailaddr']);			
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, $c['unitpostcode']);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$i, $c['totalmoney']);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$i, $c['betmoneyrate']);
			$objPHPExcel->getActiveSheet()->setCellValue('M'.$i, $c['bankcredit']);
			$objPHPExcel->getActiveSheet()->setCellValue('N'.$i, $c['worker']);
			$objPHPExcel->getActiveSheet()->setCellValue('O'.$i, $c['fax']);
			$objPHPExcel->getActiveSheet()->setCellValue('P'.$i, $c['unitcode']);
			$objPHPExcel->getActiveSheet()->setCellValue('Q'.$i, $c['linkermail']);
			$objPHPExcel->getActiveSheet()->setCellValue('R'.$i, $c['time']);
			$objPHPExcel->getActiveSheet()->setCellValue('S'.$i, $c['state']);	
			
			$i=$i+1;
		}
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save($fn);
		//文件写入成功
		$this->log("查看并导出了企业用户表格");
		//现在将文件信息存入到数据表中
		$this->get_file_($fn1);	
	}
   
  public function company_search()
	{
		$this->check_id();
		$a=M('city');$b=$a->select();
		$this->assign('city',$b);		
		
		$this->display();
	}
	public function company_search_list()
	{
		$this->check_id();
		//year place state
		$a=M('model');$b=$a->select();
		//根据年份进行排查
		$i1=array();
		foreach($b as $c)
		{
			if($_POST['year']=="无")
			{
				$i1=$b;
			}
			else
			{
				$t=explode('-',$c['time_send']);
				if(in_array($_POST['year'],$t))
				{
					$i1[]=$c;
				}
			}
		}
		//根据地域排查第二遍
		$i2=array();
		foreach($i1 as $c)
		{
			if($_POST['place']=="无")
			{
				$i2=$i1;
			}
			else
			{
				if($_POST['place']==$c['unitaddr'])
				{
					$i2[]=$c;
				}
			}
		}
		//根据状态排查第三遍
		$i3=array();
		foreach($i2 as $c)
		{
			if($_POST['state']=="无")
			{
				$i3 = $i2;
			}
			else
			{
				if($_POST['state']==$c['state'])
				{
					$i3[]=$c;
				}				
			}
		}
		//根据项目类别再排除一遍
		$i4=array();
		foreach($i3 as $c)
		{
			if($_POST['level']=="无")
			{
				$i4=$i3;
			}
			else
			{
				if($_POST['level']==$c['level'])
				{
					$i4[]=$c;
				}
			}
		}
		//重赋值
		$i3=$i4;		
		//对输出数组进行处理，加上编号等等
		for($i=0;$i<count($i3);$i=$i+1)
		{
			//获得申请单位的名称
			$a=M('unit');$b=$a->where('id='.$i3[$i]['claimid'])->select();
			$i3[$i]['idd']=$i+1;
			$i3[$i]['unit']=$b[0]['unitname'];
			
			$i3[$i]['unitid']=$b[0]['id'];
			
			$i3[$i]['law']=$b[0]['unitlaw'];
			$i3[$i]['unitcode']=$b[0]['unitcode'];
			$i3[$i]['unitlinkermobile']=$b[0]['unitlinkermobile'];
			$i3[$i]['unitaddr']=$b[0]['unitaddr'].$b[0]['detailaddr'];				
		}
		//将这些信息输出到excel文件中
		require_once 'PHPExcel-1.7.7/Classes/PHPExcel.php';
		$fn1=time().".xlsx";
		$fn="excel/".$fn1;
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		//设置宽和高度
		$objActSheet = $objPHPExcel->getActiveSheet();  
		$objActSheet->setTitle('项目统计查询汇总结果'); 
		$objActSheet->getColumnDimension('A')->setWidth(10); 
		$objActSheet->getColumnDimension('B')->setWidth(30);  
		$objActSheet->getColumnDimension('C')->setWidth(30);  
		$objActSheet->getColumnDimension('D')->setWidth(30);  
		$objActSheet->getColumnDimension('E')->setWidth(30);  
		$objActSheet->getColumnDimension('F')->setWidth(30);  
		$objActSheet->getColumnDimension('G')->setWidth(30);  
		$objActSheet->getColumnDimension('H')->setWidth(30);  
		$objActSheet->getColumnDimension('I')->setWidth(30);  
		$objActSheet->getColumnDimension('J')->setWidth(30);  
		 
		 
		//设置表头
		$objPHPExcel->getActiveSheet()->setCellValue('A1', "编号");
		$objPHPExcel->getActiveSheet()->setCellValue('B1', "企业名称");
		$objPHPExcel->getActiveSheet()->setCellValue('C1', "申报时间");
		$objPHPExcel->getActiveSheet()->setCellValue('D1', "企业地址");
		$objPHPExcel->getActiveSheet()->setCellValue('E1', "企业工商编号");
		$objPHPExcel->getActiveSheet()->setCellValue('F1', "企业法人");
		$objPHPExcel->getActiveSheet()->setCellValue('G1', "企业联系方式");
		$objPHPExcel->getActiveSheet()->setCellValue('H1', "公司上年缴税");
		$objPHPExcel->getActiveSheet()->setCellValue('I1', "公司上年收入");
		$objPHPExcel->getActiveSheet()->setCellValue('J1', "公司上年利润");
		
		
		$i=2;//
		foreach($i3 as $c)
		{
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $c['idd']);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $c['unit']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $c['time_send']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $c['unitaddr']);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $c['unitcode']);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $c['law']);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $c['unitlinkermobile']);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $c['tax']);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $c['income']);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, $c['profit']);				
			
			$i=$i+1;
		}
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save($fn);
		//文件写入成功
		//现在将文件信息存入到数据表中
		$a=M('excel');
		$data['fn']=$fn1;
		$a->add($data);
		//立刻查找该文件
		$b=$a->order('id desc')->select();		
		$this->id=$b[0]['id'];//存储excel文件的数据id
		$this->assign('li',$i3);
		$this->log("进行了一次示范企业的统计查询");
		$this->display();
	}
	
	public function getf()
	{
		$this->check_id();
		$a=M('pro');$b=$a->where('id='.$_GET['id'])->select();
		$fn=$b[0]['report'.$_GET['fid']];
		$b=explode('|',$fn);
		header("Content-type:text/html;charset=utf-8"); 
		// $file_name="cookie.jpg"; 
		$file_name=$b[1]; 
		//dump($i);die();
		//用以解决中文不能显示出来的问题 
		//$file_name=iconv("utf-8","gb2312",$file_name); 
		$file_sub_path=$_SERVER['DOCUMENT_ROOT']."/upload/"; 
		$file_path=$file_sub_path.$file_name; 
		//首先要判断给定的文件存在与否 
		if(!file_exists($file_path)){ 
		$this->error_1("没有该文件文件"); 
		return ; 
		} 
		$fp=fopen($file_path,"r"); 
		$file_size=filesize($file_path); 
		//下载文件需要用到的头 
		Header("Content-type: application/octet-stream"); 
		Header("Accept-Ranges: bytes"); 
		Header("Accept-Length:".$file_size); 
		Header("Content-Disposition: attachment; filename=".$file_name); 
		$buffer=1024; 
		$file_count=0; 
		//向浏览器返回数据 
		while(!feof($fp) && $file_count<$file_size){ 
		$file_con=fread($fp,$buffer); 
		$file_count+=$buffer; 
		echo $file_con; 
		} 
		$this->log("下载了文件".$file_name);
		fclose($fp); 	//
		
	}
	public function removef()
	{
		//删除指定的项目报告
		if(!isset($_GET['id']) || !isset($_GET['fid']))
		{
			$this->log("出现异常行为");
			$this->error_1("函数调用错误");
			return;
		}
		else
		{
			$a=M('pro');$b=$a->where('id='.$_GET['id'])->select();
			$info=$b[0];
			$info['report_total']=$info['total_report']-1;//文件数目少1
			$info['report'.$_GET['fid']]="";//对应的条目置空
			$a->save($info);
			//跳回原来的页面
			$this->log("删除了一个项目进度报告文件");
			redirect("index.php?m=Admin&a=app_project_report&id=".$_GET['id'],0,"");	
		}
	}
  
   public function app_company()
   {
   		$this->check_id();
   		$a=M('model');
		$b=$a->select();
		$li=$b;
	
		for($i=0;$i<count($li);$i=$i+1)
		{
			$a=M('unit');$b=$a->where('id='.$li[$i]['claimid'])->select();
			$li[$i]['unit']=$b[0]['unitname'];
			$li[$i]['recornot']=($li[$i]['reccomend']=="1")?"是":"否";
			$li[$i]['pid']=$i+1; //修正项目编号的问题
		}
		$this->log("查看了示范企业申请列表");
		$this->assign('l1',$li);
   		$this->display();
   }
  public function company_content()
	{
		$this->check_id();
		//显示示范企业申请信息
		$a=M('model');$b=$a->where('id='.$_GET['id'])->select();
		$this->assign('cinfo',$b[0]);
		$a=M('unit');$c=$a->where('id='.$b[0]['claimid'])->select();
		$this->assign('uinfo',$c[0]);
		//最后是文件列表信息
		$finfo=array();
		for($i=1;$i<=9;$i=$i+1)
		{
			if($b[0]['file'.$i]!="")
			{
				$ii=explode('|',$b[0]['file'.$i]);
				$finfo[]=array('id'=>$_GET['id'],"fid"=>$i,"name"=>$ii[0],"time"=>$ii[2]);
			}
		}
		$this->log("查看了示范企业申请信息");
		$this->assign('finfo',$finfo);
		$this->display();
	}	
   public function dd()
   {
   		$this->check_id();
		if(isset($_GET['id']) && isset($_GET['action']))
		{
			if($_GET['action']=="del")
			{
				$a=M('model');$a->where('id='.$_GET['id'])->delete();
				$this->log("删除了一次示范企业申请");
			}
		}
		redirect("index.php?m=Admin&a=app_company",0,"");	
   }
   
   public function control()
   {
   		$this->check_id();
   		if(isset($_POST['action']) && $_POST['action']=="modify")
		{
			$a=M('pri');
			$a->create();
			$a->id=1;
			$a->save();
		}
		$a=M('pri');$b=$a->where('id=1')->select();
		$pri=$b[0];
		//
		$p['ucs']=$pri['unit_c_search']=="1"?"开":"关";
		$p['ups']=$pri['unit_p_search']=="1"?"开":"关";
		$p['ucc']=$pri['unit_c_claim']=="1"?"开":"关";
		$p['upc']=$pri['unit_p_claim']=="1"?"开":"关";
		$p['ucsu']=$pri['unit_c_signup']=="1"?"开":"关";
		$p['ucsi']=$pri['unit_c_signin']=="1"?"开":"关";
		$p['asi']=$pri['admin_signin']=="1"?"开":"关";
		$p['aac']=$pri['admin_add_c']=="1"?"开":"关";
		$p['aap']=$pri['admin_add_p']=="1"?"开":"关";
		$p['acs']=$pri['admin_c_search']=="1"?"开":"关";
		$p['aps']=$pri['admin_p_search']=="1"?"开":"关";
		$this->assign('p',$p);
		$this->log("查看了系统当前权限分布");
   		$this->display();
   }
   public function dec()
	{
		$this->check_id();
		if(isset($_GET['id']) && isset($_GET['state'])&& isset($_GET['pifu']))
		{
			$a=M('pro');
			$data['id']=$_GET['id'];
			$data['state']=$_GET['state'];
			$data['pifu']=$_GET['pifu'];
			$data['time_pass']=date('Y-m-d');
			$data['nosee']="0";
			$a->save($data);
			
		}
		redirect("index.php?m=Admin&a=app_project",0,"");
		
	}
	 public function dec_nosee()
	{
		$this->check_id();
		if(isset($_GET['id']) && isset($_GET['state'])&& isset($_GET['pifu']))
		{
			$a=M('pro');
			$data['id']=$_GET['id'];
			$data['state']=$_GET['state'];
			$data['pifu']=$_GET['pifu'];
			$data['time_pass']=date('Y-m-d');
			$data['nosee']="1";
			
			$b=$a->where('id='.$_GET['id'])->select();
			if($b[0]['nosee']!="1")
			{			
				$data['nosee_state']=$b[0]['state'];
				$data['nosee_pifu']=$b[0]['pifu'];
			}
			$a->save($data);
			
		}
		redirect("index.php?m=Admin&a=app_project",0,"");
		
	}
	
	 public function yanshou()
	{
		$this->check_id();
		if(isset($_GET['id']) && isset($_GET['state'])&& isset($_GET['pifu']))
		{
			$a=M('pro');
			$data['id']=$_GET['id'];
			$data['state']=$_GET['state'];
			$data['yanshou_pifu']=$_GET['pifu'];
			if($_GET['state']=="验收完成")
			{
				$data['yanshoutonggshijian']=date('Y-m-d'); //验收通过时间
			}
			else
			{
				$data['yanshoushibaishijian']=date('Y-m-d'); //验收失败时间
			}	
			$a->save($data);
			$this->log("处理了一次验收申请");
		}
		redirect("index.php?m=Admin&a=app_project",0,"");
		
	}
	
	
	public function rec()
	{
		$this->check_id();
		if(isset($_GET['id']) && isset($_GET['state'])&& isset($_GET['pifu']))
		{
			$a=M('model');
			$data['id']=$_GET['id'];
			$data['state']=$_GET['state'];
			$data['time_back']=date('Y-m-d');
			$data['back_reason']=$_GET['pifu'];
			$data['nosee']="0";
			$this->log("处理了一次项目申报");
			$a->save($data);			
			
		}
		redirect("index.php?m=Admin&a=app_company",0,"");
	}
   	public function rec_nosee()
	{
		$this->check_id();
		if(isset($_GET['id']) && isset($_GET['state'])&& isset($_GET['pifu']))
		{
			$a=M('model');
			$data['id']=$_GET['id'];
			$data['state']=$_GET['state'];
			$data['time_back']=date('Y-m-d');
			$data['back_reason']=$_GET['pifu'];
			$data['nosee']="1";
			
			$b=$a->where('id='.$_GET['id'])->select();
			if($b[0]['nosee']!="1")
			{
				$data['nosee_state']=$b[0]['state'];
				$data['nosee_pifu']=$b[0]['pifu'];
			}
			$this->log("处理了一次项目申报");
			$a->save($data);			
		}
		redirect("index.php?m=Admin&a=app_company",0,"");
	}
	
   public function help()
   {
   		$this->log("查看帮助文件");
   		$this->display();
   }   
   public function user_account()
   {
   		$this->log("查看了账户信息");
   		$this->display();   
   }
   public function app_yanshou()
   {
   		$this->check_id();
   		$a=M('pro');$b=$a->select();
		$li=array();
		foreach($b as $c)
		{			
			if($c['state']=="申请验收")
			{
				$li[]=$c;
			}
		}
		//为li数组添加更多的信息
		for($i=0;$i<count($li);$i=$i+1)
		{
			$li[$i]['idd']=$i+1;
			$a=M('unit');$b=$a->where('id='.$li[$i]['claimid'])->select();
			$li[$i]['uid']=$b[0]['id'];
			$li[$i]['unit']=$b[0]['unitname'];
		}
		//
		$this->log("查看了待验收项目列表");
		$this->assign('li',$li);
		$this->display();	
   }
   public function log($msg)
	{
		$a=M('log');
		$a->ip=$_SERVER['REMOTE_ADDR'];//ip
		$a->what=$msg;
		$a->time=date('Y-m-d H:i:s',time());
		$a->user_id=$_COOKIE['root_id'];
		$a->user_kind="root";
		$a->add();
	}
	public function log_export()
	{
		$this->check_id();
		$a=M('log');$i3=$a->order('id desc')->select();
		//将这些信息输出到excel文件中
		require_once 'PHPExcel-1.7.7/Classes/PHPExcel.php';
		$fn1=time().".xlsx";
		$fn="excel/".$fn1;
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		//设置宽和高度
		$objActSheet = $objPHPExcel->getActiveSheet();  
		$objActSheet->setTitle('项目统计查询汇总结果'); 
		$objActSheet->getColumnDimension('A')->setWidth(10); 
		$objActSheet->getColumnDimension('B')->setWidth(30);  
		$objActSheet->getColumnDimension('C')->setWidth(30);  
		$objActSheet->getColumnDimension('D')->setWidth(30);  
		$objActSheet->getColumnDimension('E')->setWidth(30);  
		$objActSheet->getColumnDimension('F')->setWidth(30);
		
		 
		 
		//设置表头
		$objPHPExcel->getActiveSheet()->setCellValue('A1', "编号");
		$objPHPExcel->getActiveSheet()->setCellValue('B1', "时间");
		$objPHPExcel->getActiveSheet()->setCellValue('C1', "用户id");
		$objPHPExcel->getActiveSheet()->setCellValue('D1', "事件");
		$objPHPExcel->getActiveSheet()->setCellValue('E1', "主机ip");
		$objPHPExcel->getActiveSheet()->setCellValue('F1', "用户种类");
		
		
		
		$i=2;//
		foreach($i3 as $c)
		{
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $c['id']);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $c['time']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $c['user_id']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $c['what']);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $c['ip']);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $c['user_kind']);		
			$i=$i+1;
		}
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save($fn);
		//文件写入成功
		//现在将文件信息存入到数据表中
		$a=M('excel');
		$data['fn']=$fn1;
		$a->add($data);
		//立刻查找该文件
		$b=$a->order('id desc')->select();		
		//$this->id=$b[0]['id'];//存储excel文件的数据id
		$this->getexcel1($b[0]['id']);
		//$this->assign('li',$i3);
		//$this->log("进行了一次示范企业的统计查询");
		//$this->display();
	}
	public function getexcel1($id) //下载生成的文件
	{
		$this->check_id();
		if($id=="")
		{
			$this->error_1('参数错误');
			return;
		}
		$a=M('excel');$b=$a->where('id='.$id)->select();		
		//处理下载过程
		header("Content-type:text/html;charset=utf-8"); 
		// $file_name="cookie.jpg"; 
		$file_name=$b[0]['fn'];; 
		//dump($i);die();
		//用以解决中文不能显示出来的问题 
		//$file_name=iconv("utf-8","gb2312",$file_name); 
		$file_sub_path=$_SERVER['DOCUMENT_ROOT']."/excel/"; 
		$file_path=$file_sub_path.$file_name; 
		//首先要判断给定的文件存在与否 
		if(!file_exists($file_path)){ 
		$this->error_1("没有该文件文件"); 
		return ; 
		} 
		$fp=fopen($file_path,"r"); 
		$file_size=filesize($file_path); 
		//下载文件需要用到的头 
		Header("Content-type: application/octet-stream"); 
		Header("Accept-Ranges: bytes"); 
		Header("Accept-Length:".$file_size); 
		Header("Content-Disposition: attachment; filename=".$file_name); 
		$buffer=1024; 
		$file_count=0; 
		//向浏览器返回数据 
		while(!feof($fp) && $file_count<$file_size){ 
		$file_con=fread($fp,$buffer); 
		$file_count+=$buffer; 
		echo $file_con; 
		} 
		$this->log("下载了文件".$file_name);
		fclose($fp); 	
	}
	public function copy_sql()
	{
		$this->check_id();
		$this->log("备份了数据库");
		$host="127.0.0.1";//数据库地址
		$dbname="project";//这里配置数据库名
		$username="root";//"root";//用户名
		$passw="";//"";//这里配置密码
		
		$filename=date("Y-m-d_H-i-s")."-".$dbname.".sql";
		
		header("Content-disposition:filename=".$filename);//所保存的文件名
		header("Content-type:application/octetstream");
		header("Pragma:no-cache");
		header("Expires:0");
		//备份数据
		$i   =   0;
		$crlf="\r\n";
		global     $dbconn;
		$dbconn   =   mysql_connect($host,$username,$passw);//数据库主机，用户名，密码
		$db   =   mysql_select_db($dbname,$dbconn);
		mysql_query("SET NAMES 'utf8'");
		$tables =mysql_list_tables($dbname,$dbconn);
		$num_tables   =   @mysql_numrows($tables);
		print   "-- filename=".$filename;
		while($i   <   $num_tables)
		{
		  $table=mysql_tablename($tables,$i);
		  print   $crlf;
		  echo   get_table_structure($dbname,   $table,   $crlf).";$crlf$crlf";
		   //echo   get_table_def($dbname,   $table,   $crlf).";$crlf$crlf";
		  echo   get_table_content($dbname,   $table,   $crlf);
		  $i++;
		 }
	}
	public function error_1($msg)
	{	
		redirect("index.php?m=Admin&a=error_2&msg=".$msg,0,"");	
		return;	
	}
	public function error_2()
	{
		$this->title="出现错误!";
		$this->error_1=$_GET['msg'];
		$this->display();
	}
	public function project_guess()
	{
		$this->check_id();
		$a=M('pro');$b=$a->select();
		$l1=array();
		foreach($b as $c)
		{
			if(in_array($c['state'],array("提交待审核","草稿")))
			{
				continue;
			}
			$l1[]=$c;
		}
		///增加信息
		$all=count($l1);
		for($i=0;$i<$all;$i=$i+1)
		{
			$a=M('unit');$b=$a->where('id='.$l1[$i]['claimid'])->select();
			$l1[$i]['unit']=$b[0]['unitname'];
			
			//获得最新的报告时间以及报告内容
			$g1=explode('|',$l1[$i]['progress']);
			
			$g2=explode('*',$g1[count($g1)-1]);
			
			$l1[$i]['reporttime']=$g2[1];
			$l1[$i]['report']=$g2[0];	
			$l1[$i]['pid']=$i+1;
		}
		
		$this->assign('l1',$l1);
		$this->display();
	}
	public function check_id()
	{
		
		if(isset($_COOKIE['sys_role_admin']) && $_COOKIE['sys_role_admin']=="admin")
		{
			return 0;
		}
		else
		{
			$this->error_1("您还没有登录");	
		}
	}
	
	public function support()
	{
		
		
		$a=M('pro');
		$data['id']=$_GET['id'];
		$data['support']=$_GET['support'];
		$data['support_money']=$_GET['support_money'];
		if($data['support']=="否") $data['support_money']="0";
		
		$a->save($data);
		
		redirect("index.php?m=Admin&a=app_project",0,"");	
	}
	//网站内容管理的部分
	public function add_news()
	{
		if($_POST['title']!="" && $_POST['content']!="")
		{
			$a=M('cms');$a->create();$a->time=date("Y-m-d H:i:s");$a->kind=1;
			$a->add();
			//然后跳转到删除的页面
			redirect("index.php?m=Admin&a=del_news",0,"");
		}
		$this->display();
	}
	public function add_file()
	{
		
		if($_POST['title']!="")
		{
			//这里上传文件
			//将传过来的文件进行保存,并且拼组多个信息
			/*import("ORG.NET.UploadFile");*/include("UploadFile.class.php");
			$upload=new UploadFile();
			$upload->maxSize=100000000;//上传文件大小的限制
			$upload->allowExts=array("rar","zip","jpg","png","gif","doc","docx","ppt","pptx",'pdf','js','xls','xlsx');//允许的文件类型
			$upload->savePath='./upload/';//文件保存的路径
			
			
			
			if(!$upload->upload())
			{
				$this->error_1($upload->getErrorMsg());
				return;
			}
			else
			{
				$info=$upload->getUploadFileInfo();
				include('js.php');
				$a=M('cms');$a->title=cut_str($_POST['title'],10,0);$a->content=$info[0]['savename'];
				$a->time=date("Y-m-d");$a->kind=3;
				$a->add();
			}
			//然后跳转到删除的页面
			redirect("index.php?m=Admin&a=del_news",0,"");
		}
		
		$this->display();
	}
	public function reply()
	{
		if($_POST['title']!="" && $_POST['content']!="")
		{
			
			//需要处理的回复数据
			$a=M('cms');$a->content=$_POST['content'];$a->title=$_POST['title'];$a->time=date("Y-m-d");$a->kind=$_POST['id'];			
			$a->add();
		}
		
		$a=M('cms');$b=$a->where('kind=2')->order('id desc')->select();
		$li=array();
		foreach($b as $c)
		{
			$z=$a->where('kind='.$c['id'])->select();
			if(count($z)==0)
			{
				//表示尚没有回复的留言
				$li[]=$c;
			}
		}
		$this->assign('li',$li);
		$this->display();
	}
	public function del_news()
	{
		$a=M('cms');$b=$a->order('id desc')->select();
		for($i=0;$i<count($b);$i++)
		{
			switch($b[$i]['kind'])
			{
				case 1:$b[$i]['kind_sz']="通知公告";break;
				case 2:$b[$i]['kind_sz']="在线留言";break;
				case 3:$b[$i]['kind_sz']="供下载的文件";break;
				default:$b[$i]['kind_sz']="管理员对留言的回复";break;
			}
		}
		$this->assign('li',$b);		
		//删除内容中的某一行列
		$this->display();
	}
	public function del_info()
	{
		$a=M('cms');
		$a->where('id='.$_GET['id'])->delete();
		redirect("index.php?m=Admin&a=del_news",0,"");
	}
	
}

///////////////////////////////////////////////////////////////////
	/*新增的获得详细表结构*/
	function get_table_structure($db,$table,$crlf)
	{
		global   $drop;
		$schema_create   =   "";
		if(!empty($drop)){ $schema_create   .=   "DROP TABLE IF EXISTS `$table`;$crlf";}
		$result   =mysql_db_query($db,   "SHOW CREATE TABLE $table");
		$row=mysql_fetch_array($result);
		$schema_create   .= $crlf."-- ".$row[0].$crlf;
		$schema_create   .= $row[1].$crlf;
		Return $schema_create;
	}


	//获得表内容
	function   get_table_content($db, $table,   $crlf)
	{
	  $schema_create   =   "";
	  $temp   =   "";
	  $result   =   mysql_db_query($db,   "SELECT   *   FROM   $table");
	  $i   =   0;
	  while($row   =   mysql_fetch_row($result))
	  {
			  $schema_insert   =   "INSERT INTO `$table` VALUES   (";
			  for($j=0;   $j<mysql_num_fields($result);$j++)
			  {
					  if(!isset($row[$j]))
							  $schema_insert   .=   " NULL,";
					  elseif($row[$j]   !=   "")
							  $schema_insert   .=   " '".addslashes($row[$j])."',";
					  else
							  $schema_insert   .=   " '',";
			  }
			  $schema_insert   =   ereg_replace(",$", "",$schema_insert);
			  $schema_insert   .=   ");$crlf";
			  $temp   =   $temp.$schema_insert   ;
			  $i++;
	  }
	  return   $temp;
	}