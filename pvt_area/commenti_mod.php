<?php 
include("../commonSetting.php");
If (($_SESSION['IsUserGood'] == False) || (!isset($_SESSION['user']))) {
	header("location: ../index.php?logout=0"); 
}

// Mi permette di prelevare il menù di sinistra
$mod = 12;

if($_GET['task'] == "pubblica"){
		$result = $CNT->pubblicaCommento($_GET['id'],1);
		if($result == 0) 
			print_r($result);
		else 
			header("location: commenti_mod.php?categoria=".$_GET['categoria']);
}

if($_GET['task'] == "oscura"){
		$result = $CNT->pubblicaCommento($_GET['id'],0);
		if($result == 0) 
			print_r($result);
		else 
			header("location: commenti_mod.php?categoria=".$_GET['categoria']);
}


if($_GET['task'] == "delete"){
		settype($_GET['id'], "integer"); 
		$result = $CNT->deleteCommento($_GET['id']);
		if($result == 0) 
			print_r($CNT->getErrors());
		else
			header("location: commenti_mod.php?categoria=".$_GET['categoria']);
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

					<div class="section">
						<div class="section_inner">
							<div class="title_wrapper">
								<h2>Gestione commenti</h2>
							</div>
							<div class="section_content">
							<!-- h3>Subtitle will go here if needed</h3 -->
							<form action="commenti_mod.php" method="post" class="search_form general_form" style="margin-top: 10px">
								<!--[if !IE]>start fieldset<![endif]-->
								<fieldset>
									<!--[if !IE]>start forms<![endif]-->
									<div class="forms">
									<!--[if !IE]>start row<![endif]-->
									<div class="row"><label style="width: 120px">Sezione:<small>*</small></label>
										<div class="inputs">
											<span class="input_wrapper blank" style="width: 250px">
												<select name="categoria" style="width: 250px">
  												<option value="">Scegli sezione</option>
  												<?php 
  												foreach ($CNT->sezioni AS $key=>&$categoria){
  														if ($categoria){
  															if ($key == $_POST['categoria'])
  																echo '<option value="'.$key.'" selected>'.$categoria.'</option>';
  															else
  																echo '<option value="'.$key.'">'.$categoria.'</option>';
  														}
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




					<!--[if !IE]>start section<![endif]-->
					<div class="section table_section">
						<div class="section_inner">
							<div class="title_wrapper">
								<h2>Ultimi commenti non pubblicati</h2>
							</div>
							<div class="section_content">
							
							<div  id="product_list">
							<!--[if !IE]>start table_wrapper<![endif]-->
							<div class="table_wrapper">
								<div class="table_wrapper_inner">
								<table cellpadding="0" cellspacing="0" width="100%">
									<tbody><tr>
										<th>Sezione</th>
										<th>Oggetto</th>
										<th>Nome Utente</th>
										<th>Commento</th>
										<th>Stato</th>
										<th>Azione</th>
									</tr><?php 
									if ($_POST['categoria']){
										$filtri[] = 'sezioneID="'.$_POST['categoria'].'"';
										$limitF = "";
										$orderF = "data DESC";  
										
									}else{
										$filtri[] = 'pubblicato="0"';
										$limitF = "LIMIT 0,20";
										$orderF = "ID DESC";  
									} 
									
									$news = $CNT->getCommentiBACK($filtri, $limitF, $orderF);
									$num = 2; 
									foreach($news AS $key=>$new){
									 	if($key % $num) $row = "second"; else $row = "first";
										if ($new['pubblicato'] == 1) { $stato = "approved"; $testo = "Abilitato"; } else { $stato = "pending"; $testo = "Disabilitato"; }
										$titolo = $CNT->getNameOggetto($new['sezioneID'],$new['oggettoID']);
										$azione = ($new['pubblicato'] == 1)? "oscura":"pubblica";
									?>
									<tr class="<?php echo $row ?>">
										<td class="first_td" style="width: 26px;"><?php echo ucfirst($CNT->sezioni[$new['sezioneID']])?></td>
										<td style="font-weight: bold"><?php echo stripslashes($titolo[0]['nome'])?></td>
										<td ><?php echo stripslashes($new['nome'])?><br /><?php echo stripslashes($new['email'])?></td>
										<td><?php echo stripslashes($new['commento'])?></td>
										<td><span class="<?php echo $stato ?>"><?php echo $testo ?></span></td>
										<td style="width: 160px;">
											<div class="actions_menu" style="width: 160px;">
												<ul>
													<li><a class="edit" href="commenti_mod.php?task=<?php echo $azione?>&id=<?php echo $new['ID']?>&categoria=<?php echo $_POST['categoria']?>"><?php echo $azione?></a></li>
													<li><a class="delete" href="commenti_mod.php?task=delete&id=<?php echo $new['ID']?>&categoria=<?php echo $_POST['categoria']?>" onclick="return confirm('Sei sicuro di voler eliminare il commento!');" style="width: 40px">cancella</a></li>
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
