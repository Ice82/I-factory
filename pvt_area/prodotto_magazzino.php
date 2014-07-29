<?php 
include("../commonSetting.php");

If (($_SESSION['IsUserGood'] == False) || (!isset($_SESSION['user']))) {
	header("location: ../index.php?logout=0"); 
}

// Mi permette di prelevare il menù di sinistra
$mod = 11;

$prodottoID = $_REQUEST['prodotto'];
$prodotto = $PRD->getProdottoById($prodottoID);
							

if($_POST['pulsante'] == "Inserisci"){
	$errori = array();
	if ( !isset($_POST['taglia']) || ($_POST['taglia'] == "")) $errori['taglia'] = '<span class="system negative">Scegli taglia</span>';
	if (count($errori)<1){
		$result = $PRD->addMagazzino($_POST);
		if($result == 1) 
			header("location: prodotto_magazzino.php?prodotto=".$_POST['prodotto']);
		else
			$HP->printR($PRD->getErrors());
	}
}

if($_GET['task'] == "delete"){
		settype($_GET['id'], "integer"); 
		$result = $PRD->deleteMagazzino($_GET['id']);
		if($result == 0) 
			print_r($CNT->getErrors());
		else
			header("location: prodotto_magazzino.php?prodotto=".$prodottoID);
}

