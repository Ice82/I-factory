<?php 
include("../commonSetting.php");

If (($_SESSION['IsUserGood'] == False) || (!isset($_SESSION['user']))) {
	header("location: ../".$SETTING->pageIndex."?logout=0"); 
}

// Mi permette di prelevare il men� di sinistra
$mod = 2;

if($_POST['pulsante'] == "Memorizza"){
		$result = $UC->modifyUser($_POST);
		if($result == 0) 
			print_r($result);
		else
			header("location: utente_mod.php?userType=".$_POST['tipologia']);
}

if($_GET['task'] == "delete"){
		settype($_GET['id'], "integer"); 
		$result = $UC->deleteUser($_GET['id']);
		if($result == 0) 
			print_r($CF->getErrors());
		else
			header("location: utente_mod.php");
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
	$('.abilitazione').click(function(){
		var id= $(this).attr("id");
		//alert(id);
    	sendAjax("../ajaxRequest/queries.php","","json","5000","task=changeStateUser&userID="+id+"","cerca","changeStatoUser(result)","","0");
    	return false;
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

					<div class="section">
						<div class="section_inner">
							<div class="title_wrapper">
								<h2>Modifica Utente</h2>
							</div>
							<div class="section_content">
							<!-- h3>Subtitle will go here if needed</h3 -->
							<form action="utente_mod.php" method="post" class="search_form general_form" style="margin-top: 10px">
								<!--[if !IE]>start fieldset<![endif]-->
								<fieldset>
									<!--[if !IE]>start forms<![endif]-->
									<div class="forms">
									<!--[if !IE]>start row<![endif]-->
									<div class="row"><label style="width: 120px">Tipologia utente:<small>*</small></label>
										<div class="inputs">
											<span class="input_wrapper blank" style="width: 250px">
												<select name="userType" style="width: 250px">
												<option value="">Scegli tipologia utente</option>
												<?php 
													$comuni = $UC->getTipologia();
													foreach($comuni AS $comune){
														if ($_REQUEST['userType'] == $comune['ID'])	
															echo '<option value="'.$comune['ID'].'" selected>'.stripslashes($comune['NOME']).'</option>';
														else
															echo '<option value="'.$comune['ID'].'">'.stripslashes($comune['NOME']).'</option>';
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
<?php 
if ($_POST['pulsante'] == "Cerca"){
	$utenti = $UC->cercaUtentiFromTypeID($_POST['userType']);
	if ($utenti){
		
?>
					<!--[if !IE]>start section<![endif]-->
					<div class="section table_section">
						<div class="section_inner">
							<div class="title_wrapper">
								<h2></h2>
							</div>
							<div class="section_content">
							
							<div  id="product_list">
							<!--[if !IE]>start table_wrapper<![endif]-->
							<div class="table_wrapper">
								<div class="table_wrapper_inner">
								<table cellpadding="0" cellspacing="0" width="100%">
									<tbody><tr>
										<th>ID</th>
										<th>Cognome</th>
										<th>Ragione Sociale</th>
										<th>Indirizzo</th>
										<th>Telefono</th>
                                                                                <th>E-mail</th>
										<th>Stato</th>
										<th>Azione</th>
									</tr><?php 
									$num = 2; 
									foreach($utenti AS $key=>$utente){
									 	if($key % $num) $row = "second"; else $row = "first";
									if ($utente['ABILITATO'] == 1) { $stato = "approved"; $testo = "Abilitato"; } else { $stato = "pending"; $testo = "Disabilitato"; }
									?>
									<tr class="<?php echo $row ?>">
										<td class="first_td" style="width: 26px;"><?php echo $utente['ID']?></td>
										<td style="font-weight: bold"><?php echo stripslashes($utente['COGNOME'])?></td>
										<td style="font-weight: bold"><?php echo stripslashes($utente['RAGSOC'])?></td>
										<td style="font-weight: bold"><?php echo $utente['INDIRIZZO']?></td>
										<td style="font-weight: bold"><?php echo $utente['TELEFONO']?></td>
                                                                                <td style="font-weight: bold"><?php echo $utente['EMAIL']?></td>
										<td id="stato<?php echo $utente['ID']?>"><span class="<?php echo $stato ?>"><a href="#" id="<?php echo $utente['ID']?>" class="abilitazione"><?php echo $testo ?></a></span></td>
										<td style="width: 160px;">
											<div class="actions_menu" style="width: 160px;">
												<ul>
													<li><a class="edit" href="utente_mod.php?task=modifica&id=<?php echo $utente['ID']?>&userType=<?php echo $_POST['userType']?>">modifica</a></li>
													<li><a class="delete" href="utente_mod.php?task=delete&id=<?php echo $utente['ID']?>&userType=<?php echo $_POST['userType']?>" style="width: 40px">cancella</a></li>
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
							
<?php 		
	
	}else{
		echo '<ul class="system_messages">';
			echo '<li class="red_message"><div class="red system_inner"><span class="ico"></span><strong class="system_title">Nessun utente per questa citt&agrave;</strong></div></li>';
		echo '</ul>';
		
	}	
}
?>


<?php 
if ($_GET['task'] == "modifica"){
	$utente = $UC->getUserById($_GET['id']);
	//print_r($utente);
?>
					<div class="section">
						<div class="section_inner">
							<div class="title_wrapper">
								<h2></h2>
							</div>
							<div class="section_content">
							<!-- h3>Subtitle will go here if needed</h3 -->
							<p>Modifica dati utente.</p>
							
							<form action="utente_mod.php" method="post" class="search_form general_form" style="margin-top: 10px">
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
														if ($tipologia['ID'] == $utente[0]['TYPE'])
															echo '<OPTION value="'.$tipologia['ID'].'" selected>'.stripslashes($tipologia['NOME']).'</OPTION>';
														else
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
											<span class="input_wrapper" style="width: 450px"><input class="text" name="ragionesociale" type="text" value="<?php echo stripslashes($utente[0]['RAGSOC'])?>" /></span>
										</div>
									</div>
									<div class="row">
										<label style="width: 120px;">Cognome & Nome:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="cognome" type="text" value="<?php echo stripslashes($utente[0]['COGNOME'])?>" /></span>
										</div>
									</div>
									<div class="row">
										<label style="width: 120px;">Indirizzo:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="indirizzo" type="text" value="<?php echo stripslashes($utente[0]['INDIRIZZO'])?>" /></span>
										</div>
									</div>
									<div class="row">
										<label style="width: 120px;">Provincia:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="provincia" type="text" value="<?php echo stripslashes($utente[0]['PROVINCIA'])?>" /></span>
										</div>
									</div>
									<div class="row">
										<label style="width: 120px;">Citt&agrave;:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="citta" type="text" value="<?php echo stripslashes($utente[0]['CITTA'])?>" /></span>
										</div>
									</div>
									<div class="row">
										<label style="width: 120px;">Telefono:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="telefono" type="text" value="<?php echo $utente[0]['TELEFONO']?>" /></span>
										</div>
									</div>
									<div class="row">
										<label style="width: 120px;">E-mail:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="email" type="text" value="<?php echo $utente[0]['EMAIL']?>" /></span>
										</div>
									</div>
									<div class="row">
										<label style="width: 120px;">Login:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="login" type="text" value="<?php echo $utente[0]['USER']?>" /></span>
										</div>
									</div>
									<div class="row">
										<label style="width: 120px;">Password:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="password" type="text" value="<?php echo $utente[0]['PASSWORD']?>" /></span>
										</div>
									</div>
									<div class="row">
										<label style="width: 120px;">Abilitato:</label>
										<?php if($utente[0]['ABILITATO'] == 0) $no = "checked"; else $si = "checked"; ?>
										<div class="inputs">
											<ul>
												<li><input class="radio" name="abilitato" value="1" type="radio" <?php echo $si?> /> SI</li>
												<li><input class="radio" name="abilitato" value="0" type="radio" <?php echo $no?> /> NO</li>
											</ul>
										</div>
									</div>
									<!--[if !IE]>end row<![endif]-->
									<input type="hidden" name="id" value="<?php echo $utente[0]['ID']?>" />
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




<?php 
	}
?>











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
