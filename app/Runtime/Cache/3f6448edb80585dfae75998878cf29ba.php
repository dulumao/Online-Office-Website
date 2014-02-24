<?php if (!defined('THINK_PATH')) exit();?><html>
	<head>
	<title>fill the blank</title>
	</head>
	
	<body>
	<form method="post" action="__URL__/insert">
	Username:<input type="text" name="username" id="username"/><br />
	Email:<input type="text" name="email" id="email" /><br />
	repy:<br />
	<textarea name="content" id="content" cols="45" rows="45"></textarea>
	<br />
	<br />
	<input type="submit" name="button" id="button" value="submit"/>
	</form>
	</body>
</html>