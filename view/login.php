<?php
require_once('../library/Session.php');
Session::Start();
if (Session::Get('Id') > 0){
	header("Location: movies.php");		
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>MOVIES - LOGIN</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
<link rel="stylesheet" type="text/css" href="../assets/css/login.css" media="screen" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript" language="javascript"></script>
<script src="../assets/js/login.js" type="text/javascript" language="javascript"></script>
</head>
<body>
<br />
<br />
<form method="post" action="" id="login_form">
<div align="center" class="top">LOGIN</div>
<div align="center" >
  <table border="0">
    <tr>
      <td align="left">Username</td>
      <td align="left"><input name="username" type="text" id="username" value="" maxlength="20" /></td>
    </tr>
    <tr>
      <td align="left">Password</td>
      <td align="left"><input name="password" type="Password" id="password" value="" maxlength="20" /></td>
    </tr>
    <tr>
      <td colspan="2" align="right" class="buttondiv"><input name="Submit" type="submit" id="submit" value="Enter" style="margin-left:-10px; height:23px"  /></td>
      </tr>
      <tr>
      <td colspan="2" align="right"><span id="msgbox" style="display:none"></span></td>
      </tr>
  </table>
</div>
</form>
</body>
</html>