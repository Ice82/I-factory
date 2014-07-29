<?php
include("../commonSetting.php");
include("../includes/conf.php");
include("../includes/libreria.php");
include("../class/userCls.php");
include("../class/generalClass.php");

If (($_SESSION['IsUserGood'] == False) || (!isset($_SESSION['user']))) {
	header("location: ../index.php?ctrl=2");
}

$ClsUser = new User();
$CG = new generalClass();
$pagREF = "ore_add.php";

$utente = $ClsUser->getUserByID($_SESSION['user']);

if ($_GET['task']== "enter") {
    $CG->addEnter($_GET['id']);
}
if ($_GET['task']== "exit") {
    $CG->addExit($_GET['id']);
}

if ($_GET['task']== "enter_night") {
    $CG->addEnterNight($_GET['id']);
}
if ($_GET['task']== "exit_night") {
    $CG->addExitNight($_GET['id']);
}

?>
<html>
<head>
<title><?php echo $nome_dominio;?> :: Pannello di Controllo</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="Author" content="I-Factory di Nicola Claudio Cellamare">
<META NAME="robots" CONTENT="index, follow"> <!-- (Robot commands: All, None, Index, No Index, Follow, No Follow) -->
<META NAME="revisit-after" CONTENT="2 days">
<META NAME="distribution" CONTENT="global">
<META NAME="rating" CONTENT="general">
<META NAME="Content-Language" CONTENT="italiano">

<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<meta http-equiv="Pragma" content="no-cache" />

<link href="../includes/tool.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="../css/jquery.autocomplete.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="../jsLibs/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="../jsLibs/ajax.js"></script>
<script type="text/javascript" src="../jsLibs/jquery.autocomplete.js"></script>

<script type="text/javascript">
function unMatchCity()
{
    $('#dipendenteID').val('0');
}

function noResult()
{
 $('#dipendente').val('1');
}

$(document).ready(function(){


    $('.exit').click(function() {
        var id = $(this).attr('id');
        var app = $('#app_'+id).val(); 
        var pda = $('#pda_'+id).val(); 
        
        if(app == ""){
            var app_c = confirm('Non sono stati fatti appuntamenti?');
        }else{
            var app_c = true
        }
        
        if(pda == ""){
            var app_p = confirm('Non sono stati conclusi pda?');
        }else{
            var app_p = true;
        }
        
        if((app_c) && (app_p)){
            if(app == "") app = 0;
            if(pda == "") pda = 0;
            var link = $(this).attr('href');
            link = link+'?task=exit&id='+id+'&app='+app+'&pda='+pda;
            $(this).attr('href',link);
            return true
        }else{
            return false;
        }
    });

});
</script>

