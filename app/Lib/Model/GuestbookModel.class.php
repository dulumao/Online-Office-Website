<?php
	class GuestbookModel extends Model
	{
		protected $_validate=array(
			array('email','email','error email format!')
		);
		protected $_auto=array(
			array('dateline','time',self::MODEL_INSERT,'function')
		);	
	};
?>