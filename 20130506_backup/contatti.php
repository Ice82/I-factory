<html>
<head>
<title>I-Factory :: WebAgency :: Bari (IT) :: Contatti Aziendali :: Costruzione portali web</title>
<meta name="description" content="I-Factory - WebAgency Bari - Costruzione portali web puglia, posizionamento motori di ricerca, come raggiungerci"> 
<meta name="keywords" content="web agency bari,Puglia,web bari,posizionamento sul web,servizi,mappa città di Bari, mappa bari,contatti aziendali,come contattarci"> 
<meta name="Author" content="I-Factory - Web Agency - Bari (Italy)">
<meta name-equiv="Content-Language" CONTENT="IT">
<meta name="distribution" CONTENT="Global">
<meta name="revisit-after" CONTENT="5 days">
<meta name="robots" CONTENT="FOLLOW,INDEX">
<link rel="stylesheet" type="text/css" href="style.css">
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAU-WoHnJXeQfBwjHrdhBaSxRD8tU45vrk5yYeZd2VvB29wcHG7hTSGMGZj7rEtoEq9Z1nythg2iA65w" type="text/javascript"></script>
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
var pageNonTable = (larghezzaFinestra - 800)/2
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

function chkvals() {
 var warn = ""
 ret_val = true
   if (document.forms['form_contatti'].cognome.value.length <= 0) warn += ":.. Cognome e Nome\r"
   if (document.forms['form_contatti'].telefono.value.length <= 0) warn += ":.. Numero di telefono\r"
   if (document.forms['form_contatti'].citta.value.length <= 0) warn += ":.. Città\r"
   if (document.forms['form_contatti'].messaggio.value.length <= 0) warn += ":.. Informazione da richiedere\r"
   if (!(document.forms['form_contatti'].consenso.checked)) warn += ":.. Consenso Privacy\r"

  if (warn.length >= 1) {
  alert_str = "Hai dimenticato i seguenti campi:\r" + warn
  alert(alert_str)
  ret_val = false
  //alert(ret_val)
 }
 else {
  e_ad = document.forms['form_contatti'].email.value;
  e_ad_l = document.forms['form_contatti'].email.value.length - 2
  var at_pos_l = e_ad.indexOf('@');
  var at_pos_r = e_ad.lastIndexOf('@');
  var atdot_pos = e_ad.indexOf('@.');
  var warn = "";
  if (atdot_pos >= 0) warn += " - Sequenza '@.' non valida\r"
  else {
   if (at_pos_l <= -1) warn += " - Manca il carattere @\r"
   else {
    if (at_pos_l != at_pos_r) warn += " - Ha piu' di un carattere @\r"
    else {
     if (at_pos_l <= 0) warn += " - Almeno un carattere prima dell'@\r"
     else {
      if (at_pos_l >= e_ad_l) warn += " - Almeno due caratteri dopo l'@\r"
     }
    }
   }
  }
  if (warn.length >= 1) {
   alert_str = "Errori nell'indirizzo e-mail:\r " + e_ad + "\r" + warn
   alert_str += "\rEsempi di indirizzi validi:\r";
   alert_str += "- nome.cognome@provider.it\r";
   alert_str += "- user@net.a.com\n";
   alert_str += "N.B. Verificare anche i caratteri maiuscoli e minuscoli\n"
   alert(alert_str);
   ret_val = false
  }
 }
 return ret_val
 alert(ret_val)
}

    function initialize() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("mappa_headquarter"));
        map.setCenter(new GLatLng(41.12168,16.87355), 11);
        map.addControl(new GSmallMapControl());
        map.addControl(new GMapTypeControl());
        
        // Create our "tiny" marker icon
        var blueIcon = new GIcon(G_DEFAULT_ICON);
        blueIcon.image = "http://gmaps-samples.googlecode.com/svn/trunk/markers/blue/blank.png";
	// Set up our GMarkerOptions object
	markerOptions = { icon:blueIcon };
        var latlng = new GLatLng(41.12168,16.87355);
        map.addOverlay(new GMarker(latlng, markerOptions));
      }
    }
//-->

</SCRIPT>

</head>
<BODY onLoad="mout();initialize();" onResize="setTimeout('document.location.reload()',500);" onUnload="GUnload()">

