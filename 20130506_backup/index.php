<?
include("includes/db.php");
include("includes/libreria.php");
?>
<html>
<head>
<title>I-Factory :: WebAgency :: Bari (IT) :: Home Page :: Costruzione portali web</title>
<meta name="description" content="I-Factory - WebAgency - Costruzione siti web, posizionamento motori di ricerca. Portali web dinamici, siti web dinamico"> 
<meta name="keywords" content="web agency bari,web,posizionamento sul web,posizionamento,search engine,marketing web,comunicazione sul web,e-commerce,formazione bari,ecdl,agenzia web,portali dinamici bari"> 
<meta name="Author" content="I-Factory - Web Agency - Bari (Italy)">
<meta name-equiv="Content-Language" CONTENT="IT">
<meta name="distribution" CONTENT="Global">
<meta name="revisit-after" CONTENT="5 days">
<meta name="robots" CONTENT="FOLLOW,INDEX">
<script language="javascript">AC_FL_RunContent = 0;</script>
<script src="AC_RunActiveContent.js" language="javascript"></script>
<link rel="stylesheet" type="text/css" href="style.css">
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
  <li><span class="menuOff">Sweet Home</span> |
  <li><a href="profilo.php" class="menu" onmouseOver="document.all['frc_profilo'].style.visibility='visible';window.status='Profilo aziendale --> I-factory di Nicola Claudio Cellamare';return true;" onmouseOut="document.all['frc_profilo'].style.visibility='hidden';mout();">Profilo</a> |
  <li><a href="identity.php" class="menu" onmouseOver="document.all['frc_ide'].style.visibility='visible';window.status='Identity --> Brand Image';return true;" onmouseOut="document.all['frc_ide'].style.visibility='hidden';mout();">Identity</a> |
  <li><a href="search.php" class="menu" onmouseOver="document.all['frc_servizi'].style.visibility='visible';window.status='Servizi --> Servizi offerti';return true;" onmouseOut="document.all['frc_servizi'].style.visibility='hidden';mout();">Search Engine</a> |
  <li><a href="clienti.php" class="menu" onmouseOver="document.all['frc_port'].style.visibility='visible';window.status='Portfolio --> I nostri clienti';return true;" onmouseOut="document.all['frc_port'].style.visibility='hidden';mout();">Clienti</a> |
  <li><a href="blog.php" class="menu" onmouseOver="document.all['frc_blog'].style.visibility='visible';window.status='Blog --> Cosa succede in I-Factory';return true;" onmouseOut="document.all['frc_blog'].style.visibility='hidden';mout();">Blog</a> |
  <li><a href="sinergie.php" class="menu" onmouseOver="document.all['frc_sin'].style.visibility='visible';window.status='Sinergie --> Con chi collaboriamo...';return true;" onmouseOut="document.all['frc_sin'].style.visibility='hidden';mout();">Sinergie</a> |
  <li><a href="contatti.php" class="menu" onmouseOver="document.all['frc_con'].style.visibility='visible';window.status='Contatti --> Richiedi informazioni';return true;" onmouseOut="document.all['frc_con'].style.visibility='hidden';mout();">Contattaci</a>
 </DIV>

 <DIV id="frecce"><ul>
  <li id="frc_home_off"><img src="entity/freccia_verde.png">
  <li id="frc_profilo"><img src="entity/factory_blu.png">
  <li id="frc_ide"><img src="entity/factory_blu.png">
  <li id="frc_servizi"><img src="entity/factory_blu.png">
  <li id="frc_port"><img src="entity/factory_blu.png">
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
  
   <div id="box_centrale">
    <div id="box_text" style="text-align:justify;"><span class="titleBox">Search Engine</span><br>
     <span class="titleSotBox">Motori di Ricerca e Posizionamento</span><br>
     <span class="textBox">I motori di ricerca (es. Google) sono l�applicazione pi� usata dai Consumatori per formarsi impressioni sui prodotti e servizi prima di decidere per essi ed eventualmente comperarli.Hai una nuova attivit� e necessiti di maggiore visibilit�? Hai gi� un Sito o Portale Web? Quale termine, per�, viene maggiormente utilizzato nelle ricerche?  Con che  frequenza?
     <br>Numerose le  tecniche adottate per un�indicizzazione ottimale del proprio Sito o Portale Web.  </span><br>
     <span class="textBoxC">Richiedi una consulenza professionale<br>Inserisci la tua Mail e l'indirizzo del tuo sito</span><br>
     <table cellpadding=1 cellspacing=1 border=0 style="margin-top:10px;"><tr><FORM name="Invia" action="invia.php" method="post">
      <td class="textBox">E-mail<br><input type="text" name="email" class="form" size="25"></td>
      <td class="textBox">Nome Dominio<br><input type="text" name="website" class="form" size=25 value="http://"></td>
      <td valign=bottom style="padding-bottom:2px;"><input type="image" src="entity/invia.png"></td></FORM></tr></table>
    </div>
   </div> 


