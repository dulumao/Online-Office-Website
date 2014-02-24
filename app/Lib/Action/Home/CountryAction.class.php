<?php

class CountryAction extends Action
{
	public function index()
	{
		if($this->check_log()==0)
		{
			$this->log("未登录直接跳转到首页");
			redirect("index.php?m=Country&a=sign_in",0,"");
			return;
		}
		else
		{
			//读出有多少条信息的消息过来
			$a=M('message');$b=$a->select();
			$message=0;
			foreach($b as $c)
			{
				if($c['state']=="已送达" && $c['to']==$_COOKIE['country_name'])
				{
					$message=$message+1;
				}
				
			}
			setcookie("message",$message,time()+8*3600);
			redirect("index.php?m=Country&a=upload_project",0,"");
			
			return;
		}	
		
	}
	public function verify()
	{
		import("ORG.Util.Image");
		Image::buildImageVerify();
	}
	public function check_log()
	{
		return isset($_COOKIE['sys_role_country'])&&($_COOKIE['sys_role_country']=="country")?1:0;		
	}
	public function sign_in()
	{
				
		$this->pri_test("asi");
		//	
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
			//验证登陆过程
			$a=M('manage');$b=$a->select();
			$flag=0;$_country="";$id=0;
			foreach($b as $c)
			{	
				
				if($c['user_name']==$_POST['u'] && $c['password']==$_POST['p'])
				{
					$flag=1;
					$_country=$c['user_name'];
					$id=$c['id'];
					break;
				}
			}
			if($flag)//登陆成功
			{
				setcookie("sys_role_country","country",time()+8*3600);
				setcookie("country_name",$_country,time()+8*3600);
				setcookie("country_id",$id,time()+8*3600);
				$this->log("成功登录");
				redirect("index.php?m=Country&a=index",0,"");
			}
			else
			{
				$this->log("登录失败");
				$this->error_1('用户名或者密码有错误');
			}
		}
		$this->display();
	
	}
	public function sign_out()
	{
		setcookie("sys_role_country","",0);
		setcookie("country_name","",0);
		setcookie("country_id","",0);
		$this->log("退出登录");
		redirect("index.php?m=Country&a=index",0,"");
	}
	 public function change_password()
   	{
   		$this->check_id();
   		$this->style="block";
		$this->notify="请输入正确的原始密码和新密码";
		if(isset($_POST['o'])&& isset($_POST['n1']) && isset($_POST['n2']) )
		{
			$a=M('manage');$b=$a->where('id='.$_COOKIE['country_id'])->select();
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
				$data['id']=$_COOKIE['country_id'];
				$data['password']=$_POST['n1'];
				$a=M('manage');
				$a->save($data);
				$this->log("成功修改密码");
				$this->notify="密码更改成功，下次登录使用新密码";
			}
			else
			{
				$this->notify="原始密码错误，请重新输入";
			}
		}			
   		$this->display();
  	 }
   
	public function company_search()
	{
		$this->check_id();
		$this->pri_test("acs");
		$a=M('city');$b=$a->select();
		$this->assign('city',$b);		
		
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
				$data['fromid']=$_COOKIE['country_id'];
				$data['fromkind']="country";
				$data['from']=$_COOKIE['country_name'];
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
			$this->log("发送了消息");
			include('js.php');
			alert("消息发送成功");				
		}		
		$a=M('message');$b=$a->order('id desc')->select();
		$msglist=array();
		foreach($b as $c)
		{
			if($c['toid']==$_COOKIE['country_id'] && $c['to']==$_COOKIE['country_name'])
			{
				$msglist[]=$c;
			}
		}		
		$this->assign("msglist",$msglist);
		$this->log("查看了消息");
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
			$this->log("删除了消息");
		}
		redirect("index.php?m=Country&a=message",0,"");		
	}
	public function readmsg()
	{
		$this->check_id();
		if(isset($_GET['id']) && is_numeric($_GET['id']))
		{
			$d=M('message');
			$a=$d->where('id='.$_GET['id'])->select();
			$data=$a[0];
			if( $data['tokind']=="country" )
			{
				$data['state']="已读";
				$this->log("标志消息为已经读取状态");
				$d->save($data);
			}
		}
		redirect("index.php?m=Country&a=message",0,"");	
	}
	public function help()
	{
		$this->check_id();
		$this->log("查看了帮助页面");
		$this->display();
	}
	public function project_content()
	{
		$this->check_id();
		$this->display();
	}
	public function project_search()
	{	
		$this->check_id();
		$this->pri_test("aps");
		$a=M('unit');$b=$a->select();
		$this->assign('ui',$b);
		//地域信息的显示
		$a=M('city');$b=$a->select();
		$this->assign('ci',$b);
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
		$this->pri_test("aps");
		$this->log("进行了一次项目的统计查询");
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
		fclose($fp); 	
	}
	 public function app_project_content()
   {
   		$this->check_id();
   		//查看项目的信息，只读出并且显示即可
		if(!isset($_GET['id']) || !is_numeric($_GET['id']))
		{
			$this->log("出现了异常的行为");
			$this->error_1("非法调用本函数,不要乱来，谢谢！");
			return;
		}
		//读出信息并且显示
		$this->log("查看了项目的具体信息");
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
			$this->log("出现异常行为");
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
		$this->log("下载了文件".$file_name);
		fclose($fp); 
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
		$this->check_id();
		//删除指定的项目报告
		if(!isset($_GET['id']) || !isset($_GET['fid']))
		{
			$this->log("出现了异常行为");
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
			$this->log("删除了项目进度报告文件");
			redirect("index.php?m=Country&a=app_project_report&id=".$_GET['id'],0,"");	
		}
	}

    public function company_search_list()
	{
		$this->check_id();
		//year place state
		$this->pri_test("acs");
		$this->log("进行了一次示范企业的查询");
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
		$this->display();
	}
	public function upload_project()
	{
		$this->check_id();
		//$this->pri_test("aap");
		//找到辖下企业的提交待审核的项目申报
		$a=M('manage');$b=$a->where('id='.$_COOKIE['country_id'])->select();
		$des_region=$b[0]['region'];
		
		//
		$a=M('pro');$b=$a->select();
		$li=array();
		foreach($b as $c)
		{
			$aa=M('unit');$bb=$aa->where('id='.$c['claimid'])->select();		
			
			if($bb[0]['unitaddr']!=$des_region)
			{
				continue;
			}
			else
			{
				
				if(in_array($c['state'],array("草稿","提交待审核")))
				{
					$li[]=$c;					
				}
			}
			
		}
		
		
		//寻找更多的信息
		for($i=0;$i<count($li);$i=$i+1)
		{
			//得到企业名
			//得到id
			$li[$i]['idd']=$i+1;
			$a=M('unit');$b=$a->where('id='.$li[$i]['claimid'])->select();
			$li[$i]['unitname']=$b[0]['unitname'];
			$li[$i]['recornot']=($li[$i]['reccomend']==1)?"取消推荐":"推荐";
		}
		
		$this->log("查看了辖下企业的项目申请");///
		//对li再次进行分类清理
		$a=M('provide');$provide=$a->select();
		for($i=0;$i<count($provide);$i++)
		{
			for($j=0;$j<count($li);$j++)
			{
				if($provide[$i]['id']==$li[$j]['pro_kind'])
				{
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
		
		$this->assign('big',$provide);
		//dump($provide);die();
		
		$this->display();
	}	
	public function upload_company_upload()
	{
		$this->check_id();
		//查看项目的信息，只读出并且显示即可
		$this->pri_test("aac");
		if(!isset($_GET['id']) || !is_numeric($_GET['id']))
		{
			$this->log("出现了异常行为");
			$this->error_1("非法调用本函数,不要乱来，谢谢！");
			return;
		}
		//
		$this->id=$_GET['id'];
		$this->display();	
			//
	}  
	public function upload_project_upload()
	{
		$this->check_id();
		$this->pri_test("aap");
		//查看项目的信息，只读出并且显示即可
		if(!isset($_GET['id']) || !is_numeric($_GET['id']))
		{
			$this->log("出现了异常行为");
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
		$this->assign('li',$li);
		
		$this->id=$_GET['id'];	
		
   		$this->display();
		
	}
	public function add_file()
	{
		$this->check_id();
		$this->pri_test("aap");
		if(!isset($_POST) || $_POST['id']=="")
		{
			$this->log("出现了异常行为");
			redirect("index.php?m=Country&a=upload_project",0,"");
			return;
		}
		else
		{
			//添加新文件
			/*import("ORG.NET.UploadFile");*/include("UploadFile.class.php");
			$upload=new UploadFile();
			$upload->maxSize=100000000;//上传文件大小的限制
			$upload->allowExts=array("rar","zip","jpg","png","gif","doc","docx","ppt","pptx","pdf");//允许的文件类型
			$upload->savePath='./upload/';//文件保存的路径
			if(!$upload->upload())
			{
				if(strpos($upload->getErrorMsg(),"择")) //没有文件上传，则直接跳到下一个页面中去
				{
					
				}
				else //文件上传过程出错
				{
					$this->error_1($upload->getErrorMsg());
					return;
				}
			}
			else
			{
				//拼组文件信息存入到数据库中
				$info1=$upload->getUploadFileInfo();
				$n=count($info1); //上传过来的文件数目
				//在查询已有的文件数目
				$a=M('pro');$b=$a->where('id='.$_POST['id'])->select();
				$info=$b[0];//该项目的所有信息
				$now=$info['total_file'];
				if($now+$n>8)
				{
					$this->error_1("现已有$now个文件，上传$n个后将超出文件数目的上限，请压缩打包后再上传!");
					return;
				}
				
				$info['total_file']=$info['total_file']+$n;//文件数目加上
				
				$j=0;
				for($i=1;$i<=8;$i++)
				{	
					//
					if($info['file'.$i]!="")//如果存有信息，直接跳过
					{
						continue;
					}			
					else
					{	
						if(!empty($info1[$j]))
						{
							$info['file'.$i]=$info1[$j]['name']."|".$info1[$j]['savename']."|".date('Y-m-d');//拼凑出来的信息
							$j=$j+1;
						}
					}
					
				}
				$a=M('pro');
				$a->save($info); //保存新增的文件信
				$this->log("上传了项目申请支持文件");
			
				//转回
				redirect("index.php?m=Country&a=upload_project_upload&id=".$_POST['id'],0,"");
			}
		}

	}
	public function removefile()
	{
		$this->check_id();
		//好吧，我默认你的参数是正确的
		$a=M('pro');$b=$a->where('id='.$_GET['id'])->select();
		$c=$b[0];
		if($c['file'.$_GET['fid']]!="")
		{
			$b[0]['total_file']=$b[0]['total_file']-1;
			$b[0]['file'.$_GET['fid']]="";
			$a->save($b[0]);
			$this->log("删除了项目申请支持文件");
		}
		redirect("index.php?m=Country&a=upload_project_upload&id=".$_GET['id'],0,"");
		
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
	
	public function upload_company()
	{
		$this->check_id();
		//找到辖下企业的提交待审核的示范企业申报
		//找到辖下企业的提交待审核的项目申报
		$a=M('manage');$b=$a->where('id='.$_COOKIE['country_id'])->select();
		$des_region=$b[0]['region'];
		
		//
		$a=M('model');$b=$a->select();
		$li=array();
		foreach($b as $c)
		{
			$aa=M('unit');$bb=$aa->where('id='.$c['claimid'])->select();		
			
			if($bb[0]['unitaddr']!=$des_region)
			{
				continue;
			}
			else
			{
				
				if(in_array($c['state'],array("草稿","提交待审核","打回")))
				{
					$li[]=$c;					
				}
			}
			
		}
		
		
		//寻找更多的信息
		for($i=0;$i<count($li);$i=$i+1)
		{
			//得到企业名
			//得到id
			$li[$i]['idd']=$i+1;
			$a=M('unit');$b=$a->where('id='.$li[$i]['claimid'])->select();
			$li[$i]['unitname']=$b[0]['unitname'];
			$li[$i]['recornot']=($li[$i]['reccomend']=="1")?"取消推荐":"推荐";
		}
		
		$this->log("查看了辖下示范企业申请列表");//
		$this->assign('li',$li);
		$this->display();
	}
	 public function com()
   {
   		$this->check_id();
   		//从数据库中读出本单位的信息
		$a=M('unit');$b=$a->where('id='.$_GET['id'])->select();
		$this->assign("info",$b[0]);
		
		$this->display();
   }
	public function getfile_1()
	{
		$this->check_id();
		if( !isset($_GET['id']) || !isset($_GET['fid'])/* ||　!is_numeric($_GET['id']) || !is_numeric($_GET['nid'])*/ )
		{
			$this->error_1('参数错误');
			return;
		}
		$a=M('model');$b=$a->where('id='.$_GET['id'])->select();
		$c=$b[0]['file'.$_GET['fid']]; //拼凑出的文件字符串
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
		$this->log("下载了文件".$file_name);
		fclose($fp);
	}
	public function add_file_1()
	{
		$this->check_id();
		if(!isset($_POST) || $_POST['id']=="")
		{
			redirect("index.php?m=Country&a=upload_company",0,"");
			return;
		}
		else
		{
			//添加新文件
			/*import("ORG.NET.UploadFile");*/include("UploadFile.class.php");
			$upload=new UploadFile();
			$upload->maxSize=100000000;//上传文件大小的限制
			$upload->allowExts=array("rar","zip","jpg","png","gif","doc","docx","ppt","pptx","pdf");//允许的文件类型
			$upload->savePath='./upload/';//文件保存的路径
			if(!$upload->upload())
			{
				if(strpos($upload->getErrorMsg(),"择")) //没有文件上传，则直接跳到下一个页面中去
				{
					
				}
				else //文件上传过程出错
				{
					$this->error_1($upload->getErrorMsg());
					return;
				}
			}
			else
			{
				//拼组文件信息存入到数据库中
				$info1=$upload->getUploadFileInfo();
				$n=count($info1); //上传过来的文件数目
				//在查询已有的文件数目
				$a=M('model');$b=$a->where('id='.$_POST['id'])->select();
				$info=$b[0];//该项目的所有信息
				$now=$info['totalfile'];
				if($now+$n>9)
				{
					$this->error_1("现已有".$now."个文件，上传".$n."个后将超出文件数目的上限，请压缩打包后再上传!");
					return;
				}
				
				$info['totalfile']=$info['totalfile']+$n;//文件数目加上
				
				$j=0;
				for($i=1;$i<=9;$i++)
				{	
					//
					if($info['file'.$i]!="")//如果存有信息，直接跳过
					{
						continue;
					}			
					else
					{	
						if(!empty($info1[$j]))
						{
							$info['file'.$i]=$info1[$j]['name']."|".$info1[$j]['savename']."|".date('Y-m-d');//拼凑出来的信息
							$j=$j+1;
						}
					}
					
				}
				$a=M('model');
				$a->save($info); //保存新增的文件信
				$this->log("添加了示范企业申请文件");
				//转回
				redirect("index.php?m=Country&a=company_content&id=".$_POST['id'],0,"");
			}
		}

	}
	public function log($msg)
	{
		$a=M('log');
		$a->ip=$_SERVER['REMOTE_ADDR'];//ip
		$a->what=$msg;
		$a->user_id=$_COOKIE['country_id'];
		$a->time=date('Y-m-d H:i:s',time());
		$a->user_kind="country";
		$a->add();
	}
	public function error_1($msg)
	{	
		redirect("index.php?m=Unit&a=error_2&msg=".$msg,0,"");	
		return;	
	}
	public function error_2()
	{
		$this->title="出现错误!";
		$this->error_1=$_GET['msg'];
		$this->display();
	}
	public function pri_test($what)
	{
		 $flag=0;
		 $a=M('pri');$b=$a->where('id=1')->select();
		 $pri=$b[0];
		 /*		
		 $p['asi']=$pri['admin_signin']=="1"?"开":"关";
		 $p['aac']=$pri['admin_add_c']=="1"?"开":"关";
		 $p['aap']=$pri['admin_add_p']=="1"?"开":"关";
		 $p['acs']=$pri['admin_c_search']=="1"?"开":"关";
		 $p['aps']=$pri['admin_p_search']=="1"?"开":"关";
		 */
		 switch($what)
		 {
		 	case("asi"): if($pri['admin_signin']==0) $flag=1;break;
			case("aac"): if($pri['admin_add_c']==0) $flag=1;break;
			case("aap"): if($pri['admin_add_p']==0) $flag=1;break;
			case("acs"): if($pri['admin_c_search']==0) $flag=1;break;
			case("aps"): if($pri['admin_p_search']==0) $flag=1;break;
			
			default: $flag=0;break;		
		 }
		 
		 //////////////////////////////////////////
		 if($flag)
		 {
		 	redirect("index.php?m=Index&a=error_403",0,"");	
			return;
		 }
		 else
		 {
		 	return 1;
		 }
	}
	
	public function check_id()
	{
		if(isset($_COOKIE['sys_role_country']) && $_COOKIE['sys_role_country']=="country")
		{
			return 0;
		}
		else
		{
			$this->error_1("您还没有登录");	
		}
	}
	
	public function reccomend()
	{
		$a=M($_GET['kind']);
		$b=$a->where('id='.$_GET['id'])->select();
		$data=$b[0];
		$data['reccomend']=($data['reccomend']=="1")?"0":"1";
		$a->save($data);
		$a=$_GET['kind']=="pro"?"upload_project":"upload_company";
		redirect("index.php?m=Country&a=".$a,0,"");	
	}
}

?>