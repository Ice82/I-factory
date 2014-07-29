<?
include_once("../includes/db.php");
include_once("../includes/libreria.php");
include_once("../includes/class.php");
session_start();
If (($_SESSION['IsUserGood'] == False) || (!isset($_SESSION['user']))) {
	header("location: ../tool.php?ctrl=2"); 
}



?>
<html>
<head>
<title>I-FACTORY >> TOOL</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="Author" content="I-Factory di Nicola Claudio Cellamare">
<META NAME="robots" CONTENT="index, follow"> <!-- (Robot commands: All, None, Index, No Index, Follow, No Follow) -->
<META NAME="revisit-after" CONTENT="2 days">
<META NAME="distribution" CONTENT="global">
<META NAME="rating" CONTENT="general">
<META NAME="Content-Language" CONTENT="italiano">
<LINK href="../style.css" rel=STYLESHEET type=text/css>
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
 window.status = "Pannello di Controllo :: I-FACTORY.biz"
}

//-->
</SCRIPT>

</head>
<BODY BGCOLOR="#FFFFFF" LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0 onLoad="mout();">
<img src="factory.jpg" style="margin-left:10px;margin-top:2px;"><P>
<table border=0 width=20% align=left style="border:solid 1px #aaaaaa;margin-left:10px;"><tr>
 <td class="TitSezione" style="border-bottom:solid 1px #aaaaaa;">MENU'</td>
</tr><tr>
 <td class="credit" style="padding-left:10px;" nowrap>
  &#149; <a href="blog_add.php" class="credit">Blog add</a><br>
  &#149; <a href="blog_mod.php" class="credit">Blog mod</a><br>
  <P>&#149; <a href="work_add.php" class="credit">Work add</a><br>
  &#149; <a href="work_mod.php" class="credit">Work mod</a><br>
</td>
</tr></table> 

<table border=0 width=70% height=70% align=left style="border:solid 1px #aaaaaa;margin-left:10px;"><tr>
 <td class="TitSezione" height=1% style="border-bottom:solid 1px #aaaaaa;">WORK ADD :: PANNELLO DI CONTROLLO</td>
</tr><tr>
 <td class="credit" height=69% style="padding:2px;" valign=top>
  <FORM name="Inserisci" method="post" action="work_add.php" enctype="multipart/form-data">
   <span class="label">Titolo</span><br>
   <input type="text" name="titolo" class="form" size="50"><br>
   <span class="label">Data</span><br>
   <input type="text" name="data" class="form" size="10"><br>
   <span class="label">Descrizione</span><br>
   <TEXTAREA name="testo" cols="70" rows="7" class="form"></TEXTAREA><br>
   <span class="label">Immagine project</span><br>
   <input type="file" name="file1" class="form"><br>
   <span class="label">Immagine list</span><br>
   <input type="file" name="file2" class="form"><br>
   <span class="label">Website</span><br>
   <input type="text" name="website" class="form"><br>
   <input type="submit" name="pulsante" value="Inserisci" class="form">
  </FORM>
  <?php
  
if ($_POST[pulsante]=="Inserisci"){
 $db = mysql_connect($db_host, $db_user, $db_pass) or die("Non riesco a connettermi al server <b>$db_host");
 if (!mysql_select_db($db_name,$db)) die ("Errore nella selezione del db");
 $query = "INSERT INTO Work (TITOLO,DATA,TESTO,WEBSITE) values ('".addslashes(strip_tags($_POST['titolo']))."', '".data_sql($_POST['data'])."', '".addslashes(strip_tags($_POST['testo']))."', '".addslashes(strip_tags($_POST['website']))."')";
 mysql_query($query,$db) or die("Query non valida: " . mysql_error());
 // Prelevo l'id della query e creo la cartella dell'articolo
 $id = mysql_insert_id($db);


 // Creo la cartella per l'articolo
 mkdir("../public/work/$id", 0777);
 $image_dir = "../public/work/$id";
 // Classe per l'upload immagine
 $classe = "IMAGE";
 $Sample = new $classe;
 $Sample->UpImgs($image_dir,$_FILES['file1']['name'],$_FILES['file1']['tmp_name'],'project');
 $Sample->UpImgs($image_dir,$_FILES['file2']['name'],$_FILES['file2']['tmp_name'],'list');
 //UPDATE DI WORK PER LE IMMAGINI
 $query = "UPDATE Work SET IMAGE_PROGETTO='".$_FILES['file1']['name']."', IMAGE_LIST='".$_FILES['file2']['name']."' WHERE ID='".$id."'";
 mysql_query($query,$db) or die("Query non valida: " . mysql_error());
  mysql_close($db);
}
  ?>
</td>
</tr></table> 
</BODY>
</HTML>