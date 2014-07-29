<?php 
include("../commonSetting.php");
If (($_SESSION['IsUserGood'] == False) || (!isset($_SESSION['user']))) {
	header("location: ../index.php?logout=0"); 
}

// Mi permette di prelevare il menù di sinistra
$mod = 1;

if($_POST['pulsante'] == "Memorizza"){
		$result = $CF->modifyCategoria($_POST);
		if($result == 0) print_r($result);
}

if($_GET['task'] == "delete"){
		settype($_GET['id'], "integer"); 
		$result = $CF->deleteCategoria($_GET['id']);
		if($result == 0) 
			print_r($CF->getErrors());
		else
			header("location: categorie_mod.php");
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
								<h2>Modifica Categoria</h2>
								<div style="float: right; padding-top: 12px; padding-right: 10px">[ <a href="configurazione.php">livello superiore</a> ]</div>
							</div>
							<div class="section_content">
							<!-- h3>Subtitle will go here if needed</h3 -->
							<p>
								Seleziona la categoria superiore, per modificare le sottocategorie.
							</p>
							
							<form action="categorie_mod.php" method="post" class="search_form general_form" style="margin-top: 10px">
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
													$alberghi = $CF->getCategorie("1");
													foreach($alberghi AS $albergo){
														if ($_REQUEST['albergo'] == $albergo['ID'])	
															echo '<option value="'.$albergo['ID'].'" selected>'.stripslashes($albergo['nome']).'</option>';
														else
															echo '<option value="'.$albergo['ID'].'">'.stripslashes($albergo['nome']).'</option>';
													}
												?>	
												</select>
											</span><?php echo $errori['albergo']?>
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
	$categorie = $CF->getCategoriaByParentID($_POST['categoria']);
	if ($categorie){
?>
					<!--[if !IE]>start section<![endif]-->
					<div class="section table_section">
						<div class="section_inner">
							<div class="title_wrapper">
								<h2>Modifica Categorie</h2>
							</div>
							<div class="section_content">
							
							<div  id="product_list">
							<!--[if !IE]>start table_wrapper<![endif]-->
							<div class="table_wrapper">
								<div class="table_wrapper_inner">
								<table cellpadding="0" cellspacing="0" width="100%">
									<tbody><tr>
										<th>ID</th>
										<th>Nome</th>
										<th>Ordine</th>
										<th>Stato</th>
										<th>Azione</th>
									</tr><?php 
									$num = 2; 
									foreach($categorie AS $key=>$categoria){
									 	if($key % $num) $row = "second"; else $row = "first";
										if ($categoria['abilitato'] == 1) { $stato = "approved"; $testo = "Abilitato"; } else { $stato = "pending"; $testo = "Disabilitato"; } 
									?>
									<tr class="<?php echo $row ?>">
										<td class="first_td" style="width: 26px;"><?php echo $categoria['ID']?></td>
										<td style="font-weight: bold"><?php echo stripslashes($categoria['nome'])?></td>
										<td style="font-weight: bold"><?php echo $categoria['ordine']?></td>
										<td><span class="<?php echo $stato ?>"><?php echo $testo ?></span></td>
										<td style="width: 160px;">
											<div class="actions_menu" style="width: 160px;">
												<ul>
													<li><a class="edit" href="categorie_mod.php?task=modifica&id=<?php echo $categoria['ID']?>">modifica</a></li>
													<li><a class="delete" href="categorie_mod.php?task=delete&id=<?php echo $categoria['ID']?>" style="width: 40px" onclick="return confirm('Sei sicuro di voler eliminare la categoria!');">cancella</a></li>
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
			echo '<li class="red_message"><div class="red system_inner"><span class="ico"></span><strong class="system_title">Nessuna sottocategoria presente</strong></div></li>';
		echo '</ul>';
		
	}	
}
?>

<?php if ($_GET['task'] == "modifica"){
	settype($_GET['id'], "integer"); 
	$categoria = $CF->getCategoriaById($_GET['id']);
	?>
					<!--[if !IE]>start section<![endif]-->
					<div class="section">
						<div class="section_inner">
							<div class="title_wrapper"><h2>Modifica Sezione</h2></div>
							<div class="section_content">
							<form action="categorie_mod.php" method="post" class="search_form general_form" style="margin-top: 10px">
								<!--[if !IE]>start fieldset<![endif]-->
								<fieldset>
									<!--[if !IE]>start forms<![endif]-->
									<div class="forms">
									<!--[if !IE]>start row<![endif]-->
									<div class="row"><label>Categoria superiore:<small>*</small></label>
										<div class="inputs">
											<span class="input_wrapper blank">
												<select name="parentID">
												<option value="">Scegli categoria</option>
												<?php 
													$tipologie = $CF->getCategorie("1");
													foreach($tipologie AS $tipologia){
														if ($tipologia['ID'] == $categoria[0]['parentID'])
															echo '<option value="'.$tipologia['ID'].'" selected>'.stripslashes($tipologia['nome']).'</option>';
														else
															echo '<option value="'.$tipologia['ID'].'">'.stripslashes($tipologia['nome']).'</option>';
													}
												?>	
												</select>
											</span><?php echo $errori['tipologia']?>
										</div>
									</div>
									<div class="row">
										<label>Nome:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="nome" type="text" value="<?php echo stripslashes($categoria[0]['nome'])?>" /></span>
										</div>
									</div>
									<div class="row">
										<label>Permalink:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="permalink" type="text" value="<?php echo stripslashes($categoria[0]['permalink'])?>" /></span>
											Non modificare nulla, viene gestito in automatico!
										</div>
									</div>
									<div class="row">
										<label>Descrizione:</label>
										<div class="inputs">
											<textarea style="width: 400px; height: 100px;" id="descrizione" name="descrizione"><?php echo stripslashes($categoria[0]['descrizione'])?></textarea>
											<script type="text/javascript" src="../jsLibs/nicEdit.js"></script>
											<script type="text/javascript">
											new nicEditor({iconsPath : '../jsLibs/nicEditorIcons.gif'}).panelInstance('descrizione');
											</script>
										</div>
									</div>
									<div class="row">
										<label>Ordine:</label>
										<div class="inputs">
											<span class="input_wrapper" style="width: 50px"><input class="text" name="ordine" type="text" value="<?php echo stripslashes($categoria[0]['ordine'])?>" /></span>
										</div>
									</div>
									<div class="row"><label>Abilitato:</label>
										<?php
										if($categoria[0]['abilitato'] == 0) $no = "checked"; else $si = "checked"; ?>
										<div class="inputs">
											<ul>
												<li><input class="radio" name="abilitato" value="1" type="radio" <?php echo $si?> /> SI</li>
												<li><input class="radio" name="abilitato" value="0" type="radio" <?php echo $no?> /> NO</li>
											</ul>
										</div>
									</div>
									<!--[if !IE]>end row<![endif]-->
									<input type="hidden" name="id" value="<?php echo $categoria[0]['ID']?>">
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
