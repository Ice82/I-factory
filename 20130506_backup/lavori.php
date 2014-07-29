<?
include("includes/db.php");
include("includes/libreria.php");
?>
<html>
<head>
<title>I-Factory :: WebAgency :: Bari (IT) :: Portfolio Clienti :: Costruzione portali web</title>

<!--[if lt IE 7]>
<script defer type="text/javascript" src="pngfix.js"></script>
<![endif]-->
</head>

<body>

<div style="margin: auto; width: 412px; height: auto;">
<?
 $db = mysql_connect($db_host, $db_user, $db_pass) or die("Non riesco a connettermi al server <b>$db_host");
 if (!mysql_select_db($db_name,$db)) die ("Errore nella selezione del db");
 $query = "SELECT * FROM Work ORDER BY DATA DESC";
 $result = mysql_query($query,$db);
 while ($riga = mysql_fetch_array($result)) {
   echo '<img src="../public/work/'.$riga[ID].'/list.jpg" style="margin: 10px 0px;" border=0 Alt="'.stripslashes($riga[TITOLO]).'" />';
 }
?>
    <div style="clear: both; overflow: hidden;"></div>
</div>

</BODY>
</HTML>