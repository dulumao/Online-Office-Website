<?php

class UnitAction extends Action {
    public function index()
	{
		if($this->check_unit()=="")
		{
			redirect("index.php?m=Unit&a=sign_in",0,"");
		}
		else
		{	
			include("public/include/config.php");		
			$this->title=$PRO_NAME;
			
			
			//从数据库中读出本单位的信息
			$a=M('unit');$b=$a->where('id='.$_COOKIE['unit_id'])->select();
			$this->assign("info",$b[0]);	
			//并且删掉完成步骤1和完成步骤2的项目申报
			$a=M('pro');
			$b=$a->where('claimid='.$_COOKIE['unit_id'])->select();
			foreach($b as $c)
			{
				if($c['state']=="完成步骤1" || $c['state']=="完成步骤2" )
				{
					$a->where('id='.$c['id'])->delete();
				}
			}
			//
			if(empty($_GET['id']) | $_GET['id']=="")
			redirect("index.php?m=Unit&a=choose",0,"");
			$this->pro_kind=$_GET['id'];
			$this->display();
		}		
    }	
	public function choose()
	{
		$a=M('provide');$b=$a->select();
		$c=array();
		$j=0;
		for($i=0;$i<count($b);$i++)
		{
			
			if($b[$i]['state']=="关闭")
			{
				continue;
			}
			$b[$i]['pid']=$j+1;
			$j++;
			$c[]=$b[$i];						
		}
		
		$this->assign('li',$c);
		$notice="选择一项进行申报";
		if(empty($c)){$notice="当前没有可供申报的项目";}
		$this->notice=$notice;
		$this->display();
	}
	public function check_unit()
	{
		return (isset($_COOKIE['sys_role_unit']) && $_COOKIE['sys_role_unit']=="unit")?"unit":"";
	}
	public function sign_in()
	{
		
		
		$this->pri_test("ucsi");
		$a=M('message');$b=$a->order('id desc')->select();
		$msglist=array();
		foreach($b as $c)
		{
			if(  ($c['tokind']=="unit" && $c['toid']==$_COOKIE['unit_id'] &&$c['state']!="已读" ) || ($c['tokind'] =="all" && $c['state']!="已读") )
			{
				$msglist[]=$c;
			}
		}			
		$this->msgcount=count($msglist);
		setcookie('msg',$this->msgcount);
		
		if(isset($_POST['u']) && isset($_POST['p']) && empty($_POST['verify'])) //验证码空的提交,视为刷新页面的验证码
		{
			$this->u=$_POST['u'];$this->p=$_POST['p'];
			$this->display();
			return;
		}
		
					
		if(isset($_POST['u']) && isset($_POST['p']) && !empty($_POST['verify']))
		{		
			if($_SESSION['verify'] != md5($_POST['verify']))
			{
				$this->error_1('验证码错误');
			}
			//验证登陆过程
			$a=M('unit');$b=$a->select();
			$flag=0;$_unit="";$id=0;
			foreach($b as $c)
			{
				if($c['unitname']==$_POST['u'] && $c['password']==$_POST['p'] && $c['state'] =="待审")
				{
					$this->error_1("用户信息审查中，暂时不能使用，抱歉");
				}
				
				if($c['unitname']==$_POST['u'] && $c['password']==$_POST['p'] && $c['state'] !="待审")
				{
					$flag=1;
					$_unit=$c['unitname'];
					$id=$c['id'];
					break;
				}
			}
			if($flag)//登陆成功
			{
				setcookie("sys_role_unit","unit",time()+8*3600);
				setcookie("unit_name",$_unit,time()+8*3600);
				setcookie("unit_id",$id,time()+8*3600);
				$this->log("成功登录");
				redirect("index.php?m=Unit&a=index",0,"");
			}
			else
			{
				$this->error_1('用户名或者密码有错误');
				$this->log("登录失败");
			}
		}
		$this->display();
	}
	public function account()
	{
		if(!empty($_POST))
		{
			//用户修改了注册信息
			$a=M('unit');
			$a->create();
			$a->save();
			include('js.php');	alert('用户信息保存成功');		
		}
		$this->check_id();
		//从数据库中读出本单位的信息
		$id=isset($_GET['id'])?$_GET['id']:$_COOKIE['unit_id'];
		$a=M('unit');$b=$a->where('id='.$id)->select();
		$this->assign("info",$b[0]);
		$this->k1="";$this->k2="";$this->k3="";$this->k4="";
		switch($b[0]['regkind'])
		{
			case '私企':$this->k1="selected";break;
			case '国企':$this->k2="selected";break;
			case '外企':$this->k3="selected";break;
			case '合资企业':$this->k4="selected";break;
		}
		
		$this->s1="";$this->s2="";$this->s3="";$this->s4="";$this->s5="";
		switch($b[0]['bankcredit'])
		{
			case '无':$this->s1="selected";break;
			case 'A':$this->s2="selected";break;
			case 'AA':$this->s3="selected";break;
			case 'AAA':$this->s4="selected";break;
			case 'AAAA':$this->s5="selected";break;
		}
		
		
		$this->log("查看本单位详细信息");
		$this->display();
	}
	public function exit_1()
	{
		setcookie("sys_role_unit","");
		setcookie("unit_name","");
		setcookie("admin_name","");
		setcookie("country_name","");
		$this->log("退出登录");
		redirect("index.php?m=Index&a=index",0,"");
	}
	public function verify()
	{
		import("ORG.Util.Image");
		Image::buildImageVerify();
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
				$data['fromid']=$_COOKIE['unit_id'];
				$data['fromkind']="unit";
				$data['from']=$_COOKIE['unit_name'];
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
			$this->log("发送消息");
			include('js.php');
			alert("消息发送成功");				
		}		
		$a=M('message');$b=$a->order('id desc')->select();
		$msglist=array();
		foreach($b as $c)
		{
			if( ($c['fromkind']=="unit" && $c['fromid']==$_COOKIE['unit_id']) || ($c['tokind']=="unit" && $c['toid']==$_COOKIE['unit_id']) || $c['tokind'] =="all" )
			{
				$msglist[]=$c;
			}
		}		
		$this->assign("msglist",$msglist);
		
