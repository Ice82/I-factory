<?
include("includes/db.php");
include("includes/libreria.php");
?>
<html>
<head>
<title>I-Factory :: WebAgency :: Bari (IT) :: Portfolio Clienti :: Costruzione portali web</title>
<meta name="description" content="I-Factory - WebAgency Bari - I nostri clineti, costruzione portali web puglia, posizionamento motori di ricerca."> 
<meta name="keywords" content="web agency bari,web bari,posizionamento sul web,servizi,accessibilità,promozione sito web,skills,i nostri clienti"> 
<meta name="Author" content="I-Factory - Web Agency - Bari (Italy)">
<meta name-equiv="Content-Language" CONTENT="IT">
<meta name="distribution" CONTENT="Global">
<meta name="revisit-after" CONTENT="5 days">
<meta name="robots" CONTENT="FOLLOW,INDEX">
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="includes/contentslider.css" />
<script type="text/javascript" src="includes/contentslider.js"></script>
<script language="javascript">AC_FL_RunContent = 0;</script>
<script src="AC_RunActiveContent.js" language="javascript"></script>
<!--[if lt IE 7]>
<script defer type="text/javascript" src="pngfix.js"></script>
<![endif]-->
<SCRIPT language=Javascript><!-- 
function bwcheck(){
	this.ver=navigator.appVersion;
	this.agent=navigator.userAgent
	this.dom=document.getElementById?1:0
	this.ie5=(this.ver.indexOf("MSIE 5")>-1 && this.dom)?1:0;
	this.ie6=(this.ver.indexOf("MSIE 6")>-1 && this.dom)?1:0;
	this.ie4=(document.all && !this.dom)?1:0;
	this.ie=this.ie4||this.ie5||this.ie6
	this.mac=this.agent.indexOf("Mac")>-1
	this.opera5=this.agent.indexOf("Opera 5")>-1
	this.ns6=(this.dom && parseInt(this.ver) >= 5) ?1:0; 
	this.ns4=(document.layers && !this.dom)?1:0;
	this.bw=(this.ie6 || this.ie5 || this.ie4 || this.ns4 || this.ns6 || this.opera5 || this.dom)
	return this
}
var bw=new bwcheck()
// sezione definizione geometria finestra
if (bw.ns4 || bw.ns6) {
 larghezzaFinestra = window.innerWidth; altezzaFinestra = window.innerHeight
}
else {
 larghezzaFinestra = document.all[0].offsetWidth - 22; altezzaFinestra = document.all[0].offsetHeight - 4
}
//alert(larghezzaFinestra +" - "+ altezzaFinestra);
var pageNonTable = (larghezzaFinestra - 800)/2
//alert(pageNonTable)
var margin = pageNonTable + 455;
if (margin < 490){
 margin = 495;
}

function mon(str) {
 window.status = str
}
function mout() {
 window.status = "i-F@ctory :: WebAgency :: Bari (IT)"
}
  function Cambia(valore){
   document.getElementById('modifica').src='work.php?id='+valore;
  }

//-->
</SCRIPT>
</head>
<BODY onLoad="mout();" onResize="setTimeout('document.location.reload()',500)";>
<SCRIPT> 
 if (bw.ns6 == 1){
  margin= margin-9 
  document.write("<div id='fla' align=center style='margin-left:"+margin+"px;'>");
 }else {
  document.write("<div id='fla' align=center style='margin-left:"+margin+"px;'>");
 }
</SCRIPT>
<script language="javascript">
	if (AC_FL_RunContent == 0) {
		alert("Questa pagina richiede AC_RunActiveContent.js.");
	} else {
		AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
			'width', '296',
			'height', '291',
			'src', 'top',
			'quality', 'high',
			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', 'transparent',
			'devicefont', 'false',
			'id', 'top',
			'name', 'top',
			'menu', 'true',
			'allowFullScreen', 'false',
			'allowScriptAccess','sameDomain',
			'movie', 'top',
			'salign', ''
			); //end AC code
	}
