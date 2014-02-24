<?php

class IndexAction extends Action {
    public function index()
	{	
		//搜寻出五个最新的新闻
		$a=M('cms');
		$b=$a->where('kind=1')->order('id desc')->limit(5)->select();
		$this->assign('l1',$b);
		//搜寻出五个最新的文件
		$a=M('cms');
		$b=$a->where('kind=3')->order('id desc')->limit(5)->select();
		$this->assign('l2',$b);
		//五个最新留言
		$a=M('cms');
		$b=$a->where('kind=2')->order('id desc')->limit(5)->select();
		$this->assign('l3',$b);
		//
		$this->display();	
    }
	
	public function error_403()
	{
		$this->msg=$_GET['msg'];
		$this->display();
	}
         public function error_1($msg)
         {
                 redirect('index.php?m=Index&a=error_403&msg='.$msg,0,'');
         }
	public function file()
	{
		//搜寻出所有的新闻进行翻页
		//根据传入的参数设置默认的页面
		if( isset($_GET['pageid'])&&is_numeric($_GET['pageid']) )
		{
			$pageid=$_GET['pageid'];
		}
		else
		{	
			$pageid=1;//设置最新一页为当前页面
		}
		//获得总的页面数
		$a=M('cms');$b=$a->where('kind=3')->order('id desc')->select();$b=count($b);
		$totalpages=ceil($b/10);
		$this->cur=$pageid;
		$this->totalpages=$totalpages;
		//设置上下一页的ID
		if($pageid==1)
		{
			$up=1;
		}
		else
		{
			$up=$pageid-1;
		}
		if($pageid==$totalpages)
		{
			$down=$pageid;
		}
		else
		{
			$down=$down+1;
		}
		$this->up=$up;$this->down=$down;
		//找出当页的新闻列表
		$li=array();$count=0;
		$b=$a->where('kind=3')->order('id desc')->select();
		for($i=1;$i<=count($b);$i=$i+1)
		{
			if($i<($pageid-1)*10)
			{
				continue;
			}
			else
			{
				$li[]=$b[$i-1];
				$count=$count+1;
				if($count==10)
				{
					break;
				}
			}
		}
		//
		$this->assign('li',$li);
		$this->display();
		
	}
	public function error()
	{
		$this->display();
	}
	public function message()
	{
		if( isset($_GET['pageid'])&&is_numeric($_GET['pageid']) )
		{
			$pageid=$_GET['pageid'];
		}
		else
		{	
			$pageid=1;//设置最新一页为当前页面
		}
		//获得总的页面数
		$a=M('cms');$b=$a->where('kind=2')->order('id desc')->select();$b=count($b);
		$totalpages=ceil($b/10);
		$this->cur=$pageid;
		$this->totalpages=$totalpages;
		//设置上下一页的ID
		if($pageid==1)
		{
			$up=1;
		}
		else
		{
			$up=$pageid-1;
		}
		if($pageid==$totalpages)
		{
			$down=$pageid;
		}
		else
		{
			$down=$down+1;
		}
		$this->up=$up;$this->down=$down;
		//找出当页的新闻列表
		$li=array();$count=0;
		$b=$a->where('kind=2')->order('id desc')->select();
		for($i=1;$i<=count($b);$i=$i+1)
		{
			if($i<($pageid-1)*10)
			{
				continue;
			}
			else
			{
				$li[]=$b[$i-1];
				$count=$count+1;
				if($count==10)
				{
					break;
				}
			}
		}
		//
		$this->assign('li',$li);
		$this->display();
		
	}
	public function message_content()
	{
		//获得message的内容以及可能存在的管理员回复内容
		$a=M('cms');$b=$a->where('id='.$_GET['id'])->select();$this->assign('msg',$b[0]);
		//获得管理员回复的内容
		$a=M('cms');$b=$a->where('kind='.$b[0]['id'])->select();$this->assign('msg_b',$b[0]);
		//然后处理上下一条什么的。
		/*
		$msg['upid']=$_GET['id'];$msg['uptitle']=iconv('gb2312','utf-8',"没有了");
		$msg['downid']=$_GET['id'];$msg['downtitle']=iconv('gb2312','utf-8',"没有了");
		$b=$a->where('kind=2')->order('id  desc')->select();
		for($i=0;$i<count($b);$i++)
		{
			if($b[$i]['id']>$_GET['id'] && $b[$i-1]['id'] == $_GET['id'])
			{
				$msg['downid']=$b[$i]['id'];$msg['downtitle']=$b[$i]['title'];
			}
			if($b[$i+1]['id']<$_GET['id'] && $b[$i]['id'] == $_GET['id'])
			{
				$msg['upid']=$b[$i+1]['id'];$msg['uptitle']=$b[$i+1]['title'];
			}
		}
		$this->assign('li',$msg);
		*/
		$this->display();
	}
	public function news()
	{
		//搜寻出所有的新闻进行翻页
		//根据传入的参数设置默认的页面
		if( isset($_GET['pageid'])&&is_numeric($_GET['pageid']) )
		{
			$pageid=$_GET['pageid'];
		}
		else
		{	
			$pageid=1;//设置最新一页为当前页面
		}
		//获得总的页面数
		$a=M('cms');$b=$a->where('kind=1')->order('id desc')->select();$b=count($b);
		$totalpages=ceil($b/10);
		$this->cur=$pageid;
		$this->totalpages=$totalpages;
		//设置上下一页的ID
		if($pageid==1)
		{
			$up=1;
		}
		else
		{
			$up=$pageid-1;
		}
		if($pageid==$totalpages)
		{
			$down=$pageid;
		}
		else
		{
			$down=$down+1;
		}
		$this->up=$up;$this->down=$down;
		//找出当页的新闻列表
		$li=array();$count=0;
		$b=$a->where('kind=1')->order('id desc')->select();
		for($i=1;$i<=count($b);$i=$i+1)
		{
			if($i<($pageid-1)*10)
			{
				continue;
			}
			else
			{
				$li[]=$b[$i-1];
				$count=$count+1;
				if($count==10)
				{
					break;
				}
			}
		}
		//
		$this->assign('li',$li);
		$this->display();
	}
	public function verify()
	{
		import("ORG.Util.Image");
		Image::buildImageVerify();
	}
	public function add_weibo()
	{
		//$_POST过来的数据
		
		if(($_POST['title']!="") && ($_POST['content']!="") && ($_POST['verify']!="") )
		{
			if($_SESSION['verify'] != md5($_POST['verify']))
			{
				redirect("index.php?m=Index&a=error_403&msg=".iconv('gb2312','utf-8','验证码错误'),0,"");
				return;
			}
			$a=M('cms');$a->create();$a->time=date("Y-m-d H:i:s");$a->kind=2;
			$a->add();
			redirect("index.php?m=Index&a=message",0,"");			
		}
		else
		{
			redirect("index.php?m=Index&a=error_403&msg=".iconv('gb2312','utf-8','填写的信息不完整'),0,"");			
			return;			
		}
		
	}
	
