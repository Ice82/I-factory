<?php 
include("../commonSetting.php");
If (($_SESSION['IsUserGood'] == False) || (!isset($_SESSION['user']))) {
	header("location: ../index.php?logout=0"); 
}
// Mi permette di prelevare il menù di sinistra
$mod = 11;
$pagina = "offerta_mod.php";
if($_POST['pulsante'] == "Memorizza"){
		$result = $PRD->modifyOfferta($_POST,$_FILES);
		if(is_array($result)) 
			print_r($result);
		else 
			header("location: offerta_prdAdd.php?offerta=".$result);
}

if($_GET['task'] == "delete"){
		settype($_GET['id'], "integer"); 
		$result = $PRD->deleteProdotto($_GET['id']);
		if($result == 0) 
			print_r($PRD->getErrors());
		else
			header("location: prodotto_mod.php?categoria=".$_GET['categoria']);
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
	$('#inizio').datePicker({clickInput:true, createButton:false})
});	   
$(function(){
	$('#fine').datePicker({clickInput:true, createButton:false})
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
								<h2>Modifica Offerta</h2>
							</div>
							<div class="section_content">
							<!-- h3>Subtitle will go here if needed</h3 -->
							<p>
								Scegli categoria del'offerta.
							</p>
							
							<form action="<?php echo $pagina ?>" method="post" class="search_form general_form" style="margin-top: 10px">
								<!--[if !IE]>start fieldset<![endif]-->
								<fieldset>
									<!--[if !IE]>start forms<![endif]-->
									<div class="forms">
									<!--[if !IE]>start row<![endif]-->
									
									<div class="row"><label style="width: 120px">Categoria:<small>*</small></label>
										<div class="inputs">
											<span class="input_wrapper blank" style="width: 250px">
												<select name="categoria" style="width: 250px">
  												<option value="">Scegli categoria</option>
  												<?php 
  												$macroaree = $CF->getCategoriaPadre();
  												foreach ($macroaree AS $macroarea){
  														if ($macroarea['ID'] == $_REQUEST['categoria'])
  															echo '<option value="'.$macroarea['ID'].'" selected>'.$macroarea['nome'].'</option>';
  														else
  															echo '<option value="'.$macroarea['ID'].'">'.$macroarea['nome'].'</option>';
  												}
  												?>
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
								<h2>Modifica Offerta</h2>
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
										<th>Data</th>
										<th>Prezzo</th>
										<th>Stato</th>
										<th>Azione</th>
									</tr><?php 
									$news = $PRD->getOffertaFromCategoryID($_POST['categoria'],1);
									$num = 2; 
									foreach($news AS $key=>$new){
									 	if($key % $num) $row = "second"; else $row = "first";
										if ($new['abilitato'] == 1) { $stato = "approved"; $testo = "Abilitato"; } else { $stato = "pending"; $testo = "Disabilitato"; } 
									?>
									<tr class="<?php echo $row ?>">
										<td class="first_td" style="width: 26px;"><?php echo $new['ID']?></td>
										<td style="font-weight: bold"><?php echo stripslashes($new['titolo'])?></td>
										<td><?php echo $HP->data_it($new['attivazione'])?> - <?php echo $HP->data_it($new['scadenza'])?></td>
										<td style="font-weight: bold"><?php echo str_replace(".",",",$new['prezzo'])?></td>
										<td><span class="<?php echo $stato ?>"><?php echo $testo ?></span></td>
										<td style="width: 160px;">
											<div class="actions_menu" style="width: 160px;">
												<ul>
													<li><a class="edit" href="<?php echo $pagina?>?task=modifica&categoria=<?php echo $_POST['categoria']?>&id=<?php echo $new['ID']?>">modifica</a></li>
													<li><a class="delete" href="<?php echo $pagina?>?task=delete&categoria=<?php echo $_POST['categoria']?>&id=<?php echo $new['ID']?>" onclick="return confirm('Sei sicuro di voler eliminare il prodotto!');" style="width: 40px">cancella</a></li>
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
	$prodotto = $PRD->getOffertaById($_GET['id']);
	?>
					<div class="section">
						<div class="section_inner">
							<div class="title_wrapper">
								<h2>Modifica Offerta</h2>
							</div>
							<div class="section_content">
							<!-- h3>Subtitle will go here if needed</h3 -->
							<form action="<?php echo $pagina ?>" method="post" class="search_form general_form" style="margin-top: 10px" enctype="multipart/form-data">
								<!--[if !IE]>start fieldset<![endif]-->
								<fieldset>
									<!--[if !IE]>start forms<![endif]-->
									<div class="forms">
									<!--[if !IE]>start row<![endif]-->
									<div class="row"><label>Categoria:<small>*</small></label>
										<div class="inputs">
											<span class="input_wrapper blank" style="width: 250px">
												<select name="categoria" style="width: 250px">
  												<option value="">Scegli categoria</option>
  												<?php 
  												$macroaree = $CF->getCategoriaPadre();
  												foreach ($macroaree AS $macroarea){
  														if ($macroarea['ID'] == $prodotto['offerta']['categoryID'])
  															echo '<option value="'.$macroarea['ID'].'" selected>'.$macroarea['nome'].'</option>';
  														else
  															echo '<option value="'.$macroarea['ID'].'">'.$macroarea['nome'].'</option>';
  												}
  												?>
												</select>
											</span>
										</div>
									</div>
									<div class="row">
										<label>Titolo:<small>*</small></label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="titolo" type="text" value="<?php echo stripslashes($prodotto['offerta']['titolo'])?>" /></span>
											<?php echo $errori['nome']?>
										</div>
									</div>
									<div class="row">
										<label>Sottotitolo:</label>
										<div class="inputs">
											<span class="input_wrapper" style="width: 350px;"><input class="text" name="sottotitolo" value="<?php echo stripslashes($prodotto['offerta']['sottotitolo'])?>" type="text" /></span>
										</div>
									</div>
									<div class="row">
										<label>Inizio:</label>
										<div class="inputs">
											<span class="input_wrapper" style="width: 100px;"><input class="text" name="inizio" id="inizio" value="<?php echo $HP->data_it($prodotto['offerta']['attivazione'])?>" type="text" readonly /></span>
										</div>
									</div>
									<div class="row">
										<label>Fine:</label>
										<div class="inputs">
											<span class="input_wrapper" style="width: 100px;"><input class="text" name="fine" id="fine" value="<?php echo $HP->data_it($prodotto['offerta']['scadenza']) ?>" type="text" readonly /></span>
										</div>
									</div>
									<div class="row">
										<label>Descrizione:</label>
										<div class="inputs">
											<span class="input_wrapper textarea_wrapper" style="width: 300px; height: 100px">
												<textarea class="text" name="descrizione"><?php echo stripslashes($prodotto['offerta']['descrizione'])?></textarea>
											</span>
										</div>
									</div>
									<div class="row">
										<label>Prezzo:</label>
										<div class="inputs">
											<span class="input_wrapper" style="width: 70px;"><input class="text" name="prezzo" value="<?php echo str_replace(".",",",$prodotto['offerta']['prezzo']) ?>" type="text" /></span>
										</div>
									</div>
									<div class="row">
										<label>Rivenditori:</label>
										<div class="inputs">
											<span class="input_wrapper" style="width: 70px;"><input class="text" name="offerta" value="<?php echo str_replace(".",",",$prodotto['offerta']['offerta']) ?>" type="text" /></span>
										</div>
									</div>
									<div class="row">
										<label>Immagine:</label>
										<div class="inputs">
										    <?php if ($prodotto['offerta']['immagine'] != "")
										    	echo  '<a href="../offerte/'.$prodotto['offerta']['ID'].'/'.$prodotto['offerta']['immagine'].'" target="new">'.$prodotto['offerta']['immagine'].'</a><br />';
										    ?>
											<span class="input_wrapper blank"><input name="immagine" type="file" /></span>
										</div>
									</div>
									<div class="row"><label>Abilitato:</label>
										<?php
										if($prodotto['offerta']['abilitato'] == 0) $no = "checked"; else $si = "checked"; ?>
										<div class="inputs">
											<ul>
												<li><input class="radio" name="abilitato" value="1" type="radio" <?php echo $si?> /> SI</li>
												<li><input class="radio" name="abilitato" value="0" type="radio" <?php echo $no?> /> NO</li>
											</ul>
										</div>
									</div>
									<!--[if !IE]>end row<![endif]-->
									<input type="hidden" name="id" value="<?php echo $prodotto['offerta']['ID']?>">
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
