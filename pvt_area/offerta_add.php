<?php 
include("../commonSetting.php");

If (($_SESSION['IsUserGood'] == False) || (!isset($_SESSION['user']))) {
	header("location: ../index.php?logout=0"); 
}

// Mi permette di prelevare il menù di sinistra
$mod = 11;

if($_POST['pulsante'] == "Inserisci"){
	$errori = array();
	if ( !isset($_POST['categoria']) || ($_POST['categoria'] == "")) $errori['categoria'] = '<span class="system negative">Scegli categoria</span>';
	if ( !isset($_POST['titolo']) || ($_POST['titolo'] == "")) $errori['nome'] = '<span class="system negative">Inserisci titolo</span>';
	if ( !isset($_POST['inizio']) || ($_POST['inizio'] == "")) $errori['inizio'] = '<span class="system negative">Inserisci attivazione</span>';
	if ( !isset($_POST['fine']) || ($_POST['fine'] == "")) $errori['fine'] = '<span class="system negative">Inserisci scadenza</span>';
	if ( !isset($_POST['prezzo']) || ($_POST['prezzo'] == "")) $errori['prezzo'] = '<span class="system negative">Inserisci prezzo</span>';
	
	if (count($errori)<1){
		$result = $PRD->addOfferta($_POST,$_FILES);
		if($result) 
			header("location: offerta_prdAdd.php?offerta=".$result);
		else
			$HP->printR($CNT->getErrors());
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
<link media="screen" rel="stylesheet" type="text/css" href="../css/datePicker.css"  />

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
			<?php 
				if(count($errori)>0){
					echo '<ul class="system_messages">';
						echo '<li class="red_message"><div class="red system_inner"><span class="ico"></span><strong class="system_title">Errore nell\'inserimento dell\'offerta</strong></div></li>';
					echo '</ul>';
				}
			?>	
					<!--[if !IE]>start section<![endif]-->
					<div class="section">
						<div class="section_inner">
							<div class="title_wrapper">
								<h2>Aggiungi Offerta</h2>
							</div>
							<div class="section_content">
							<!-- h3>Subtitle will go here if needed</h3 -->
							<p>
								Inserisci offerta. Questo &egrave; il primo passo, nel secondo passo dovrai aggiungere i prodotti all'offerta<br />
							</p>
							<form action="offerta_add.php" method="post" class="search_form general_form" style="margin-top: 10px" enctype="multipart/form-data">
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
													$categorie = $CF->getCategoriaPadre();
													
													foreach($categorie AS $categoria){
														echo '<option value="'.$categoria['ID'].'">'.stripslashes($categoria['nome']).'</option>';
													}
												?>	
												</select>
											</span><?php echo $errori['categoria']?>
										</div>
									</div>
									<div class="row">
										<label>Titolo:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="titolo" type="text" /></span>
											<?php echo $errori['titolo']?>
										</div>
									</div>
									<div class="row">
										<label>Sottotitolo:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="sottotitolo" type="text" /></span>
										</div>
									</div>
									<div class="row">
										<label>Inizio:</label>
										<div class="inputs">
											<span class="input_wrapper" style="width: 100px;"><input class="text" name="inizio" id="inizio" type="text" readonly /></span>
											<?php echo $errori['inizio']?>
										</div>
									</div>
									<div class="row">
										<label>Fine:</label>
										<div class="inputs">
											<span class="input_wrapper" style="width: 100px;"><input class="text" name="fine" id="fine" type="text" readonly /></span>
											<?php echo $errori['fine']?>
										</div>
									</div>
									<div class="row">
										<label>Descrizione:</label>
										<div class="inputs">
											<span class="input_wrapper textarea_wrapper" style="width: 300px; height: 100px">
												<textarea class="text" name="descrizione"></textarea>
											</span>
										</div>
									</div>
									<div class="row">
										<label>Prezzo:</label>
										<div class="inputs">
											<span class="input_wrapper" style="width: 50px;"><input class="text" name="prezzo" type="text" /></span>&euro;
											<?php echo $errori['prezzo']?>
										</div>
									</div>
									<div class="row">
										<label>Rivenditori:</label>
										<div class="inputs">
											<span class="input_wrapper" style="width: 50px;"><input class="text" name="offerta" type="text" /></span>&euro;
											<?php echo $errori['rivenditori']?>
										</div>
									</div>
									<div class="row">
										<label>Immagine:</label>
										<div class="inputs">
											<span class="input_wrapper blank"><input name="immagine" type="file" /></span>
										</div>
									</div>
									<div class="row">
										<label>Abilitato:</label>
										<div class="inputs">
											<ul>
												<li><input class="radio" name="abilitato" value="1" type="radio" /> SI</li>
												<li><input class="radio" name="abilitato" value="0" type="radio" /> NO</li>
											</ul>
										</div>
									</div>
									<!--[if !IE]>end row<![endif]-->
									<!--[if !IE]>start row<![endif]-->
									<div class="row">
										<div class="buttons">
											<ul>
												<li><span class="button send_form_btn"><span><span>Inserisci</span></span><input name="pulsante" type="submit" value="Inserisci"/></span></li>
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
