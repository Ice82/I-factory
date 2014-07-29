<?php 
include("../commonSetting.php");
If (($_SESSION['IsUserGood'] == False) || (!isset($_SESSION['user']))) {
	header("location: ../index.php?logout=0"); 
}

// Mi permette di prelevare il menù di sinistra
$mod = 12;

if($_POST['pulsante'] == "Memorizza"){
		$result = $CNT->modifyBanner($_POST,$_FILES);
		if($result) 
			print_r($result);
		else
			header("location: banner_mod.php?tipologia=".$_POST['tipologia']);
			
}

if($_GET['task'] == "delete"){
		settype($_GET['id'], "integer"); 
		$result = $CNT->deleteBanner($_GET['id']);
		if($result == 0) 
			print_r($CNT->getErrors());
		else
			header("location: banner_mod.php?tipologia=".$_GET['tipologia']);
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
<link media="screen" rel="stylesheet" type="text/css" href="../css/datePicker.css"  />

<script type="text/javascript" src="../jsLibs/css.js"></script>
<script type="text/javascript" src="../jsLibs/behaviour.js"></script>
<script type="text/javascript" src="../jsLibs/jquery-1.3.2.js"></script>

<script type="text/javascript" src="../jsLibs/commonFunction.js"></script>

<script type="text/javascript" src="../jsLibs/date.js"></script>
<script type="text/javascript" src="../jsLibs/jquery.datePicker-2.1.2.js"></script>
<script type="text/javascript">
$(function(){
	$('#data').datePicker({clickInput:true, createButton:false})
});	   
</script>
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

					<div class="section">
						<div class="section_inner">
							<div class="title_wrapper">
								<h2>Modifica Banners</h2>
							</div>
							<div class="section_content">
							<!-- h3>Subtitle will go here if needed</h3 -->
							<p>
								Scegli la posizione del banner.
							</p>
							
							<form action="banner_mod.php" method="post" class="search_form general_form" style="margin-top: 10px">
								<!--[if !IE]>start fieldset<![endif]-->
								<fieldset>
									<!--[if !IE]>start forms<![endif]-->
									<div class="forms">
									<!--[if !IE]>start row<![endif]-->
									<div class="row"><label style="width: 120px">Posizione:<small>*</small></label>
										<div class="inputs">
											<span class="input_wrapper blank" style="width: 250px">
												<select name="tipologia" style="width: 250px">
												<option value="">Scegli posizione</option>
												<?php if ($_REQUEST['tipologia'] == 1) echo '<option value="1" selected>Superiore (680*100px)</option>'; else echo '<option value="1">Superiore (680*100px)</option>'?>
												<?php if ($_REQUEST['tipologia'] == 2) echo '<option value="2" selected>Laterale (220*100px)</option>'; else echo '<option value="2">Laterale (680*100px)</option>'?>
												<?php if ($_REQUEST['tipologia'] == 3) echo '<option value="3" selected>Inferiore (680*100px)</option>'; else echo '<option value="3">Inferiore (680*100px)</option>'?>
												</select>
											</span>
												<ul>	
												<li><span class="button green_btn"><span><span>Cerca</span></span><input name="pulsante" type="submit" value="Cerca" /></span></li>
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



<?php if ($_POST['pulsante'] == "Cerca"){ ?>
					<!--[if !IE]>start section<![endif]-->
					<div class="section table_section">
						<div class="section_inner">
							<div class="title_wrapper">
								<h2>Modifica Banners</h2>
							</div>
							<div class="section_content">
							
							<div  id="product_list">
							<!--[if !IE]>start table_wrapper<![endif]-->
							<div class="table_wrapper">
								<div class="table_wrapper_inner">
								<table cellpadding="0" cellspacing="0" width="100%">
									<tbody><tr>
										<th>ID</th>
										<th>Titolo</th>
										<th>Attivazione</th>
										<th>Scadenza</th>
										<th>Ordine</th>
										<th>Azione</th>
									</tr><?php 
									$eventi = $CNT->getBannerFromPosizioneID($_POST['tipologia']);
									$num = 2; 
									foreach($eventi AS $key=>$evento){
									 	if($key % $num) $row = "second"; else $row = "first";
									?>
									<tr class="<?php echo $row ?>">
										<td class="first_td" style="width: 26px;"><?php echo $evento['ID']?></td>
										<td style="font-weight: bold"><?php echo stripslashes($evento['titolo'])?></td>
										<td><?php echo $HP->data_it($evento['attivazione'])?></td>
										<td><?php echo $HP->data_it($evento['scadenza'])?></td>
										<td><?php echo $evento['ordine']?></td>
										<td style="width: 160px;">
											<div class="actions_menu" style="width: 160px;">
												<ul>
													<li><a class="edit" href="banner_mod.php?task=modifica&tipologia=<?php echo $_POST['tipologia']?>&id=<?php echo $evento['ID']?>">modifica</a></li>
													<li><a class="delete" href="banner_mod.php?task=delete&tipologia=<?php echo $_POST['tipologia']?>&id=<?php echo $evento['ID']?>" style="width: 40px">cancella</a></li>
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
	$evento = $CNT->getBannerByID($_GET['id']);
	?>
					<div class="section">
						<div class="section_inner">
							<div class="title_wrapper">
								<h2>Modifica Banner</h2>
							</div>
							<div class="section_content">
							<!-- h3>Subtitle will go here if needed</h3 -->
							
							<form action="banner_mod.php" method="post" class="search_form general_form" style="margin-top: 10px" enctype="multipart/form-data">
								<!--[if !IE]>start fieldset<![endif]-->
								<fieldset>
									<!--[if !IE]>start forms<![endif]-->
									<div class="forms">
									
									<!--[if !IE]>start row<![endif]-->
									<div class="row"><label>Posizione:<small>*</small></label>
										<div class="inputs">
											<span class="input_wrapper blank" style="width: auto">
												<select name="tipologia" style="width: auto">
												<option value="">Scegli tipologia</option>
												<?php if ($evento[0]['posizioneID'] == 1) echo '<option value="1" selected>Superiore (680*100px)</option>'; else echo '<option value="1">Superiore (680*100px)</option>'?>
												<?php if ($evento[0]['posizioneID'] == 2) echo '<option value="2" selected>Laterale (220*100px)</option>'; else echo '<option value="2">Laterale (680*100px)</option>'?>
												<?php if ($evento[0]['posizioneID'] == 3) echo '<option value="3" selected>Inferiore (680*100px)</option>'; else echo '<option value="3">Inferiore (680*100px)</option>'?>
												</select>
											</span>
										</div>
									</div>
									<div class="row">
										<label>Immagine:</label>
										<div class="inputs">
										    <?php if ($evento[0]['immagine'] != "")
										    	echo  '<a href="../banners/'.$evento[0]['ID'].'/'.$evento[0]['immagine'].'" target="new">'.$evento[0]['immagine'].'</a><br />';
										    ?>
											<span class="input_wrapper blank"><input name="immagine" type="file" /></span>
										</div>
									</div>
									<div class="row">
										<label>Titolo: <small>*</small></label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="titolo" type="text" value="<?php echo stripslashes($evento[0]['titolo'])?>" /></span>
										</div>
									</div>
									<div class="row">
										<label>Attivazione:</label>
										<div class="inputs">
										<?php if ($evento[0]['attivazione']) $attivazione = $HP->data_it($evento[0]['attivazione'])?>
											<span class="input_wrapper" style="width: 100px;"><input class="text" name="attivazione" id="attivazione" value="<?php echo $attivazione ?>" type="text" readonly /></span>
										</div>
									</div>
									<div class="row">
										<label>Scadenza:</label>
										<div class="inputs">
										<?php if ($evento[0]['scadenza']) $scadenza = $HP->data_it($evento[0]['scadenza'])?>
											<span class="input_wrapper" style="width: 100px;"><input class="text" name="scadenza" id="scadenza" value="<?php echo $scadenza ?>" type="text" readonly /></span>
										</div>
									</div>
									<div class="row">
										<label>Link:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="link" type="text" value="<?php echo stripslashes($evento[0]['link'])?>" /></span>
										</div>
									</div>
									<div class="row"><label>Apertura:</label>
										<?php
										if($evento[0]['apertura'] == "_self") $si = "checked"; else $no = "checked"; ?>
										<div class="inputs">
											<ul>
												<li><input class="radio" name="apertura" value="_self" type="radio" <?php echo $si?> /> Stessa pagina</li>
												<li><input class="radio" name="apertura" value="_blank" type="radio" <?php echo $no?> /> Nuova pagina</li>
											</ul>
										</div>
									</div>
									<div class="row">
										<label>Ordine:</label>
										<div class="inputs">
											<span class="input_wrapper" style="width: 50px;"><input class="text" name="ordine" value="<?php echo $evento[0]['ordine']?>" type="text" /></span>
										</div>
									</div>
									<!--[if !IE]>end row<![endif]-->
									<input type="hidden" name="id" value="<?php echo $evento[0]['ID']?>">
									<!--[if !IE]>start row<![endif]-->
									<div class="row">
										<div class="buttons">
											<ul>
												<li><span class="button send_form_btn"><span><span>Memorizza</span></span><input name="pulsante" type="submit" value="Memorizza" /></span></li>
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
