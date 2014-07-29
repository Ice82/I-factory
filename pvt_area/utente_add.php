<?php 
include("../commonSetting.php");

If (($_SESSION['IsUserGood'] == False) || (!isset($_SESSION['user']))) {
	header("location: ../".$SETTING->pageIndex."?logout=0"); 
}

// Mi permette di prelevare il menù di sinistra
$mod = 2;

if($_POST['pulsante'] == "Inserisci"){
	$errori = array();
	if ( !isset($_POST['tipologia']) || ($_POST['tipologia'] == "")) $errori['tipologia'] = '<span class="system negative">Seleziona tipologia utente</span>';
	//if ( !isset($_POST['ragsoc']) || ($_POST['ragsoc'] == "")) $errori['ragsoc'] = '<span class="system negative">Inserisci Ragione Sociale</span>';
	if ( !isset($_POST['cognome']) || ($_POST['cognome'] == "")) $errori['referente'] = '<span class="system negative">Inserisci Cognome</span>';
	if ( !isset($_POST['indirizzo']) || ($_POST['indirizzo'] == "")) $errori['indirizzo'] = '<span class="system negative">Inserisci Indirizzo</span>';
	if ( !isset($_POST['citta']) || ($_POST['citta'] == "")) $errori['citta'] = '<span class="system negative">Inserisci Citt&agrave;</span>';
	if ( !isset($_POST['telefono']) || ($_POST['telefono'] == "")) $errori['telefono'] = '<span class="system negative">Inserisci Telefono</span>';
	if ( !isset($_POST['email']) || ($_POST['email'] == "")) $errori['email'] = '<span class="system negative">Inserisci Indirizzo e-mail</span>';
	if ( !isset($_POST['password']) || ($_POST['password'] == "")) $errori['password'] = '<span class="system negative">Inserisci Password</span>';
	
	if (count($errori)<1){
		$checkEmail = $UC->checkEmail($_POST['email']);
		if ($checkEmail == "ok"){
			$user = $UC->addUser($_POST);
			if ($_POST['inviaMail'] == 1){
				$invioMail = $UC->inviaMailNuvoUtente($user);
				if ($invioMail != "ok"){
					$HP->printR($UC->getErrors());
					$HP->printR($invioMail);
				}	
			}else{
				header("location: utente_add.php?add=ok");
			}	
		}else{
			header("location: utente_add.php?add=2");
		}
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
<script type="text/javascript" src="../jsLibs/ajax.js"></script>
<script type="text/javascript" src="../jsLibs/commonFunction.js"></script>

<script>
$(document).ready(function(){
	$('#provincia').change(function(){
    	sendAjax("../ajaxRequest/queries.php","","json","5000","task=getComuniFromProvincia&idprov="+$(this).val()+"","cerca","popolaSelectComuni(result)","","0");
   });
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
							echo '<li class="red_message"><div class="red system_inner"><span class="ico"></span><strong class="system_title">Errore nell\'inserimento dell\'utente</strong></div></li>';
					echo '</ul>';
				}
			?>	
			<?php 
				if($_GET['insert'] == 2){
					echo '<ul class="system_messages">';
						echo '<li class="red_message"><div class="red system_inner"><span class="ico"></span><strong class="system_title">E-mal già presente in archivio</strong></div></li>';
					echo '</ul>';
				}
			?>	
			<?php 
				if($_GET['add'] == "ok"){
					echo '<ul class="system_messages">';
						echo '<li class="yellow_message"><div class="yellow system_inner"><span class="ico"></span><strong class="system_title">Utente inserito correttamente</strong></div></li>';
					echo '</ul>';
				}
			?>	

					<!--[if !IE]>start section<![endif]-->
					<div class="section">
						<div class="section_inner">
							<div class="title_wrapper">
								<h2>Aggiungi Utente Agenzia</h2>
							</div>
							<div class="section_content">
							<!-- h3>Subtitle will go here if needed</h3 -->
							<p>
								Inserisci i dati per registrare un utente.<br />
								Il dato "User" &egrave; la stessa mail inserita.
							</p>
							
							<form action="utente_add.php" method="post" class="search_form general_form" style="margin-top: 10px">
								<!--[if !IE]>start fieldset<![endif]-->
								<fieldset>
									<!--[if !IE]>start forms<![endif]-->
									<div class="forms">
									<!--[if !IE]>start row<![endif]-->
									<div class="row"><label style="width: 120px;">Tipologia:<small>*</small></label>
										<div class="inputs">
											<span class="input_wrapper blank" style="width: 250px">
												<select name="tipologia" style="width: 250px">
												<option value="">Scegli tipologia</option>
												<?php 
													$tipologie = $UC->getTipologia();
													foreach($tipologie AS $tipologia){
														echo '<OPTION value="'.$tipologia['ID'].'">'.stripslashes($tipologia['NOME']).'</OPTION>';
													
													}
												?>
												</select>
											</span><?php echo $errori['tipologia']?>
										</div>
									</div>
									<div class="row">
										<label style="width: 120px;">Ragione sociale:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="ragionesociale" type="text" /></span>
											<?php echo $errori['ragsoc']?>
										</div>
									</div>
									<div class="row">
										<label style="width: 120px;">Cognome & Nome:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="cognome" type="text" /></span>
											<?php echo $errori['referente']?>
										</div>
									</div>
									<div class="row">
										<label  style="width: 120px;">Indirizzo:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="indirizzo" type="text" /></span>
											<?php echo $errori['indirizzo']?>
										</div>
									</div>
									<div class="row">
										<label style="width: 120px;">Provincia:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="provincia" type="text" /></span>
											<?php echo $errori['provincia']?>
										</div>
									</div>
									<div class="row">
										<label style="width: 120px;">Citt&agrave;:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="citta" type="text" /></span>
											<?php echo $errori['citta']?>
										</div>
									</div>
									<div class="row">
										<label style="width: 120px;">Telefono:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="telefono" type="text" /></span>
											<?php echo $errori['telefono']?>
										</div>
									</div>
									<div class="row">
										<label style="width: 120px;">E-mail:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="email" type="text" /></span>
											<?php echo $errori['email']?>
										</div>
									</div>
									<div class="row">
										<label style="width: 120px;">Password:</label>
										<div class="inputs">
										<?php 
										$password = rand(1, 1000)."srt".rand(1, 1000);
										?>
											<span class="input_wrapper"><input class="text" name="password" type="text" value="<?php echo $password ?>" /></span>
											<?php echo $errori['password']?>
										</div>
									</div>
									<div class="row">
										<label style="width: 120px;">Abilitato:</label>
										<div class="inputs">
											<ul>
												<li><input class="radio" name="abilitato" value="1" type="radio" /> SI</li>
												<li><input class="radio" name="abilitato" value="0" type="radio" /> NO</li>
											</ul>
										</div>
									</div>
									<div class="row">
										<label style="width: 120px;">Invia mail:</label>
										<div class="inputs">
											<ul>
												<li><input class="radio" name="inviaMail" value="1" type="radio" /> SI</li>
												<li><input class="radio" name="inviaMail" value="0" type="radio" checked /> NO</li>
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
