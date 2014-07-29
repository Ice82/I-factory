<?php

include_once("includes/db.php");
session_start();

if (!empty($_POST['user'])) {
$db = mysql_connect($db_host, $db_user, $db_pass);
if ($db==False)die("Errore nella connessione");
if (!mysql_select_db($db_name,$db)) die ("Errore nella selezione del db");
// replace per MySql Injection
$user = str_replace("'","",$_POST['user']);
$pass = str_replace("'","",$_POST['psw']);
//echo $user;
//echo $pass;
$query = "SELECT ID FROM Tool WHERE USER='".$user."' AND PSW='".$pass."'";
$result = mysql_query($query,$db);
 if (mysql_num_rows($result)==1){
    $row = mysql_fetch_array($result);
    $_SESSION['user'] = $row['ID'];
    $_SESSION['IsUserGood'] = 'True';
    header("location: pvt_area/index.php"); 
 }else {
    header("location: tool.php?ctrl=1"); 
 }
 mysql_close($db);
}

?>
<html>
<head>
<title>I-FACTORY.biz >> TOOL</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="Author" content="I-Factory di Nicola Claudio Cellamare">
<META NAME="robots" CONTENT="index, follow"> <!-- (Robot commands: All, None, Index, No Index, Follow, No Follow) -->
<META NAME="revisit-after" CONTENT="2 days">
<META NAME="distribution" CONTENT="global">
<META NAME="rating" CONTENT="general">
<META NAME="Content-Language" CONTENT="italiano">
<LINK href="style.css" rel=STYLESHEET type=text/css>
<STYLE>
.TitSezione {margin-left:4px; margin-top:4px; text-decoration:none; color:#aaaaaa; font-weight:bold; font-family:Tahoma,Arial; font-size:12px; font-variant:small-caps;}
.credit {font-family: Verdana, Arial, Helvetica, sans-serif;font-size:11px;font-weight:normal;line-height:18px;color: #aaaaaa;text-decoration:none;}
a.credit:hover{color:#FE9E00;}

</STYLE>

<SCRIPT language=Javascript><!-- 
function mon(str) {
 window.status = str
}
function mout() {
 window.status = "Pannello di Controllo :: I-Factory.biz"
}

function chkvals() {
 var warn = ""
 ret_val = true
   if (document.forms['Accedi'].user.value.length <= 0) warn += " Login mancante\r"
   if (document.forms['Accedi'].psw.value.length <= 0) warn += " Password mancante\r"
 if (warn.length >= 1) {
  alert_str = warn
  alert(alert_str)
  ret_val = false
  //alert(ret_val)
 }
 return ret_val
 alert(ret_val)
}
//-->
</SCRIPT>

</head>
<BODY BGCOLOR="#FFFFFF" LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0 onLoad="mout();">
<img src="pvt_area/factory.jpg" style="margin-left:10px;margin-top:2px;"><P>
<table border=0 style="border:solid 1px #aaaaaa;margin-left:10px;"><FORM name="Accedi" method="post" action="tool.php" onSubmit="return chkvals()"><tr>
 <td class="TitSezione" align=center style="border-bottom:solid 1px #aaaaaa;">AREA RISERVATA</td>
</tr><tr>
 <td class="credit">Nome utente<br><input type="text" name="user" class="form" size=20><br>
  Password<br><input type="password" name="psw" class="form" size=10></td>
</tr><tr>
 <td align=left><input type="submit" name="pulsante" value="Accedi" class="form"></td>
</tr></table> 

<?
if ($_GET[ctrl] == 2){
echo "<span class=\"credit\">Login errato</span>";
}
?>


</BODY>
</HTML>