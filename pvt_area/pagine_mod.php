<?php 
include("../commonSetting.php");
If (($_SESSION['IsUserGood'] == False) || (!isset($_SESSION['user']))) {
	header("location: ../index.php?logout=0"); 
}

// Mi permette di prelevare il menù di sinistra
$mod = 6;

if($_POST['pulsante'] == "Memorizza"){
		$result = $AD->modifyPagina($_POST);
		if($result) print_r($result);
}

if($_GET['task'] == "delete"){
		settype($_GET['id'], "integer"); 
		$result = $AD->deletePagina($_GET['id']);
		if($result == 0) 
			print_r($AD->getErrors());
		else
			header("location: pagine_mod.php");
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

<?php if (!isset($_GET['task'])){ ?>
					<!--[if !IE]>start section<![endif]-->
					<div class="section table_section">
						<div class="section_inner">
							<div class="title_wrapper">
								<h2>Modifica Pagine</h2>
							</div>
							<div class="section_content">
							
							<div  id="product_list">
							<!--[if !IE]>start table_wrapper<![endif]-->
							<div class="table_wrapper">
								<div class="table_wrapper_inner">
								<table cellpadding="0" cellspacing="0" width="100%">
									<tbody><tr>
										<th>Modulo</th>
										<th>Sezione</th>
										<th>Nome Pagina</th>
										<th>Azione</th>
									</tr><?php 
									$pagine = $AD->getPagine();
									$num = 2; 
									foreach($pagine AS $key=>$pagina){
									 	if($key % $num) $row = "second"; else $row = "first";
									?>
									<tr class="<?php echo $row ?>">
										<td><?php echo stripslashes($pagina['MODULO'])?></td>
										<td><?php echo stripslashes($pagina['SEZIONE'])?></td>
										<td><?php echo stripslashes($pagina['NOME'])?></td>
										<td style="width: 160px;">
											<div class="actions_menu" style="width: 160px;">
												<ul>
													<li><a class="edit" href="pagine_mod.php?task=modifica&id=<?php echo $pagina['ID']?>">modifica</a></li>
													<li><a class="delete" href="pagine_mod.php?task=delete&id=<?php echo $pagina['ID']?>" style="width: 40px">cancella</a></li>
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
	$pagina = $AD->getPaginaById($_GET['id']);
	?>
					<!--[if !IE]>start section<![endif]-->
					<div class="section">
						<div class="section_inner">
							<div class="title_wrapper"><h2>Modifica Pagina</h2></div>
							<div class="section_content">
							<form action="pagine_mod.php" method="post" class="search_form general_form" style="margin-top: 10px">
								<!--[if !IE]>start fieldset<![endif]-->
								<fieldset>
									<!--[if !IE]>start forms<![endif]-->
									<div class="forms">
									<!--[if !IE]>start row<![endif]-->
									<div class="row">
										<label>Modulo:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="modulo" type="text" value="<?php echo stripslashes($pagina[0]['MODULO'])?>" readonly /></span>
										</div>
									</div>
									<div class="row">
										<label>Sezione:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="sezione" type="text" value="<?php echo stripslashes($pagina[0]['SEZIONE'])?>" readonly /></span>
										</div>
									</div>
									<div class="row">
										<label>Nome:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="nome" type="text" value="<?php echo stripslashes($pagina[0]['NOME'])?>" /></span>
										</div>
									</div>
									<div class="row">
										<label>File:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="file" type="text" value="<?php echo stripslashes($pagina[0]['FILE'])?>" /></span>
										</div>
									</div>
									<!--[if !IE]>end row<![endif]-->
									<input type="hidden" name="id" value="<?php echo $pagina[0]['ID']?>">
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
