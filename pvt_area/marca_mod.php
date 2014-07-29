<?php 
include("../commonSetting.php");
If (($_SESSION['IsUserGood'] == False) || (!isset($_SESSION['user']))) {
	header("location: ../index.php?logout=0"); 
}

// Mi permette di prelevare il menù di sinistra
$mod = 11;

if($_POST['pulsante'] == "Memorizza"){
		$result = $PRD->modifyMarca($_POST);
		if($result == 0) 
			print_r($result);
		else 
			header("location: marca_mod.php");
}

if($_GET['task'] == "delete"){
		settype($_GET['id'], "integer"); 
		$result = $PRD->deleteMarca($_GET['id']);
		if($result == 0) 
			print_r($PRD->getErrors());
		else
			header("location: marca_mod.php");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $SETTING->nome_dominio ?> - <?php echo $SETTING->sottotitolo ?></title>
<meta http-equiv="pragma" content="no-cache"> 
<meta http-equiv="Expires" content="-1"> 
<meta http-equiv="no-cache"> 
<meta http-equiv="cache-Control" content="no-cache"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="it" />
<meta name="Owner" content="I-factory" /> 
<meta name="Author" content="I-factory" />  
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

<?php if (!isset($_GET['task'])){ ?>
					<!--[if !IE]>start section<![endif]-->
					<div class="section table_section">
						<div class="section_inner">
							<div class="title_wrapper">
								<h2>Modifica Marca</h2>
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
										<th>Stato</th>
										<th>Azione</th>
									</tr><?php 
									$marche = $PRD->getMarca("");
									$num = 2; 
									foreach($marche AS $key=>$marca){
									 	if($key % $num) $row = "second"; else $row = "first";
										if ($marca['abilitato'] == 1) { $stato = "approved"; $testo = "Abilitato"; } else { $stato = "pending"; $testo = "Disabilitato"; } 
									?>
									<tr class="<?php echo $row ?>">
										<td class="first_td" style="width: 26px;"><?php echo $marca['ID']?></td>
										<td style="font-weight: bold"><?php echo stripslashes($marca['nome'])?></td>
										<td><span class="<?php echo $stato ?>"><?php echo $testo ?></span></td>
										<td style="width: 160px;">
											<div class="actions_menu" style="width: 160px;">
												<ul>
													<li><a class="edit" href="marca_mod.php?task=modifica&id=<?php echo $marca['ID']?>">modifica</a></li>
													<li><a class="delete" href="marca_mod.php?task=delete&id=<?php echo $marca['ID']?>" style="width: 40px">cancella</a></li>
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
	$marca = $PRD->getMarcaById($_GET['id']);
	?>
					<!--[if !IE]>start section<![endif]-->
					<div class="section">
						<div class="section_inner">
							<div class="title_wrapper"><h2>Modifica Marca Prodotto</h2></div>
							<div class="section_content">
							<form action="marca_mod.php" method="post" class="search_form general_form" style="margin-top: 10px">
								<!--[if !IE]>start fieldset<![endif]-->
								<fieldset>
									<!--[if !IE]>start forms<![endif]-->
									<div class="forms">
									
									<!--[if !IE]>start row<![endif]-->
									<div class="row">
										<label>Nome:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="nome" type="text" value="<?php echo stripslashes($marca[0]['nome'])?>" /></span>
										</div>
									</div>
									<div class="row">
										<label>Permalink:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="permalink" type="text" value="<?php echo stripslashes($marca[0]['permalink'])?>" /></span>
											Non modificare nulla, viene gestito in automatico!
										</div>
									</div>
									<div class="row">
										<label>Descrizione:</label>
										<div class="inputs">
											<textarea style="width: 400px; height: 100px;" id="descrizione" name="descrizione"><?php echo stripslashes($marca[0]['descrizione'])?></textarea>
											<script type="text/javascript" src="../jsLibs/nicEdit.js"></script>
											<script type="text/javascript">
											new nicEditor({iconsPath : '../jsLibs/nicEditorIcons.gif'}).panelInstance('descrizione');
											</script>
										</div>
									</div>
									<div class="row">
										<label>Link:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="link" type="text" value="<?php echo stripslashes($marca[0]['link'])?>" /></span>
										</div>
									</div>
									<div class="row"><label>Abilitato:</label>
										<?php
										if($marca[0]['abilitato'] == 0) $no = "checked"; else $si = "checked"; ?>
										<div class="inputs">
											<ul>
												<li><input class="radio" name="abilitato" value="1" type="radio" <?php echo $si?> /> SI</li>
												<li><input class="radio" name="abilitato" value="0" type="radio" <?php echo $no?> /> NO</li>
											</ul>
										</div>
									</div>
									<!--[if !IE]>end row<![endif]-->
									<input type="hidden" name="id" value="<?php echo $marca[0]['ID']?>">
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