<SCRIPT><!-- 
 if (bw.ns6 == 1){
  margin= margin-9 
  document.write("<div id='fla' style='margin-left:"+margin+"px;text-align:center;'><center><div id=\"mappa_headquarter\" style=\"width:296px;height:287px;\"></div></center></div>");
 }else {
  document.write("<div id='fla' style='margin-left:"+margin+"px;text-align:center;'><center><div id=\"mappa_headquarter\" style=\"width:296px;height:287px;\"></center></div></div>");
 }
//-->
</script>

	
 <!-- start #header -->
<div id="header">
 <img src="entity/logo.png" border="0" Alt="I-Factory :: Web Agency :: Bari" style="margin-left:10px;margin-top:5px;">
 <DIV id="menu"><ul> 
  <li><a href="index.php" class="menu" onmouseOver="document.all['frc_home'].style.visibility='visible';window.status='Portfolio --> I nostri clienti';return true;" onmouseOut="document.all['frc_home'].style.visibility='hidden';mout();">Sweet Home</a> |
  <li><a href="profilo.php" class="menu" onmouseOver="document.all['frc_profilo'].style.visibility='visible';window.status='Profilo aziendale --> I-factory di Nicola Claudio Cellamare';return true;" onmouseOut="document.all['frc_profilo'].style.visibility='hidden';mout();">Profilo</a> |
  <li><a href="identity.php" class="menu" onmouseOver="document.all['frc_ide'].style.visibility='visible';window.status='Identity --> Brand Image';return true;" onmouseOut="document.all['frc_ide'].style.visibility='hidden';mout();">Identity</a> |
  <li><a href="search.php" class="menu" onmouseOver="document.all['frc_servizi'].style.visibility='visible';window.status='Servizi --> Servizi offerti';return true;" onmouseOut="document.all['frc_servizi'].style.visibility='hidden';mout();">Search Engine</a> |
  <li><a href="clienti.php" class="menu" onmouseOver="document.all['frc_port'].style.visibility='visible';window.status='Portfolio --> I nostri clienti';return true;" onmouseOut="document.all['frc_port'].style.visibility='hidden';mout();">Clienti</a> |
  <li><a href="blog.php" class="menu" onmouseOver="document.all['frc_blog'].style.visibility='visible';window.status='Blog --> Cosa succede in I-Factory';return true;" onmouseOut="document.all['frc_blog'].style.visibility='hidden';mout();">Blog</a> |
  <li><a href="sinergie.php" class="menu" onmouseOver="document.all['frc_sin'].style.visibility='visible';window.status='Sinergie --> Con chi collaboriamo...';return true;" onmouseOut="document.all['frc_sin'].style.visibility='hidden';mout();">Sinergie</a> |
  <li><span class="menuOff">Contattaci</span>
 </DIV>

 <DIV id="frecce"><ul>
  <li id="frc_home"><img src="entity/factory_blu.png">
  <li id="frc_profilo"><img src="entity/factory_blu.png">
  <li id="frc_ide"><img src="entity/factory_blu.png">
  <li id="frc_servizi"><img src="entity/factory_blu.png">
  <li id="frc_port"><img src="entity/factory_blu.png">
  <li id="frc_blog"><img src="entity/factory_blu.png">
  <li id="frc_sin"><img src="entity/factory_blu.png">
  <li id="frc_job"><img src="entity/factory_blu.png">
  <li id="frc_con_off"><img src="entity/freccia_verde.png">
  </ul> 
 </DIV>
</div>
<!-- end #header -->

