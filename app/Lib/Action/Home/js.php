<?php
	/*
	*   ���ļ���php��ʵ���˳�������ת�����������ԣ���ȫ��Ч�ɿ�
	*   @л�� 2013-01-01 00:40
	*   ��������Ȩ��
	*/
	

	/*php�в���js����*/	   
	include("db.php");
	function alert($msg)      //alert��ǩ
	{
		echo "<script type='text/javascript'>";
		echo "alert('".$msg."')";
		echo "</script>";
	}
	
	function redir_in($url)  //վ����ת
	{
		echo "<script type='text/javascript'>";
		echo "window.setTimeout(\"window.location.href='".$url."'\",0)";
		echo "</script>";
	}
	function redir_out($url)  //��ת��վ��
	{
		echo "<script type='text/javascript'>";
		echo "location='".$url."'";
		echo "</script>";
	}
	
	function randname($length)							//���������ļ���
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
		$mail->IsSMTP();                            // �趨ʹ��SMTP����
		$mail->SMTPAuth   = true;                   // ���� SMTP ��֤����
				
		$mail->Host       =$HOST;       // SMTP ������
		$mail->Port       = $PORT;                    // SMTP�������Ķ˿ں�
		$mail->Username   = $U;// "xiepan1990929@126.com";  // SMTP�������û���
		$mail->Password   = $P;//"3330372";        // SMTP����������
		
		$mail->From     = $U;//"xiepan1990929@126.com";  //���÷����˵������ַ
		$mail->FromName = $FROMNAME;//"������������";                       //���÷����˵�����

		$mail->Subject    = $subject;//'��ӭע�ᱱ���������ݻ�Ա';                     // �����ʼ�����
		$mail->AltBody    = "Ϊ�˲鿴���ʼ������л���֧�� HTML ���ʼ��ͻ���"; 
		$mail->Body = $content;;//"�𾴵�".$info->fam.":"."���ã���ϲ���ɹ�ע�ᱱ���������ݻ�Ա�����ĵ�¼��������:".$info->p."����ʹ�ø������¼�����μ����룬�Է�ֹй¶��";      
	
		$mail->AddAddress($to,$toname);

		if(!$mail->Send()) {			
				return 0;
			//alert("�ʼ�����ʧ�ܣ��������������ַ�Ƿ���Ч");
			//die();
		} else {
				return 1;		
			//alert("ע��ɹ������¼���������ĵ�¼������е�¼");
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