		$a=M('unit');$b=$a->select();$this->assign('unitlist',$b);
		$a=M('manage');$b=$a->select();$this->assign('countrylist',$b);	
		$this->log("查看消息");	
		$this->display();
	}
	
	public function delmsg()
	{
		$this->check_id();
		if(isset($_GET['id']) && is_numeric($_GET['id']))
		{
			$d=M('message');
			$b=$d->where('id='.$_GET['id'])->select();
			if($b[0]['tokind']=="all") 
			{
				redirect("index.php?m=Unit&a=message",0,"");		
				return;
			}	
			$d->where('id='.$_GET['id'])->delete();
			$this->log("删除消息");
		}
		redirect("index.php?m=Unit&a=message",0,"");		
	}
	public function readmsg()
	{
		$this->check_id();
		if(isset($_GET['id']) && is_numeric($_GET['id']))
		{
			$d=M('message');
			$a=$d->where('id='.$_GET['id'])->select();
			$data=$a[0];
			if( ($data['toid']==$_COOKIE['unit_id'] && $data['tokind']=="unit" )|| ($data['tokind']=="all"))
			{
				$data['state']="已读";
				$d->save($data);
				$this->log("将消息标志为已读");
			}
		}
		redirect("index.php?m=Unit&a=message",0,"");	
	}
	public function sign_up()
	{
		$this->pri_test("ucsu");
		
		if(isset($_POST['unitname']))
		{
			//首先查阅数据库中有多少条来自本地的注册信息
			$a=M('unit');$b=$a->select();
			$count=0;
			$user_IP = ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
			$user_IP = ($user_IP) ? $user_IP : $_SERVER["REMOTE_ADDR"];
			foreach($b as $c)
			{
				if($c['reg_ip']==$user_IP)
					$count=$count+1;
			}
			if($count>2)
			{
				$this->error_1('本机已经注册了三个以上帐号，请耐心等待管理员审核，不要重复操作');
			}
			
			//不做数据是否为空的校验，我们认为，客户不知道怎么跨过浏览器端的js验证
			//验证工商注册的编号，这个需要是唯一的
			if(isset($_POST['unitcode']))
			{
				//测试是否是唯一的
				$a=M('unit');$b=$a->select();
				foreach($b as $c)
				{
					if($c['unitcode']==$_POST['unitcode'] ||$c['unitname']==$_POST['unitname'] )
					{
						$this->log("重复的工商号注册");
						$this->error_1('所填写的工商注册编号或者用户名已经被使用，请不要重新申请账号!');
						
					}
				} 
			}
			//其他的，就不管了，直接写入数据库中进行审查即可
			$a=M('unit');
			$a->create();
			$a->state="待审";
			$a->time=date("Y-m-d H:i:s");
			
			$a->reg_ip=$user_IP; //记录注册的IP
			$a->add();
			
			//跳转至注意事项页面
			redirect("index.php?m=Unit&a=notice",0,"");
			//$this->success("注册信息已经记录，等待管理员审查通过后方可使用!","index.php?m=Unit&a=notice",0);
			return;
		}	
		
		//
		//将所有的地址信息读出来
		$addr=M('city');
		$addrlist=$addr->select();
		$this->assign("addrlist",$addrlist);
		$this->display();
	}
	public function notice()
	{
		$this->display();
	}
	public function del()
	{
		$this->check_id();
		/*这个代码用来生成陕西省西安市的区县单位数据库*/
		$a=M('city');
		$b=$a->select();
		foreach($b as $c)
		{
			if(!in_array($c['parent_id'],array("0","161","20","1309","1307","1302","1305","1306","1308","1304","1303","16110","9913")))
			{
				//需要将$C从数据库中删除
				$a->where('region_id='.$c['region_id'])->delete();
			}
		}		
	}
	
	public function change_password()
	{
		$this->check_id();
		$this->style="none";
		$this->notify="没有进行相关操作";
		if(isset($_POST['old']) && isset($_POST['new1']) && isset($_POST['new2']))
		{
			$a=M('unit');$b=$a->where('id='.$_COOKIE['unit_id'])->select();
			$old=$b[0]['password'];
			if($_POST['old']!=$old)
			{
				$this->style="block";
				$this->notify="原始密码输入错误!";
				$this->display();
				return;				
			}
			if( $_POST['new1'] !=$_POST['new2'])
			{
				$this->style="block";
				$this->notify="两次新密码不一致!";
				$this->display();
				return;	
			}
			$data['id']=$_COOKIE['unit_id'];
			$data['password']=$_POST['new1'];
			$a->save($data);
			$this->style="block";
			$this->notify="密码修改成功!";	
			$this->log("修改登录密码");		
		}
		$this->display();
	}

	public function newproject_submit()
	{
		$this->check_id();
		$this->pri_test("upc");
		//看是否有id值提交
		if(!isset($_POST['id']) || $_POST['id']=="")
		{
			//页面进入不正常，跳回
			redirect("index.php?m=Unit&a=index",0,"");
			return;
		}
		else
		{	
			//将传过来的文件进行保存,并且拼组多个信息
			///*import("ORG.NET.UploadFile");*/
			include("UploadFile.class.php");
			$upload=new UploadFile();
			$upload->maxSize=100000000;//上传文件大小的限制
			$upload->allowExts=array("rar","zip","jpg","png","gif","doc","docx","ppt","pptx",'pdf');//允许的文件类型
			$upload->savePath='./upload/';//文件保存的路径
			if(!$upload->upload())
			{
				$this->error_1($upload->getErrorMsg());
				return;
			}
			else
			{
				//拼组文件信息存入到数据库中
				$info=$upload->getUploadFileInfo();
				$n=count($info);
				
				$data['id']=$_POST['id'];
				$data['total_file']=$n;				
				$data['state']="完成步骤2";
				for($i=1;$i<=$n;$i++)
				{					
					$data['file'.$i]=$info[$i-1]['name']."|".$info[$i-1]['savename']."|".date('Y-m-d');//拼凑出来的信息
				}
				$a=M('pro');
				$a->save($data);
				$this->log("上传了项目申请文件");				
			}
			
			$this->id=$_POST['id'];//id值一直在传递中	
			//$this->display();
		}
		$this->display();
	}
	public function newproject_upload()
	{
		$this->check_id();
		$this->pri_test("upc");
		//首先判断是否有数据提交，如果没有的话，则跳回到首页面
		if(!isset($_POST['proname']) || !isset($_POST['totalmoney']) || $_POST['proname']=="" || $_POST['totalmoney']=="")
		{
			redirect("index.php?m=Unit&a=index",0,"");
			return;
		}
		else
		{
			//验证三个数据之和是否等于总投资
			$a=intval($_POST['self'])+intval($_POST['bankloan']);
			$a=$a+intval($_POST['get']);
			if(intval($_POST['totalmoney'])!=$a)
			{
				$this->error_1("自筹经费，申请专项，银行贷款数目之和不等于项目总投资，请确认后重写");
				return;
			}			
			//接收数据并且处理和验证
			if($_POST['start']=="" || $_POST['end']=="")
			{
				$this->error_1("项目起止年限日期不完整，请重新填写");
				return;
			}
			if($_POST['prokind']=="")
			{
				$this->error_1("项目类型信息不完整，请重新填写");
				return;
			}
			if($_POST['linker']=="")
			{
				$this->error_1("项目联系人信息不完整，请重新填写");
				return;
			}
			if($_POST['prokind']=="")
			{
				$this->error_1("项目类型信息不完整，请重新填写");
				return;
			}
			if($_POST['linkertel']=="")
			{
				$this->error_1("项目类型联系人电话完整，请重新填写");
				return;
			}
			if($_POST['income']=="" || !is_numeric($_POST['income']))
			{
				$this->error_1("上年度销售收入不完整，请重新填写");
				return;
			}
			if($_POST['profit']=="" || !is_numeric($_POST['profit']))
			{
				$this->error_1("上年利润信息不完整，请重新填写");
				return;
			}
			if($_POST['tax']=="" || !is_numeric($_POST['tax']))
			{
				$this->error_1("上年上交利税信息不完整，请重新填写");
				return;
			}
			if($_POST['totalmoney']=="" || !is_numeric($_POST['totalmoney']))
			{
				$this->error_1("上年总投资信息不完整，请重新填写");
				return;
			}
			if($_POST['self']=="" || !is_numeric($_POST['self']))
			{
				$this->error_1("自筹资金信息不完整，请重新填写");
				return;
			}
			if($_POST['bankloan']=="" || !is_numeric($_POST['bankloan']))
			{
				$this->error_1("银行贷款信息不完整，请重新填写");
				return;
			}
			if($_POST['claimkind']=="")
			{
				$this->error_1("申请专项方式不完整，请重新填写");
				return;
			}
			if($_POST['prosignificance']=="")
			{
				$this->error_1("项目意义等信息不完整，请重新填写");
				return;
			}				
			
			//数据的校验完毕，现在开始写入草稿中,覆盖式的填写信息
			//更新资产和资产负债率
			$data['id']=$_COOKIE['unit_id'];
			$data['unittotalmoney']=$_POST['unittotalmoney'];
			$data['betmoneyrate']=$_POST['betmoneyrate'];
			$a=M('unit');$a->save($data);//数据更新完毕
			
			//
			$a=M('pro');
			$a->create();
			$a->claimid=$_COOKIE['unit_id'];
			$a->state="完成步骤1";
			$a->total_file=0;
			
			$a->add();
			$this->log("填写了项目申请的基本信息");
			$b=$a->where('claimid='.$_COOKIE['unit_id'])->order('id desc')->select();
			$this->id=$b[0]['id'];
		}
			
		$this->display();
	}	
	
	public function project_content()
	{
		$this->check_id();
		//查看项目的信息，只读出并且显示即可
		if(!isset($_GET['id']) || !is_numeric($_GET['id']))
		{
			$this->error_1("非法调用本函数,不要乱来，谢谢！");
			$this->log("出现不正常的调用行为");
			return;
		}
		//读出信息并且显示
		$a=M('pro');$b=$a->where('id='.$_GET['id'])->select();
		$this->assign('info',$b[0]);
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
		$a=M('unit');$b=$a->where('id='.$_COOKIE['unit_id'])->select();
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
		$this->log("查看了项目信息");
		//dump($finfo);die();
		$this->display();
	}
	public function project_list()
	{
		$this->check_id();
		//在这个位置处理提交事宜
		if(isset($_POST['id']))
		{
			//dump($_POST);die();
			$data['id']=$_POST['id'];
			$data['pifu']="";
			$data['upload1']=$_POST['upload1'];
			$data['upload2']=$_POST['upload2'];
			$data['time']=date('Y-m-d');
			if(isset($_POST['submit1']))
			{
				//提交
				$data['state']="提交待审核";
			}
			else
			{
				//存草稿
				$data['state']="草稿";
			}
			$a=M('pro');$a->save($data);			
		}
		//然后显示和该用户相关的工程项目
		//一共分成下面几种 提交待审核的  被打回的  通过审核在进行中的 已经通过验收的
		$a=M('pro');
		$b=$a->where('claimid='.$_COOKIE['unit_id'])->select();
		$c=$b;
		for($i=0;$i<count($c);$i=$i+1)
		{
			if($c[$i]['nosee']=="1")
			{			
				$c[$i]['state']=$c[$i]['nosee_state'];
				$c[$i]['back_reason']=$c[$i]['nosee_backreason'];;		
				$c[$i]['pifu']=$c[$i]['nosee_pifu'];	
								
			}
			$c[$i]['pid']=$i+1;
			$c[$i]['showornot']=($c[$i]['support']=="是")?"":"tty";
		}		
		$b=$c;
		//再对b进行处理,找出所有可供申报的项目进行
		$a=M('provide');$provide=$a->select();
		for($i=0;$i<count($provide);$i++)
		{
			$m=1;
			for($j=0;$j<count($c);$j++)
			{
				if($provide[$i]['id']==$c[$j]['pro_kind'])
				{
					$c[$j]['pid']=$m;$m++;
					$provide[$i]['content'][]=$c[$j];
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
		
		//dump($provide);die();
		
		
		$this->assign('big',$provide);
		$this->log("查看了项目信息");
		$this->display();
	}

	public function project_temp()
	{
		$this->check_id();
		//列出所有的草稿箱中的申请
		$a=M('pro');$b=$a->where('claimid='.$_COOKIE['unit_id'])->select();
		$c=array();
		foreach($b as $d)
		{
			if($d['state']=="草稿")
			{
				$c[]=$d;
			}
		}
		$this->assign('c',$c);
		$this->log("查看了项目申请草稿箱");
		$this->display();
	}
	
	public function caogao_remove()
	{
		$this->check_id();
		$a=M('pro');
		$a->where('id='.$_GET['id'])->delete();
		$this->log("删除了项目申请草稿");
		redirect("index.php?m=Unit&a=project_temp",0,"");	
		
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
		$this->log("下载了文件".$file_name);
		fclose($fp); 
	}
	//
	public function project_progress()
	{
		$this->check_id();
		//读出正在进行的项目 已经 申请验收的项目
		$a=M('pro');
		$b=$a->where('id='.$_GET['id'])->select();
		if($b[0]['state']=="草稿" ||$b[0]['state']=="提交待审核" )
		{
				redirect("index.php?m=Unit&a=project_list",0,"");	
		}
		
		$l2=$b;
		//通过将l3得到最新的进度信息
		$array_i=array();
		$i=0;
		foreach($l2 as $co)
		{
			$mi=explode('|',$co['progress']);
			$mii=$mi[count($mi)-1];//得到最新的项目进度信息
			$info=explode('*',$mii);
			//
			$l2[$i]['ptime']=$info[0];
			include('js.php');
			$l2[$i]['p']=$info[1];//这里需要对字符串进行截取，免得超出
			
			$i=$i+1;
		}
		
		$this->assign('l2',$l2);
		
		$this->log("查看了项目进度及等待验收的项目");
		//
		$this->display();
	}
	public function shenqingyanshou()
	{
		$a=M('pro');$b=$a->where('id='.$_GET['id'])->select();
		$data=$b[0];
		if(in_array($data['state'],array("草稿","提交待审核","验收完成")))
			redirect("index.php?m=Unit&a=project_list",0,"");
		else
		{
			$data['state']="申请验收";
			$a->save($data);
			include('js.php');
			alert('成功向管理员申请验收该项目');
			redirect("index.php?m=Unit&a=project_list",0,"");
		}	
		
	}
	
	public function change_progress()
	{
		$this->check_id();
		if(!isset($_POST['progress']) || !isset($_POST['id']) )
		{
			//直接跳回到调用页面
			redirect("index.php?m=Unit&a=project_progress&id=".$_POST['id'],0,"");	
			return;
		}
		
		else
		{
			$a=M('pro');$b=$a->where('id='.$_POST['id'])->select();
			$data['id']=$_POST['id'];
			$data['progress']=$b[0]['progress']."|".$_POST['progress']."*".date('Y-m-d');//拼凑出新的进度信息
			$a->save($data);
			//跳回进度页面
			$this->log("更新了项目进度");
			redirect("index.php?m=Unit&a=project_progress&id=".$_POST['id'],0,"");	
			return;
		}
		
	}
	public function project_report_1()
	{
		$this->check_id();
		//申请验收，直接设置状态然后跳回即可
		$a=M('pro');$b=$a->where('id='.$_GET['id'])->select();
		$data=$b[0];
		if(in_array($data['state'],array("草稿","提交待审核","验收完成")))
			redirect("index.php?m=Unit&a=project_list",0,"");
			
		$data['id']=$_GET['id'];
		$data['state']="申请验收";
		$data['shenqingyanshoushijian']=date('Y-m-d');
		$a=M('pro');
		$a->save($data);
		$this->log("申请了项目验收");
		redirect("index.php?m=Unit&a=project_progress",0,"");	
	}
	
	
	public function project_report()
	{
		$this->check_id();
		//处理可能存在的文件上传问题
		if(isset($_POST['id']) && $_POST['id']!="")
		{
			//有文件需要上传
			//dump($_POST);die();
			///*import("ORG.NET.UploadFile");*/
			include("UploadFile.class.php");
			$upload=new UploadFile();
			$upload->maxSize=100000000;//上传文件大小的限制
			$upload->allowExts=array("rar","zip","jpg","png","gif","doc","docx","ppt","pptx","pdf");//允许的文件类型
			$upload->savePath='./upload/';//文件保存的路径
			if(!$upload->upload())
			{
				$this->error_1($upload->getErrorMsg());
				return;
			}
			else
			{
				//拼组文件信息存入到数据库中
				$info1=$upload->getUploadFileInfo();
				$n=count($info1); //上传过来的文件数目
				//在查询已有的文件数目
				$a=M('pro');$b=$a->where('id='.$_POST['id'])->select();
				$info=$b[0];//该项目的所有信息
				$now=$info['report_total'];
				if($now+$n>9)
				{
					$this->error_1("现已有$now个文件，上传$n个后将超出文件数目的上限，请压缩打包后再上传!");
					return;
				}
				
				$info['report_total']=$info['report_total']+$n;//文件数目加上
				
				$j=0;
				for($i=1;$i<=9;$i++)
				{	
					//
					if($info['report'.$i]!="")//如果存有信息，直接跳过
					{
						continue;
					}			
					else
					{	
						if(!empty($info1[$j]))
						{
							$info['report'.$i]=$info1[$j]['name']."|".$info1[$j]['savename']."|".date('Y-m-d');//拼凑出来的信息
							$j=$j+1;
						}
					}
					
				}
				$a=M('pro');
				$a->save($info); //保存新增的文件信息
				$this->log("查看上传了项目进度文件");	
				//dump($info);die();			
			}
		}
		//在这个地方提交项目报告
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
	public function removef()
	{
		$this->check_id();
		//删除指定的项目报告
		if(!isset($_GET['id']) || !isset($_GET['fid']))
		{
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
			$this->log("删除了一个项目");
			//跳回原来的页面
			redirect("index.php?m=Unit&a=project_report&id=".$_GET['id'],0,"");	
		}
	}
	public function caogao()
	{
		$this->check_id();
		if(!isset($_GET['id']) || !is_numeric($_GET['id']))
		{
			$this->error_1("非法调用本函数");
			return;
		}
		//否则的话，将草稿中的信息列出并且显示
		//允许修改草稿中的信息
		
		//首先读出项目中的信息
		$a=M('pro');$b=$a->where('id='.$_GET['id'])->select();
		$pinfo=$b[0];
		$this->assign('pinfo',$pinfo);
		//然后读出单位的信息
		$a=M('unit');$b=$a->where('id='.$b[0]['claimid'])->select();
		$uinfo=$b[0];
		$this->assign('uinfo',$uinfo);
		//ok then show it		
		$this->title=$pinfo['proname'].'___项目申请草稿编辑';
		$this->log("查看、编辑了项目草稿");
		$this->display();
	}
	public function oldproject_upload()
	{
		$this->check_id();
		$this->pri_test("upc");
		//首先需要处理上传的文件信息，如果那些信息没有上传，直接跳回到上个页面，从哪里来，回哪里去
		//首先判断是否有数据提交，如果没有的话，则跳回到首页面
		if(!isset($_GET['id']) &&( !isset($_POST['id']) || !isset($_POST['proname']) || !isset($_POST['totalmoney']) || $_POST['proname']=="" || $_POST['totalmoney']=="") )
		{
			redirect("index.php?m=Unit&a=index",0,"");
			return;
		}
		else if(isset($_GET['id']))
		{
			//表明是删完文件回来的
			//直接跳到最后的显示文件信息的页面
		}
		else
		{
			$a=intval($_POST['self'])+intval($_POST['bankloan']);
			$a=$a+intval($_POST['get']);
			if(intval($_POST['totalmoney'])!=$a)
			{
				$this->error_1("自筹经费，申请专项，银行贷款数目之和不等于项目总投资，请确认后重写");
				return;
			}
			//接收数据并且处理和验证
			if($_POST['start']=="" || $_POST['end']=="")
			{
				$this->error_1("项目起止年限日期不完整，请重新填写");
				return;
			}
			if($_POST['prokind']=="")
			{
				$this->error_1("项目类型信息不完整，请重新填写");
				return;
			}
			if($_POST['linker']=="")
			{
				$this->error_1("项目联系人信息不完整，请重新填写");
				return;
			}
			if($_POST['prokind']=="")
			{
				$this->error_1("项目类型信息不完整，请重新填写");
				return;
			}
			if($_POST['linkertel']=="")
			{
				$this->error_1("项目类型联系人电话完整，请重新填写");
				return;
			}
			if($_POST['income']=="" || !is_numeric($_POST['income']))
			{
				$this->error_1("上年度销售收入不完整，请重新填写");
				return;
			}
			if($_POST['profit']=="" || !is_numeric($_POST['profit']))
			{
				$this->error_1("上年利润信息不完整，请重新填写");
				return;
			}
			if($_POST['tax']=="" || !is_numeric($_POST['tax']))
			{
				$this->error_1("上年上交利税信息不完整，请重新填写");
				return;
			}
			if($_POST['totalmoney']=="" || !is_numeric($_POST['totalmoney']))
			{
				$this->error_1("上年总投资信息不完整，请重新填写");
				return;
			}
			if($_POST['self']=="" || !is_numeric($_POST['self']))
			{
				$this->error_1("自筹资金信息不完整，请重新填写");
				return;
			}
			if($_POST['bankloan']=="" || !is_numeric($_POST['bankloan']))
			{
				$this->error_1("银行贷款信息不完整，请重新填写");
				return;
			}
			if($_POST['claimkind']=="")
			{
				$this->error_1("申请专项方式不完整，请重新填写");
				return;
			}
			if($_POST['prosignificance']=="")
			{
				$this->error_1("项目意义等信息不完整，请重新填写");
				return;
			}				
			
			//数据的校验完毕，现在开始写入草稿中,覆盖式的填写信息
			$data['id']=$_COOKIE['unit_id'];
			$data['unittotalmoney']=$_POST['unittotalmoney'];
			$data['betmoneyrate']=$_POST['betmoneyrate'];
			$a=M('unit');$a->save($data);//数据更新完毕
			//
			$a=M('pro');
			$a->create();
			//$a->claimid=$_COOKIE['unit_id'];
			$a->state="完成步骤1";
			$a->id=$_POST['id'];			
		    $a->save();			
		}
		//经过上面的步骤，新的信息已经保存下来了。
		//现在，从表中读出关于该申请的文件信息
		$id=isset($_POST['id'])?$_POST['id']:$_GET['id'];
		$a=M('pro');$b=$a->where('id='.$id)->select();
		$finfo=array();
		$n=$b[0]['total_file'];//已经上传的文件数量
		for($i=1;$i<=8;$i=$i+1)
		{
			if($b[0]['file'.$i] !="" )
			{
				//说明在这里面存有文件信息的
				$ii=explode('|',$b[0]['file'.$i]);
				$finfo[]=array("id"=>$id,"fid"=>$i,"name"=>$ii[0],"fname"=>$ii[1],"time"=>$ii[2]);
			}
		}
		//dump($finfo);die();	
		$this->assign("li",$finfo);
		$a=M('pro');$b=$a->where('id='.$id)->select();
		$pinfo=$b[0];
		$this->assign('pinfo',$pinfo);
		$this->title=$pinfo['proname'].'___项目申请草稿编辑';
		$this->id=$id;
		$this->display();
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
			$this->log("删除了项目申报文件");
		}
		redirect("index.php?m=Unit&a=oldproject_upload&id=".$_GET['id'],0,"");
		
	}
	public function oldproject_submit()
	{
		$this->check_id();
		$this->pri_test("upc");
		//这里处理文件传
		if(isset($_POST['id']) && $_POST['id']!="")
		{
			//有文件需要上传
			//dump($_POST);die();
			///*import("ORG.NET.UploadFile");*/
			include("UploadFile.class.php");
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
				$a->save($info); //保存新增的文件信息							
			}
		}
		$this->id=$_POST['id'];
		$this->display();
	}
	public function company()
	{
		$this->check_id();
		//读出一些企业的信息，并且不能不允许修改
		$a=M('unit');$b=$a->where('id='.$_COOKIE['unit_id'])->select();
		$this->assign('uinfo',$b[0]);
		$this->log("打开了示范企业申报页面");
		$this->display();
	}
	public function company_progress()
	{
		$this->check_id();
		//首先处理可能传过来的申请
		if( isset($_POST['id']) )
		{
			//说明是从草稿那边过来的
			$this->pri_test("ucc");
			
			$data['id']=$_COOKIE['unit_id'];
			$data['unittotalmoney']=$_POST['unittotalmoney'];
			$data['betmoneyrate']=$_POST['betmoneyrate'];
			$a=M('unit');$a->save($data);//数据更新完
			
			$a=M('model');
			$a->create();
			$a->state=isset($_POST['submit1'])?"提交待审核":"草稿";
			$a->claimid=$_COOKIE['unit_id'];
			$a->time_send=date('Y-m-d');
						
			$a->save();
			$b=$a->where('id='.$_POST['id'])->select();//选择刚刚写入的读出
			//将文件上传信息进行打包
			$data=$b[0];
			///*import("ORG.NET.UploadFile");*/
			include("UploadFile.class.php");
			$upload=new UploadFile();
			$upload->maxSize=100000000;//上传文件大小的限制
			$upload->allowExts=array("rar","zip","jpg","png","gif","doc","docx","ppt","pptx","pdf");//允许的文件类型
			$upload->savePath='./upload/';//文件保存的路径
			if(!$upload->upload())
			{
				if(strpos($upload->getErrorMsg(),"择")) //没有文件上传，则直接跳到下一个页面中去
				{
					
				}
				else
				{
					$this->error_1($upload->getErrorMsg());
					return;
				}
				
			}
			else
			{
				//拼组文件信息存入到数据库中
				$info=$upload->getUploadFileInfo();
				$n=count($info); //上传过来的文件数目
				//在查询已有的文件数目
				if($n+$data['totalfile']>9)
				{
					$this->error_1("文件数目将超过允许的上限，请先打包再传!");
					return;
				}
				$data['totalfile']=$n+$data['totalfile'];//总的文件数目
				
				$j=0;
				for($i=1;$i<=9;$i++)
				{	
					
					if($data['file'.$i]!="")//如果存有信息，直接跳过
					{
						continue;
					}			
					else
					{	
						if(!empty($info[$j]))
						{
							$data['file'.$i]=$info[$j]['name']."|".$info[$j]['savename']."|".date('Y-m-d');//拼凑出来的信息
							$j=$j+1;
						}
					}
					
				}
				
				$a->save($data); //保存新增的文件信息
			}	
		}
		else if(isset($_POST['self']) && isset($_POST['tax']))
		{
			$this->pri_test("ucc");
			
			//
			//更新资产和资产负债率
			$data['id']=$_COOKIE['unit_id'];
			$data['unittotalmoney']=$_POST['unittotalmoney'];
			$data['betmoneyrate']=$_POST['betmoneyrate'];
			$a=M('unit');$a->save($data);//数据更新完
			
			//
			$a=M('model');
			$a->create();
			$a->state=isset($_POST['submit1'])?"提交待审核":"草稿";
			$a->claimid=$_COOKIE['unit_id'];
			$a->time_send=date('Y-m-d');			
			$a->add();
			$b=$a->where('claimid='.$_COOKIE['unit_id'])->order('id desc')->select();//选择刚刚写入的读出
			//将文件上传信息进行打包
			$data=$b[0];
			///*import("ORG.NET.UploadFile");*/
			include("UploadFile.class.php");
			$upload=new UploadFile();
			$upload->maxSize=100000000;//上传文件大小的限制
			$upload->allowExts=array("rar","zip","jpg","png","gif","doc","docx","ppt","pptx","pdf");//允许的文件类型
			$upload->savePath='./upload/';//文件保存的路径
			if(!$upload->upload())
			{
				$this->error_1($upload->getErrorMsg());
				return;
				
			}
			else
			{
				//拼组文件信息存入到数据库中
				$info=$upload->getUploadFileInfo();
				$n=count($info); //上传过来的文件数目
				//在查询已有的文件数目
				if($n+$data['totalfile']>9)
				{
					$this->error_1("文件数目将超过允许的上限，请先打包再传!");
					return;
				}
				$data['totalfile']=$n+$data['totalfile'];//总的文件数目
				
				$j=0;
				for($i=1;$i<=9;$i++)
				{	
					
					if($data['file'.$i]!="")//如果存有信息，直接跳过
					{
						continue;
					}			
					else
					{	
						if(!empty($info[$j]))
						{
							$data['file'.$i]=$info[$j]['name']."|".$info[$j]['savename']."|".date('Y-m-d');//拼凑出来的信息
							$j=$j+1;
						}
					}
					
				}
				
				$a->save($data); //保存新增的文件信息
			}	
		}
		//读出信息进行显示
		$a=M('model');$b=$a->where('claimid='.$_COOKIE['unit_id'])->order('id desc')->select();
		$c=$b;
		for($i=0;$i<count($c);$i=$i+1)
		{
			if($c[$i]['nosee']=="1")
			{			
				$c[$i]['state']=$c[$i]['nosee_state'];
				$c[$i]['back_reason']=$c[$i]['nosee_backreason'];		
				$c[$i]['pifu']=$c[$i]['nosee_pifu'];				
			}
		}
		$this->assign('l1',$c);
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
		$this->assign('finfo',$finfo);
		$this->log("查看了示范企业申请文件");
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
		$this->log("下载了文件");
		fclose($fp);
	}
	public function company_temp()
	{
		$this->check_id();
		$a=M('model');$b=$a->where('claimid='.$_COOKIE['unit_id'])->select();
		$li=array();
		foreach($b  as $c )
		{
			if($c['state']=="草稿")
			{
				$li[]=$c;
			}
		}
		$this->assign('li',$li);
		$this->display();
	}
	public function rr()
	{
		$this->check_id();
		$a=M('model');
		$a->where('id='.$_GET['id'])->delete();
		$this->log("删除了示范企业申请信息");
		redirect("index.php?m=Unit&a=company_temp",0,"");
	}
	
	public function company_old()
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
		$this->assign('finfo',$finfo);		
		$this->id=$_GET['id'];
		$this->display();
	}
	public function rrr()
	{
		$this->check_id();
		$a=M('model');
		$b=$a->where('id='.$_GET['id'])->select();
		$data=$b[0];
		if($data['file'.$_GET['fid']]!="")
		{
			//删除之
			$data['file'.$_GET['fid']]="";//清空
			$data['totalfile']=$data['totalfile']-1;
			$a->save($data);
		}
		$this->log("删除了一个示范企业申请文件");
		redirect("index.php?m=Unit&a=company_old&id=".$_GET['id'],0,"");
	}
	public function project_search()
	{
		$this->check_id();
		$this->pri_test("ups");
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
		//
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
		$this->pri_test("ups");
		//下面，对项目进行排查
		$this->log("进行了一次项目的统计查询");
		$a=M('pro');
		$b=$a->select();//选中所有的
		$i1=array();
		//根据公司筛选第一遍
		if($_POST['unit']=="不关心")
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
		if($_POST['place']=="不关心")
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
		if($_POST['state']=="不关心")
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
		if($_POST['prokind']=="不关心")
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
		if($_POST['start']="不关心")
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
		if($_POST['end']="不关心")
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
		if($_POST['totalmoney']=="不关心")
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
		 
		//设置表头
		$objPHPExcel->getActiveSheet()->setCellValue('A1', "项目编号");
		$objPHPExcel->getActiveSheet()->setCellValue('B1', "项目名称");
		$objPHPExcel->getActiveSheet()->setCellValue('C1', "项目起始时间");
		$objPHPExcel->getActiveSheet()->setCellValue('D1', "项目结束时间");
		$objPHPExcel->getActiveSheet()->setCellValue('E1', "项目承建单位");
		$objPHPExcel->getActiveSheet()->setCellValue('F1', "公司上年收入");
		$objPHPExcel->getActiveSheet()->setCellValue('G1', "公司上年利润");
		$objPHPExcel->getActiveSheet()->setCellValue('H1', "公司上年缴税");
		$objPHPExcel->getActiveSheet()->setCellValue('I1', "项目总投资");
		$objPHPExcel->getActiveSheet()->setCellValue('J1', "专向资金");
		$objPHPExcel->getActiveSheet()->setCellValue('K1', "专向资金申请方式");
		$objPHPExcel->getActiveSheet()->setCellValue('L1', "自筹资金");
		$objPHPExcel->getActiveSheet()->setCellValue('M1', "自筹资金是否到位");
		$objPHPExcel->getActiveSheet()->setCellValue('N1', "银行贷款");
		$objPHPExcel->getActiveSheet()->setCellValue('O1', "银行贷款是否到账");
		$objPHPExcel->getActiveSheet()->setCellValue('P1', "项目当前状态");
		$objPHPExcel->getActiveSheet()->setCellValue('Q1', "项目种类");
		//$objPHPExcel->getActiveSheet()->setCellValue('Q1', "最新进度报告时间");
		
		$i=2;//
		foreach($i7 as $c)
		{
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $c['idd']);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $c['proname']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $c['start']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $c['end']);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $c['unit']);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $c['income']);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $c['profit']);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $c['tax']);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $c['totalmoney']);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, $c['get']);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$i, $c['claimkind']);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$i, $c['self']);
			$objPHPExcel->getActiveSheet()->setCellValue('M'.$i, $c['gettoornot']);
			$objPHPExcel->getActiveSheet()->setCellValue('N'.$i, $c['bankloan']);
			$objPHPExcel->getActiveSheet()->setCellValue('O'.$i, $c['bankloanornot']);
			$objPHPExcel->getActiveSheet()->setCellValue('P'.$i, $c['state']);
			$objPHPExcel->getActiveSheet()->setCellValue('Q'.$i, $c['prokind']);
			//$objPHPExcel->getActiveSheet()->setCellValue('Q'.$i, $c['last']);		
			
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
	public function company_search()
	{
		$this->check_id();
		$this->pri_test("ups");
		$a=M('city');$b=$a->select();
		$this->assign('city',$b);		
		
		$this->display();
	}
	public function company_search_list()
	{
		$this->check_id();
		$this->pri_test("ups");
		$this->log("进行了一次示范企业的查询");
		//year place state
		$a=M('model');$b=$a->select();
		//根据年份进行排查
		$i1=array();
		foreach($b as $c)
		{
			if($_POST['year']=="不关心")
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
			if($_POST['place']=="不关心")
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
			if($_POST['state']=="不关心")
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
			if($_POST['level']=="不关心")
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
	public function mail_to($to,$toname,$subject,$content)
	{
		//构造出下面的变量
		$a=M('mail');$b=$a->order('id desc')->select();
		$U=$b[0]['u'];$P=$b[0]['p'];$PORT=25;
		$u=$U;
		$arr=explode('@',$u);
		
		$HOST="smtp.".$arr[1];
		
		
		//echo $HOST;die();
		//$U="xiepan1990929@126.com";
		//$P="3330372";
		$FROMNAME="市工信委项目申报管理系统";
		require_once("PHPMailer_v5.1/class.phpmailer.php");				
		$mail  = new PHPMailer(); 		
		$mail->CharSet    ="utf-8";                 
		$mail->IsSMTP();                            // 设定使用SMTP服务
		$mail->SMTPAuth   = true;                   // 启用 SMTP 验证功能
				
		$mail->Host       =$HOST;       // SMTP 服务器
		$mail->Port       = $PORT;                    // SMTP服务器的端口号
		$mail->Username   = $U;// "xiepan1990929@126.com";  // SMTP服务器用户名
		$mail->Password   = $P;//"3330372";        // SMTP服务器密码
		
		$mail->From     = $U;//"xiepan1990929@126.com";  //设置发件人的邮箱地址
		$mail->FromName = $FROMNAME;//"北京京滨宾馆";                       //设置发件人的姓名
	
		$mail->Subject    = $subject;//'欢迎注册北京京滨宾馆会员';                     // 设置邮件标题
		$mail->AltBody    = "为了查看该邮件，请切换到支持 HTML 的邮件客户端"; 
		$mail->Body = $content;      
	
		$mail->AddAddress($to,$toname);
	
		if(!$mail->Send()) {			
				return 0;
			
		} else {
				return 1;			
		}
	}
	public function reset_password()
	{
		$this->show="block";
		if(!empty($_POST))
		{
			//发送邮件
			$a=M('unit');$b=$a->select();
			foreach($b as $c)
			{
				if($c['linkermail']==$_POST['mail'])
				{
					$to=$c['linkermail'];
					$toname=$c['linkermail'];
					$content="您在<b>市工信委项目申报管理系统中注册帐号的密码为:".$c['password']."</b>,请勿泄漏";		//邮件内容
					$subject="市工信委项目申报管理系统密码找回邮件";
					$this->mail_to($to,$toname,$subject,$content);						
				}
			}
		}
		else
		{
			$this->show="none";
		}	
		$this->display();
	}
	public function help()
	{
		$this->log("查看帮助文件");
		$this->display();
	}
	public function log($msg)
	{
		$a=M('log');
		$a->ip=$_SERVER['REMOTE_ADDR'];//ip
		$a->what=$msg;
		$a->time=date('Y-m-d H:i:s',time());
		$a->user_id=$_COOKIE['unit_id'];
		$a->user_kind="unit";
		$a->add();
	}
	//读出进行权限限制
	
	public function pri_test($what)
	{
		 $flag=0;
		 $a=M('pri');$b=$a->where('id=1')->select();
		 $pri=$b[0];
		 /*
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
		 */
		 switch($what)
		 {
		 	case("ucs"): if($pri['unit_c_search']==0) $flag=1;break;
			case("ups"): if($pri['unit_p_search']==0) $flag=1;break;
			case("ucc"): if($pri['unit_c_claim']==0) $flag=1;break;
			case("upc"): if($pri['unit_p_claim']==0) $flag=1;break;
			case("ucsu"): if($pri['unit_c_signup']==0) $flag=1;break;
			case("ucsi"): if($pri['unit_c_signin']==0) $flag=1;break;
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
	
	public function error_1($msg)
	{	
		redirect("index.php?m=Unit&a=error_2&msg=".$msg,0,"");	
		return;	
	}
	public function error_2()
	{
		$this->title="出现错误!";
		$this->error=$_GET['msg'];
		$this->display();
	}
	public function check_id()
	{
		if(isset($_COOKIE['sys_role_unit']) && $_COOKIE['sys_role_unit']=="unit")
		{
			return 0;
		}
		else
		{
			$this->error_1("您还没有登录");	
		}
	}
	public function dd_p()
	{
		$a=M('pro');$b=$a->where('id='.$_GET['id'])->select();
		dump($b[0]);
		if($b[0]['state']!="草稿" && $b[0]['state']!="验收完成" )
		{
			//不允许删除
			//include('js.php');
			//alert('当前项目不允许删除!');
			redirect("index.php?m=Unit&a=project_list",0,"");	
			return;	
		}			
		$a->where('id='.$_GET['id'])->delete();			
		redirect("index.php?m=Unit&a=project_list",0,"");		
	}
	
	
}

