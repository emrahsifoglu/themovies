<?php
require_once('../library/Session.php');
require_once('../model/Movie.php');
Session::Start();
if (Session::Get('Id') == 0){
	header("Location: login.php");		
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>MOVIES - ADD</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
<link rel="stylesheet" type="text/css" href="../assets/css/movies.css" media="screen" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript" language="javascript"></script>
<script src="../assets/js/movies.js" type="text/javascript" language="javascript"></script>
</head>
<body>
<div align="right">
<div align="center" id="logoutBtnHolder">
<span class="exit">LOGOUT</span>
</div></div>
<div align="center" class="top">
  <h2>ADD NEW MOVIE</h2>
</div>
<div align="center" >
  <table border="0">
      <tr>
      	  <td align="left"><b>NAME</b></td>
        <td align="left"><b>RELEASE YEAR</b></td>
      </tr>
    <tr>
      <td align="right"><input name="name" type="text" id="name" value="" maxlength="20" tabindex="1"/></td>
            <td align="right">
            <select style="width:100%" id="releaseYear" name="releaseYear" tabindex="2">
              <option value="" selected disabled>Year</option>
            </select>
            </td>
    </tr>
    <tr>
      <td colspan="2" align="right" class="buttondiv"><button id="addBtn" name="addBtn" tabindex="5">ADD</button></td>
      </tr>
        <tr>
          <td colspan="2" align="right" class="buttondiv">
              <button id="allBtn" name="allBtn" tabindex="6">ALL</button>
              <button id="searchBtn" name="searchBtn" tabindex="7">SEARCH</button>
          </td>
          </tr>
      <tr>
      <td colspan="2" align="right"><span id="msgbox" style="display:none"></span></td>
      </tr>
  </table>
</div>
<div align="center" id="moviesTableHolder"></div>
</body>
</html>