<style>
label {
        font-size: 12px;
        font-weight: bold;
        color: #999
}
em { font-size: 11px; }
.subRow td { text-align: center; line-height: 16px; background-color: #e7e7e7; border: solid 1px #aaaaaa;}
.fieldRow td input { width: 66px; font-size: 12px; text-align:center; margin: 0px 5px; border: solid 1px #000000 }
#tableAdd td.title { text-align: right; padding-bottom: 5px; }


</style>
</head>
<BODY BGCOLOR="#FFFFFF" LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>
<TABLE CELLPADDING=0 CELLSPACING=1 BORDER=0 WIDTH=100% HEIGHT=100%><TR>
<TD WIDTH=1% HEIGHT=99% VALIGN=TOP style="border-right:solid 1px <?php echo $colore_pannello?>">
<!-- TABELLA TOP START -->
 <table cellpadding=0 cellspacing=0 border=0 height='60' width='176' style="border-bottom:solid 1px <?php echo $colore_pannello;?>"><tr>
  <td width=180 align=center>
        <?php if($logo != "no") {?>
      <a href="index.php"><img src="entity/<?php echo $logo;?>" border=0 Alt="<?php echo $nome_dominio;?> :: Home Pannello di controllo"></a>
  <?php }else{ ?>
      <a href="index.php" class="topItem" style="color:<?php echo $colore_pannello ?>;font-size: 15px;"><?php echo $intestazione;?></a>
  <?php } ?></td>
</tr></table>
<!-- TABELLA TOP END -->
<!-- MENU' START -->
 <table cellpadding=0 cellspacing=0 border=0 width=170><tr>
 <td><!-- MENU' START -->
  <?php include("menu.php")?>
 </td>
 </tr></table>
<!-- MENU' END -->
</TD>
 <TD WIDTH=99% HEIGHT="99%" VALIGN=TOP>
<table cellpadding=0 cellspacing=0 border=0 width=100% height=100%><tr>
<td height=1%><!-- TOP BODY START -->
 <table cellpadding=0 cellspacing=0 border=0 bgcolor="#BCBCBC" width=100% height=101 style='border-bottom:solid 2px <?php echo $colore_pannello;?>;'><tr>
 <td width=99% class='logo' height=100% style='padding-left:4px;padding-top:4px;'>
  <table cellpadding=0 cellspacing=0 border=0 width=99% height=100%><tr>
  <td height=50% class="logo" style='color:#000000;font-weight:normal;padding-bottom:7px;' valign=bottom>:: Pannello di Controllo ::</td>
  <td valign=bottom class='creditV' align=right style='padding-right:3px;'>Benvenuto: <b><?php echo $utente[0]['COGNOME'];?></b></td>
 </tr><tr>
  <td colspan=2 height=50% style='border-top:solid 1px <?php echo $colore_pannello;?>;border-right:solid 1px <?php echo $colore_pannello;?>;padding-bottom:25px;' valign=bottom align=right>
  <span class="logo" style='padding-bottom:3px;font-variant:small-caps;padding-left:10px;line-height:16px;font-weight:normal;letter-spacing:1px;color:<?php echo $colore_pannello;?>;'>:: <?php echo $nome_dominio;?> :: &nbsp;</span>
  </td>
 </tr></table>
 </td>
 <td width=1% style='padding-right:3px;'><img src="entity/img.jpg" vspace=0 hspace=0></td>
 </tr></table>
<!-- TOP BODY END --></td>
</tr><tr>
<td height=99%><!-- MIDDLE BODY START -->
<div class='testo' id='tool' style='height:100%;width:100%;margin:4px;background-color:#ffffff;'>
<strong>INSERISCI PRESENZA</strong><br />

<?php 
/*
<p>Inserire il totale delle ore nel formato HH:mm</p>
<br />
<?php 
if ($_GET['msg']== 1){
	echo '<div class="positive">Inserimento effettuato con successo!</div>';
}

$sede = $Clgeneral->getSediById($utente[0]['SEDE']);
?>
<?php echo $errori['mese']?>
<form action="ore_add.php" method="post">
<table cellpadding="1" cellspacing="1" border="0" id="tableAdd"><tr>
    <td class="title"><label>Data</label></td>
    <td><input name="data" value="<?php echo date("d/m/Y")?>" style="width: 80px; height: 20px; font-size: 12px; border: solid 1px #000000" /> <em>(gg/mm/aaaa)</em> <?php echo $errori['data']?></td>
</tr><tr>
    <td class="title"><label>Dipendente</label></td>
    <td><input type="text" name="dipendente" id="dipendente" style="width: 200px; font-size: 12px; height: 24px; border: solid 1px #000000" />
        <?php echo $errori['dipendenteID']?>
	<input type="hidden" name="dipendenteID" id="dipendenteID" />
    </td>
</tr><tr>
    <td class="title" valign="bottom"><label>Ore</label></td>
    <td>
        <table cellpadding="1" cellspacing="1"><tr class="subRow">
            <td><label>Giorno</label></td>
            <?php if($sede[0]['NOTTE'] == "SI"){?><td><label>Notte</label></td><?php } ?>
            <td><label>Prova</label></td>
        </tr><tr class="fieldRow">
            <td>
                <select name="ore_am">
                    <option value="">Scegli</option>
                    <?php
                    foreach($Clgeneral->ore AS $valore){
                        echo '<option value="'.$valore.':00">'.$valore.'</option>';
                    }
                    ?>
                </select>
            </td>
            <?php if($sede[0]['NOTTE'] == "SI"){?><td><select name="ore_pm">
                    <option value="">Scegli</option>
                    <?php
                    foreach($Clgeneral->ore AS $valore){
                        echo '<option value="'.$valore.':00">'.$valore.'</option>';
                    }
                    ?>
                </select></td><?php }?>
            <td>
                <select name="prova">
                    <option value="">Scegli</option>
                    <?php
                    foreach($Clgeneral->ore AS $valore){
                        echo '<option value="'.$valore.':00">'.$valore.'</option>';
                    }
                    ?>
                </select>
            </td>
                <td>Inserire le ore totali</td>
        </tr></table>
    </td>
    </tr><tr>
    <td class="title" valign="bottom"><label>Residenziale</label></td>
    <td>
        <table cellpadding="1" cellspacing="1"><tr class="subRow">
            <td><label>App.ti</label></td>
            <td><label>Pda</label></td>
        </tr><tr class="fieldRow">
            <td><input type="text" name="app_private" /></td>
            <td><input type="text" name="pda_private" /></td>
        </tr></table>
    </td>
<?php 
if($sede[0]['business']){ ?>
    </tr><tr>
    <td class="title" valign="bottom"><label>Business</label></td>
    <td>
        <table cellpadding="1" cellspacing="1"><tr class="subRow">
            <td><label>App.ti</label></td>
            <td><label>Pda</label></td>
        </tr><tr class="fieldRow">
            <td><input type="text" name="app_business" /></td>
            <td><input type="text" name="pda_business" /></td>
        </tr></table>
    </td>
<?php } ?>
    </tr><tr>
    <td colspan="2"><input type="hidden" name="sedeID" value="<?php echo $sede[0]['ID']?>" /><input type="submit" name="pulsante" value="Inserisci"></td>
</tr></table>
</form>

<div>
<h3>Presenze Giornaliere del <?php echo date("d/m/Y")?> [ <a href="ore_mod.php?data=<?php echo date("d/m/Y")?>">Modifica presenze giorno</a> ]</h3>
<table cellpadding="1" cellspacing="1" border="0"><tr class="intestazione">
	<th>Dipendente</th>
	<th>Ore</th>
	<th>Appuntamenti</th>
        <th>Pda</th>
</tr>
<?php 
	$presenze = $Clgeneral->getPresenzeByData(date("Y-m-d"));
        
	if ($presenze){
		foreach($presenze AS $item){
			$dip = $Clgeneral->getDipendenteById($item['dipendenteID']);
			echo '<tr class="intestazione"><form method="post" action="ore_add.php">';
			echo '<td>'.stripslashes($dip[0]['COGNOME']).' '.stripslashes($dip[0]['NOME']).'</td>';
			echo '<td>'.$item['ore_am'];
                        if($sede[0]['NOTTE'] == "SI") echo ' / '.$item['ore_pm'];
                        echo ' / '.$item['prova'];
                        echo '</td>';
			echo '<td align=center>'.$item['app_private'];
                        if($sede[0]['business'])
                                echo ' / '.$item['app_business'];
                        echo '</td>';
                        echo '<td>'.$item['pda_private'];
                        if($sede[0]['business'])
                            echo ' / '.$item['pda_business'];
                        echo '</td>';
			echo '<td><input type="hidden" name="id" value="'.$item['ID'].'">';
			echo '<input type="submit" name="pulsante" value="Elimina" /></td>';
			echo '</form></tr>';
		}
	}
?>
</table>

*/
?>
<h3>Presenze del giorno <?php echo date("d.m.Y")?>
<br />
<table cellpadding="1" cellspacing="1" border="1" style="margin-top: 15px; float: left; margin-right: 20px;"><tr>
    <td class="title" colspan="5" style="background-color: #ccc;text-align:center">GIORNO</td>
</tr><tr>        
    <td class="title">Dipendente</td>
    <td class="title">Lavoro</td>
    <td class="intestazione">Entrata</td>
    <td class="intestazione">Uscita</td>
    <td class="intestazione">Ore Lavorate</td>
</tr>
<?php

if ($utente[0]['TYPE'] == 1)
    $dipendenti = $CG->getAssuntiView("");
else
    $dipendenti = $CG->getAssuntiView($_SESSION['user']);
//$CG->printR($dipendenti);
if($dipendenti){
    foreach($dipendenti AS $item){
        $result = $CG->esistePresenzaDIP($item['ID'], date("Y-m-d"));
        //$CG->printR($result);
        $exit = ($result[0]['inizio']) ? '<a href="'.$pagREF.'?task=exit&id='.$item['ID'].'" class="exit" id="'.$item['ID'].'"><img src="../entity/exit.png" border="0" style="width:20px; border:0px;" /></a>' : $result['fine'];
        $enter = ($result[0]['inizio']) ? $result[0]['inizio'] : '<a href="'.$pagREF.'?task=enter&id='.$item['ID'].'"><img src="../entity/enter.png" border="0" style="width:20px;" /></a>';
        if($result[0]['fine'])
            $exit = $result[0]['fine'];
        echo '<tr>
            <td class="testo">'.stripslashes($item['fullname']).'</td>
            <td class="testo">'.stripslashes($item['lavoroNome']).'</td>
            <td class="testo" style="text-align:center;">'.$enter.'</td>
            <td class="testo" style="text-align:center;">'.$exit.'</td>
            
        </tr>';
        
    }
}

?>
</table>

<table cellpadding="1" cellspacing="1" border="1" style="margin-top: 15px;"><tr>
    <td class="title" style="background-color: #ccc;text-align: center;" colspan="5">NOTTE</td>
</tr><tr>        
    <td class="title">Dipendente</td>
    <td class="title">Lavoro</td>
    <td class="intestazione">Entrata</td>
    <td class="intestazione">Uscita</td>
    <td class="intestazione">Ore Lavorate</td>
</tr>
<?php

if ($utente[0]['TYPE'] == 1)
    $dipendenti = $CG->getAssuntiView("");
else
    $dipendenti = $CG->getAssuntiView($_SESSION['user']);
//$CG->printR($dipendenti);
if($dipendenti){
    foreach($dipendenti AS $item){
        $result = $CG->esistePresenzaDIP($item['ID'], date("Y-m-d"));
        //$CG->printR($result);
        $exit_notte = ($result['inizio_notte']) ? '<a href="'.$pagREF.'?task=exit_night&id='.$item['ID'].'" class="exit" id="'.$item['ID'].'"><img src="../entity/exit.png" border="0" style="width:20px; border:0px;" /></a>' : $result['fine_notte'];
        $enter_notte = ($result['inizio_notte']) ? $result[0]['inizio_notte'] : '<a href="'.$pagREF.'?task=enter_night&id='.$item['ID'].'"><img src="../entity/enter.png" border="0" style="width:20px;" /></a>';
        if($result[0]['fine'])
            $exit = $result[0]['fine'];
        echo '<tr>
            <td class="testo">'.stripslashes($item['fullname']).'</td>
            <td class="testo">'.stripslashes($item['lavoroNome']).'</td>
            <td class="testo" style="text-align:center;">'.$enter_notte.'</td>
            <td class="testo" style="text-align:center;">'.$exit_notte.'</td>
            
        </tr>';
        
    }
}

?>
</table>



</div>

</div><!-- MIDDLE BODY START --></td>
</tr></table>
 </TD>
</TR><TR>
 <TD HEIGHT=1% COLSPAN=2 align=center bgcolor="#BCBCBC" class='testo' style='padding-top:6px;padding-bottom:2px;border-top:solid 3px <?php echo $colore_pannello;?>'>
 Copyright 2008 :: <?php echo $nome_dominio;?> :--: Created by <a href="http://www.i-factory.biz/" target=new class="testo">i-F@ctory</a> &#149; Control Panel ver. 1.0</TD>
</TR></TABLE>
</BODY>
</HTML>