<?php
	/*
	*   本文件在php中实现了常见的跳转操作，经测试，安全有效可靠
	*   @谢盼 2013-01-01 00:40
	*   保留所有权利
	*/
	

	/*php中插入js操作*/	   
	include("db.php");
	function alert($msg)      //alert标签
	{
		echo "<script type='text/javascript'>";
		echo "alert('".$msg."')";
		echo "</script>";
	}
	
	function redir_in($url)  //站内跳转
	{
		echo "<script type='text/javascript'>";
		echo "window.setTimeout(\"window.location.href='".$url."'\",0)";
		echo "</script>";
	}
	function redir_out($url)  //跳转到站外
	{
		echo "<script type='text/javascript'>";
		echo "location='".$url."'";
		echo "</script>";
	}
	
	function randname($length)							//获得随机的文件名
	{
		$hash='CR';
		$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZ1334567890abcdefghigklmnopqrstuvwxyz';
		$max=strlen($chars)-1;
		mt_srand((double)microtime()*1000000);
		for($i=0;$i<$length;$i++)
		{
			$hash.=$chars[mt_rand(0,$max)];
		}
		return $hash;
	}
	
	function back()
	{
		echo "<script type='text/javascript'>";
		echo "history.go(-1);";
		echo "</script>";
	}
	function get_root_path()
	{
		$s_real_path = realpath('./');
		$s_self_path = $_SERVER['PHP_SELF'];
		$s_self_path = substr($s_self_path, 0, strrpos($s_self_path, '/'));
		return str_replace('\\','/',substr($s_real_path, 0,strlen($s_real_path) - strlen($s_self_path)));
	}
	function mail_to($to,$toname,$subject,$content)
	{
		//$toname=iconv('utf-8','gb2312',$toname);
		//$content=iconv('utf-8','gb2312',$content);
		//$subject=iconv('utf-8','gb2312',$subject);
		include(get_root_path()."/PHPMailer_v5.1/class.phpmailer.php");
	    include(get_root_path()."/PHPMailer_v5.1/class.smtp.php");
		include(get_root_path()."/php/db.php");
		//echo get_root_path();
		$mail  = new PHPMailer(); 		
		$mail->CharSet    ="gb2312";                 
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
		$mail->Body = $content;;//"尊敬的".$info->fam.":"."您好！恭喜您成功注册北京京滨宾馆会员，您的登录的密码是:".$info->p."。请使用该密码登录。请牢记密码，以防止泄露！";      
	
		$mail->AddAddress($to,$toname);

		if(!$mail->Send()) {			
				return 0;
			//alert("邮件发送失败，请检查您的邮箱地址是否有效");
			//die();
		} else {
				return 1;		
			//alert("注册成功，请登录邮箱获得您的登录密码进行登录");
		}
	}
	
	
	function cut_str($string, $sublen, $start = 0, $code = 'UTF-8')
	{
    	if($code == 'UTF-8')
    	{
        	$pa = 	"/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
	        preg_match_all($pa, $string, $t_string);

    	    if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen))."...";
        	return join('', array_slice($t_string[0], $start, $sublen));
    	}
    	else
    	{
        	$start = $start*2;
       		$sublen = $sublen*2;
        	$strlen = strlen($string);
        	$tmpstr = '';

        	for($i=0; $i< $strlen; $i++)
        	{
            	if($i>=$start && $i< ($start+$sublen))
            	{
                	if(ord(substr($string, $i, 1))>129)
                	{
                    	$tmpstr.= substr($string, $i, 2);
                	}
                	else
                	{
                    	$tmpstr.= substr($string, $i, 1);
                	}
           		}
            	if(ord(substr($string, $i, 1))>129) $i++;
        	}
        	if(strlen($tmpstr)< $strlen ) $tmpstr.= "...";
        	return $tmpstr;
    	}
	}

	
?>