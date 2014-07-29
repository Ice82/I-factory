<?php 
include("../commonSetting.php");

If (($_SESSION['IsUserGood'] == False) || (!isset($_SESSION['user']))) {
	header("location: ../index.php?logout=0"); 
}

$offertaID = $_REQUEST['offerta'];
//echo $offertaID;
$offerta = $PRD->getOffertaByID($offertaID);
$categoria = $CF->getCategoriaById($offerta['offerta']['categoryID']);
//$HP->printR($offerta);
// Mi permette di prelevare il menù di sinistra
$mod = 11;

if($_POST['pulsante'] == "Inserisci"){
	$errori = array();
	if ( !isset($_POST['categoria']) || ($_POST['categoria'] == "")) $errori['categoria'] = '<span class="system negative">Scegli categoria</span>';
	if ( !isset($_POST['prodotto']) || ($_POST['prodotto'] == "")) $errori['prodotto'] = '<span class="system negative">Scegli prodotto</span>';
	if ( !isset($_POST['quantita']) || ($_POST['quantita'] == "")) $errori['quantita'] = '<span class="system negative">Inserisci quantita</span>';
	
	if (count($errori)<1){
		$result = $PRD->addProdottoOfferta($_POST);
		if($result == 1) 
			header("location: offerta_prdAdd.php?offerta=".$offertaID);
		else
			$HP->printR($PRD->getErrors());
	}
}

if ($_GET['task'] == "delete"){
	settype($_GET['id'], "integer"); 
	$result = $PRD->deletePrdOfferta($_GET['id']);
	if($result == 0) 
		print_r($PRD->getErrors());
	else
		header("location: offerta_prdAdd.php?offerta=".$offertaID);
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

$(document).ready(function(){
	$('#categoria').change(function(){
    	sendAjax("../ajaxRequest/queries.php","","json","5000","task=getProdottiFromCategoriaID&categoriaID="+$(this).val()+"","cerca","popolaSelectProdotti(result)","","0");
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
						echo '<li class="red_message"><div class="red system_inner"><span class="ico"></span><strong class="system_title">Errore nell\'inserimento del prodotto all\'offerta</strong></div></li>';
					echo '</ul>';
				}
			?>	
			
					<!--[if !IE]>start section<![endif]-->
					<div class="section table_section">
						<div class="section_inner">
							<div class="title_wrapper">
								<h2>Prodotti dell'offerta</h2>
							</div>
							<div class="section_content">
							
							<div  id="product_list">
							<!--[if !IE]>start table_wrapper<![endif]-->
							<div class="table_wrapper">
								<div class="table_wrapper_inner">
								<table cellpadding="0" cellspacing="0" width="100%">
									<tbody><tr>
										<th>Linea</th>
										<th>Nome</th>
										<th>Q.ta</th>
										<th>Azione</th>
									</tr><?php 
									$news = $PRD->getProdottoFromOffertaID($offertaID);
									$num = 2; 
									foreach($news AS $key=>$new){
									 	if($key % $num) $row = "second"; else $row = "first";
									 ?>
									<tr class="<?php echo $row ?>">
										<td style="font-weight: bold"><?php echo stripslashes($new['nomeMARCA'])?></td>
										<td style="font-weight: bold"><?php echo stripslashes($new['nome'])?></td>
										<td><?php echo $new['qta']?></td>
										<td style="width: 160px;">
											<div class="actions_menu" style="width: 160px;">
												<ul>
													<li><a class="delete" href="offerta_prdAdd.php?task=delete&id=<?php echo $new['idPrd']?>&offerta=<?php echo $offertaID?>" onclick="return confirm('Sei sicuro di voler eliminare il prodotto dall\'offerta?');" style="width: 40px">cancella</a></li>
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
			
			
					<!--[if !IE]>start section<![endif]-->
					<div class="section">
						<div class="section_inner">
							<div class="title_wrapper">
								<h2>Aggiungi prodotti all'offerta </h2>
							</div>
							<div class="section_content">
							<!-- h3>Subtitle will go here if needed</h3 -->
							<p>
								Nome offerta: <strong><?php echo stripslashes($offerta['offerta']['titolo'])?></strong><br />
								Periodo: <strong><?php echo $HP->data_it($offerta['offerta']['attivazione'])." - ".$HP->data_it($offerta['offerta']['scadenza'])?></strong><br />
								Categoria: <strong><?php echo stripslashes($categoria[0]['nome'])?></strong><br />
							</p>
							<form action="offerta_prdAdd.php" method="post" class="search_form general_form" style="margin-top: 10px" enctype="multipart/form-data">
								<!--[if !IE]>start fieldset<![endif]-->
								<fieldset>
									<!--[if !IE]>start forms<![endif]-->
									<div class="forms">
									<!--[if !IE]>start row<![endif]-->
									<div class="row"><label>Categoria:<small>*</small></label>
										<div class="inputs">
											<span class="input_wrapper blank" style="width: 250px">
												<select name="categoria" id="categoria" style="width: 250px">
												<option value="">Scegli categoria</option>
												<?php 
													$categorie = $CF->getCategoriaByParentID($offerta['offerta']['categoryID'],1);
													
													foreach($categorie AS $categoria){
														echo '<option value="'.$categoria['ID'].'">'.stripslashes($categoria['nome']).'</option>';
													}
												?>	
												</select>
											</span><?php echo $errori['categoria']?>
										</div>
									</div>
									<div class="row"><label>Prodotto:<small>*</small></label>
										<div class="inputs">
											<span class="input_wrapper blank" style="width: 250px">
												<select name="prodotto" id="prodotto" style="width: 250px">
												<option value="">Scegli prodotto</option>
												</select>
											</span><?php echo $errori['prodotto']?>
										</div>
									</div>
									<div class="row">
										<label>Quantit&agrave;:</label>
										<div class="inputs">
											<span class="input_wrapper" style="width: 50px;"><input class="text" name="quantita" type="text" /></span>
											<?php echo $errori['quantita']?>
										</div>
									</div>
									<!--[if !IE]>end row<![endif]-->
									<input type="hidden" name="offerta" value="<?php echo $offertaID?>" />
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
