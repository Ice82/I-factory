<?php 
include("../commonSetting.php");
If (($_SESSION['IsUserGood'] == False) || (!isset($_SESSION['user']))) {
	header("location: ../".$SETTING->pageIndex."?logout=0"); 
}

// Mi permette di prelevare il menù di sinistra
$mod = 2;

if($_GET['task'] == "genera"){
		settype($_GET['id'], "integer");
		$result = $UC->generaPsw($_GET['id']);
		if($result['result'] != 1) 
			print_r($result);
		else
			header("location: utente_genera.php");
}

if($_GET['task'] == "delete"){
		settype($_GET['id'], "integer"); 
		$result = $UC->deleteUser($_GET['id']);
		if($result == 0) 
			print_r($UC->getErrors());
		else
			header("location: utente_genera.php");
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
<?php include("../css/css.php")?>

<script type="text/javascript" src="../jsLibs/css.js"></script>
<script type="text/javascript" src="../jsLibs/behaviour.js"></script>
<script type="text/javascript" src="../jsLibs/jquery-1.3.2.js"></script>

<script type="text/javascript" src="../jsLibs/commonFunction.js"></script>

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

<?php if (!isset($_GET['task'])){ ?>
					<!--[if !IE]>start section<![endif]-->
					<div class="section table_section">
						<div class="section_inner">
							<div class="title_wrapper">
								<h2>Utenti Registrati</h2>
							</div>
							<div class="section_content">
							
							<div  id="product_list">
							<!--[if !IE]>start table_wrapper<![endif]-->
							<div class="table_wrapper">
								<div class="table_wrapper_inner">
								<table cellpadding="0" cellspacing="0" width="100%">
									<tbody><tr>
										<th>ID</th>
										<th>Ragione Sociale</th>
										<th>Referente</th>
										<th>Citt&agrave;</th>
										<th>Stato</th>
										<th>Azioni</th>
									</tr><?php 
									$utenti = $UC->getGuest();
									//print_r($utenti);
									$num = 2; 
									foreach($utenti AS $key=>$utente){
									 	if($key % $num) $row = "second"; else $row = "first";
										if ($utente['ABILITATO'] == 1) { $stato = "approved"; $testo = "Abilitato"; } else { $stato = "pending"; $testo = "Disabilitato"; } 
									?>
									<tr class="<?php echo $row ?>">
										<td class="first_td" style="width: 26px;"><?php echo $utente['ID']?></td>
										<td style="font-weight: bold"><?php echo stripslashes($utente['RAGSOC'])?></td>
										<td style="font-weight: bold"><?php echo stripslashes($utente['REFERENTE'])?></td>
										<td style="font-weight: bold"><?php echo stripslashes($utente['nomeCOMUNE'])?></td>
										<td><span class="<?php echo $stato ?>"><?php echo $testo ?></span></td>
										<td style="width: 160px;">
											<div class="actions_menu" style="width: 160px;">
												<ul>
													<li><a class="edit" href="utente_genera.php?task=genera&id=<?php echo $utente['ID']?>">genera</a></li>
													<li><a class="delete" href="utente_genera.php?task=delete&id=<?php echo $utente['ID']?>" style="width: 40px">cancella</a></li>
												</ul>
											</div>
										</td>
									</tr>
								<?php } ?>
								</tbody></table>
								</div>
							</div>
							<!--[if !IE]>end table_wrapper<![endif]-->
							</div>
							</div>
						</div>
					</div>
					<!--[if !IE]>end section<![endif]-->
<?php } ?>

<?php if ($_GET['task'] == "modifica"){
	settype($_GET['id'], "integer"); 
	$tipologia = $CF->getClassificazioneAlbergoById($_GET['id']);
	?>
					<!--[if !IE]>start section<![endif]-->
					<div class="section">
						<div class="section_inner">
							<div class="title_wrapper"><h2>Modifica Classificazione Albergo</h2></div>
							<div class="section_content">
							<form action="alberghi_cla_mod.php" method="post" class="search_form general_form" style="margin-top: 10px">
								<!--[if !IE]>start fieldset<![endif]-->
								<fieldset>
									<!--[if !IE]>start forms<![endif]-->
									<div class="forms">
									<!--[if !IE]>start row<![endif]-->
									<div class="row">
										<label>Nome:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="nome" type="text" value="<?php echo stripslashes($tipologia[0]['NOME'])?>" /></span>
											<?php echo $errori['nome']?>
										</div>
									</div>
									<div class="row">
										<label>Descrizione:</label>
										<div class="inputs">
											<span class="input_wrapper textarea_wrapper" style="width: 300px; height: 100px">
												<textarea class="text" name="descr"><?php echo stripslashes($tipologia[0]['DESCR'])?></textarea>
											</span>
										</div>
									</div>
									<div class="row"><label>Abilitato:</label>
										<?php
										if($tipologia[0]['ABILITATO'] == 0) $no = "checked"; else $si = "checked"; ?>
										<div class="inputs">
											<ul>
												<li><input class="radio" name="abilitato" value="1" type="radio" <?php echo $si?> /> SI</li>
												<li><input class="radio" name="abilitato" value="0" type="radio" <?php echo $no?> /> NO</li>
											</ul>
										</div>
									</div>
									<!--[if !IE]>end row<![endif]-->
									<input type="hidden" name="id" value="<?php echo $tipologia[0]['ID']?>">
									<!--[if !IE]>start row<![endif]-->
									<div class="row">
										<div class="buttons">
											<ul>
												<li><span class="button send_form_btn"><span><span>Memorizza</span></span><input name="pulsante" type="submit" value="Memorizza"/></span></li>
											</ul>
										</div>
									</div>
									<!--[if !IE]>end row<![endif]-->
									</div>
									<!--[if !IE]>end forms<![endif]-->
								</fieldset>
								<!--[if !IE]>end fieldset<![endif]-->
							</form>
							<!--[if !IE]>end forms<![endif]-->
							<!--[if !IE]>start forms<![endif]-->
							</div>
						</div>
					</div>
					<!--[if !IE]>end section<![endif]-->
<?php }?>

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
