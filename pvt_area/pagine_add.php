<?php 
include("../commonSetting.php");

If (($_SESSION['IsUserGood'] == False) || (!isset($_SESSION['user']))) {
	header("location: ../index.php?logout=0"); 
}

// Mi permette di prelevare il menù di sinistra
$mod = 6;

if($_POST['pulsante'] == "Inserisci"){
	$errori = array();
	if ( !isset($_POST['sezione']) || ($_POST['sezione'] == "")) $errori['sezione'] = '<span class="system negative">Scegli sezione</span>';
	if ( !isset($_POST['nome']) || ($_POST['nome'] == "") ) $errori['nome'] = '<span class="system negative">Inserisci nome</span>';
	if ( !isset($_POST['file']) || ($_POST['file'] == "") ) $errori['file'] = '<span class="system negative">Inserisci file</span>';
	
	if (count($errori)<1){
		$result = $AD->addPagina($_POST);
		//print_r($result);
		//print_r($CTR->getErrors());
		if($result == 1) 
			header("location: pagine_add.php?insert=ok");
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
	$('#modulo').change(function(){
    	sendAjax("../ajaxRequest/queries.php","","json","5000","task=getSezioniModulo&modulo="+$(this).val()+"","cerca","popolaSelectSezioniModulo(result)","","0");
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
					<!--[if !IE]>start section<![endif]-->
			<?php 
				if(count($errori)>0){
					echo '<ul class="system_messages">';
						echo '<li class="red_message"><div class="red system_inner"><span class="ico"></span><strong class="system_title">Errore nell\'inserimento della pagina</strong></div></li>';
					echo '</ul>';
				}
			?>	
			<?php 
				if($_GET['insert'] == "ok"){
					echo '<ul class="system_messages">';
						echo '<li class="yellow_message"><div class="yellow system_inner"><span class="ico"></span><strong class="system_title">Pagina inserita correttamente</strong></div></li>';
					echo '</ul>';
				}
			?>	
					<div class="section">
						<div class="section_inner">
							<div class="title_wrapper">
								<h2>Inserisci pagina</h2>
							</div>
							<div class="section_content">
							<!-- h3>Subtitle will go here if needed</h3 -->
							<p>
								Inserisci pagina del sistema.<br />
								(*) Campi obbligatori
							</p>
							
							<form action="pagine_add.php" method="post" class="search_form general_form" style="margin-top: 10px">
								<!--[if !IE]>start fieldset<![endif]-->
								<fieldset>
									<!--[if !IE]>start forms<![endif]-->
									<div class="forms">
									<!--[if !IE]>start row<![endif]-->
									<div class="row"><label style="width: 120px">Modulo:<small>*</small></label>
										<div class="inputs">
											<span class="input_wrapper blank" style="width: 250px">
												<select name="modulo" id="modulo" style="width: 250px">
												<option value="">Scegli modulo</option>
												<?php 
													$moduli = $AD->getModuli(1);
													print_r($moduli);
													foreach($moduli AS $modulo){
														echo '<option value="'.$modulo['ID'].'">'.stripslashes($modulo['NOME']).'</option>';
													}
												?>	
												</select>
											</span><?php echo $errori['modulo']?>
										</div>
									</div>
									<div class="row"><label style="width: 120px">Sezioni:<small>*</small></label>
										<div class="inputs">
											<span class="input_wrapper blank" style="width: 250px">
												<select name="sezione" id="sezioni" style="width: 250px">
												<option value="">Scegli sezione</option>
												</select>
											</span><?php echo $errori['sezione']?>
										</div>
									</div>
									<div class="row">
										<label style="width: 120px">Nome <small>*</small></label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="nome" type="text" /></span>
											<?php echo $errori['nome']?>
										</div>
									</div>
									<div class="row">
										<label style="width: 120px">File <small>*</small></label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="file" type="text" /></span>
											<?php echo $errori['file']?>
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
