<?
include("includes/db.php");
include("includes/libreria.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body style="margin:0px;background-repeat:no-repeat;background-color:#ffffff;background-image:none;">
<?
 $db = mysql_connect($db_host, $db_user, $db_pass) or die("Non riesco a connettermi al server <b>$db_host");
 if (!mysql_select_db($db_name,$db)) die ("Errore nella selezione del db");
 if ($_GET[id] == ""){
  $query = "SELECT * FROM Work ORDER BY DATA DESC LIMIT 0,1";
 }else {
  $query = "SELECT * FROM Work WHERE ID=".$_GET[id]."";
 }
 $result = mysql_query($query,$db);
 while ($riga = mysql_fetch_array($result)) {
?>  
  <div id="lavoro" style="text-align:right;border:solid 0px #000000;padding:0px;">
   <span class="work"><?echo stripslashes($riga[TITOLO]);?></span>
   <br><span class="textBoxG"><?echo data_it($riga[DATA]);?></span>
   <br><span class="textBoxV" style="font-weight:normal;"><?php echo stripslashes($riga[TESTO]);?></span>
   <br><img src="../public/work/<?echo $riga[ID];?>/project.jpg" border=0 vspace=0 hspace=0 style="border:solid 1px #aaaaaa;">
   <a href="<?echo $riga[WEBSITE];?>" target=new class="textBoxC"><?echo $riga[WEBSITE];?></a>
  </div>
<? 
 }
?>
</>