</script>
<noscript>
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="296" height="291" id="top" align="middle">
	<param name="allowScriptAccess" value="sameDomain">
	<param name="allowFullScreen" value="false">
	<param name="movie" value="top.swf">
	<param name="quality" value="high">
	<param name="wmode" value="transparent">
	<embed src="top.swf" quality="high" wmode="transparent" width="296" height="291" name="top" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer">
	</object>
</noscript>
</DIV>	
 <!-- start #header -->
<div id="header">
 <img src="entity/logo.png" border="0" Alt="I-Factory :: Web Agency :: Bari" style="margin-left:10px;margin-top:5px;">
 <DIV id="menu"><ul> 
  <li><a href="index.php" class="menu" onmouseOver="document.all['frc_home'].style.visibility='visible';window.status='Portfolio --> I nostri clienti';return true;" onmouseOut="document.all['frc_home'].style.visibility='hidden';mout();">Sweet Home</a> |
  <li><a href="profilo.php" class="menu" onmouseOver="document.all['frc_profilo'].style.visibility='visible';window.status='Profilo aziendale --> I-factory di Nicola Claudio Cellamare';return true;" onmouseOut="document.all['frc_profilo'].style.visibility='hidden';mout();">Profilo</a> |
  <li><a href="identity.php" class="menu" onmouseOver="document.all['frc_ide'].style.visibility='visible';window.status='Identity --> Brand Image';return true;" onmouseOut="document.all['frc_ide'].style.visibility='hidden';mout();">Identity</a> |
  <li><a href="search.php" class="menu" onmouseOver="document.all['frc_servizi'].style.visibility='visible';window.status='Servizi --> Servizi offerti';return true;" onmouseOut="document.all['frc_servizi'].style.visibility='hidden';mout();">Search Engine</a> |
  <li><span class="menuOff">Clienti</span> |
  <li><a href="blog.php" class="menu" onmouseOver="document.all['frc_blog'].style.visibility='visible';window.status='Blog --> Cosa succede in I-Factory';return true;" onmouseOut="document.all['frc_blog'].style.visibility='hidden';mout();">Blog</a> |
  <li><a href="sinergie.php" class="menu" onmouseOver="document.all['frc_sin'].style.visibility='visible';window.status='Sinergie --> Con chi collaboriamo...';return true;" onmouseOut="document.all['frc_sin'].style.visibility='hidden';mout();">Sinergie</a> |
  <li><a href="contatti.php" class="menu" onmouseOver="document.all['frc_con'].style.visibility='visible';window.status='Contatti --> Richiedi informazioni';return true;" onmouseOut="document.all['frc_con'].style.visibility='hidden';mout();">Contattaci</a>
 </DIV>

 <DIV id="frecce"><ul>
  <li id="frc_home"><img src="entity/factory_blu.png">
  <li id="frc_profilo"><img src="entity/factory_blu.png">
  <li id="frc_ide"><img src="entity/factory_blu.png">
  <li id="frc_servizi"><img src="entity/factory_blu.png">
  <li id="frc_port_off"><img src="entity/freccia_verde.png">
  <li id="frc_blog"><img src="entity/factory_blu.png">
  <li id="frc_sin"><img src="entity/factory_blu.png">
  <li id="frc_job"><img src="entity/factory_blu.png">
  <li id="frc_con"><img src="entity/factory_blu.png">
  </ul> 
 </DIV>
</div>
<!-- end #header -->

<!-- start #container -->
<center>
 <div id="container" style="height:640px;">


<DIV id="box_portfolio" style="margin-left:12px;width:424px;border:solid 0px #000000;">




