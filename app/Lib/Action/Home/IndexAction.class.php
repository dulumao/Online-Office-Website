<?php

class IndexAction extends Action {
    public function index()
	{	
		//��Ѱ��������µ�����
		$a=M('cms');
		$b=$a->where('kind=1')->order('id desc')->limit(5)->select();
		$this->assign('l1',$b);
		//��Ѱ��������µ��ļ�
		$a=M('cms');
		$b=$a->where('kind=3')->order('id desc')->limit(5)->select();
		$this->assign('l2',$b);
		//�����������
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
		//��Ѱ�����е����Ž��з�ҳ
		//���ݴ���Ĳ�������Ĭ�ϵ�ҳ��
		if( isset($_GET['pageid'])&&is_numeric($_GET['pageid']) )
		{
			$pageid=$_GET['pageid'];
		}
		else
		{	
			$pageid=1;//��������һҳΪ��ǰҳ��
		}
		//����ܵ�ҳ����
		$a=M('cms');$b=$a->where('kind=3')->order('id desc')->select();$b=count($b);
		$totalpages=ceil($b/10);
		$this->cur=$pageid;
		$this->totalpages=$totalpages;
		//��������һҳ��ID
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
		//�ҳ���ҳ�������б�
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
			$pageid=1;//��������һҳΪ��ǰҳ��
		}
		//����ܵ�ҳ����
		$a=M('cms');$b=$a->where('kind=2')->order('id desc')->select();$b=count($b);
		$totalpages=ceil($b/10);
		$this->cur=$pageid;
		$this->totalpages=$totalpages;
		//��������һҳ��ID
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
		//�ҳ���ҳ�������б�
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
		//���message�������Լ����ܴ��ڵĹ���Ա�ظ�����
		$a=M('cms');$b=$a->where('id='.$_GET['id'])->select();$this->assign('msg',$b[0]);
		//��ù���Ա�ظ�������
		$a=M('cms');$b=$a->where('kind='.$b[0]['id'])->select();$this->assign('msg_b',$b[0]);
		//Ȼ��������һ��ʲô�ġ�
		/*
		$msg['upid']=$_GET['id'];$msg['uptitle']=iconv('gb2312','utf-8',"û����");
		$msg['downid']=$_GET['id'];$msg['downtitle']=iconv('gb2312','utf-8',"û����");
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
		//��Ѱ�����е����Ž��з�ҳ
		//���ݴ���Ĳ�������Ĭ�ϵ�ҳ��
		if( isset($_GET['pageid'])&&is_numeric($_GET['pageid']) )
		{
			$pageid=$_GET['pageid'];
		}
		else
		{	
			$pageid=1;//��������һҳΪ��ǰҳ��
		}
		//����ܵ�ҳ����
		$a=M('cms');$b=$a->where('kind=1')->order('id desc')->select();$b=count($b);
		$totalpages=ceil($b/10);
		$this->cur=$pageid;
		$this->totalpages=$totalpages;
		//��������һҳ��ID
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
		//�ҳ���ҳ�������б�
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
		//$_POST����������
		
		if(($_POST['title']!="") && ($_POST['content']!="") && ($_POST['verify']!="") )
		{
			if($_SESSION['verify'] != md5($_POST['verify']))
			{
				redirect("index.php?m=Index&a=error_403&msg=".iconv('gb2312','utf-8','��֤�����'),0,"");
				return;
			}
			$a=M('cms');$a->create();$a->time=date("Y-m-d H:i:s");$a->kind=2;
			$a->add();
			redirect("index.php?m=Index&a=message",0,"");			
		}
		else
		{
			redirect("index.php?m=Index&a=error_403&msg=".iconv('gb2312','utf-8','��д����Ϣ������'),0,"");			
			return;			
		}
		
	}
	
	public function get_file()
	{
		if( !isset($_GET['id']))
		{
			$this->error_403('��������');
			return;
		}
		$a=M('cms');$b=$a->where('id='.$_GET['id'])->select();		
		//�������ع���
		header("Content-type:text/html;charset=utf-8"); 
		// $file_name="cookie.jpg"; 
		$file_name=$b[0]['content'];; 
		//dump($i);die();
		//���Խ�����Ĳ�����ʾ���������� 
		//$file_name=iconv("utf-8","gb2312",$file_name); 
		$file_sub_path=$_SERVER['DOCUMENT_ROOT']."/upload/"; 
		$file_path=$file_sub_path.$file_name; 
		//����Ҫ�жϸ������ļ�������� 
		if(!file_exists($file_path)){ 
		$this->error_1("File Not Find!"); 
		return ; 
		} 
		$fp=fopen($file_path,"r"); 
		$file_size=filesize($file_path); 
		//�����ļ���Ҫ�õ���ͷ 
		Header("Content-type: application/octet-stream"); 
		Header("Accept-Ranges: bytes"); 
		Header("Accept-Length:".$file_size); 
		Header("Content-Disposition: attachment; filename=".$file_name); 
		$buffer=1024; 
		$file_count=0; 
		//��������������� 
		while(!feof($fp) && $file_count<$file_size){ 
		$file_con=fread($fp,$buffer); 
		$file_count+=$buffer; 
		echo $file_con; 
		} 
		fclose($fp);
	}
	public function news_content()
	{
		//�ҳ���Ӧ��֪ͨ������Ϣ
		$a=M('cms');
		$b=$a->where('id='.$_GET['id'])->select();
		$msg=$b[0];
		//Ȼ���ҵ����ŵ���һ�����ź�������һ������
		$msg['upid']=$_GET['id'];$msg['uptitle']=iconv('gb2312','utf-8',"û�и����֪ͨ������");
		$msg['downid']=$_GET['id'];$msg['downtitle']=iconv('gb2312','utf-8',"û�и��µ�֪ͨ������");
		//Ȼ���������ݿ⣬���������Ĭ������
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