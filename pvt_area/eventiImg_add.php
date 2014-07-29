<?php 
include("../commonSetting.php");
If (($_SESSION['IsUserGood'] == False) || (!isset($_SESSION['user']))) {
	header("location: ../".$SETTING->pageIndex."?logout=0"); 
}

// Mi permette di prelevare il menù di sinistra
$mod = 12;

if($_POST['pulsante'] == "Inserisci"){
	$errori = array();
	//$HP->printR($_FILES); 
	if ( !isset($_FILES['immagine']['name']) || ($_FILES['immagine']['name'] == "")) $errori['immagine'] = '<span class="system negative">Scegli immagine</span>';
	if ( !isset($_POST['descrizione']) || ($_POST['descrizione'] == "")) $errori['descrizione'] = '<span class="system negative">Inserisci descrizione</span>';

	if (count($errori)<1){
		$result = $CNT->addImgEvento($_POST,$_FILES);
		if($result){
			$HP->printR($result);
			$HP->printR($CNT->getErrors());	
		} else{
			header("location: eventiImg_add.php?evento=".$_POST['evento']);
		}
	}
}

if ($_GET['task'] == "elimina"){
		$result = $CNT->deleteImageEvento($_GET['image']);
		if ($result == 0)
			$HP->printR($CNT->getErrors());
		else
			header("location: eventiImg_add.php?evento=".$_GET['evento']);
}

if($_POST['pulsante'] == "Memorizza"){
	$result = $CNT->modifyImgEvento($_POST,$_FILES);
	if($result){
		$HP->printR($result);
		$HP->printR($CNT->getErrors());	
	} else{
		header("location: eventiImg_add.php?evento=".$_POST['evento']);
	}
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="imagetoolbar" content="no" />
<meta http-equiv="Content-Language" content="it" />
<meta http-equiv="Pragma" content="no-cache"> 
<meta http-equiv="no-cache"> 
<meta http-equiv="Expires" content="-1"> 
<meta http-equiv="cache-Control" content="no-cache"> 
<meta name="Robots" content="All" />
<meta name="Owner" content="I-factory" /> 
<meta name="Author" content="I-factory" />  
<meta name="Copyright" content="Scenari d'Italia.it" />
<title><?php echo $SETTING->nome_dominio ?> - <?php echo $SETTING->sottotitolo ?></title>
<?php include("../css/default.php")?>

<script type="text/javascript" src="../jsLibs/css.js"></script>
<script type="text/javascript" src="../jsLibs/behaviour.js"></script>
<script type="text/javascript" src="../jsLibs/jquery-1.3.2.js"></script>

<script type="text/javascript" src="../jsLibs/commonFunction.js"></script>

<style>
#tableImg tr td{width: 120px; height: 120px; border: solid 1px #999; margin-right: 5px; 
				background-image: url(../css/layout/site/cartella.png); background-repeat: no-repeat; background-position: center top; text-align: center}
#tableImg tr td span{position: relative; top: 35px; font-size: 11px; }

#tableImmagini tr td{width: 115px; height: 120px; border: solid 1px #999; vertical-align: top; text-align: left; padding-left: 5px;}
.immagine {width: 110px; height: 85px; margin-top: 4px;}
#tableImmagini tr td span{text-align: left; float: left; display: block}
#tableImmagini tr td div{ text-align: left; float: right; margin-right: 5px; margin-top: 5px}
#tableImmagini tr td div a img{ border: 0px}
</style>
</head>

<body>
<?php include("header.php")?>	
		<!--[if !IE]>start content<![endif]-->
		<div id="content">
			<!--[if !IE]>start page<![endif]-->
			<div id="page">
				<div class="inner">
					<!--[if !IE]>start section<![endif]-->
					<?php include("menu.php")?>
					<!--[if !IE]>end section<![endif]-->
					<!--[if !IE]>start section<![endif]-->