<!-- start #container -->
<center>
 <div id="container" style="height:670px;">
   <div id="box_portfolio" style="text-align:left;height:300px;">
   
   <div class="textBoxG">Per rispondere meglio alle tue esigenze puoi contattarci ai seguenti indirizzi mail:<P>
	<p style="margin:0px;border:0px;line-height:20px;margin-left:5px;"><a href="mailto:info@i-factory.biz" class="textBoxG"><b>info@i-factory.biz:</b></a><br> &nbsp; per richiesta informazioni generiche</p>
	<p style="margin:0px;border:0px;line-height:20px;margin-left:5px;"><a href="mailto:tecnical@i-factory.biz" class="textBoxG"><b>tecnical@i-factory.biz</b></a><br> &nbsp; per richiesta informazioni di carattere tecnico </p>
	<p style="margin:0px;border:0px;line-height:20px;margin-left:5px;"><a href="mailto:commercial@i-factory.biz" class="textBoxG"><b>commercial@i-factory.biz</b></a><br> &nbsp; per richiesta preventivi</p>
	<p style="margin:0px;border:0px;line-height:20px;margin-left:5px;"><a href="mailto:job@i-factory.biz" class="textBoxG"><b>job@i-factory.biz</b></a><br> &nbsp; lavora con noi</p>
   </div>

   <?
   if ($_GET[ctr]==1){
    echo "<P><span class='work'><b>Richiesta inviata correttamente...</b><br>Al più presto sarai contattato da un nostro responsabile</span>";
   }
   ?>
   
   <div class="textBoxG" style="margin-top:40px;"><b>Headquarters</b><br>
   Via Cardassi, 14 (1st floor)<br>
   70125 BARI (Italy)<br>
   tel (+39) 080.5240790<br>
   fax (+39) 080.9756910<br>
   mob (+39) 393.9934643<br>
   <table cellpadding=1 cellspacing=2 border=0 style="margin-top:8px;margin-left:8px;">
   <tr><td><img src="entity/mail.jpg" Alt="E-mail referente aziendale"></td><td><a href="mailto:info@i-factory.biz?subject=Richiesta informzioni dal sito" class="textBoxG" onmouseOver="window.status='Richiedi informazioni';return true;" onmouseOut="mout();"> info@i-factory.biz</a></td></tr>
   <tr><td><img src="entity/skype.gif"></td><td><a href="skype:factorybari?call" class="textBoxG" onmouseOver="window.status='Chiamaci tramite Skype';return true;" onmouseOut="mout();"> factorybari</a></td></tr>
   <tr><td><img src="entity/vcard.jpg"></td><td><a href="i-factory.vcf" class="textBoxG" onmouseOver="window.status='Scarica la nostra vCard';return true;" onmouseOut="mout();"> Vcard i-factory</a></td></tr>
   </table>
   </div>
   
   
   </div> 


<DIV id="rightMiddle">
 <div id="freccia" align=right><table border=0><tr><td style="padding-right:10px;" class="titleSotBox">Richiesta informazioni</td><td><img src="entity/freccia_lavori.png" vspace=0 hspace=0 align=right></td></tr></table></div>
 <div id="lastWork" style="padding:2px;text-align:justify;height:325px;border:0px;" class="textBoxG">
  Se vuoi ricevere informazioni o richiedere un preventivo, compila la seguente form elettronica e sarai contattato al più presto da un nostro responsabile.<br>
  (*) Campi obbligatori
 <div name="form" style="margin-top:5px;display:block;"><FORM action="invia.php" method="post" name="form_contatti" onSubmit="return chkvals();"><table><tr>
  <td class="textBoxG" colspan=2>Cognome Nome / Ragione sociale *<br><input type=text name="cognome" size=46 class="form"></td>
 </tr><tr>
  <td class="textBoxG" >Indirizzo<br><input type=text name="indirizzo" size=25 class="form"></td>
  <td class="textBoxG">Città <br><input type=text name="citta" size=17 class="form"></td>
 </tr><tr>
  <td class="textBoxG">E-mail *<br><input type=text name="email" size="25" class="form"></td>
  <td class="textBoxG">Telefono<br><input type=text name="telefono" size="17" class="form"></td>
 </tr><tr>
  <td class="textBoxG" colspan=2>Messaggio<br><TEXTAREA name="messaggio" cols=43 rows=5 class="form"></TEXTAREA></td>
 </tr><tr>
  <td colspan=2><table cellpadding=0 cellspacing=0 border=0><tr><td valign=top><input type="checkbox" name="consenso" class="form"></td>
    <td class="textBoxG" style="padding-left:3px;">Autorizzo la I-F@ctory al trattamento dei dati personali <br>in conformità alla legge 196/2003 sulla privacy.</td>
   </tr></FORM></table></td>
 </tr><tr>
  <td><input type="button" name="pulsante" value="SEND" class="form"></td>
 </tr></table></FORM></div>
 
  
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