if($_POST['pulsante'] == "Memorizza"){
		$result = $PRD->modifyMagazzino($_POST);
		if($result) 
			print_r($result);
		else
			header("location: prodotto_magazzino.php?prodotto=".$prodottoID);
			
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
			<?php 
				if(count($errori)>0){
					echo '<ul class="system_messages">';
						echo '<li class="red_message"><div class="red system_inner"><span class="ico"></span><strong class="system_title">Errore nell\'inserimento del prodotto</strong></div></li>';
					echo '</ul>';
				}
			?>	
			<?php 
				if($_GET['insert'] == "ok"){
					echo '<ul class="system_messages">';
						echo '<li class="yellow_message"><div class="yellow system_inner"><span class="ico"></span><strong class="system_title">Prodotto inserito correttamente</strong></div></li>';
					echo '</ul>';
				}
			?>
					<!--[if !IE]>start section<![endif]-->
					<div class="section">
						<div class="section_inner">
							<div class="title_wrapper">
								<h2>Dati Magazzino Prodotto</h2>
							</div>
							<div class="section_content">
							<!-- h3>Subtitle will go here if needed</h3 -->
							<p>
								Nome Prodotto: <strong><?php echo stripslashes($prodotto[0]['nome'])?></strong><br />
								Prezzo: <strong><?php echo stripslashes($prodotto[0]['prezzo'])?></strong><br />
							</p>
							<form action="prodotto_magazzino.php" method="post" class="search_form general_form" style="margin-top: 10px">
								<!--[if !IE]>start fieldset<![endif]-->
								<fieldset>
									<!--[if !IE]>start forms<![endif]-->
									<div class="forms">
									<!--[if !IE]>start row<![endif]-->
									<div class="row"><label>Taglia:<small>*</small></label>
										<div class="inputs">
											<span class="input_wrapper blank" style="width: 250px">
												<select name="taglia">
  												<option value="">Scegli taglia</option>
  												<?php 
  												$taglie = $PRD->getTaglie();
  												foreach ($taglie AS $taglia){
  														echo '<option value="'.$taglia['ID'].'">'.$taglia['nome'].'</option>';
  													}
  												?>
												</select>
											</span>
										</div>
										<?php echo $errori['taglia']?>
									</div>
									<div class="row">
										<label>Colore:<small>*</small></label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="colore" type="text" /></span>
										</div>
									</div>
									<div class="row">
										<label>Q.ta:</label>
										<div class="inputs">
											<span class="input_wrapper" style="width: 30px;"><input class="text" name="qta" type="text" /></span>
										</div>
									</div>
									<!--[if !IE]>end row<![endif]-->
									<!--[if !IE]>start row<![endif]-->
									<input type="hidden" name="prodotto" value="<?php echo $prodottoID?>" />
									<div class="row">
										<div class="buttons">
											<ul>
												<li><span class="button send_form_btn"><span><span>Inserisci</span></span><input name="pulsante" type="submit" value="Inserisci" /></span></li>
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

<?php if($_GET['task']!="modifica"){?>
					<!--[if !IE]>start section<![endif]-->
					<div class="section table_section">
						<div class="section_inner">
							<div class="title_wrapper">
								<h2>Lista Magazzino</h2>
							</div>
							<div class="section_content">
							
							<div  id="product_list">
							<!--[if !IE]>start table_wrapper<![endif]-->
							<div class="table_wrapper">
								<div class="table_wrapper_inner">
								<table cellpadding="0" cellspacing="0" width="100%">
									<tbody><tr>
										<th>Taglia</th>
										<th>Colore</th>
										<th>Q.ta</th>
										<th>Azione</th>
									</tr><?php 
									$magazzini = $PRD->getListMagazzino($prodottoID);
									$num = 2; 
									if ($magazzini){
									foreach($magazzini AS $key=>$magazzino){
									 	if($key % $num) $row = "second"; else $row = "first";
									?>
									<tr class="<?php echo $row ?>">
										<td class="first_td"><?php echo $magazzino['taglia']?></td>
										<td><?php echo stripslashes($magazzino['colore'])?></td>
										<td style="font-weight: bold"><?php echo stripslashes($magazzino['qta'])?></td>
										<td style="width: 160px;">
											<div class="actions_menu" style="width: 160px;">
												<ul>
													<li><a class="edit" href="prodotto_magazzino.php?task=modifica&prodotto=<?php echo $prodottoID?>&id=<?php echo $magazzino['ID']?>">modifica</a></li>
													<li><a class="delete" href="prodotto_magazzino.php?task=delete&prodotto=<?php echo $prodottoID?>&id=<?php echo $magazzino['ID']?>" style="width: 40px">cancella</a></li>
												</ul>
											</div>
										</td>
									</tr>
								<?php } }?>
								</tbody></table>
								</div>
							</div>
							<!--[if !IE]>end table_wrapper<![endif]-->
							</div>
							</div>
						</div>
					</div>
					<!--[if !IE]>end section<![endif]-->
<?php }?>
	

<?php if ($_GET['task'] == "modifica"){
	settype($_GET['id'], "integer"); 
	$magaz = $PRD->getMagazzinoById($_GET['id']);
	//$HP->printR($magaz);
	?>
					<div class="section">
						<div class="section_inner">
							<div class="title_wrapper">
								<h2>Modifica Dato Magazzino</h2>
							</div>
							<div class="section_content">
							<!-- h3>Subtitle will go here if needed</h3 -->
							<form action="prodotto_magazzino.php" method="post" class="search_form general_form" style="margin-top: 10px">
								<!--[if !IE]>start fieldset<![endif]-->
								<fieldset>
									<!--[if !IE]>start forms<![endif]-->
									<div class="forms">
									<!--[if !IE]>start row<![endif]-->
									<div class="row"><label>Taglia:<small>*</small></label>
										<div class="inputs">
											<span class="input_wrapper blank" style="width: 250px">
												<select name="taglia">
  												<option value="">Scegli taglia</option>
  												<?php 
  												$taglie = $PRD->getTaglie();
  												foreach ($taglie AS $taglia){
  														if ($taglia['ID'] == $magaz[0]['tagliaID'])
  															echo '<option value="'.$taglia['ID'].'" selected>'.$taglia['nome'].'</option>';
  														else
  															echo '<option value="'.$taglia['ID'].'">'.$taglia['nome'].'</option>';
  													}
  												?>
												</select>
											</span>
										</div>
									</div>
									<div class="row">
										<label>Colore:</label>
										<div class="inputs">
											<span class="input_wrapper"><input class="text" name="colore" value="<?php echo stripslashes($magaz[0]['colore'])?>" type="text" /></span>
										</div>
									</div>
									<div class="row">
										<label>Q.ta:</label>
										<div class="inputs">
											<span class="input_wrapper" style="width: 30px;"><input class="text" name="qta" value="<?php echo $magaz[0]['qta']?>" type="text" /></span>
										</div>
									</div>
									<!--[if !IE]>end row<![endif]-->
									<!--[if !IE]>start row<![endif]-->
									<input type="hidden" name="prodotto" value="<?php echo $prodottoID?>" />
									<input type="hidden" name="id" value="<?php echo $_GET['id']?>" />
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