<!-- Pagina INIZIALE elenco alberghi - START -->
<?php if (!($_REQUEST['evento'])){?>
					<div class="section">
						<div class="section_inner">
							<div class="title_wrapper">
								<h2>Inserisci Immagine Eventi</h2>
							</div>
							<div class="section_content" style="height: auto;">
							<!-- h3>Subtitle will go here if needed</h3 -->
							<table cellpadding="0" id="tableImg" cellspacing="5" border="0">														
							<?php 
							$eventi = $CNT->getEventi();
							$imgRiga = 5;
							$n = 0;
							//$HP->printR($alberghi);
							foreach($eventi AS $key=>$evento){
								$n++;
								if ($n  == 1){
									echo '<tr>';
									echo '<td><span><a href="eventiImg_add.php?evento='.$evento['ID'].'">'.stripslashes($evento['titolo']).'</a><span></td>';
								}else{
									echo '<td><span><a href="eventiImg_add.php?evento='.$evento['ID'].'">'.stripslashes($evento['titolo']).'</a><span></td>';
								}
								if ($n == $imgRiga){
									echo "</tr>";
									$n=0;
								}
							}
							?>
							</table>
							<!--[if !IE]>end forms<![endif]-->
							<!--[if !IE]>start forms<![endif]-->
							</div>
						</div>
					</div>
					<!--[if !IE]>end section<![endif]-->
<?php }?>
<!-- Pagina INIZIALE elenco alberghi - END -->					


<!-- Pagina VISUALIZZAZIONE foto albergo - START -->
<?php if ( ($_REQUEST['evento']) && (!($_GET['task']))) {
$evento = $CNT->getEventoById($_REQUEST['evento']);
//$HP->printR($albergo);
?>
					<div class="section">
						<div class="section_inner">
							<div class="title_wrapper">
								<h2><?php echo stripslashes($evento[0]['titolo'])?></h2>
								<div style="float: right; padding-top: 12px; padding-right: 10px">[ <a href="eventiImg_add.php">livello superiore</a> ]</div>
							</div>
							<div class="section_content" style="height: auto;">
							<h3>Inserisci Immagine</h3>
							<!--[if !IE]>start fieldset<![endif]-->
							<form action="eventiImg_add.php" method="post" class="search_form general_form" style="margin-top: 10px" enctype="multipart/form-data">
							<fieldset>
							<!--[if !IE]>start forms<![endif]-->
							<div class="forms">								
									<div class="row">
										<label>Immagine:</label>
										<div class="inputs">
											<span class="input_wrapper blank"><input name="immagine" type="file" /></span>
										</div><?php echo $errori['immagine']?>
									</div>
									<div class="row">
										<label>Descrizione:</label>
										<div class="inputs" >
											<span class="input_wrapper"><input class="text" name="descrizione" type="text" /></span>
											<div style="float: left">Oridne: &nbsp; </div><span class="input_wrapper" style="width: 20px"><input class="text" name="ordine" type="text" /></span>
										</div><?php echo $errori['descrizione']?>
									</div>
									<input type="hidden" name="evento" value="<?php echo $_REQUEST['evento']?>" />
									<div class="row">
										<div class="buttons">
											<ul>
												<li><span class="button send_form_btn"><span><span>Inserisci</span></span><input name="pulsante" type="submit" value="Inserisci"/></span></li>
											</ul>
										</div>
									</div>
							</div>
							</fieldset>
							</form>						
							<table cellpadding="0" id="tableImmagini" cellspacing="5" border="0">														
							<?php 
							$immagini = $CNT->getImmaginiFromEvento($_REQUEST['evento']);
							//$HP->printR($immagini);
							$imgRiga = 5;
							$n = 0;
							//$HP->printR($alberghi);
							foreach($immagini AS $immagine){
								$n++;
								if ($n  == 1){
									echo '<tr>';
									echo '<td><img src="../eventi/'.$immagine['eventoID'].'/'.$immagine['immagine'].'" class="immagine" />';
									echo '<span>'.substr(stripslashes($immagine['descrizione']),0,7).'('.$immagine['ordine'].')</span>';
									echo '<div class="modifiche"><a href="eventiImg_add.php?evento='.$_REQUEST['evento'].'&task=modifica&image='.$immagine['ID'].'" title="Modifica"><img src="../css/layout/site/modify.png"></a> ';
									echo '<a href="eventiImg_add.php?evento='.$_REQUEST['evento'].'&task=elimina&image='.$immagine['ID'].'" title="Elimina foto"><img src="../css/layout/site/delete.png"></a></div>';
									echo '</td>';
								}else{
									echo '<td><img src="../eventi/'.$immagine['eventoID'].'/'.$immagine['immagine'].'" class="immagine" />';
									echo '<span>'.substr(stripslashes($immagine['descrizione']),0,7).'('.$immagine['ordine'].')</span>';
									echo '<div class="modifiche"><a href="eventiImg_add.php?evento='.$_REQUEST['evento'].'&task=modifica&image='.$immagine['ID'].'" title="Modifica immagine"><img src="../css/layout/site/modify.png"></a> ';
									echo '<a href="eventiImg_add.php?evento='.$_REQUEST['evento'].'&task=elimina&image='.$immagine['ID'].'" title="Elimina foto"><img src="../css/layout/site/delete.png"></a></div>';
									echo '</td>';
								}
								if ($n == $imgRiga){
									echo "</tr>";
									$n=0;
								}
							}
							?>
							</table>
							<!--[if !IE]>end forms<![endif]-->
							<!--[if !IE]>start forms<![endif]-->
							</div>
						</div>
					</div>
					<!--[if !IE]>end section<![endif]-->
<?php }?>
<!-- Pagina VISUALIZZAZIONE foto albergo - END -->					