<DIV id="rightMiddle">

<DIV id="lastWork" style="height:60px;text-align:right;margin-top:0px;border:0px;">
<!-- AddThis Button BEGIN -->
<script type="text/javascript">var addthis_pub = "factory";</script>
<a href="http://www.addthis.com/bookmark.php" onmouseover="return addthis_open(this, '', '[URL]', '[TITLE]')" onmouseout="addthis_close()" onclick="return addthis_sendto()"><img src="http://s7.addthis.com/static/btn/lg-bookmark-en.gif" width="125" height="16" border="0" alt="" /></a><script type="text/javascript" src="http://s7.addthis.com/js/152/addthis_widget.js"></script>
<!-- AddThis Button END -->
<br><a href="http://www.facebook.com/pages/I-factorybiz/45057166015?ref=ts" target="new"><img src="entity/facebook.gif" border=0 alt="I-factory � su Facebook"></a>
</DIV>
 
 <div id="freccia" align=right><table border=0><tr><td style="padding-right:10px;" class="titleSotBox">Ultimo Lavoro</td><td><img src="entity/freccia_lavori.png" vspace=0 hspace=0 align=right></td></tr></table></div>
 
 <div id="lastWork" style="height:240px;clear:both;">
 <?
 $db = mysql_connect($db_host, $db_user, $db_pass) or die("Non riesco a connettermi al server <b>$db_host");
 if (!mysql_select_db($db_name,$db)) die ("Errore nella selezione del db");
 $query = "SELECT * FROM Work ORDER BY DATA DESC LIMIT 0,1";
 $result = mysql_query($query,$db);
 while ($riga = mysql_fetch_array($result)) {
  echo "<a href=\"clienti.php\"><img src='../public/work/".$riga[ID]."/project.jpg' border=0 vspace=0 hspace=0 Alt=\"".$riga[TITOLO]."\"></a>";
 }
 ?>
 
 
 </div>
 

</DIV>  

<div id="box_formazione">
    <div id="box_text" style="text-align:justify;margin-top:35px;"><span class="titleBoxV">Formazione</span><br>
     <span class="titleSotBox">Corsi di Formazione Professionale</span><br>
     <span class="textBoxG">I-Factory svolge attivit� di formazione presso enti privati e pubblici per Livelli Base, Intermedi e Avanzati.</span><br>
     <span class="textBoxC">Per maggiori informazioni contattaci</span><a href="contatti.php"><img src="entity/invia.png" border=0 align=absmiddle vspace=0 hspace=4 Alt="I-Factory :: Web Agency :: Formazione"></a>
    </div>
</div>

</div>
<!-- end #container -->

<!-- start #bottom -->
  <div id="bottom">
   <div id="credits" class="textBoxG" style="font-weight:normal;">I-factory di Nicola Claudio Cellamare :: P.IVA 06132490720 :: <a href="mailto:info@i-factory.biz" class="textBoxG" style="font-weight:bold;">info@i-factory.it</a></div>
  </div>
<!-- end #bottom -->
</center>
 <!-- end #container -->
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-3526732-1");
pageTracker._trackPageview();
</script>
</BODY>
</HTML>