<?
 $db = mysql_connect($db_host, $db_user, $db_pass) or die("Non riesco a connettermi al server <b>$db_host");
 if (!mysql_select_db($db_name,$db)) die ("Errore nella selezione del db");
 $query = "SELECT COUNT(ID) FROM Work";
 $result = mysql_query($query,$db);
 $riga = mysql_fetch_array($result);
 $totFile = $riga[0];
 //echo "File Totali: $totFile<br>";
 $limit = 6;
 //echo "Immagini per pagina: $limit<br>";
 $numPagine= ceil($totFile / ($limit-1));
 //echo "Numeri di pagina: $numPagine<br>";
 $modPagine = $totFile % $numPagine;
 //echo "Modulo della divisione :". $modPagine."<br>";
?>
<div id="slider2" class="sliderwrapper">
<?
 $n=1;  
 $query = "SELECT * FROM Work ORDER BY DATA DESC";
 $result = mysql_query($query,$db);
 while ($riga = mysql_fetch_array($result)) {
  
  if (($n>1) && ($n<$limit)){
   echo "<img src='../public/work/".$riga[ID]."/list.jpg' class=\"work_off\" border=0 onClick=\"Cambia(".$riga[ID].")\" Alt=\"".stripslashes($riga[TITOLO])."\" onmouseover=\"this.style.opacity=1;this.filters.alpha.opacity=100\" onmouseout=\"this.style.opacity=0.4;this.filters.alpha.opacity=40\">";
   $n=$n+1;
  }
  if ($n==1){
   echo "<div class=\"contentdiv\">";
   echo "<img src='../public/work/".$riga[ID]."/list.jpg' class=\"work_off\" border=0 onClick=\"Cambia(".$riga[ID].")\" Alt=\"".stripslashes($riga[TITOLO])."\" onmouseover=\"this.style.opacity=1;this.filters.alpha.opacity=100\" onmouseout=\"this.style.opacity=0.4;this.filters.alpha.opacity=40\">";
   $n=$n+1;
  }
  if ($n==$limit) {
   echo "</div>";
   $n=1;
   }

 }
 if ($modPagine > 0) echo "</div>";

?>




</div>

<!-- DIV NUMERI DI PAGINE - START-->
   <div id="paginate-slider2" class="pagination" style="margin-top:10px;">
   <? for($i=1;$i<=$numPagine;$i++){
   	echo "<a href=\"#\" class=\"toc\">".$i." </a>";
      }
   ?>
   </div>
<!-- DIV NUMERI DI PAGINE - END-->

<script type="text/javascript">
featuredcontentslider.init({
	id: "slider2",  //id of main slider DIV
	contentsource: ["inline", ""],  //Valid values: ["inline", ""] or ["ajax", "path_to_file"]
	toc: "markup",  //Valid values: "#increment", "markup", ["label1", "label2", etc]
	nextprev: ["Previous", "Next"],  //labels for "prev" and "next" links. Set to "" to hide.
	revealtype: "click", //Behavior of pagination links to reveal the slides: "click" or "mouseover"
	enablefade: [true, 0.2],  //[true/false, fadedegree]
	autorotate: [false, 3000],  //[true/false, pausetime]
	onChange: function(previndex, curindex){  //event handler fired whenever script changes slide
		//previndex holds index of last slide viewed b4 current (1=1st slide, 2nd=2nd etc)
		//curindex holds index of currently shown slide (1=1st slide, 2nd=2nd etc)
	}
})

</script>   

</DIV>

<DIV id="rightMiddle">
<div id="freccia" align=right><table border=0><tr>
  <td style="padding-right:8px;" align=right>
   <iframe id="modifica" style="width:302px;height:350px;" frameborder=0 src="work.php" border=1></iframe>
  </td>
  <td valign=top><img src="entity/freccia_lavori.png" vspace=0 hspace=0 align=right></td>
 </tr></table>
 
</div> 
 
</DIV>  

</div>
<!-- end #container -->

<!-- start #bottom -->
  <div id="bottom">
   
  </div>
<!-- end #bottom -->
</center>
 <!-- end #container -->
</BODY>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-3526732-1");
pageTracker._trackPageview();
</script>
</HTML>