<!-- Pagina VISUALIZZAZIONE foto albergo - START -->
<?php if ($_GET['task'] == "modifica") {
$evento = $CNT->getEventoById($_REQUEST['evento']);
$immagine = $CNT->getImmagineEventoById($_GET['image']);
//$HP->printR($albergo);
?>
					<div class="section">
						<div class="section_inner">
							<div class="title_wrapper">
								<h2><?php echo stripslashes($evento[0]['titolo'])?></h2>
								<div style="float: right; padding-top: 12px; padding-right: 10px">[ <a href="eventiImg_add.php">livello superiore</a> ]</div>
							</div>
							<div class="section_content" style="height: auto;">
							<h3>Modifica Immagine</h3>
							<!--[if !IE]>start fieldset<![endif]-->
							<form action="eventiImg_add.php" method="post" class="search_form general_form" style="margin-top: 10px" enctype="multipart/form-data">
							<fieldset>
							<!--[if !IE]>start forms<![endif]-->
							<div class="forms">								
									<img src="../eventi/<?php echo $_REQUEST['evento']?>/<?php echo $immagine[0]['immagine']?>" style="width: 120px; height: 90px" />
									<input type="hidden" name="evento" value="<?php echo $_REQUEST['evento'] ?>" />
									<input type="hidden" name="id" value="<?php echo $immagine[0]['ID'] ?>" />
									<div class="row">
										<label>Immagine:</label>
										<div class="inputs">
											<span class="input_wrapper blank"><input name="immagine" type="file" /></span>
										</div><?php echo $errori['immagine']?>
									</div>
									<div class="row">
										<label>Descrizione:</label>
										<div class="inputs" >
											<span class="input_wrapper"><input class="text" name="descrizione" type="text" value="<?php echo stripslashes($immagine[0]['descrizione'])?>" /></span>
											<div style="float: left">Oridne: &nbsp; </div><span class="input_wrapper" style="width: 20px"><input class="text" name="ordine" type="text" value="<?php echo $immagine[0]['ordine']?>" /></span>
										</div>
									</div>
									<input type="hidden" name="evento" value="<?php echo $_REQUEST['evento']?>" />
									<div class="row">
										<div class="buttons">
											<ul>
												<li><span class="button send_form_btn"><span><span>Memorizza</span></span><input name="pulsante" type="submit" value="Memorizza"/></span></li>
											</ul>
										</div>
									</div>
							</div>
							</fieldset>
							</form>						
							<!--[if !IE]>end forms<![endif]-->
							<!--[if !IE]>start forms<![endif]-->
							</div>
						</div>
					</div>
					<!--[if !IE]>end section<![endif]-->
<?php }?>
<!-- Pagina VISUALIZZAZIONE foto albergo - END -->					
				</div>
			</div>
			<!--[if !IE]>end page<![endif]-->
			
			<!--[if !IE]>start sidebar<![endif]-->
			<div id="sidebar" >
				<div class="inner">
					<?php include("menu_option.php")?>
					<!-- QUICK START --><!--[if !IE]>start section<![endif]-->
					<?php include("quick.php")?>
					<!--[if !IE]>end section<![endif]-->
					<!-- QUICK END -->
				</div>
			</div>
			<!--[if !IE]>end sidebar<![endif]-->
		
		</div>
		<!--[if !IE]>end content<![endif]-->
	</div>
	<!--[if !IE]>end wrapper<![endif]-->
	<!--[if !IE]>start footer<![endif]-->
	<?php include("footer.php")?>
	<!--[if !IE]>end footer<![endif]-->
</body>
</html>