	public function get_file()
	{
		if( !isset($_GET['id']))
		{
			$this->error_403('参数错误');
			return;
		}
		$a=M('cms');$b=$a->where('id='.$_GET['id'])->select();		
		//处理下载过程
		header("Content-type:text/html;charset=utf-8"); 
		// $file_name="cookie.jpg"; 
		$file_name=$b[0]['content'];; 
		//dump($i);die();
		//用以解决中文不能显示出来的问题 
		//$file_name=iconv("utf-8","gb2312",$file_name); 
		$file_sub_path=$_SERVER['DOCUMENT_ROOT']."/upload/"; 
		$file_path=$file_sub_path.$file_name; 
		//首先要判断给定的文件存在与否 
		if(!file_exists($file_path)){ 
		$this->error_1("File Not Find!"); 
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
	public function news_content()
	{
		//找出对应的通知公告信息
		$a=M('cms');
		$b=$a->where('id='.$_GET['id'])->select();
		$msg=$b[0];
		//然后找到新闻的上一条新闻和新闻下一条新闻
		$msg['upid']=$_GET['id'];$msg['uptitle']=iconv('gb2312','utf-8',"没有更早的通知公告了");
		$msg['downid']=$_GET['id'];$msg['downtitle']=iconv('gb2312','utf-8',"没有更新的通知公告了");
		//然后搜索数据库，更新上面的默认数据
		$b=$a->where('kind=1')->order('id  desc')->select();
		for($i=0;$i<count($b);$i++)
		{
			if($b[$i]['id'] == $_GET['id'])
			{
                             if($i!=0)
			$msg['downid']=$b[$i+1]['id'];$msg['downtitle']=$b[$i+1]['title'];
                             if($i!=count($b))
			$msg['upid']=$b[$i-1]['id'];$msg['uptitle']=$b[$i-1]['title'];
			}
		}
		$this->assign('msg',$msg);
		$this->display();
	}
	
	
}